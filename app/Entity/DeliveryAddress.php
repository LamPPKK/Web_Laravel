<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'province_id',
        'district_id',
        'commune_id',
        'phone',
        'address',
        'name',
        'status'
    ];
    public function getDeliverAddressUser($user_id){
        return DeliveryAddress::select(
            'delivery_addresses.id',
            'delivery_addresses.phone',
            'delivery_addresses.name',
            'delivery_addresses.address',
            'delivery_addresses.status',
            'provinces.name as province_name',
            'districts.name as district_name',
            'communes.name as commune_name'
            )
            ->join('provinces','provinces.id','delivery_addresses.province_id')
            ->join('districts','districts.id','delivery_addresses.district_id')
            ->join('communes','communes.id','delivery_addresses.commune_id')
            ->where('user_id',$user_id)->get()->toJson();
    }
    public function getDeliverAddressDetail($delivery_id,$user_id){
        return DeliveryAddress::select(
            'delivery_addresses.id',
            'delivery_addresses.phone',
            'delivery_addresses.name',
            'delivery_addresses.address',
            'delivery_addresses.status',
            'provinces.name as province_name',
            'districts.name as district_name',
            'communes.name as commune_name'
            )
            ->join('provinces','provinces.id','delivery_addresses.province_id')
            ->join('districts','districts.id','delivery_addresses.district_id')
            ->join('communes','communes.id','delivery_addresses.commune_id')
            ->where([
                'delivery_addresses.id'=>$delivery_id,
                'delivery_addresses.user_id'=>$user_id,
            ])->first();
    }
    public function chooseDeliveryAddress($user_id){
        return DeliveryAddress::select(
            'delivery_addresses.id',
            'delivery_addresses.phone',
            'delivery_addresses.name',
            'delivery_addresses.address',
            'delivery_addresses.status',
            'provinces.name as province_name',
            'districts.name as district_name',
            'communes.name as commune_name'
            )
            ->join('provinces','provinces.id','delivery_addresses.province_id')
            ->join('districts','districts.id','delivery_addresses.district_id')
            ->join('communes','communes.id','delivery_addresses.commune_id')
            ->where([
                'delivery_addresses.status'=>1,
                'delivery_addresses.user_id'=>$user_id,
            ])->first();
    }
    public function resetDeliveryAddresses($user_id){
        DeliveryAddress::where(['user_id' => $user_id ])->update(['status'=>0]);
    }
    public function updateDeliveryAddress($delivery_id,$user_id){
        $where = [
            'id' => $delivery_id,
            'user_id' => $user_id ,
        ];
        DeliveryAddress::where($where)->update(['status'=>1]);
    }
   
}
