<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = 'districts';


    public static function getAll(){
        $data = District::get()->toJSON();
        return $data;
    }
    public  function get_all(){
        $data = District::get()->toJSON();
        return $data;
    }
}
