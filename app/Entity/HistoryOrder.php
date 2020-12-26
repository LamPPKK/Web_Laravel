<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class HistoryOrder extends Model
{
    //
    protected $fillable =[
        'order_id',
        'status'
    ];
    /**
         * status 0 chờ xác nhận
         * 1 Chờ lấy hàng(Đa giao hàng cho đvvc)
         * 2 đang giao hàng
         * 3 đã giao hàng
         * 4 đã hủy
         * **/
    public function findHistoryOrderByOrderId($order_id){
        return HistoryOrder::where('order_id',$order_id)->first();
    }
    public function updateStatusOrder($order_id,$status){
        $order =[
            'order_id' => $order_id,
            'status' => $status
        ];
        // $history_order = HistoryOrder::where('order_id',$order_id)->first();
        // $history_order->status = $status;
        // $history_order->save();
        HistoryOrder::create($order);
    }
}
