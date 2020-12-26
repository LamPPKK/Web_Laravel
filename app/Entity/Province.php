<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'provinces';

    public static function getAll(){
        $data = Province::get()->toJSON();
        return $data;
    }
    public  function get_all(){
        $data = Province::get()->toJSON();
        return $data;
    }
}
