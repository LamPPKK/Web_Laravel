<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewProduct extends Model
{
    //
    protected $fillable =[
        'product_id',
        'user_id',
        'star',
        'content',
        'status',
    ];
    public function userReviewProduct($request,$product_id){
        $review = [
            'product_id' => $product_id,
            'user_id' => Auth::user()->id,
            'star' => $request->star,
            'content' => $request->content,
            'status' => 0,
        ];
        ReviewProduct::Create($review);

    }
    public function paginate($total){
        return DB::table('review_products')->paginate($total);
    }
}
