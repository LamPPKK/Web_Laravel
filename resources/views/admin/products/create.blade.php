@extends('admin.layouts.app') 
@section('title', 'Sản phẩm')

@section('after-css')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <style>
        .toast.show {
    display: block;
    opacity: 1;
    transition: opacity 3s;
    transition-property: opacity;
    transition-duration: 3s;
    transition-timing-function: ease;
    transition-delay: 0s;
}
    </style>
@endsection
@section('content') 
<div class="row">
    <div class="col-12">
        <!-- Default box -->
       
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm mới sản phẩm</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            {{-- </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button> --}}
                </div>
            </div>
            <div class="card-body">
               
                <form action="{{route('admin.products.store')}}" enctype="multipart/form" method="POST" id="formCreateProduct">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-10">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="inputTitle">Tiêu đề sản phẩm</label>
                                        <input  type="text" value="{{old('title')}}" name="title" class="form-control" id="inputTitle"  placeholder="Nhập tiêu đề sản phẩm">
                                        @if ($errors->has('title'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('title') }}</strong></span>
                                        @endif
                                       
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="inputSlug">Slug bài viết</label>
                                        <input type="text"  value="{{old('slug')}}" name="slug" class="form-control" id="inputSlug"  placeholder="Nhập slug bài viết">
                                        @if ($errors->has('slug'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('slug') }}</strong></span>
                                        @endif
                                      
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="button" onclick="return uploadImage(this);" value="Chọn ảnh" size="20"  style="margin-bottom: .25rem">
                                        <input name="image" type="hidden" value="">
                                        <div id="image"></div>
                                        @if ($errors->has('image'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('image') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputListImage">Bộ sưu tập ảnh</label>
                                        <input type="button" onclick="return openKCFinder(this);" value="Chọn ảnh" size="20">
                                        <div class="imageList">
                                        </div>
                                        <input name="images" type="hidden" value="">
                                        @if ($errors->has('images'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('images') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputPriceBuy">Giá bán</label>
                                        <input type="text" name="price_buy" value="{{old('price_buy')}}" class="form-control formatPrice" id="inputPriceBuy"  placeholder="Nhập giá bán">
                                        @if ($errors->has('price_buy'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('price_buy') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputPriceSale">Giá sale</label>
                                        <input type="text" name="price_sale" value="{{old('price_sale')}}" class="form-control formatPrice" id="inputPriceSale"  placeholder="Nhập giá sale">
                                        @if ($errors->has('price_sale'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('price_sale') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputDescription">Mô tả bài sản phẩm</label>
                                            <textarea name="description" id="inputDescription" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập mô tả bài sản phẩm">
                                                {{old('description')}}
                                            </textarea>
                                            @if ($errors->has('description'))
                                            <span class="help-block text-danger "><strong>{{ $errors->first('description') }}</strong></span>
                                            @endif
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputContent">Giới thiệu sản phẩm</label>
                                        <textarea name="content" id="inputContent" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Giới thiệu sản phẩm">
                                            {{old('content')}}
                                        </textarea>
                                        @if ($errors->has('content'))
                                        <span class="help-block text-danger "><strong>{{ $errors->first('content') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <div class="box box-primary boxCateScoll">
                                <div class="box-header with-border">
                                    <h3 class="box-title" style="font-size:16px">Chọn danh mục</h3>
                                </div>
                                <!-- /.box-header -->
                              
                                <div class="box-body">
        
                                    @foreach($categories  as $cate)
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="categories[]" value="{{ $cate->id }}" class="flat-red">
                                                {{ $cate->title }}
                                            </label>
                                        </div>
                                    @endforeach
        
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success" id="submitFormPost">Thêm mới</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <!-- /.card-body -->
            {{-- <div class="card-footer">
                Footer
            </div> --}}
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>
{{-- <button type="button" class="btn btn-success toastrDefaultSuccess">
    Launch Success Toast
  </button> --}}
@endsection 
@section('after-scripts')
<script src="{{ asset('template/AdminLTE-master/plugins/toastr/toastr.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('template/AdminLTE-master/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
     $(function() {
      
        $('.editor').each(function (e) {
            CKEDITOR.replace(this.id, {
                filebrowserImageBrowseUrl: '/kcfinder-master/browse.php?type=images&dir=images/public',
            });
        });
    });
   
    $(document).ready(function() {
        $('.formatPrice').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.'
        });
		// $("#formCreateProduct").validate({
		// 	rules: {
		// 		title: "required",
		// 		slug: "required",
		// 		inputDescriptionPost: "required",
		// 		inputContentPost: "required",
		// 	},
		// 	messages: {
		// 		title: "Chưa nhập tiêu đề sản phẩm",
		// 		slug: "Chưa nhập tiêu đề sản phẩm",
		// 		inputDescriptionPost: "Chưa nhập tiêu đề sản phẩm",
		// 		inputContentPost: "Chưa nhập tiêu đề sản phẩm",
		// 	}
		// });
    });
</script>
@endsection