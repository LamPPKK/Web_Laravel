@extends('admin.layouts.app')
@section('title', 'Sản phẩm')

@section('content')
@include('admin.partials._alert')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Danh sách sản phẩm
          </h3>
          <div class="float-right">
            <a href="{{route('admin.products.create')}}" class="btn btn-primary">
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
                <th>Giá bán</th>
                <th>Thời gian</th>
                <th>Cập nhật</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
                @foreach (json_decode($products) as $key => $product)
                    <tr data-widget="expandable-table" aria-expanded="false" class="text-center">
                        <td> {{++$key}}</td>
                        <td class="text-left">{{$product->title}}</td>
                        <td class="text-left">{{number_format($product->price_buy)}}</td>
                        <td >{{date('d-m-Y',strtotime($product->updated_at))}}</td>
                        <td>
                            <a href="{{route('admin.products.edit',$product->slug)}}">
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
                        <td colspan="6">
                        <p style="display: none;">
                            {!! $product->content !!}
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
  @include('admin.partials._alert')

@endsection