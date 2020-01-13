<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
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

}