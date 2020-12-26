<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'delivery_address_id',
        'status',
    ];

    public function getOrderByStatus($status,$user_id){
        $where = [
            'orders.status' => $status,
            'orders.user_id' => $user_id,
        ];
        return Order::select(
                        'orders.id as order_id',
                        'orders.delivery_address_id',
                        'orders.status'
                        // 'history_orders.status',
                        // 'detail_orders.total',
                        // 'detail_orders.money',
                        // 'detail_orders.id as detail_order_id',
                        // 'products.*',
                        // 'posts.title',
                        // 'posts.slug',
                        // 'posts.image'
                    )
                    ->where($where)
                    // ->join('history_orders','history_orders.order_id','orders.id')
                    // ->join('item_orders','item_orders.order_id','orders.id')
                    // ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
                    // ->join('products','products.id','detail_orders.product_id')
                    // ->join('posts', 'posts.id', 'products.post_id')
                    ->get()->toJson();
    }

    public function getOrderAll($user_id){
        $where = [
            ['orders.status','!=' ,4],
            'orders.user_id' => $user_id,
        ];
        return Order::select(
                'orders.id as order_id',
                'orders.delivery_address_id',
                'orders.status'
                // 'history_orders.status',
                // 'detail_orders.total',
                // 'detail_orders.money',
                // 'detail_orders.id as detail_order_id',
                // 'products.*',
                // 'posts.title',
                // 'posts.slug',
                // 'posts.image'
            )
            ->where($where)
            // ->join('history_orders','history_orders.order_id','orders.id')
            // ->join('item_orders','item_orders.order_id','orders.id')
            // ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
            // ->join('products','products.id','detail_orders.product_id')
            // ->join('posts', 'posts.id', 'products.post_id')
            ->get()->toJson();
    }
    public function getStatusmAll($status){
        $where = [
            'orders.status' => $status,
        ];
        return Order::select(
                    'orders.id as order_id',
                    'orders.delivery_address_id',
                    'orders.status'
                    // 'history_orders.status'
                    // 'history_orders.status',
                    // 'detail_orders.total',
                    // 'detail_orders.money',
                    // 'detail_orders.id as detail_order_id',
                    // 'products.*',
                    // 'posts.title',
                    // 'posts.slug',
                    // 'posts.image'
                )
                ->where($where)
                // ->join('history_orders','history_orders.order_id','orders.id')
                // ->join('item_orders','item_orders.order_id','orders.id')
                // ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
                // ->join('products','products.id','detail_orders.product_id')
                // ->join('posts', 'posts.id', 'products.post_id')
                ->get()->toJson();
    }

    public function findOrderById($order_id){
        return Order::find($order_id);
    }
    
    public function updateStatusOrder($order_id,$status){
        
        $history_order = Order::where('id',$order_id)->first();
        $history_order->status = $status;
        $history_order->save();
    }
    

}
