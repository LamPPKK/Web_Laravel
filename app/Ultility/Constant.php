<?php

namespace App\Ultility;

use Carbon\Carbon;

class Constant
{
    //
    public $statusOrder = [
        '0' => 'đang chờ xác nhận',
        '1' => 'đã được xác nhận',
        '2' => 'đang giao',
        '3' => 'đã giao',
        '4' => 'đã hủy',
    ];
    public function getStatusOrder()
    {
        return $this->statusOrder;
    }
    public static function getdateFacebook($date)
    {
        $date_facebook = '';
        if (!empty($date)) {
            //lay giờ theo giống facebook
            Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
            $date = date_create($date);
            $date_fb = Carbon::create((date_format($date, "Y")), (date_format($date, "m")), (date_format($date, "d")), (date_format($date, "H")), (date_format($date, "i")), (date_format($date, "s")));
            $now = Carbon::now();
            $date_facebook = $date_fb->diffForHumans($now); //1 giờ trước
        }
        return $date_facebook;

    }
}
