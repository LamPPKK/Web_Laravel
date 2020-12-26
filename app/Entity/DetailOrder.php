<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    //
    protected $fillable =[
        'user_id',
        'product_id',
        'total',
        'money',
    ];
    public function getDetailOrderById($detail_order_id,$user_id){
        $where = [
            'detail_orders.id' => $detail_order_id,
            'orders.user_id' => $user_id,
        ];
        return Order::select(
                        'orders.id as order_id',
                        'orders.delivery_address_id',
                        'history_orders.status',
                        'detail_orders.total',
                        'detail_orders.money',
                        'detail_orders.id as detail_order_id',
                        'products.*',
                        'posts.title',
                        'posts.slug',
                        'posts.image'
                    )
                    ->where($where)
                    ->join('history_orders','history_orders.order_id','orders.id')
                    ->join('item_orders','item_orders.order_id','orders.id')
                    ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
                    ->join('products','products.id','detail_orders.product_id')
                    ->join('posts', 'posts.id', 'products.post_id')
                    ->first();
    }
    public function getOrderById($order_id,$user_id){
        $where = [
            'orders.id' => $order_id,
            'orders.user_id' => $user_id,
        ];
        return Order::select(
                        'orders.id as order_id',
                        'orders.delivery_address_id',
                        'orders.updated_at',
                        'orders.status',
                        'detail_orders.total',
                        'detail_orders.money',
                        'detail_orders.id as detail_order_id',
                        'products.images',
                        'products.price_buy',
                        'products.price_sale',
                        'posts.title',
                        'posts.slug',
                        'posts.image'
                    )
                    ->where($where)
                    // ->join('history_orders','history_orders.order_id','orders.id')
                    ->join('item_orders','item_orders.order_id','orders.id')
                    ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
                    ->join('products','products.id','detail_orders.product_id')
                    ->join('posts', 'posts.id', 'products.post_id')
                    ->get();
    }
    public static function getDetailOrderByOrderId($order_id){
        $where = [
            'orders.id' => $order_id,
            // 'orders.user_id' => $user_id,
        ];
        return Order::select(
                        'orders.id as order_id',
                        'orders.delivery_address_id',
                        'orders.updated_at',
                        'orders.status',
                        'detail_orders.total',
                        'detail_orders.money',
                        'detail_orders.id as detail_order_id',
                        'products.images',
                        'products.price_buy',
                        'products.price_sale',
                        'posts.title',
                        'posts.slug as post_slug',
                        'posts.image'
                    )
                    ->where($where)
                    // ->join('history_orders','history_orders.order_id','orders.id')
                    ->join('item_orders','item_orders.order_id','orders.id')
                    ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
                    ->join('products','products.id','detail_orders.product_id')
                    ->join('posts', 'posts.id', 'products.post_id')
                    ->get();
    }
    public static function getDetailOrderByUserOrderId($order_id,$user_id){
        $where = [
            'orders.id' => $order_id,
            'orders.user_id' => $user_id,
        ];
        return Order::select(
                        'orders.id as order_id',
                        'orders.delivery_address_id',
                        'orders.updated_at',
                        'history_orders.status',
                        'detail_orders.total',
                        'detail_orders.money',
                        'detail_orders.id as detail_order_id',
                        'products.images',
                        'products.price_buy',
                        'products.price_sale',
                        'posts.title',
                        'posts.slug',
                        'posts.image'
                    )
                    ->where($where)
                    ->join('history_orders','history_orders.order_id','orders.id')
                    ->join('item_orders','item_orders.order_id','orders.id')
                    ->join('detail_orders','detail_orders.id','item_orders.detail_order_id')
                    ->join('products','products.id','detail_orders.product_id')
                    ->join('posts', 'posts.id', 'products.post_id')
                    ->get();
    }
}
