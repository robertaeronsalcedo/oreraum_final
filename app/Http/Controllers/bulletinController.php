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
        $id = Auth::User()->id;
        $bulletin = User::all();
        $compose= composemessage::where('user_id','=',$id)->get();
       
        return view('Bulletin.bulletin',compact('compose'));
    }
}
