<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Manuscripts;
use Auth;
use App\User;
class submitController extends Controller
{
 public function index()
    {
        $id= Auth::User()->id;
        $manuscripts= Manuscripts::where('user_id','=',$id)
        ->orderBy('id','DESC')
        ->get();
        return view('submission.submission',compact('manuscripts'));
    }  
    public function adviser_manuscript_list() {
    $code_email= Auth::User()->email;
    $manuscripts = Manuscripts::all();
    $manuscripts= Manuscripts::where('code','=',$code_email)
    // ->join('users','user_id','=','users.id')
    ->get();
    return view('submission.advisers_manuscript_list',compact('manuscripts'));
}
public function openAnnotation() {

    return view('submission.annotation_pdf');

}
public function admin_manuscript_list() {
    $code_email= Auth::User()->email;
    $manuscripts= Manuscripts::where('code','=',$code_email)
    ->join('users','user_id','=','users.id')
    ->get();
    return view('submission.admin_manuscript_list',compact('manuscripts'));
}



    public function openPdf(Request $request)
    {   
        $title = Manuscripts::where('id',$request->id)->first();
        return view('submission.viewPdf',compact('title'));
       
    }

    public function newopenPdf(Request $request)
    {   
        $title = Manuscripts::where('id',$request->id)->first();
        return view('submission.view-pdf',compact('title'));
       
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
        


    
     $output = array(
         'success' => 'Manuscripts uploaded successfully',
         'image'  => '<img src="/images/manuscripts/'.$new_name.'" class="img-thumbnail" />'
        );

     
        return response()->json($output);
     
    }
}
