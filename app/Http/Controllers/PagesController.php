<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // use MojaSMS;

    public function index(){

        return view('welcome');
        
    }
}