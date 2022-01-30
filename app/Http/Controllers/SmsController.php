<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;
use App\Traits\SMS\MojaSMS;

class SmsController extends Controller
{
    use MojaSMS;

    public function fetchAllSms()
    {

        $allSms = Sms::latest('id')
            ->get()
            ->map(function ($sms) {
                return [
                    'id' => $sms->id,
                    'phone' => $sms->phone,
                    'message' => $sms->message,
                    'status' => $sms->status,
                    'created_at' => \Carbon\Carbon::parse($sms->created_at)->toDateTimeString(),
                    'updated_at' =>  \Carbon\Carbon::parse($sms->updated_at)->toDateTimeString(),
                ];
            });

        return response()->json([
            'data' => $allSms,
            'status' => 200
        ]);
    }


    public function sendSingleSms(Request $request)
    {


        $phone = $request->input('phone');
        $message = $request->input('message');

        $sms = Sms::create([
            'phone' => $phone,
            'message' => $message,
            'status' => 'pending',
        ]);

        $response = $this->sendMojaGateSingleSMS($phone, $message, $sms->id);

        if ($response->status == 'Success') {

            Sms::where('id', $sms->id)->update(['status' => 'sent']);

            return response()->json([
                'data' => $response,
                'status' => 200
            ]);
        } else {
            Sms::where('id', $sms->id)->update(['status' => 'failed']);

            return response()->json([
                'status_code' => $response->status_code,
                'status' => 'Failed'
            ]);
        }
    }


    public function sendBulkSms(Request $request)
    {

        $input = $request->input();

        $latestTimestamp = null;

        $sms = Sms::insert(
            $input
        );

        if ($sms) {
            $latestTimestamp = Sms::latest()->first()->created_at;
        }

        $response = $this->sendMojaGateBulkSMS($input);

        if ($response->status == 'Success') {

            return response()->json([
                'data' => $response,
                'status' => 200
            ]);
        } else {
            if ($latestTimestamp !== null) {
                Sms::where('created_at', $latestTimestamp)->update(['status' => 'failed']);
            }
            return response()->json([
                'status_code' => $response->status_code,
                'status' => 'Failed'
            ]);
        }
    }



    public function getSmsbalance(){

        $response = $this->getMojaGateSmsBalance();
        
        if ($response->status == 'Success') {

            return response()->json([
                'data' => $response,
                'status' => 200
            ]);
        } else {
            
            return response()->json([
                'status_code' => $response->status_code,
                'status' => 'Failed'
            ]);
        }

    }
}
