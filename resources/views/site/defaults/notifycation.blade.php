@extends('site.layouts.app-new')
@section('title', 'Thông báo')

@section('content')
<section>
    <div class="col-12">
        <ul class="breadcrumb">
            <li>
                <a href="javascript:;">Trang chủ</a>
            </li>
    
            <li>
                <a href="javascript:;">
                    Thông báo
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="info-user d-flex">
                <div class="box-image-user flex-1 rounded-circle d-flex align-items-center justify-content-center">
                    <img src="{{ asset('template/Site/public/images/products/avatar.jpg')}}" class="rounded-circle" />
                </div>
                <div class="name-user d-flex  flex-column-reverse align-items-center">
                    <div class="name mb-2  order-2 ">
                        Vũ Minh Đức
                    </div>
                    <div class="edit-name mb-2 order-1">
                        <i class="fa fa-pencil"> </i>Sửa hồ sơ
                    </div>
                </div>
            </div>
           
            <div class="item-user">
                <div class="item-link d-flex align-items-center">
                    <div class="item-icon-user icon-account">
                        <i class="fa fa-user-circle "></i>
                    </div>
                    <a href="javascript:;" class=>
                        <div class="item-title-cate ml-2 ">
                            Tài khoản của tôi
                        </div>
                    </a>
                </div>
                <div class="item-link d-flex align-items-center">
                    <div class="item-icon-user">
                        <i class="fa fa-file-text-o "></i>
                    </div>
                    <a href="{{route('users.order')}}">
                        <div class="item-title-cate ml-2 @if (URL::current() == route('users.order')) echo active @endif" >
                            Đơn hàng
                        </div>
                    </a>
                </div>
                <div class="item-link d-flex align-items-center">
                    <div class="item-icon-user icon-notification">
                        <i class="fa fa-bell-o "></i>
                    </div>
                    <a href="{{route('users.notification',Auth::user()->id)}}" class="w-100">
                        <div class="item-title-cate ml-2 d-flex justify-content-between @if (URL::current() == route('users.notification',Auth::user()->id)) echo active @endif">
                            Thông báo
                            <span class="right badge badge-danger">
                                @php
                                    $totalNoti = \App\Entity\Notification::getTotalNoti(Auth::user()->id);
                                @endphp
                                {{$totalNoti->count()}}
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-10 mt-2 bg-white">
           <div class="notifications">
                <ul style="list-style:none">
                @foreach (\App\Entity\Notification::notificationByUserId(Auth::user()->id) as $noti)
                <a href="{{route('users.detailOrder',$noti->order_id)}}">
                    <li class="d-flex align-items-center justify-content-between not_seen p-2">
                        {{$noti->content}}
                        @php
                            $date = \App\Ultility\Constant::getdateFacebook($noti->updated_at);
                        @endphp
                        <span>{{$date}}</span>
                        
                    </li>
                </a>
                    
                @endforeach
                </ul>

           </div>
        </div>
    </div>
</section>
@endsection
@section('after-css')
<style>
     .item-order img{
        border:1px solid #fff!important;
    }
</style>
   
@endsection