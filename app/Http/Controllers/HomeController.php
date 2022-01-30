<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function getBalance(){

        $smsDetails = $this->getSmsBalance();
        
    }
}
