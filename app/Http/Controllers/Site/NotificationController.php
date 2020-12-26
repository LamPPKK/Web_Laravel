<?php

namespace App\Http\Controllers\Site;

use App\Entity\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    //
    private $notification;
    public function __construct(
        Notification $notification
    ){
        $this->notification = $notification;
    }
    public function notification($user_id){
        $notifications = $this->notification->notificationByUserId($user_id);
        return view('site.defaults.notifycation',compact('notifications'));
    }
}
