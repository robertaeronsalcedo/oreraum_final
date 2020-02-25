<?php

namespace App\Http\Controllers\manuscript;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Manuscripts;
use Auth;
use App\User;
use App\ActivityLog;
use Carbon\Carbon;

class ManuscriptController extends Controller
{
     public function index() {   
        $title = Manuscripts::where('id',request()->get('id'))->first();
        return view('Submission.view-pdf',compact('title'));
    }


    public function getAnnotation($id) {
        return Manuscripts::where('id',$id)->get();
    }

    public function store() {
    
        $trans = Manuscripts::find(request()->get('id'));
        $trans->annotation = request()->get('annotation');
        $trans->evaluation = request()->get('evaluation');
        $trans->save();

        $getid = Manuscripts::where('id',request()->get('id'))->get();

        $trans = new ActivityLog;
        $trans->notification_message = Auth::user()->name ." Evaluated ".$getid[0]->name;
        $trans->user_id = $getid[0]->user_id;
        $trans->save();

        return response()->json([[
                    "success"   => true
                    ]]);
    }

    public function assignChecker() {

        $trans = Manuscripts::find(request()->get('id'));
        $trans->code = request()->get('email');
        $trans->save();

        $getid = Manuscripts::where('id',request()->get('id'))->get();
        $getuser = User::wherE('email',request()->get('email'))->get();

        $trans = new ActivityLog;
        $trans->notification_message = Auth::user()->name ." Assign you as checker ". $getid[0]->name;
        $trans->user_id = $getuser[0]->id;
        $trans->save();

        return response()->json([[
                    "success"   => true,
                    "user_id"   =>  $getuser[0]->id
                    ]]);
    }
}
