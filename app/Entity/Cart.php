<?php

namespace App\Entity;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'user_id',
        'product_id',
        'total',
        'status',
    ];
    public function getCartByUserId($user_id){
        $data =  Cart::select(
                    'carts.id as cart_id',
                    'carts.total',
                    'carts.id as product_id',
                    // 'carts.*'
                    // 'products.*'
                    'products.price_buy',
                    'products.price_sale',
                    'products.images as gallery',
                    'posts.id',
                    'posts.title',
                    'posts.slug',
                    'posts.image'
                    )
                    ->where('carts.status',1)
                    ->where('user_id',$user_id)
                    ->join('products','products.id','carts.product_id')
                    ->join('posts','posts.id','products.post_id')
                    ->get();
        return $data;
    }
    public function checkCart($product_id,$user_id){
        $cart = Cart::where([
            'carts.product_id'=>$product_id,
            'carts.user_id'=>$user_id,
            'carts.status'=>1,
        ])->first();
        return $cart;
    }
    public function updateCart($cart_id,$total){
        // try{
            $cart = Cart::find($cart_id);
            $cart->total = $total;
            $cart->save();
            return $cart;
        // }catch(Exception $e){
        //     return false;
        // }
       
    }
    public function getDetailCartById($cart_id){
        $data =  Cart::select(
            'carts.id as cart_id',
            'carts.total',
            'carts.id as product_id',
            'products.price_buy',
            'products.price_sale',
            'products.images as gallery',
            'posts.id',
            'posts.title',
            'posts.slug',
            'posts.image'
            )
            ->join('products','products.id','carts.product_id')
            ->join('posts','posts.id','products.post_id')
            ->where('carts.id',$cart_id)
            ->first();
        return $data;
    }
    public function getArrCart($arrCart){
        $data =  Cart::select(
            'carts.id as cart_id',
            'carts.total',
            'carts.id as product_id',
            'products.price_buy',
            'products.price_sale',
            'products.images as gallery',
            'posts.id',
            'posts.title',
            'posts.slug',
            'posts.image'
            )->where('carts.status',1)
            ->whereIn('carts.id',$arrCart)
            ->join('products','products.id','carts.product_id')
            ->join('posts','posts.id','products.post_id')
            ->get();
        return $data;
    }

    public function getUserTotalMoneyCart($checkCart,$user_id){
        
        return Cart::select(
                      'carts.id', 
                      'carts.total',
                      'products.id as product_id', 
                      'products.price_buy', 
                      'products.price_sale'
                    )
                    ->where('carts.status',1)
                    ->whereIn('carts.id', $checkCart)
                    ->join('products','products.id','carts.product_id')
                    ->get();
    }
}
