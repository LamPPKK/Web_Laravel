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
                <h3 class="card-title">Sửa bài viết</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
           
                </div>
            </div>
            <div class="card-body">
               
                <form action="{{route('admin.posts.update',$post->id)}}" enctype="multipart/form" method="post" id="formCreatePost">
                    @csrf
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputTitlePost">Tiêu đề bài viết</label>
                                <input type="text" name="title" value="{{$post->title}}" class="form-control" id="inputTitlePost" aria-describedby="emailHelp" placeholder="Nhập tiêu đề bài viết">
                                </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputSlugPost">Slug bài viết</label>
                                <input type="text" name="slug"  value="{{$post->slug}}" class="form-control" id="inputSlugPost" aria-describedby="emailHelp" placeholder="Nhập slug bài viết">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-6">
                                <div class="form-group">
                                <input type="button" onclick="return uploadImage(this);" value="Chọn ảnh" size="20">
                                <img src="{{$post->image}}" width="80" height="70">
                                <input name="image" type="hidden" value="{{$post->image}}">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputDescriptionPost">Mô tả bài viết</label>
                                <textarea name="description" id="inputDescriptionPost" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập mô tả bài viết">
                                    {!! $post->description !!}
                                </textarea>

                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputContentPost">Nội dung tả bài viết</label>
                                <textarea name="content" id="inputContentPost" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập nội dung bài viết">
                                    {{$post->content}}

                                </textarea>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success" id="submitFormPost">Cập nhật</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <!-- /.card-body -->
           
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>

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
        
        $('#submitFormPost').click(function(e) {
            e.preventDefault();
            let title = $('#inputTitlePost').val();
            let description = $('#inputDescriptionPost').val();
            let content = $('#inputContentPost').val();
            let images = $(input[name="images"]).val();
            if(
                title.length != ''||
                description.length != ''||
                content.length != ''||
                images.length != ''||
            ){
                if
            }
        });
    });
     
</script>
@endsection