<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'slug',
        'type',
    ];
    // type
    //---- 1 thể loại sản phẩm
    //---- 2 danh mục sản phẩm
    public function getAll(){
        return Category::select('slug','title','type','id')->get();
    }
    
    public static function getCategoryHeader(){
        return Category::select('id','title','type')->where('type',1)->get()->toJson();
    }

    public static function getCategoryTitle($param){
        return Category::select('title')->where('id',$param)->first()->toJson();
    }


    public function getProductByCategory($slug){
        $data = Category::select('categories.*','products.*','posts.*')
                        ->join('category_products','category_products.category_id','categories.id')
                        ->join('products','products.id','category_products.product_id')
                        ->join('posts','posts.id','products.post_id')
                        ->where('categories.id',$slug)
                        ->get();
        return $data;
    }
}
