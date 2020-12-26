

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
   
    <div class="order-address">
        <div class="header-address row">
            <div class="text-address col-4">
                Địa chỉ nhận hàng
                <a href="#crollTop"></a>
                <div id="crollTop"></div>
            </div>
            <div class="text-right col-8 createAddress">
                <a href="#" data-toggle="modal" data-target="#addressModal">
                    Thêm mới địa chỉ
                </a>
                {{-- <a href="">
                    Chọn lại địa chỉ
                </a> --}}
            </div>
        </div>
       
        <div class="list-address">
            @foreach (json_decode($listAddressDelivery) as $key=> $deliveyAddress)
            <div class="content-address row" >
                <div class="col-1 d-flex align-items-center justify-content-between">
                    <div class="icheck-primary d-inline">
                        <input type="radio" class="getDelivery" @if($deliveyAddress->status == 1) echo checked @endif delivery="{{$deliveyAddress->id}}"  id="radioPrimary<?php echo $key ?>" name="status" >
                        <label for="radioPrimary<?php echo $key ?>">
                        </label>
                      </div>
                </div>
                <div class="col-10 align-items-center col-10 d-flex justify-content-start">
                        {{$deliveyAddress->name}}( {{$deliveyAddress->phone}})-    {{$deliveyAddress->address}}- {{$deliveyAddress->commune_name}}- {{$deliveyAddress->district_name}}- {{$deliveyAddress->province_name}}
                </div>
            </div>
            @endforeach
            <div id="addAddress"></div>

            <button class="btnOrange button saveDeliverAddress">Hoàn thành</button>
        </div>
        <div class="choose-address" >
            @if (!empty($chooseAddress) )
            {{$chooseAddress->name}}- 
            {{$chooseAddress->phone}}- 
            {{$chooseAddress->address}}- 
            {{$chooseAddress->commune_name}}- 
            {{$chooseAddress->district_name}}- 
            {{$chooseAddress->province_name}}
            <span class="ml-4">
                <a href="#" id="changeDeliveryAddress"  onclick="changeDeliveryAddress()">Thay đổi</a>
            </span>
            @else
                Chưa chọn địa chỉ nhận hàng 
                <span class="ml-4">
                    <a href="#" id="changeDeliveryAddress"  onclick="changeDeliveryAddress()">Thay đổi</a>
                </span>
            @endif
           
        </div>
    </div>
    
    <div class="order-product">
        <div class="header-order-product d-flex">
            <div class="text-header-product" >
               Sản phẩm
            </div>
        </div>
            
        <div class="detail-order-product">
            <div class="row text-center">
                <div class="col-2">Ảnh</div>
                <div class="col-6">Thông tin sản phẩm</div>
                <div class="col-2">Đơn giá</div>
                <div class="col-2">Thành tiền</div>
            </div>
            @foreach ($listCart as $cart)
                <div class="row">
                    <div class="col-2">
                        <div class="box-image" >
                            <img src="{{$cart->image}}" alt="  {{$cart->title}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="title__product cart__id"  cart-id="{{$cart->cart_id}}">
                            {{$cart->title}}
                        </div>
                        {{-- <div class="type__product">
                            Phân loại hàng: Xám
                        </div> --}}
                        <div class="total__product">
                            Số lượng: {{$cart->total}}
                        </div>
                    </div>
                    <div class="col-2 ">
                        <div class="price__product text-red justify-content-center">
                            <sup class="text-underline ">đ</sup>
                            @if (!empty($cart->price_sale))
                                {{number_format($cart->price_sale)}} 
                            @else
                                {{number_format($cart->price_buy)}} 
                            @endif
                        </div>
                    </div>
                    <div class="col-2 ">
                        <div class="price__product text-red justify-content-center">
                            <sup class="text-underline ">đ</sup>
                            @if (!empty($cart->price_sale))
                                {{number_format($cart->price_sale * $cart->total)}} 
                            @else
                                {{number_format($cart->price_buy * $cart->total)}} 
                            @endif
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
                                <sup class="text-underline ">đ</sup>
                                @php
                                    $totalMoney = null;
                                    foreach ($listCart as $cart){
                                        $money = !empty($cart->price_sale) ? $cart->price_sale :$cart->price_buy;
                                        $totalMoney = $totalMoney + $money * $cart->total;
                                    }
                                @endphp
                                    {{number_format($totalMoney)}} 
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
                                <sup class="text-underline ">đ</sup>
                                {{number_format($totalMoney)}}
    
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
                    <div class="d-flex p-3 border payment-item ">
                        <button class="btn btnOrange ml-auto btnPayment">
                            Thanh toán
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

  
  <!-- Modal -->
  <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addressModalLabel">Thêm 1 Địa Chỉ Mới</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="box-content">
                <div class="form-group">
                    <input type="text" name="name" class="form-control resert" placeholder="Họ và tên" autocomplete="off" >
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control resert" placeholder="Số điện thoại" autocomplete="off" >
                </div>
                <div class="form-group">
                    <select name="province_id" id="province_id" class="form-control">
                        <option value="">Tỉnh thành phố</option>
                        @foreach (json_decode($provinces) as $province)
                            <option value="{{$province->id}}">{{$province->name}}</option>
                        @endforeach
                       
                    </select>
                </div>
                <div class="form-group">
                    <select name="district_id" id="district_id" disabled class="form-control">
                        <option value="">Quận/Huyện</option>
                        @foreach (json_decode($districts) as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select name="community_id" id="community_id" disabled class="form-control">
                        <option value="">Phường/Xã</option>
                        @foreach (json_decode($communities) as $community)
                        <option value="{{$community->id}}">{{$community->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control resert" placeholder="Địa chỉ cụ thể" autocomplete="off" >
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở lại</button>
          <button type="button" class="btn btnOrange btnSubDeliveryAddress">Hoàn thành</button>
        </div>
      </div>
    </div>
  </div>
