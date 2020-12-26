@extends('admin.layouts.app') 
@section('title', 'Bài viết')

@section('after-css')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content') 
@if (session('error'))
<div class="row">
    <div class="col-12 col-xs-12 col-md-12 col-lg-12  pd-0 pd-t-15">
        <div class="alert alert-danger mg-b-0 " role="alert">
            {{ session('error') }}
            <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
        </div>
    </div>
</div>
@endif
@if (session('success'))
<div class="row">
    <div class="col-12 col-xs-12 col-md-12 col-lg-12  pd-0 pd-t-15">
        <div class="alert alert-success mg-b-0 ">
            {{session('success')}}
            <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
        </div>
    </div>
</div>
@endif

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
                                <label for="inputTitle">Tiêu đề bài viết</label>
                                <input autocomplete="off" type="text" name="title" value="{{$post->title}}" class="form-control" id="inputTitle" aria-describedby="emailHelp" placeholder="Nhập tiêu đề bài viết">
                                </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputSlug">Slug bài viết</label>
                                <input readonly type="text" name="slug"  value="{{$post->slug}}" class="form-control" id="inputSlug" aria-describedby="emailHelp" placeholder="Nhập slug bài viết">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-6">
                                <div class="form-group">
                                <input type="button" onclick="return uploadImage(this);" value="Chọn ảnh" size="20">
                                {{-- <img src="{{$post->image}}" width="80" height="70"> --}}
                                <input name="image" type="hidden" value="{{$post->image}}">
                                <div id="image"></div>
                                @if ($errors->has('image'))
                                <span class="help-block text-danger "><strong>{{ $errors->first('image') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputDescription">Mô tả bài viết</label>
                                <textarea name="description" id="inputDescription" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập mô tả bài viết">
                                    {!! $post->description !!}
                                </textarea>

                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputContent">Nội dung tả bài viết</label>
                                <textarea name="content" id="inputContent" cols="30" rows="10" class="editor form-control" rows="3" placeholder="Nhập nội dung bài viết">
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
        
        // $('#submitFormPost').click(function(e) {
        //     e.preventDefault();
        //     let title = $('#inputTitle').val();
        //     let description = $('#inputDescription').val();
        //     let content = $('#inputContent').val();
        //     let images = $(input[name="images"]).val();
        //     if(
        //         title.length != ''||
        //         description.length != ''||
        //         content.length != ''||
        //         images.length != ''||
        //     ){
        //         if
        //     }
        // });
    });
     
</script>
@endsection