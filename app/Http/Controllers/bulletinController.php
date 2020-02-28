<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\composemessage;
use Auth;
use App\Schedule;
use App\ActivityLog;


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
    public function defsched() {
    
        $viewsched = \DB::table('schedule')
        ->orderBy('id','DESC')
        ->get();
         
       
        return view('Bulletin.schedule',compact('viewsched'));

    }
    public function makesched() {
        
       
       
        return view('Bulletin.defschedule');

    }
      public function createSchedule() {

        $trans = new Schedule;
        $trans->date = request()->get('date');
        $trans->month= request()->get('month');
        $trans->timestart = request()->get('timestart');
        $trans->timeend = request()->get('timeend');
        $trans->fullname = request()->get('fullname');
        $trans->venue = request()->get('venue');
        $trans->user_id = Auth::user()->id;
        $trans->save();
        $log = new ActivityLog;
        $log->notification_message = Auth::user()->name." Posted a Schedule for defense";
        $log->user_id = Auth::user()->id;
        $log->save();
        return redirect('/make-schedule');

    }


}
