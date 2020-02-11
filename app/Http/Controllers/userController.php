<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Avatar;
use Validator;
class userController extends Controller
{
    public function index()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
        $users = User::all();
        return view('users.index',compact('users'));
    }
    public function admin_registration()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
        $users = User::all();
        return view('auth.admin_registration');
    }
  
    public function avatar()
    {
        // if(!Gate::allows('isAdmin')){
        //     abort(404,"Sorry, You can do this actions");
        // }
        
       
        return view('users.avatar');
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
   


