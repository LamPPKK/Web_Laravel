<?php

namespace App\Http\Controllers\Site;

use App\Entity\District;
use App\Entity\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    //
    public function districtByProvinceId($province_id)
    {
        $districts = District::where('province_id',$province_id)->get();
        foreach($districts as $district){
            echo '<option value=" ' . $district->id . '">' . $district->name . '</option>';
        }
    }
}
