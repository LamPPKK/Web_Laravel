@extends('admin.layouts.app') 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Expandable Table</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Tên bài viết</th>
                            <th>Thời gian</th>
                            <th>Cập nhật</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection
@section('after-css')
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="{{asset('template/AdminLTE-master/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
     <!-- Toastr -->
     <link rel="stylesheet" href="{{asset('template/AdminLTE-master/plugins/toastr/toastr.min.css')}}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{asset('template/AdminLTE-master/dist/css/adminlte.min.css')}}">
@endsection
@section('after-scripts')

  <script src="{{asset('template/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('template/AdminLTE-master/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{asset('template/AdminLTE-master/plugins/toastr/toastr.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('template/AdminLTE-master/dist/js/adminlte.min.js')}}"></script>
  <script>
    $(document).ready(function() {
      $('.toast').toast('show')
    });
  </script>
@endsection