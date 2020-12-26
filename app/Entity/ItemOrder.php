<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    //
    protected $fillable = [
        'order_id',
        'detail_order_id'
    ];
}
