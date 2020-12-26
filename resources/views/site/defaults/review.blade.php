@extends('site.layouts.app-new')
@section('content')
<div class="get-rating col-12">
    <div class="row text-center">
        <div class="col-lg-6 col-md-6 fontReview"><b class="tilte-show">Hãy cho chúng tôi biết cảm nhận của bạn về sản phẩm!</b></div>
        <div class="col-lg-6 col-md-6 loadajax">
            <b>
                <span id="ContentPlaceHolder1_lbgetrating">{{round(4,1)}}</span><i
                        class="fa fa-star"></i>
            </b>
            <div id="ContentPlaceHolder1_divrating" class="rating">
                <div itemscope="" itemtype="https://schema.org/Book">
                    <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                        <span itemprop="ratingValue">{{round(4,1)}}</span>
                        <span itemprop="ratingCount"> {{4}} </span> đánh giá
                        <meta itemprop="bestRating" content="5">
                        <meta itemprop="worstRating" content="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="star-rating">
        <div class="row text-center">
            <div class="form-wid100 choose__rate ">
                <span class="rating-title  to-way-none"
                      style="color: #0000ff;font-weigh:bold">Chọn đánh giá </span>
                <span class="review-rating-8 "></span>
            </div>
            <div class="form-wid100">
                <div class="live-rating hide "></div>
            </div>
        </div>
        <span class="rsdanhgia hide"></span>
        <div class="form-rating hide">
            <form action="{{route('users.postReview',$post->product_id)}}" method="post"id="formRating" method="post">
                {{csrf_field()}}
                <div class="row form-group">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 no-padding-left">
                        <input type="text" name="star" hidden value="">
                        <textarea id="content_rating"
                                  class="form-control form-control-style error-message keyup-content" rows="3"
                                  name="content"
                                  placeholder="Đánh giá sản phẩm">
                           
                        </textarea>
                        <div class="color-red info-error" style="display: none"></div>
                        @if ($errors->has('content'))
                            <span class="help-block color-red"><strong>{{ $errors->first('content') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    {{-- <div class="col-12 col-sm-3 col-md-3 col-lg-3 pd_r_6px">
                        <input type="text" id="user_name" name="rate_name" autocomplete="off"
                               placeholder="Họ tên" class="form-control-style form-control keyup-content">
                        <div class="color-red user_name-info-error" style="display: none"></div>
                        @if ($errors->has('user_name'))
                            <span class="help-block color-red"><strong>{{ $errors->first('user_name') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 pd_l_6px pd_r_6px">
                        <input type="text" id="phone_assess" name="rate_phone" autocomplete="off"
                               placeholder="Số điện thoại"
                               onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10"
                               class="form-control-style form-control keyup-content">
                        <div class="color-red phone_assess-info-error" style="display: none"></div>
                        @if ($errors->has('phone_assess'))
                            <span class="help-block color-red"><strong>{{ $errors->first('phone_assess') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 pd_l_6px pd_r_6px">
                        <input type="email" id="email" name="rate_email" autocomplete="off" placeholder="Email"
                               class="form-control-style form-control keyup-content">
                        <div class="color-red email-info-error" style="display: none"></div>
                        @if ($errors->has('email'))
                            <span class="help-block color-red"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div> --}}
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 pd_l_6px ">
                        <input type="submit" id="btnrating" class="btn bgOrange" value="Gửi đánh giá"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        @if (!empty($reviews))
            <div id="ContentPlaceHolder1_divdanhgia">
                <ol class="danhgialist">
                    @foreach($reviews as $evaluate)
                        <div class="itemReview">
                            <div class="row">
                                {{-- <div class="border-top-10px-md"></div> --}}
                                <div class=" col-12 col-sm-6 col-md-6 col-lg-6 ">
                                    <div class="border-top-10px title__info">
                                        <div class="rating-name">{{!empty($evaluate->star_name)? $evaluate->star_name: 'Ẩn danh'}}</div>
                                        |
                                        <div class="user-detail-rating"
                                             data-rating="{{$evaluate->star}}"></div>
                                    </div>
                                </div>
                                <div class=" col-12 col-sm-6 text-right col-md-6 col-lg-6">
                                    @php
                                        $dateEvaluate = \App\Ultility\Constant::getdateFacebook($evaluate->created_at);
                                    @endphp
                                    {{$dateEvaluate}}
                                </div>
                            </div>
                            <div class="row">
                                <div class=" contentReview col-12 col-sm-12">{{$evaluate->content}}</div>
                            </div>
                        </div>
                    @endforeach
                </ol>
                {!! $reviews->links() !!}
                @endif
            </div>
    </div>
</div>
@endsection
@section('after-scripts')
<script src="{{asset('js/site/star-rating-svg.min.js')}}"></script>
<script src="{{asset('js/site/star-rating-code.js')}}"></script>
@endsection
@section('after-css')
<link defer rel="stylesheet" type="text/css" href="{{asset('css/site/star-rating-svg.css')}}">
<link defer rel="stylesheet" type="text/css" media="screen" href="{{asset('css/site/style-rating.css')}}">
@endsection