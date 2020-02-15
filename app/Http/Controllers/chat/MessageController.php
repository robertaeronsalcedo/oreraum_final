<?php

namespace App\Http\Controllers\chat;
use App\Http\Controllers\Controller;
use App\chat\Messages;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Auth;
use DB;
use App\User;

class MessageController extends Controller
{

	public function getMessages($sender_id,$receiver_id) {

    $this->seen($sender_id,$receiver_id);
		return Messages::with('receiverInfo','senderInfo')
                    ->whereIn('sender_id',[$sender_id, $receiver_id])
                    ->whereIn('receiver_id', [$receiver_id, $sender_id])
                    ->get();

	}

  public function seen($sender_id,$receiver_id) {
    Messages::where('sender_id',$receiver_id)
              ->where('receiver_id',$sender_id)
                    ->update(array('seen_at' => now()));
  }

  public function getChatList() {
      return User::where('id','<>',Auth::User()->id)->get();
  }

	public function store() {

    $data = request()->except('_token','message_id');
    $validator = Validator::make(request()->all(), [
   'message'      => 'required',
   'sender_id'    => 'required',
   'receiver_id'  => 'required',
    ]);
    $success = !$validator->fails();

    if ($success) {

       Messages::updateOrCreate(['message_id' => request()->get('message_id')],$data);

			return response()->json([[
						"success" 	=> true
						]]);
      
    }

    return response()->json([[
				"success" 	=> false,
				"error" 	=> $validator->errors()
				]]);;

	}

	public function destroy($id) {
    $category = Messages::where('message_id',$id)->first();
    if(Messages::where('message_id',$id)->delete()){
      
      return response()->json([[
            "success"   => true
            ]]);

    }
      return response()->json([[
          "success"   => false,
          "error"   => "Unable to delete category."
          ]]);
	}
}