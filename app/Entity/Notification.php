<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = [
        'user_id',
        'order_id',
        'content',
        'status'
    ];
    public static function getTotalNoti($user_id){
        $where =[
            'user_id' => $user_id,
            'status' => 0
        ];
        $data = Notification::where($where)->get();
        return $data;
    }
    public static function notificationByUserId($user_id){
        $where =[
            'user_id' => $user_id,
            'status' => 0
        ];
        $data = Notification::where($where)->get();
        return $data;
    }
    
}
