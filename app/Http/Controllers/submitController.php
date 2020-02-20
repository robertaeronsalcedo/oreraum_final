<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Manuscripts;
use Auth;
use App\User;
use App\ActivityLog;

class submitController extends Controller
{
 public function index()
    {
        $id= Auth::User()->id;
        $manuscripts = "";
        if(Auth::User()->user_type == "Student") {
            $manuscripts = Manuscripts::where('user_id','=',$id)
            ->orderBy('id','DESC')
            ->get();
        }
        if(Auth::User()->user_type == "Committee") {
            $manuscripts = Manuscripts::where('code','=',Auth::User()->email)
            ->orderBy('id','DESC')
            ->get();
        }

        $adviser = User::where('user_type','Adviser')->get();

        return view('Submission.submission',compact('manuscripts','adviser'));
    }  
    public function adviser_manuscript_list() {
    $code_email= Auth::User()->email;
    $manuscripts = Manuscripts::all();
    $manuscripts= Manuscripts::where('code','=',$code_email)
    ->join('users','user_id','=','users.id')
    ->select('manuscripts.*','users.name as username')
    ->limit(10)
    ->get();
    return view('Submission.advisers_manuscript_list',compact('manuscripts'));
}
public function openAnnotation() {

    return view('Submission.annotation_pdf');

}
public function admin_manuscript_list() {
    $code_email= Auth::User()->email;
    $committee = User::where('user_type','Committee')->get();
<<<<<<< HEAD
    $manuscripts= Manuscripts::where('code','=',$code_email)->get();
    return view('Submission.admin_manuscript_list',compact('manuscripts','committee'));
=======
    $manuscripts= Manuscripts::where('code','=',$code_email)
    ->join('users','user_id','=','users.id')
    ->select('manuscripts.*','users.name as username')
    ->limit(10)
    ->get();
    return view('submission.admin_manuscript_list',compact('manuscripts','committee'));
>>>>>>> e157ff210fcf72b317e9073e25297d0e3a90e644
}



    public function openPdf(Request $request)
    {   
        $title = Manuscripts::where('id',$request->id)->first();
        return view('Submission.viewPdf',compact('title'));
       
    }

    public function newopenPdf(Request $request)
    {   
        $title = Manuscripts::where('id',$request->id)->first();
        return view('Submission.view-pdf',compact('title'));
       
    }

   public function upload(Request $request)
    {
        
     $rules = array(
        "file" => "required|mimes:pdf|max:10000"
     
     );

     $error = Validator::make($request->all(), $rules);

     if($error->fails())
     {
      return response()->json(['errors' => $error->errors()->all()]);
     }
     

     $image = $request->file;
     $new_name = rand() . '.' . $image->getClientOriginalExtension();
     $image->move(public_path('images/manuscripts'), $new_name);

        
        $script = new Manuscripts;
        $script->user_id=Auth::user()->id;
        $script->name=$request->name;
        $script->code=$request->email;
        // $script->code=$new_name;
        $script->path=$new_name;
        $script->save();
        
        $getid = User::where('email',$request->email)->get();
        $trans = new ActivityLog;
        $trans->notification_message = Auth::user()->name ." submitted ".$request->name;
        $trans->user_id = $getid[0]->id;
        $trans->save();
    
     $output = array(
         'success' => 'Manuscripts uploaded successfully',
         'image'  => '<img src="/images/manuscripts/'.$new_name.'" class="img-thumbnail" />'
        );

     
        return response()->json($output);
     
    }
}
