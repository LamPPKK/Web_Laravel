@extends('admin.layouts.app')
@section('title', 'Đơn hàng')

@section('content')
@include('admin.partials._alert')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Danh sách đơn hàng
          </h3>
          
        </div>
        <!-- ./card-header -->
        <div class="card-body">
          <div class="col-12 mt-2 bg-white">
            <ul class="nav nav-pills mb-2 box-title" id="pills-tab" role="tablist">
                {{-- <li class="nav-item flex-1 text-center">
                    <a class="nav-link active" id="order_all_tab" data-toggle="pill" href="#order_all" role="tab" aria-controls="order_all" aria-selected="true">Tất cả</a>
                </li> --}}
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link active" id="wait_confirm_tab" data-toggle="pill" href="#wait_confirm" role="tab" aria-controls="wait_confirm" aria-selected="true">Chờ xác nhận</a>
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
                {{-- <div class="tab-pane fade show active" id="order_all" role="tabpanel" aria-labelledby="order__all_tab">
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
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="{{ asset($order->image)}}" alt="{{$order->title}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                            {{$order->title}}
                                        </div>
                                        <div class=" list__image">
                                            @foreach (explode(',', $order->images) as $img)
                                                <img src="{{asset($img)}}" alt="{{$order->title}}" width="40">
                                            @endforeach
                                        </div>
                                        <div class="total__product">
                                            Số lượng: {{$order->total}}
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($order->money/$order->total)}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-2 text-center">
                                        <div class="price__product text-red">
                                            <sup class="text-underline ">đ</sup>{{number_format($order->money)}}
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="item__wait_confirm item-status">
                                            @if ($order->status ==0)
                                                Chờ xác nhận
                                            @elseif($order->status ==1)
                                                Chờ lấy hàng
                                            @elseif($order->status ==2)
                                                Đang giao hàng
                                            @elseif($order->status ==3)
                                                Đã giao hàng
                                            @else
                                                Đã hủy
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 ">
                                        <a href="{{route('users.detailOrder',$order->detail_order_id)}}">
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
                </div> --}}
                <div class="tab-pane fade show active" id="wait_confirm" role="tabpanel" aria-labelledby="wait_confirm_tab">
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
                              @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id) as $item)
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
                                      <a href="{{route('admin.orders.updateStatus',$order->order_id)}}" class="btn btn-primary">
                                          {{-- <div class="show__detail__order"> --}}
                                              Xác nhận
                                          {{-- </div> --}}
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="{{route('admin.orders.updateCancelled',$order->order_id)}}" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
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
                          @foreach (json_decode($orderWaitGetItem)  as $order)
                            <div class="item-order">
                              @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id) as $item)
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
                                      <a href="{{route('admin.orders.updateTransporting',$order->order_id)}}" class="btn btn-primary">
                                            Giao ĐVVC
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="{{route('admin.orders.updateCancelled',$order->order_id)}}" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
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
                          @foreach (json_decode($orderDelivering)  as $order)
                            <div class="item-order">
                              @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id) as $item)
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
                                  <div class="col-3 text-right ">
                                      <a href="{{route('admin.orders.updateDelivered',$order->order_id)}}" style="max-with:300px" class="btn btn-primary">
                                          Xác nhận đã giao hàng
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="{{route('admin.orders.updateCancelled',$order->order_id)}}" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
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
                          @foreach (json_decode($orderDelivered)  as $order)
                            <div class="item-order">
                              @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id) as $item)
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
                          @foreach (json_decode($orderCancelled)  as $order)
                            <div class="item-order">
                              @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id) as $item)
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
                              {{-- <div class="row ">
                                  <div class="col d-flex justify-content-center align-items-center text-warning">
                                      Lựa chọn
                                  </div>
                                  <div class="col-2 ">
                                      <a href="{{route('admin.orders.updateDelivered',$order->order_id)}}" class="btn btn-primary">
                                            Giao ĐVVC
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="{{route('admin.orders.updateCancelled',$order->order_id)}}" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
                                  </div>
                              </div> --}}
                          </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  @include('admin.partials._alert')

@endsection