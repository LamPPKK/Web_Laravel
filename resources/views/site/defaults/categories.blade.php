@extends('site.layouts.app-new')
@php
    $titleCate = \App\Entity\Category::getCategoryTitle($slug_cate);

@endphp
@section('title',json_decode($titleCate)->title)
@section('content')
    <section class="list-new">
        <div class="row">
            <div class="col-12">
                <div class="title-home-page">
                    <h3>
                        
                        {{json_decode($titleCate)->title}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
           
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                    @include('site.partials._item-product')
                </div>
            @endforeach
            
        </div>
    </section>
@endsection
@section('after-css')
<link rel="stylesheet" href="{{ asset('template/Site/public/css/home__page.css')}}" type="text/css">
@endsection