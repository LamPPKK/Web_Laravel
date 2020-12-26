<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{asset('images/Hình ảnh CLB/huyhieu.jpg')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/dist/css/adminlte.min.css')}}"> 
    <link rel="stylesheet" href="{{ asset('template/Admin/css/style.css')}}"> 
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/client.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/Site/public/css/detail_order.css')}}" type="text/css">
    @yield('after-css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.partials.nav-header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        {{-- <div class="col-sm-6">
                            <h1>Fixed Layout</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Fixed Layout</li>
                            </ol>
                        </div> --}}
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @yield('footer')

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
   
  {{-- <div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite" style="">
      <div class="toast-message">Thêm mới sản phẩm thành công.</div>
        <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" style="position: absolute; right:.5rem;top:.5rem" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
  </div>  --}}



  <!-- jQuery -->
  <script src="{{ asset('template/AdminLTE-master/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('template/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script
    src="{{ asset('template/AdminLTE-master/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('template/AdminLTE-master/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('template/AdminLTE-master/dist/js/demo.js')}}"></script>
  <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('js/jquery.price-format.js')}}"></script>
  <script src="{{ asset('js/slug.js')}}"></script>
  
  <!-- CK Editor -->
  @include('admin.partials.scripts') 
  @yield('after-scripts')
</body>

</html>