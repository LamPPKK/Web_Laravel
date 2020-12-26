<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    //
    protected $table = 'communes';


    public static function getAll(){
        $data = Community::get()->toJSON();
        return $data;
    }
    public  function get_all(){
        $data = Community::get()->toJSON();
        return $data;
    }
    

}
