@extends('admin.layouts.app') 
@section('title', 'Bài viết')

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
                <h3 class="card-title">Thêm mới bài viết</h3>

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
               
                <form action="{{route('admin.posts.store')}}" enctype="multipart/form" method="post" id="formCreatePost">
                    @csrf
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputTitle">Tiêu đề bài viết</label>
                                <input autocomplete="off"  type="text" name="title" class="form-control" value="{{old('title')}}" id="inputTitle"  placeholder="Nhập tiêu đề bài viết">
                                @if ($errors->has('title'))
                                    <span class="help-block text-danger ">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputSlug">Slug bài viết</label>
                                <input readonly type="text" name="slug"  value="{{old('slug')}}" class="form-control" id="inputSlug"  placeholder="Nhập slug bài viết">
                                @if ($errors->has('slug'))
                                    <span class="help-block text-danger " >
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="button" onclick="return uploadImage(this);" value="Chọn ảnh" size="20">
                                <input name="image"  type="hidden" value="">
                                <div id="image"></div>
                                @if ($errors->has('image'))
                                <span class="help-block text-danger "><strong>{{ $errors->first('image') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputDescription">Mô tả bài viết</label>
                                <textarea name="description" id="inputDescription" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập mô tả bài viết">
                                    {{old('description')}}
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block text-danger " >
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputContent">Nội dung tả bài viết</label>
                                <textarea name="content" id="inputContent" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập nội dung bài viết">
                                    {{old('content')}}
                                </textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block text-danger " >
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
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
@include('admin.partials._alert')

@endsection 
@section('after-scripts')
<script src="{{ asset('template/AdminLTE-master/plugins/toastr/toastr.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('template/AdminLTE-master/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
     $(function() {
        // $(document).Toasts('create', {
        //     class: 'bg-success',
        //     title: 'Toast Title',
        //     subtitle: 'Subtitle',
        //     body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        // })
        $('.editor').each(function (e) {
            CKEDITOR.replace(this.id, {
                filebrowserImageBrowseUrl: '/kcfinder-master/browse.php?type=images&dir=images/public',
            });
        });
    });
    
    // $(document).ready(function() {

	// 	$("#formCreatePost").validate({
	// 		rules: {
	// 			title: "required",
	// 			slug: "required",
	// 			inputDescriptionPost: "required",
	// 			inputContentPost: "required",
	// 		},
	// 		messages: {
	// 			title: "Chưa nhập tiêu đề bài viết",
	// 			slug: "Chưa nhập tiêu đề bài viết",
	// 			inputDescriptionPost: "Chưa nhập tiêu đề bài viết",
	// 			inputContentPost: "Chưa nhập tiêu đề bài viết",
	// 		}
	// 	});
    // });
</script>
@endsection