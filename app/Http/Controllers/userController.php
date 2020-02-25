<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Avatar;
use Validator;
class userController extends Controller
{
    public function index()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
        $users = User::all();
        return view('Users.index',compact('users'));
    }
    public function admin_registration()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
        $users = User::all();
        return view('auth.admin_registration');
    }
  
    public function changepass()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
       
        return view('Users.changepass');
    }
    

    public function update(Request $request) {
        $id = $request->user_id;
        $user = User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->id_number=$request->id_number;
        $user->save();
        return $request;

        

    }

    public function createAccount() {
        $validator = Validator::make(request()->all(), [
       'name'      => 'required|min:3|max:50',
       'email'    => 'email|unique:users',
       'user_id'    => 'email|unique:users',
       'user_type'  => 'required',
       'password'  => 'required|confirmed:min:6',   
       'id_number'    => 'required|unique:users',
        ]);
        $success = !$validator->fails();
        $accessid=0;
        if(request()->get('user_type')=="Student"){
            $accessid=2;
        }else if(request()->get('user_type')=="Student Teacher") {
            $accessid=2;
        }
        else if(request()->get('user_type')=="Adviser"){
            $accessid=3;
        }
        else  if(request()->get('user_type')=="Committee"){
            $accessid=4;
        }
        else if(request()->get('user_type')=="Coordinator"){
            $accessid=5;
        
        }

        if ($success) {
            $trans              = new User();
            $trans->name        = request()->get('name');
            $trans->email       = request()->get('email');
            $trans->user_type   = request()->get('user_type');
            $trans->password    = bcrypt(request()->get('password'));
            $trans->id_number   = request()->get('id_number');
            $trans->access_id   = $accessid;
            $trans->save();

            return redirect("/home");
        }
        return redirect()->back()->withErrors($validator)->withInput(); 
    }
    public function adminCreate() {
         $validator = Validator::make(request()->all(), [
       'name'      => 'required|min:3|max:50',
       'email'    => 'email|unique:users',
       'user_id'    => 'email|unique:users',
       'user_type'  => 'required',
       'password'  => 'required|confirmed:min:6',   
       'id_number'    => 'required|unique:users',
        ]);
        $success = !$validator->fails();
        $accessid=0;
      
        if(request()->get('user_type')=="Adviser"){
            $accessid=3;
            
        }
        else  if(request()->get('user_type')=="Committee"){
            $accessid=4;
            
        }
        else if(request()->get('user_type')=="Coordinator"){
            $accessid=5;
          
        
        }
        if ($success) {
            $trans              = new User();
            $trans->name        = request()->get('name');
            $trans->email       = request()->get('email');
            $trans->user_type   = request()->get('user_type');
            $trans->password    = bcrypt(request()->get('password'));
            $trans->id_number   = request()->get('id_number');
            $trans->access_id   = $accessid;
            $trans->save();
            return redirect('/home');
        }

        return redirect()->back()->withErrors($validator)->withInput(); 
    }
        
    

    public function delete(Request $request) {
        $id = $request->user_id;
        $user =User::find($id); 
        $user->delete();
        return "success!";

        
    }
    public function upload_avatar(Request $request)
    {
     $rules = array(
        "image" => "required|image|max:10000"
     
     );

     $error = Validator::make($request->all(), $rules);

     if($error->fails())
     {
      return response()->json(['errors' => $error->errors()->all()]);
     }

     $image = $request->file;
     $new_name = rand() . '.' . $image->getClientOriginalExtension();
     $image->move(public_path('images/manuscripts'), $new_name);

        
        $avatar = new Avatar;
        $avatar->user_id=Auth::user()->id;
        $avatar->profile=$new_name;
        // $script->code=$new_name;
        $avatar->save();


     $output = array(
         'success' => 'Manuscripts uploaded successfully',
         'image'  => '<img src="/images/manuscripts/'.$new_name.'" class="img-thumbnail" />'
        );

        return response()->json($output);
    }
    public function studentchatlist() {
        $list = 0;
        if(['filterlist']=="1"){
        $list=1; 
        }
        else if(['filterlist']=="2"){
            $list=2; 
        }
        else if(['filterlist']=="3"){
                $list=3; 
        }
        else {
            $list=4;
    }
        $chatlist= User::where('access_id','=',$list)
        ->get();
        return view('chat_box.Chat_Message',compact('chatlist'));
    }
    }
//     public function changeprofile(Request $request)
//     {
//         $rules = array(
//            "image" => "required|image|max:2000"
        
//         );
   
//         $error = Validator::make($request->all(), $rules);
   
//         if($error->fails())
//         {
//         //  return response()->json(['errors' => $error->errors()->all()]);
//         }
   
//         $image = $request->file;
        
//         $image->move(public_path('images/manuscripts'), $new_name);
   
           
//            $script = new profile_picture;
//            $script->user_id=Auth::user()->id;
//            $script->profile=$request->name;
//            // $script->code=$new_name;
//            $script->path=$new_name;
//            $script->save();
   
   
//         $output = array(
//             'success' => 'Image uploaded successfully',
//             'image'  => '<img src="/images/manuscripts/'.$new_name.'" class="img-thumbnail" />'
//            );
   
//            return response()->json($output);
//        }
//    }
   


