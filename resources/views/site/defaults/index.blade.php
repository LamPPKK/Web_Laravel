@extends('site.layouts.app-new')
@section('title', 'Trang chủ')
@section('content')

    <section class="list-new">
        <div class="row">
            <div class="col-12">
                <div class="title-home-page">
                    <h3>HOT !!!</h3>
                </div>
            </div>
        </div>
        <div class="row slidePost">
        
            @foreach (\App\Entity\Product::getProductByCategory(5) as $product)
            @include('site.partials._item-product')
            @endforeach
            
        </div>
    </section>
    <section class="list-new">
        <div class="row">
            <div class="col-12">
                <div class="title-home-page">
                    <h3>NEW !</h3>
                </div>
            </div>
        </div>
        <div class="row slidePost">
        
            @foreach (\App\Entity\Product::getProductByCategory(6) as $product)
            @include('site.partials._item-product')
            @endforeach
            
        </div>
    </section>
    <section class="list-new">
        <div class="row">
            <div class="col-12">
                <div class="title-home-page">
                    <h3>Sản phẩm dành cho bạn !</h3>
                </div>
            </div>
        </div>
        <div class="row slidePost">
        
            @foreach (\App\Entity\Product::getProductByCategory(7) as $product)
            @include('site.partials._item-product')
            @endforeach
            
        </div>
    </section>
    <section class="list-new">
        <div class="row">
            <div class="col-12">
                <div class="title-home-page">
                    <h3>Tin tức MU shop</h3>
                </div>
            </div>
        </div>
        <div class="row slidePost">
           
            @foreach ($posts as $post)
            {{-- <div class="col-12 col-sm-4 col-md-3  col-lg-2"> --}}
               @include('site.partials._item-post')
            {{-- </div> --}}
            @endforeach
            
        </div>
    </section>
@endsection
@section('after-css')
<link rel="stylesheet" href="{{ asset('template/Site/public/css/home__page.css')}}" type="text/css">
@endsection
@section('after-scripts')
    <script>
         $('.slidePost').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                }, {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endsection