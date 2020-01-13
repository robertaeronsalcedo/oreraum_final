<?php

namespace App\Http\Controllers;
use \App\composemessage;
use Illuminate\Http\Request;
use Auth;

class composeController extends Controller
{
    public function index()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
      
        return view('Compose.compose');
    }
    
    public function post(Request $request) {

        $compose= new composemessage;
        $compose->message= $request->message;
        $compose->user_id = Auth::User()->id;
        $compose->save();
        return "success";
    }

}
