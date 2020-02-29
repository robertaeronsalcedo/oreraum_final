<?php

namespace App\Http\Controllers\manuscript;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Manuscripts;
use App\ManuscriptCommittee;
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

     public function pdfCommittee() {   
        $title = ManuscriptCommittee::with('getManuscripts')
        ->where('id',request()->get('committee_id'))
        ->where('manuscripts_id',request()->get('id'))
        ->first();
        // return $title;
        return view('Submission.view-pdf-committee',compact('title'));
    }

    public function committeeManuscripts() {
        $manuscripts = ManuscriptCommittee::with('getUser','getManuscripts.getAuthor')
        ->where('manuscripts_committee.id',Auth::User()->id)
        ->get();
        // return $manuscripts; 
        return view('Submission.committee-manuscript',compact('manuscripts'));
    }  

    public function getAnnotation($id) {
        return Manuscripts::where('id',$id)->get();
    }

    public function getAnnotationCommittee($id,$committe_id) {
            return ManuscriptCommittee::where('id',$committe_id)
                    ->where('manuscripts_id',$id)
                    ->get();
        
    }

    public function store() {
        

        $trans = Manuscripts::find(request()->get('id'));
        if(Auth::user()->user_type == "Adviser" && request()->get('evaluation') == "Approved") {
            $getuser = User::where('user_type','Coordinator')->get();
            $trans->code = $getuser[0]->email;
        }
        if(Auth::user()->user_type == "Coordinator" && request()->get('evaluation') == "Approved") {
            $getuser = User::where('user_type','Admin')->get();
            $trans->code = $getuser[0]->email;
        }

        $trans->annotation = request()->get('annotation');
        $trans->evaluation = request()->get('evaluation');
        $trans->save();

        $getid = Manuscripts::where('id',request()->get('id'))->get();

        $trans = new ActivityLog;
        $trans->notification_message = Auth::user()->name ." Evaluated ".$getid[0]->name ." ".request()->get('evaluation');
        $trans->user_id = $getid[0]->user_id;
        $trans->save();

        return response()->json([[
                    "success"   => true
                    ]]);
    }


    public function storeCommittee() {
        ManuscriptCommittee::where('id', Auth::user()->id)->where('manuscripts_id',request()->get('id'))
            ->update([
            "annotation" => request()->get('annotation'),
            "evaluation" => request()->get('evaluation')
        ]);

        $getid = Manuscripts::where('id',request()->get('id'))->get();

        $trans = new ActivityLog;
        $trans->notification_message = Auth::user()->name ." Evaluated ".$getid[0]->name ." ".request()->get('evaluation');
        $trans->user_id = $getid[0]->user_id;
        $trans->save();

        return response()->json([[
                    "success"   => true
                    ]]);
    }

    public function assignChecker() {
        $email = request()->get('email');

        foreach($email as $emailVal) {
            $getuser = User::where('email',$emailVal)->get();
            $getid = Manuscripts::where('id',request()->get('id'))->get();

            $mcscript = new ManuscriptCommittee();
            $mcscript->manuscripts_id   = request()->get('id');
            $mcscript->id               = $getuser[0]->id;
            $mcscript->save();

            $trans = new ActivityLog;
            $trans->notification_message = Auth::user()->name ." Assign you as checker ". $getid[0]->name;
            $trans->user_id = $getuser[0]->id;
            $trans->save();
        }

        $trans = Manuscripts::find(request()->get('id'));
        $trans->code = json_encode($email);
        $trans->save();

        return response()->json([[
                    "success"   => true,
                    "user_id"   =>  $getuser[0]->id
                    ]]);
    }
}
