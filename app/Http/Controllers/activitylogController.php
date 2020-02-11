<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class activitylogController extends Controller
{
    public function index()
    {
      
        $compose = \DB::table('activity_log')
        ->join('users','user_id','=','users.id')
        ->orderBy('id','DESC')
        ->get();

         
       
        return view('Bulletin.bulletin',compact('compose'));
        
    }
}
