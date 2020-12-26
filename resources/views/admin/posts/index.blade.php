@extends('admin.layouts.app')
@section('title', 'Bài viết')

@section('content')
@include('admin.partials._alert')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Danh sách bài viết</h3>
          <div class="float-right">
            <a href="{{route('admin.posts.create')}}" class="btn btn-primary">
              Thêm mới
            </a>
          </div>
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
                @foreach (json_decode($posts) as $key => $post)
                    <tr data-widget="expandable-table" aria-expanded="false" class="text-center">
                        <td> {{++$key}}</td>
                        <td class="text-left">{{$post->title}}</td>
                        <td >{{date('d-m-Y',strtotime($post->updated_at))}}</td>
                        <td>
                            <a href="{{route('admin.posts.edit',$post->id)}}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="expandable-body d-none">
                        <td colspan="5">
                        <p style="display: none;">
                           <div class="row">
                             <div class="col-1">
                               <div class="CropImg CropImg80">
                                 <div class="thumbs">
                                  <img src="{{asset($post->image)}}" alt="{{$post->title}}">
                                 </div>
                               </div>
                             </div>
                             <div class="col-11 line-4">
                              {!!$post->description!!}
                             </div>
                           </div>
                        </p>
                        </td>
                    </tr>
                @endforeach
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
    <style>
      .line-4{
          line-height: 1.125rem;
          display: -webkit-box;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 4;
          text-overflow: ellipsis;
          overflow: hidden;
          color: rgba(0, 0, 0, .8);
          font-size: 0.875rem;
      }
      }
      .CropImg {
          width: 100%;
          position: relative;
          z-index: 1;
      }
      .CropImg80:before {
          content: "";
          display: block;
          padding-bottom: 80%;
      }
      .CropImg .thumbs {
          overflow: hidden;
          text-align: center;
          display: inline-block;
          position: absolute;
          z-index: 1;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
      }
      .CropImg .thumbs img {
          width: 100%;
          height: 100%;
          max-width: 150%;
          max-height: none;
          position: absolute;
          z-index: 1;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%);
          -moz-transform: translate(-50%, -50%);
          -o-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
      }
    </style>
@endsection