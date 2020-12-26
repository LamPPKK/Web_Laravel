<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =[
        'title',
        'slug',
        'description',
        'image',
        'content',
        'type_post',
    ];
    public static function getPostTotal($total){
        return Post::limit($total)->get();
    }
    public function getPostBySlug($slug){
        return Post::select(
            'posts.*',
            'products.id as product_id'
            )
            ->join('products','products.post_id','posts.id')
            ->where('slug',$slug)
            ->first();
    }
    public function getPostByProductId($product_id){
        return Post::select(
            'posts.*',
            'products.id as product_id'
            )
            ->join('products','products.post_id','posts.id')
            ->where('products.id',$product_id)
            ->first();
    }
}
