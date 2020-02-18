<?php

namespace App\Http\Controllers;
use App\Groups;
use App\User;
use Auth;
use Validator;
use code_requests;
use Illuminate\Http\Request;

class groupController extends Controller
{
    public function index() {


     

        return view('CodeRequest.make_group');
     }
     public function showrequest(){

      return view('CodeRequest.grouprequest');
  }
  public function showgroups(){

    return view('CodeRequest.group_list');
} 
public function advisergroups(){
  $id = Auth::User()->id;
  $groups = Groups::all();
  $groups= Groups::where('user_id','=',$id)
  ->orderBy('id','DESC')
  ->get();
  return view('CodeRequest.group_list',compact('groups'));
}
public function studentgroups(){
    
  $compose = \DB::table('groups')
  ->join('users','user_id','=','users.id')
  ->orderBy('id','DESC')
  ->get();
  return view('CodeRequest.group_list',compact('groups'));
}





       public function insertform(Request $request)
       {
        $rules = array(
          'group_code' => 'required|string|min:6|max:12|unique:groups',
       
       );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
         
        }
      
       
        $groupdata= new Groups();
        $groupdata->group_name= $request->get('group_name');
        $groupdata->group_code= $request->get('group_code');
        $groupdata->group_schedule= $request->get('group_schedule');
        $groupdata->user_id = Auth::User()->id;
        $groupdata->save();
        // dd($groupdata);
        return redirect('created_group');
}
}
