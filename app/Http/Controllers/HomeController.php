<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manuscripts;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = Auth::user()->email;
        $countpdfsubmitted = Manuscripts::where('user_id',Auth::user()->id)->count();
        $countpdfrevised = Manuscripts::whereNotNull('annotation')->where('user_id',Auth::user()->id)->count();
        $countpdfreceived = Manuscripts::whereNotNull('annotation')->where('user_id',Auth::user()->id)->count();
        $countadvisers = User::where('user_type','=', "Adviser")->count();
        $countstudents = User::where('user_type','=', "Student")->count();
        $countcommittee = User::where('user_type','=', "Committee")->count();
        $countpdf = Manuscripts::where('code',Auth::user()->email)->count();

        return view('home',compact('countpdfsubmitted','countpdfrevised','countadvisers','countstudents','countcommittee','countpdf'));
    }

}
