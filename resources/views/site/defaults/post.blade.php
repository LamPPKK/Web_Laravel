@extends('site.layouts.app-new')
@section('title', $post->title)

@section('content')
<section class="post">
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:;">Trang chủ</a>
                </li>
        
                <li>
                    <a href="javascript:;">
                        Bài viết
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        {{$post->title}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8">
            <h1 class="title-post">
                {{$post->title}}
            </h1>
            
            <div class="content-post">
                <p><?= $post->content ?></p>

            </div>
            {{-- <div class="share-post">
                <div class="fb-share-button" data-href="{{ route('post.detail',  $post->slug) }}" data-layout="button_count" data-size="small">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('post.detail',  $post->slug) }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                        Chia sẻ
                    </a>
                </div>
                <div class="zalo-share-button" data-href="{{ route('post.detail',  $post->slug) }}" data-oaid="3838145860528513831" data-layout="1" data-color="blue" data-customize=false></div>
            </div> --}}
            <div class="comments-post">
                <div class="row">
                    <div class="col-12">
                        <div class="fb-comments"  data-numposts="5" data-width=""></div>
                    </div>
                </div>
                {{-- <div class="fb-comments"  data-numposts="5" data-width=""></div> --}}
            </div>
        </div>
        <div class="col-12 col-md-4">
            <h4>Danh sách bài viết gần đây</h4>
            @php
                $listPost = \App\Entity\Post::getPostTotal(4);
            @endphp
            <ul class="list-unstyled">
                @foreach ($listPost as $post)
                <a href="{{ route('post.detail', $post->slug) }}" class="focus-outline-none" title="{{ $post->title }}">
                    
                    <li class="media mb-2">
                    <img class="mr-3" src="{{$post->image}}" style="width: 64px; height: 64px;" alt="Generic placeholder image">
                    <div class="media-body">
                        <h6 class="mt-0 mb-1">
                            {{$post->title}}
                        </h6>
                        <div class="calander__post" style="color: rgb(119 110 107);padding-top: 0rem;">
                            <i class="fa fa-calendar"></i>
                            <span >
                                {{date('d-m-Y',strtotime($post->updated_at))}}
                            </span>
                        </div>
                    </div>
                    </li>
                </a>
                @endforeach
            </ul>
            
        </div>
    </div>
</section>
@endsection
{{-- @section('after-scripts')
    <script>
        setTimeout(function() {
            var listScripts = [
               'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=1508841146171149',
                'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js',
            ];
            for(var i=0; i<listScripts.length; i++){
                var headID = document.getElementsByTagName("head")[0];         
                var newScript = document.createElement('script');
                newScript.type = 'text/javascript';
                newScript.src = listScripts[i];
                headID.appendChild(newScript);
                console.log(newScript);

            }
           
            var da = new Date();
            console.log(da);
        }, 4000);
    </script>
@endsection --}}