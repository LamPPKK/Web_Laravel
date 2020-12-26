<!DOCTYPE html>
<html mlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" class="no-js">

<head>
    <title>@yield('title')</title>
    <!-- meta -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- your_facebook_user_id = 100045665363614 --}}
    {{-- <meta property="fb:admins" content="100045665363614"/> --}}
    <meta property="fb:app_id" content="978229195998565">

    <link rel="alternate" href="https://shopmu.vn" hreflang="vi-vn" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hệ thống bán đồ phục vụ các fan hâm mộ CLB Manchester United."
    />
    <meta name="keywords" content="Quần áo MU, đồ lưu niệm MU,áo khoác MU, ba lô MU, khẩu trang MU, tất MU, móc khóa MU." />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('images/Hình ảnh CLB/huyhieu.jpg')}}" type="image/x-icon" />



    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:locale" content="vi_VN" />

    <meta property="og:type" content="" />
    <meta property="og:title" content="Chuyên nhập khẩu phân phối quần áo MU chất lượng cao" />
    <meta property="og:description" content="Hệ thống bán đồ phục vụ các fan hâm mộ CLB Manchester United."
    />
    <meta property="og:url" content="https://MUshop.vn" />
    <meta property="og:image" content="https://MUshop.vn/Chưa cập nhật" />
    <meta property="og:image:secure_url" content="https://MUshop.vn/Chưa cập nhật" />

    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />



    <!-- Bootstrap 4.0.0 -->
    <link rel="stylesheet" href="{{ asset('template/Site/public/bootstrap-4.0.0/dist/css/bootstrap.css')}}" type="text/css">


    <link rel="stylesheet" href="{{ asset('template/Site/public/font-awesome-master/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('template/Site/public/sweetalert2/dark.css')}}">
    <link rel="stylesheet" href="{{ asset('slick/slick.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('template/Site/public/css/product.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/header.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/home__page.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/thang_responsive.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/client.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/detail_order.css')}}" type="text/css">
    @yield('after-css')
   
</head>

<body>

    @include('site.partials.nav-header')
    <div class="content container bg-white">
       @yield('content')

    </div>
    @include('site.partials.footer')
    @include('site.partials._login')
    <script type="text/javascript" src="{{ asset('template/Site/public/js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/Site/public/bootstrap-4.0.0/dist/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/Site/public/js/numeral.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/Site/public/bootstrap-4.0.0/dist/js/bootstrap.bundle.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/Site/public/js/jquery.matchHeight-min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/Site/public/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/Site/public/js/scripts.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    @yield('after-scripts')

   
    @include('site.partials.message-facebook')
   {{-- @include('site.partials.message-zalo') --}}
    {{-- @include('site.partials.sdk-facebook')
    @include('site.partials.sdk-zalo') --}}
</body>

</html>