<?php

namespace App\Http\Controllers\Site;

use App\Entity\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    //
    
    public function communityByDistrictId($district_id)
    {
        $communities = Community::where('district_id',$district_id)->get();
        foreach($communities as $community){
            echo '<option value=" ' . $community->id . '">' . $community->name . '</option>';
        }
    }
}
