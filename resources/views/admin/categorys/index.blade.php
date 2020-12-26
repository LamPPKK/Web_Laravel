@extends('admin.layouts.app')
@section('content')
@include('admin.partials._alert')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Danh sách danh mục </h3>
          <div class="float-right">
            <a href="{{route('admin.categorys.create')}}" class="btn btn-primary">
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
                <th>Tên</th>
                <th>
                  Loại
                </th>
                <th>Cập nhật</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
                @foreach (json_decode($categorys) as $key => $category)
                    <tr >
                        <td class="text-center"> {{++$key}}</td>
                        <td class="text-left">{{$category->title}}</td>
                        <td class="text-left">{{$category->type}}</td>
                        <td class="text-center">
                            <a href="{{route('admin.posts.edit',$category->id)}}" class="text-center">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="" class="text-center">
                                <i class="fa fa-trash"></i>
                            </a>
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