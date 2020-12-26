@extends('site.layouts.app-new')
@section('title', 'Giỏ hàng')

@section('content')
<section class="user-cart">
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
        <div class="col-12">
            <div class="list-order">
                <div class="info-top">
                    <div class="row">
                        <div class="col-2">Ảnh</div>
                        <div class="col-3">
                            Thông tin sản phẩm
                        </div>
                        <div class="col-2">
                            Giá sản phẩm
                        </div>
                        <div class="col-2">
                            Số lượng
                        </div>
                        <div class="col-1">
                            Tổng tiền
                        </div>
                        <div class="col-2">
                            Thao tác
                        </div>
                    </div>
                </div>
                @foreach (json_decode($carts) as  $key =>  $cart)
                <div class="item-order">
                    <div class="row">
                        <div class="col-2">
                            <div class="box-image d-flex align-items-center justify-content-center">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary@php echo $key  @endphp" cart_id="{{$cart->cart_id}}" class="checkItem" >
                                    <label for="checkboxPrimary@php echo $key  @endphp">
                                    </label>
                                </div>
                                <img src="{{ asset($cart->image)}}" alt="{{$cart->title}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="title__product ">
                                {{$cart->title}}
                            </div>
                            <div class="gallery">
                               
                                @foreach(explode(',',$cart->gallery) as $image)
                                    <img src="{{$image}}" width="50" style="margin-left: 5px; margin-bottom: 5px;"/>
                                @endforeach
                            </div>
                           
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            {{-- <div class="price__product text-red">
                                <sup class="text-underline ">đ</sup>25.000.000.000
                            </div> --}}
                            @if (!empty($cart->price_sale))
                                <div class=" price__origin ">
                                    <div class=" text-underline">
                                        <sup class="money-vietnamese">đ</sup>
                                    </div>
                                    <div class=" font-14px left-6px text-line-through ">{{ number_format($cart->price_buy)}}</div>
                                </div>
                                <div class=" price__sale ml-2">
                                    <div class=" text-underline">
                                        <sup class="money-vietnamese">đ</sup>
                                    </div>
                                    <div class=" font-22px left-6px text-red sell-price"
                                            price="{{$cart->price_sale}}">{{ number_format($cart->price_sale)}}</div>
                                </div>
                            @else
                                <div class=" price__sale ml-2">
                                    <div class=" text-underline">
                                        <sup class="money-vietnamese">đ</sup>
                                    </div>
                                    <div class=" font-22px left-6px text-red sell-price"
                                            price="{{$cart->price}}">{{ number_format($cart->price_buy)}}</div>
                                </div>
                              
                            @endif
                        </div>
                        <div class="col-2 align-items-center col-2 d-flex justify-content-center">
                            <div class="box-total d-flex">
                                <input type="hidden" name="price_product"  value="{{ !empty($cart->price_sale)  ? $cart->price_sale : $cart->price_buy}}">

                                <button class="btn minus-product" cart-id="{{$cart->cart_id}}">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text"  readonly name="total" maxlength="2" value="{{$cart->total}}" class="only-number input-total" id="total__product">
                                <button class="btn plus-product" cart-id="{{$cart->cart_id}}">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-1 text-center">
                            <div class="price__product text-red">
                                <sup class="text-underline ">đ</sup>
                                <span class="show-price">
                                    @if (!empty($cart->price_sale))
                                            {{  number_format($cart->price_sale * $cart->total)}}
                                    @else
                                            {{  number_format($cart->price_buy * $cart->total)}}
                                    @endif
                                </span>

                            </div>
                        </div>
                        <div class="col-2  d-flex align-items-center justify-content-around">
                            <div class="box-action w-100">
                                <div class="row">
                                    <div class="col d-block text-center ">
                                        <a href="{{route('users.checkOut',$cart->cart_id)}}" class=" text-orange payment-cart">Thanh toán</a>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col d-block text-center ">
                                        <a href="{{route('users.cancelCart',$cart->cart_id)}}" class=" text-red cancel-cart">Hủy</a>
                                    </div>
                                </div>
                            </div>
                           

                        </div>
                    </div>
                </div>
                @endforeach
                @if (count(json_decode($carts)) > 0)
                <div class="row ">
                    <div class="col-1">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkboxAll" class="checkAll" >
                            <label for="checkboxAll">
                            </label>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center text-warning">
                        Lựa chọn
                    </div>
                    <div class="col-2 align-items-center d-flex justify-content-center">
                        <div class=" price__sale d-flex">
                            <div class=" text-underline">
                                <sup class="money-vietnamese">đ</sup>
                            </div>
                            <div class=" font-22px left-6px text-red sell-price " id="totalMoneyCartChoose" ></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class=" button btnOrange" id="buyItemCart">
                           Mua hàng
                        </div>
                    </div>
                </div>
                @endif
              
            </div>
        </div>
    </div>
</section>
<section class="checkoutOrder">

</section>
@endsection
@section('after-css')
    <link rel="stylesheet" href="{{asset('template/Site/public/css/check-bootstrap-v3.0.1.css')}}">
@endsection
@section('after-scripts')
{{-- <script type="text/javascript" src="{{ asset('js/site/product.js') }}"></script> --}}
    <script>
         
        $('.minus-product').on('click', function(e) {
            e.preventDefault();
            let total__product = $(this).next();
            if (total__product.val() > 1) {
                let total = parseInt(total__product.val()) - 1;
                total__product.val(total);
                let product_price = $(this).prev().val()
                if (product_price != undefined) {
                    let cart_id = $(this).attr('cart-id');
                    let show_price = total * product_price;
                    let change_price = show_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

                    $(this).parent().parent().next().children().children().next().text(change_price);
                   
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "/update-cart",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            total: total,
                            cart_id: cart_id,
                        },
                        success: function(data) {
                            console.log(data)
                        },
                        dataType: false
                    });
                }
            }
        });
        $('.plus-product').on('click', function(e) {
            e.preventDefault();
            let total__product = $(this).prev();
            let total = parseInt(total__product.val()) + 1;
            if (total > 99) {
                total__product.val(99);
            } else {
                total__product.val(total);
            }
            let product_price = $(this).prev().prev().prev().val()
            if (product_price != undefined) {
                let cart_id = $(this).attr('cart-id');
                let show_price = total * product_price;
                let change_price = show_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

                $(this).parent().parent().next().children().children().next().text(change_price);


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/update-cart",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        total: total,
                        cart_id: cart_id,
                    },
                    success: function(data) {
                        console.log(data)
                    },
                    dataType: false
                });
            }
           
        });
        $(".checkAll").click(function(){
            $(".checkItem").prop('checked', $(this).prop('checked'));
            var listCart = [];
            $(".checkItem:checked").each(function() {
                var cart_id = $(this).attr('cart_id');
                listCart.push(cart_id);
                console.log(listCart)
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{route('users.getTotalMoneyCart')}}",
                data: {
                    listCart: listCart,
                },
                success: function(data) {
                    let show_price = data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                    $('#totalMoneyCartChoose').text(show_price);
                },
                dataType: false
            });
        });
        $(".checkItem").click(function(){
            var listCart = [];
            $(".checkItem:checked").each(function() {
                var cart_id = $(this).attr('cart_id');
                listCart.push(cart_id);
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{route('users.getTotalMoneyCart')}}",
                data: {
                    listCart: listCart,
                },
                success: function(data) {
                    let show_price = data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                    $('#totalMoneyCartChoose').text(show_price);
                },
                dataType: false
            });
        });
        $("#buyItemCart").click(function(){
            var listCart = [];
            $(".checkItem:checked").each(function() {
                var cart_id = $(this).attr('cart_id');
                listCart.push(cart_id);
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{route('users.checkOutCart')}}",
                data: {
                    listCart: listCart,
                },
                success: function(data) {
                    $('.user-cart').hide();
                    $('.checkoutOrder').html(data);
                },
                dataType: false
            });
        });
        function changeDeliveryAddress(){
            $('.createAddress').show();
            $('.list-address').show();
            $('.choose-address').hide();
        }

        $(document).on("click", ".saveDeliverAddress", function() { 
            let delivery_id = $("input:radio.getDelivery:checked").attr('delivery');
            console.log(delivery_id)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{route('users.choose-delivery-address')}}",
                data: {
                    delivery_id: delivery_id,
                },
                success: function(res) {
                    if(res.status =='200'){
                        let data = res.data;
                        let address = data.name+ '- '+ data.phone+ '- '+ data.address+ '- '+ data.commune_name+ '- '+ data.district_name+ '- '+ data.province_name+ '<span class="ml-4"> <a href="#" id="changeDeliveryAddress" delivery_id='+data.id+' onclick="changeDeliveryAddress()">Thay đổi</a></span>';
                        $('.list-address').hide();
                        $('.createAddress').hide();
                        $('.choose-address').html(address);
                        $('.choose-address').html(address);
                        $('.choose-address').show();
                        topFunction()
                    }
                },
                dataType: false
            });
        });
        $(document).on("change","#province_id",function () {
            console.log(1);
            $.get("checkout/ajax-district/" + $(this).val(), function (data) {
                // console.log(data);
                $("#district_id").removeAttr('disabled');
                $("#district_id").html(data);
            });
        });
        $(document).on("change","#district_id",function () {
            console.log(1);
            $.get("checkout/ajax-community/" + $(this).val(), function (data) {
                // console.log(data);
                $("#community_id").removeAttr('disabled');
                $("#community_id").html(data);
            });
        });
        $(document).on("click",".btnSubDeliveryAddress",function () {
            let name = $('input[name="name"]').val();
            let phone = $('input[name="phone"]').val();
            let address = $('input[name="address"]').val();
            let province_id = $('#province_id').val();
            let district_id = $('#district_id').val();
            let community_id = $('#community_id').val();
           
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{route('users.save-delivery-address')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    address: address,
                    phone: phone,
                    province_id: province_id,
                    district_id: district_id,
                    commune_id: community_id
                },
                success: function(data) {
                    console.log(data)
                    if(data.status =='200'){
                        $('#addressModal').modal('hide');
                        Swal.fire({
                            title: 'Thàng công!',
                            text: "Thêm mới địa chỉ thành công",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#007bff',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            console.log(data.address)
                            $('.resert').val('');
                            $('#addAddress').before(data.address);
                        })
                        
                    }
                },
                dataType: false
            });
        });
        $(document).on('click','.btnPayment',function (){
            var listCart = [];
            $(".cart__id").each(function() {
                var cart_id = $(this).attr('cart-id');
                listCart.push(cart_id);
                console.log(cart_id)
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{route('users.paymentOrder')}}",
                data: {
                    listCart: listCart,
                },
                success: function(res) {
                    console.log(res);
                    if(res.status =='200'){
                        Swal.fire({
                            title: 'Thàng công!',
                            text: "Lên đơn hàng thành công",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#007bff',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = res.url;
                            }
                        })
                    }
                },
                dataType: false
            });
        });
    </script>
@endsection