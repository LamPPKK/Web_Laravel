<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    public function getAll(){
        return Menu::get();
    }
}
