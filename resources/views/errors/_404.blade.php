@extends('site.layouts.app-new')
@section('content')
<section class="content">
    <div class="error-page row justify-content-center">
      <h2 class="headline text-warning col-2"> 404</h2>

      <div class="error-content col-10">
        <h3><i class="fa fa-exclamation-triangle text-warning"></i> Cảnh báo</h3>

        <p>
            Chúng tôi không thể tìm thấy trang bạn đang tìm kiếm.
            Trong khi đó, bạn có thể <a href="/"> quay lại trang chủ. </a> 
        </p>

        
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
@endsection