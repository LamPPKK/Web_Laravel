@extends('site.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{-- <div class="fb-comments" data-href="https://www.hangnhatso1.vn/sua-bot-beanstalk-so-0-nhat-ban-800g-cho-be-tu-0-12-thang" data-numposts="5" data-width=""></div> --}}
            <div class="fb-comments" data-href="http://shopmu.test/home" data-numposts="5" data-width=""></div>
        </div>
    </div>
    {{-- <div class="form-group">
        <input type="button" onclick="return uploadImage(this);" value="Chọn ảnh" size="20">
        <img src="" width="80" height="70">
        <input name="image" type="hidden" value="">
    </div> --}}
</div>
@endsection
