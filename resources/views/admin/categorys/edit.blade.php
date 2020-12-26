@extends('admin.layouts.app') 
@section('after-css')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/AdminLTE-master/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

@endsection
@section('content') 
@include('admin.partials._alert')
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
               
                <form action="{{route('admin.categorys.store')}}" enctype="multipart/form" method="POST" id="formCreateProduct">
                    @csrf
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputTitle">Tiêu đề danh mục</label>
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
                                <label for="selectCategory" >Loại danh mục</label>
                                <select name="type" class="form-control" id="selectCategory">
                                    <option value="1">Danh mục sản phẩm</option>
                                    <option value="2">Danh mục hiển thị</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block text-danger " >
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="inputSlug">Slug danh mục</label>
                                <input autocomplete="off" readonly  type="text" name="slug" class="form-control" value="{{old('slug')}}" id="inputSlug"  placeholder="Nhập tiêu đề bài viết">
                                @if ($errors->has('slug'))
                                    <span class="help-block text-danger ">
                                        <strong>{{ $errors->first('slug') }}</strong>
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

@endsection 
