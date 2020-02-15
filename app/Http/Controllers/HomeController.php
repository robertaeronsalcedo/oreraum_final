<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manuscripts;
use Auth;

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
        $countpdfsubmitted = Manuscripts::where('user_id',Auth::user()->id)->count();
        $countpdfrevised = Manuscripts::whereNotNull('annotation')->where('user_id',Auth::user()->id)->count();

        return view('home',compact('countpdfsubmitted','countpdfrevised'));
    }
}
