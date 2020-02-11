<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatmessageController extends Controller
{
    public function index()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
      
        return view('chat_box.Chat_Message');
    }
}
