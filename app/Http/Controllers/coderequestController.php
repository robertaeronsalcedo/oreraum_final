<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class coderequestController extends Controller
{
    public function index()
    {
      
      
        return view('coderequest.coderequest');
    }
}
