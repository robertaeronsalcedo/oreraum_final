<?php

namespace App\Http\Controllers\manuscript;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Manuscripts;
use Auth;
use App\User;

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

        return response()->json([[
                    "success"   => true
                    ]]);
    }
}
