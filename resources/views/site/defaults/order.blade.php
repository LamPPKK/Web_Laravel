@extends('site.layouts.app-new')
@section('title', 'Danh sách đơn hàng')

@section('content')
<section>
    <div class="col-12">
        <ul class="breadcrumb">
            <li>
                <a href="javascript:;">Trang chủ</a>
            </li>
    
            <li>
                <a href="javascript:;">
                    Danh sách đơn hàng của bạn
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
                        <a href="javascript:;" class=>
                            <i class="fa fa-pencil"> </i>Sửa hồ sơ
                        </a>
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
            <ul class="nav nav-pills mb-2 box-title" id="pills-tab" role="tablist">
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link active" id="order_all_tab" data-toggle="pill" href="#order_all" role="tab" aria-controls="order_all" aria-selected="true">Tất cả</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="wait_confirm_tab" data-toggle="pill" href="#wait_confirm" role="tab" aria-controls="wait_confirm" aria-selected="false">Chờ xác nhận</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="wait_get_item_tab" data-toggle="pill" href="#wait_get_item" role="tab" aria-controls="wait_get_item" aria-selected="false">Chờ lấy hàng</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link " id="delivering_tab" data-toggle="pill" href="#delivering" role="tab" aria-controls="delivering" aria-selected="true">Đang giao</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="delivered_tab" data-toggle="pill" href="#delivered" role="tab" aria-controls="delivered" aria-selected="false">Đã giao</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="cancelled_tab" data-toggle="pill" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Đã hủy</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="order_all" role="tabpanel" aria-labelledby="order__all_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                            @foreach (json_decode($orderAll) as  $order)
                            <div class="item-order">
                                @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id,Auth::user()->id) as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$item->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $item->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$item->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money/$item->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($item->status ==0)
                                                Chờ xác nhận
                                            @elseif($item->status ==1)
                                                Chờ lấy hàng
                                            @elseif($item->status ==2)
                                                Đang giao hàng
                                            @elseif($item->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->order_id)}}">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>
                                    @if ($item->status <3)
                                    <div class="col-2">
                                        <a href="{{route('users.updateCancelled',$order->order_id)}}">
                                            <div class=" cancelled__order__item">
                                                Hủy đơn hàng
                                            </div>
                                        </a>
                                        
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="wait_confirm" role="tabpanel" aria-labelledby="wait_confirm_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                            @foreach (json_decode($orderWaitConfirm)  as $order)
                            
                            <div class="item-order">
                                @foreach (\App\Entity\DetailOrder::getDetailOrderByUserOrderId($order->order_id,Auth::user()->id) as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$item->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $item->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$item->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money/$item->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($item->status ==0)
                                                Chờ xác nhận
                                            @elseif($item->status ==1)
                                                Chờ lấy hàng
                                            @elseif($item->status ==2)
                                                Đang giao hàng
                                            @elseif($item->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->order_id)}}">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <div class=" cancelled__order__item">
                                            Hủy đơn hàng
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                       
                       
                    </div>
                </div>
                <div class="tab-pane fade" id="wait_get_item" role="tabpanel" aria-labelledby="wait_get_item_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                            @foreach (json_decode($orderWaitGetItem) as  $order)
                            <div class="item-order">
                                @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id,Auth::user()->id) as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$item->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $item->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$item->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money/$item->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($item->status ==0)
                                                Chờ xác nhận
                                            @elseif($item->status ==1)
                                                Chờ lấy hàng
                                            @elseif($item->status ==2)
                                                Đang giao hàng
                                            @elseif($item->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->order_id)}}">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <div class=" cancelled__order__item">
                                            Hủy đơn hàng
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivering" role="tabpanel" aria-labelledby="delivering_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                            @foreach (json_decode($orderDelivering) as  $order)
                            <div class="item-order">
                                @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id,Auth::user()->id) as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$item->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $item->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$item->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money/$item->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($item->status ==0)
                                                Chờ xác nhận
                                            @elseif($item->status ==1)
                                                Chờ lấy hàng
                                            @elseif($item->status ==2)
                                                Đang giao hàng
                                            @elseif($item->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->order_id)}}">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <div class=" cancelled__order__item">
                                            Hủy đơn hàng
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                            @foreach (json_decode($orderDelivered) as  $order)
                            <div class="item-order">
                                @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id,Auth::user()->id) as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$item->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $item->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$item->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money/$item->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($item->status ==0)
                                                Chờ xác nhận
                                            @elseif($item->status ==1)
                                                Chờ lấy hàng
                                            @elseif($item->status ==2)
                                                Đang giao hàng
                                            @elseif($item->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->order_id)}}">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                       
                                        <a href="{{route('users.review',$item->post_slug)}}">
                                             <div class=" review__product button btnOrange">
                                           Đánh giá sản phẩm
                                        </div>
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                            @foreach (json_decode($orderCancelled) as  $order)
                            <div class="item-order">
                                @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id,Auth::user()->id) as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$item->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $item->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$item->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$item->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money/$item->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($item->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($item->status ==0)
                                                Chờ xác nhận
                                            @elseif($item->status ==1)
                                                Chờ lấy hàng
                                            @elseif($item->status ==2)
                                                Đang giao hàng
                                            @elseif($item->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->order_id)}}">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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