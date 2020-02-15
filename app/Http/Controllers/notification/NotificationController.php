<?php

namespace App\Http\Controllers\notification;
use App\Http\Controllers\Controller;
use App\notification\Messages;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Validator;
use Auth;
use DB;
use App\User;
use App\composemessage;
use App\ActivityLog;

class NotificationController extends Controller
{

	public function getNotification() {

    $activityLog = ActivityLog::select(DB::raw('notification_message as message'),'created_at')
    ->where('user_id',Auth::User()->id)
    ->limit(10)
    ->orderBy('id','desc')
    ->get()
    ->map(function ($item) {
      $item['notif_type'] = "activitylog";
      return $item;
    });
    $announcement = composemessage::select(DB::raw('message as message'),'created_at')
    ->limit(10)
    ->orderBy('message_id','desc')
    ->get()
    ->map(function ($item) {
      $item['notif_type'] = "announcement";
      return $item;
    });

    $merged = $announcement->toBase()->merge($activityLog);

    $result = array_reverse(array_sort($merged, function ($value) {
      return $value['created_at'];
    }));

    return $result;
	}


}