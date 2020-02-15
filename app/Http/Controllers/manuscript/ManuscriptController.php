<?php

namespace App\Http\Controllers\manuscript;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Manuscripts;
use Auth;
use App\User;
use App\ActivityLog;

class ManuscriptController extends Controller
{
     public function index() {   
        $title = Manuscripts::where('id',request()->get('id'))->first();
        return view('submission.view-pdf',compact('title'));
    }


    public function getAnnotation($id) {
        return Manuscripts::where('id',$id)->get();
    }

    public function store() {
        $trans = Manuscripts::find(request()->get('id'));
        $trans->annotation = request()->get('annotation');
        $trans->save();

        $getid = Manuscripts::where('id',request()->get('id'))->get();

        $trans = new ActivityLog;
        $trans->notification_message = Auth::user()->name ." add annotation ".$getid[0]->name;
        $trans->user_id = $getid[0]->user_id;
        $trans->created_at = date(now());
        $trans->save();

        return response()->json([[
                    "success"   => true
                    ]]);
    }
}
