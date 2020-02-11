<?php

namespace App\Http\Controllers;
use App\code_request;
use Auth;
use User;
use Illuminate\Http\Request;

class coderequestController extends Controller
{
    public function index()
    {
      
      
        return view('coderequest.coderequest');
    }
   
    public function post(Request $request) {

        $coderequest= new code_request;
        $coderequest->code= $request->code;
        $coderequest->user_id = Auth::User()->id;
        $coderequest->save();
        return "success";
    }
 
}
