<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'post_id',
        'images',
        'price_buy',
        'price_sale',
        'product_code',
    ];
    public function detailProductById($product_id){
        return Product::find($product_id);
    }
    public function detailProductBySlug($slug)
    {
        $data = Product::select(
            'products.*',
            'posts.title',
            'posts.slug',
            'posts.description',
            'posts.content',
            'posts.image'
        )
            ->join('posts', 'posts.id', 'products.post_id')
            ->where('posts.slug', $slug)
            ->first();
        return $data;
    }
    public static function getProductByCategory($category_id)
    {
        $data = Category::select('categories.*', 'products.*', 'posts.*')
            ->join('category_products', 'category_products.category_id', 'categories.id')
            ->join('products', 'products.id', 'category_products.product_id')
            ->join('posts', 'posts.id', 'products.post_id')
            ->where('categories.id', $category_id)
            ->get();
        return $data;
    }
    
}
