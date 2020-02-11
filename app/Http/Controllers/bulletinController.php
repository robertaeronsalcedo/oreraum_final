<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\composemessage;
use Auth;



class bulletinController extends Controller
{
    public function index()
    {
      
        $compose = \DB::table('composemessage')
        ->join('users','user_id','=','users.id')
        ->orderBy('message_id','DESC')
        ->get();

         
       
        return view('Bulletin.bulletin',compact('compose'));
        
    }
    public function delete_message()
    {
        $compose=composemessage::find()->message_id; 
        $compose->delete();
        return "success!";
       
    }


}
