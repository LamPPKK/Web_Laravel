@extends('admin.layouts.app') 
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
                                <label for="inputTitlePost">Tiêu đề bài viết</label>
                                <input  type="text" name="title" class="form-control" id="inputTitlePost"  placeholder="Nhập tiêu đề bài viết">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputSlugPost">Slug bài viết</label>
                                <input type="text" name="slug" class="form-control" id="inputSlugPost"  placeholder="Nhập slug bài viết">
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-6">
                                <div class="form-group">
                                <input type="button" onclick="return uploadImage(this);" value="Chọn ảnh" size="20">
                                <img src="" width="80" height="70">
                                <input name="images" type="hidden" value="">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputDescriptionPost">Mô tả bài viết</label>
                                <textarea name="description" id="inputDescriptionPost" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập mô tả bài viết"></textarea>

                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputContentPost">Nội dung tả bài viết</label>
                                <textarea name="content" id="inputContentPost" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập nội dung bài viết"></textarea>
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