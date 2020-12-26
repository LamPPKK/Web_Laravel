@extends('site.layouts.app-new')
@section('title','Chi tiết đơn hàng')
@section('content')
<section>
    <div class="col-12">
        <ul class="breadcrumb">
            <li>
                <a href="javascript:;">Trang chủ</a>
            </li>
    
            <li>
                <a href="javascript:;">
                   Chi tiết đơn hàng của bạn
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="info-user d-flex">
                <div class="box-image-user flex-1 rounded-circle d-flex align-items-center justify-content-center">
                    <img src="{{ asset('template/Site/public/images/avatar.jpg')}}" class="rounded-circle" />
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
                        <div class="item-title-cate ml-2 active">
                            Đơn hàng
                        </div>
                    </a>
                </div>
                <div class="item-link d-flex align-items-center">
                    <div class="item-icon-user icon-notification">
                        <i class="fa fa-bell-o "></i>
                    </div>
                    <a href="{{route('users.notification',Auth::user()->id)}}" class="w-100">
                        <div class="item-title-cate ml-2 d-flex justify-content-between">
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

            <div class="text-header-order">
                <div class="text-left-header-order">
                    Đơn hàng số: {{$order[0]->order_id}}
                </div>
                <div class="text-right-status">
                    @if ($order[0]->status ==0)
                    Chờ xác nhận
                @elseif($order[0]->status ==1)
                    Chờ lấy hàng
                @elseif($order[0]->status ==2)
                    Đang giao hàng
                @elseif($order[0]->status ==3)
                    Đã giao hàng
                @else
                    Đã hủy
                @endif
                </div>
            </div>
            @if ($order[0]->status == 4)
            <div class="order-status position-relative showOrderDetailCancel">
                <div class="row ">
                    <div class="offset-1 col-2 col-md-2 item-status-order">
                        <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đơn hàng đã đặt
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                12:20 21-08-2020
                            </div>
                        </div>
                    </div>
                    <div class="col-2 item-status-order offset-6 ">
                        <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>
                        <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã hủy
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                9:00 24-08-2020
                            </div>
                        </div>
                    </div>
                </div>

                <div class="horizontal-line position-absolute">
                    <div class="line line-active"></div>
                </div>

            </div>
            @else 
            
            <div class="order-status position-relative ">
                <div class="row">

                    <div class="offset-1 col-2 col-md-2 item-status-order">
                        <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đơn hàng đã đặt
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                {{  date('d-m-Y H:i:s',strtotime($order[0]->updated_at))}}
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon  rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-check-square-o"></i>
                        </div>
                        {{-- <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã xác nhận đơn hàng
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                18:00 21-08-2020
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                        {{-- <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã giao cho ĐVVC
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                12:00 22-08-2020
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-ambulance"></i>
                        </div>
                        {{-- <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đang giao hàng
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                6:20 23-08-2020
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-money"></i>
                        </div>
                        {{-- <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã nhận hàng
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                9:00 24-08-2020
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="horizontal-line position-absolute">
                    <div class="line"></div>
                    <!-- <div class="line-active"></div> -->
                </div>
            </div>
             
            @endif
            {{-- <div class="show-text">
                <div class=" row">
                    <div class="text-show-left col align-items-center d-flex">
                        Bạn đã nhận đơn hàng này
                    </div>
                    <div class="text-show-left text-right col-3 ">
                        <div class="buy__again">
                            Mua lại lần nữa
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="order-address">
                <div class="text-address">
                    Địa chỉ nhận hàng
                </div>
                <div class="content-address">
                    <div class="name-user-address">
                        {{$delivery_address->name}}
                    </div>
                    <div class="phone-user-address">
                        {{$delivery_address->phone}}
                    </div>
                    <div class="user-address">
                        {{$delivery_address->address}}- {{$delivery_address->commune_name}}- {{$delivery_address->district_name}}- {{$delivery_address->province_name}}
                    </div>
                </div>
            </div>
            <div class="order-history-deliver">

            </div>
            <div class="order-product">
                <div class="header-order-product d-flex">
                    <div class="text-header-product">
                        Kiện hàng
                    </div>
                    <div class="status-header-product text-right text-warning">
                        @if ($order[0]->status ==0)
                            Chờ xác nhận
                        @elseif($order[0]->status ==1)
                            Chờ lấy hàng
                        @elseif($order[0]->status ==2)
                            Đang giao hàng
                        @elseif($order[0]->status ==3)
                            Đã giao hàng
                        @else
                            Đã hủy
                        @endif
                    </div>
                </div>
                <div class="detail-order-product">
                    @foreach ($order as $item)
                    <div class="row">
                        <div class="col-2">
                            <div class="box-image">
                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="title__product">
                                {{$item->title}}
                            </div>
                            <div class="list__image">
                                @foreach (explode(',', $item->images) as $img)
                                    <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                @endforeach
                            </div>
                            <div class="total__product">
                                Số lượng: {{$item->total}}
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <div class="price__product text-red justify-content-end">
                                <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex p-3 border payment-item">
                                <div class="text-order-payment flex-auto ">
                                    Tổng tiền hàng

                                </div>
                                <div class="d-flex  money-order-payment">
                                    <div class="payment-money-product justify-content-end ">
                                        <sup class="text-underline ">đ</sup>{{number_format($totalMoney)}}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex p-3 border payment-item">
                                <div class="text-order-payment flex-auto ">
                                    Vận chuyển-J&T Express
                                </div>
                                <div class="money-order-payment">
                                    <div class="payment-money-product justify-content-end ">
                                        <sup class="text-underline ">đ</sup>30.000
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex p-3 border payment-item">
                                <div class="text-order-payment flex-auto ">
                                    Miễn Phí Vận Chuyển
                                </div>
                                <div class="money-order-payment">
                                    <div class="payment-money-product justify-content-end ">
                                        -<sup class="text-underline ">đ</sup>30.000
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex p-3 border payment-item">
                                <div class="text-order-payment flex-auto ">
                                    Tổng số tiền

                                </div>
                                <div class="money-order-payment">
                                    <div class="payment-money-product justify-content-end text-red">
                                        <sup class="text-underline ">đ</sup>{{number_format($totalMoney)}}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex p-3 border payment-item">
                                <div class="text-order-payment flex-auto ">
                                    Phương thức thanh toán

                                </div>
                                <div class="money-order-payment text-red">
                                    Thanh toán khi nhận hàng
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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