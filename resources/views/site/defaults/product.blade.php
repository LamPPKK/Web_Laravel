@extends('site.layouts.app-new')
@section('title', $product->title)

@section('content')
<section>
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Trang chủ</a>
                </li>
                <li>
                    <a href="javascript:;">
                        Sản phẩm
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        {{$product->title}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{route('users.buyNow',$product->id)}}" method="post">
                @csrf
                <div id="info-product" style="background: #fff">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                                    <div class="product_image_zoom">
                                        @php
                                            $url_image =  !empty($product->image) ?  asset($product->image) : asset('/site/img/no-image.png');
                                            $gallery = explode(",", $product->images);
                                        @endphp
                                        <img class="zoom-img" id="zoom_03" class="image__product"
                                            src="{{$url_image}}" alt="{{ $product->title }}"
                                            data-zoom-image="{{$url_image}}"
                                            />

                                    </div>


                                    <div id="gallery_01" class=" slideProductZoom  slick-slider">
                                        <a href="#" class="elevatezoom-gallery active" data-update=""
                                        data-image="{{$url_image}}"
                                        data-zoom-image="{{$url_image}}">
                                            <img src="{{$url_image}}"/>
                                        </a>
                                        @foreach ($gallery as $image)
                                            <a href="#" class="elevatezoom-gallery a_slicck_image " data-update=""
                                                data-image="{{$image}}"
                                                data-zoom-image="{{$image}}">
                                                <img src="{{$image}}"/>
                                            </a>
                                        @endforeach
                                    </div>

                                </div>
                                <div class="group__info product col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
                                
                                            <div class="title__product_cart">
                                                <h1 class="f22">{{ $product->title }}</h1>
                                            </div>
                                            @if (!empty($avgEvaluate))
                                                <div class="row pd_t_1 d-flex align-items-center">
                                                    <div class="col-3 ">
                                                        Số sao đánh giá:
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="avgStar"
                                                                data-rating="{{round($avgEvaluate,1)}}"></div>
                                                    </div>

                                                </div>
                                            @endif

                                            <div class="price pd_t_1 row">
                                                <div class="col-3">
                                                    Giá: 
                                                </div>
                                                <div class="col-9 d-flex align-items-center justify-content-start">
                                                   
                                                    @if (!empty($product->price_sale))
                                                        <div class=" price__origin ">
                                                            <div class=" text-underline">
                                                                <sup class="money-vietnamese">đ</sup>
                                                            </div>
                                                            <div class=" font-14px left-6px text-line-through ">{{ number_format($product->price_buy)}}</div>
                                                        </div>
                                                        <div class=" price__sale ml-2">
                                                            <div class=" text-underline">
                                                                <sup class="money-vietnamese">đ</sup>
                                                            </div>
                                                            <div class=" font-22px left-6px text-red sell-price"
                                                                    price="{{$product->price_sale}}">{{ number_format($product->price_sale)}}</div>
                                                        </div>
                                                    @elseif(!empty($product->price_buy))
                                                        <div class=" price__sale ml-2">
                                                            <div class=" text-underline">
                                                                <sup class="money-vietnamese">đ</sup>
                                                            </div>
                                                            <div class=" font-22px left-6px text-red sell-price"
                                                                    price="{{$product->price}}">{{ number_format($product->price_buy)}}</div>
                                                        </div>
                                                    @else
                                                        <div class=" price__sale ml-2">
                                                            <div class=" font-22px left-6px text-red sell-price" price="{{$product->price}}">
                                                                Đang cập nhật
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="pd_t_1 row">
                                                <div class="col-3 ">
                                                    Vận chuyển
                                                </div>
                                                <div class="col-9">
                                                    Miễn Phí Vận Chuyển khi đơn đạt giá trị tối thiểu
                                                </div>
                                            </div>
                                            @if (!empty($product->color))
                                                <div class="pd_t_1 row">
                                                    <div class="col-3">
                                                        Màu sắc
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="flex-w color">
                                                            <div class="product-variation choose-item-color">
                                                                Xanh
                                                            </div>
                                                            <div class="product-variation choose-item-color">
                                                                Đỏ
                                                            </div>
                                                            <div class="product-variation choose-item-color">
                                                                Tím
                                                            </div>
                                                            <div class="product-variation choose-item-color">
                                                                Vàng
                                                            </div>
                                                            <div class="product-variation choose-item-color">
                                                                Hồng
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="pd_t_1 row content__description">
                                                    <div class="col-3">
                                                        Mô tả sản phẩm
                                                    </div>
                                                    <div class="col-9">
                                                        {!! $product['description'] !!}
                                                    </div>


                                                </div>

                                            @endif

                                            <div class="pd_t_1 row">
                                                <div class="col-3 d-flex align-items-center">
                                                    Số lượng
                                                </div>
                                                <div class="col-4">
                                                
                                                    <input type="hidden" name="product_id"  value="{{ $product->id }}">
                                                    <div class="box-total d-flex">
                                                        <button class="btn minus-product">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                        <input type="text" value="1" readonly name="total" maxlength="2" class="only-number input-total" id="total__product">
                                                        <button class="btn plus-product">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            
                                            </div>

                                            <div class="mbds_block_770 dsNone">
                                                <button type="submit" class="button-cart button w-100 mt-2">
                                                    <i class="fa fa-cart-plus"></i> 
                                                    Thêm vào giỏ hàng
                                                </button>
                                                <button type="submit" class="button-order button w-100 mt-2 d-block text-center">
                                                    <i class="fa fa-cart-plus"></i> Đặt hàng ngay
                                                </button>
                                            </div>

                                            <div class="contact__us">
                                                <div class="title__contact text-center">
                                                    Chúng tôi sẽ liên lạc với bạn
                                                </div>
                                                <div class="contact__content">
                                                    <div class="content__left">
                                                        <input type="text" class="form-control form-control-sm"
                                                                id="contact__name" style="margin-bottom: .2rem"
                                                                name="name"
                                                                autocomplete="off" placeholder="Họ và tên">
                                                        <input type="text" class="form-control form-control-sm"
                                                                id="contact__phone" name="name"
                                                                autocomplete="off"
                                                                placeholder="Cho chúng tôi biết số điện thoại của bạn !">
                                                    </div>
                                                    <div class="content__right">
                                                        <button class=" btn-danger btn__send__contact">Gửi
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mbds_none_770 pd_t_1">
                                                <div class="col-12">
                                                    <button type="submit" class="button-cart button">
                                                        <i class="fa fa-cart-plus"></i> 
                                                        Thêm vào giỏ hàng
                                                    </button>
                                                    <button type="submit" class="button-order button ">
                                                        <i class="fa fa-cart-plus"></i> Đặt hàng ngay
                                                    </button>
                                                </div>
                                            </div>
                                            

                                                
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
            <div id="content-product" class="content-product bg_white ">
                <div class="title-product">
                    Chi tiết sản phẩm
                </div>
                <div class="content-box">
                    {!! $product['content'] !!}


                    <div class="share__post pd_t_1">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                Chia sẻ:
                                <div class="fb-share-button btn__share ml-2"
                                     data-href="{{ route('product', [ 'post_slug' => $product->slug]) }}"
                                     data-layout="button_count">
                                </div>
                                <div class="zalo-share-button btn__share ml-2" data-href=""
                                     data-oaid="579745863508352884" data-layout="1" data-color="blue"
                                     data-customize=false></div>
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
<link rel="stylesheet" href="{{ asset('zoom-plus/prism.css') }}" type="text/css">
@endsection
@section('after-scripts')
{{-- /*zoom image*/ --}}
<script type="text/javascript" src="{{ asset('zoom-plus/jquery.ez-plus.js') }}"></script>
 <script type="text/javascript" src="{{ asset('zoom-plus/web.js') }}"></script>
<script type="text/javascript" src="{{ asset('zoom-plus/snippet-helper.js') }}"></script>
<script type="text/javascript" src="{{ asset('zoom-plus/prism.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/product.js') }}"></script>
{{-- /*zoom image*/ --}}

   
@endsection