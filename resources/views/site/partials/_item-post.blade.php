<div class="box__product js_box_post">
    <a href="{{ route('post.detail',  $post->slug) }}">
        <div class="hover__product">
            <div class="margin__bottom">
                <div class="box__image__product">
                    <div class="CropImg CropImg80">
                        <div class="thumbs">
                            <img src=" {{ !empty($post->image) ?  asset($post->image) : asset('clothes-04/site/img/no-image.png') }}"
                                 class="item__image__product" alt="{{$post->title}}">
                        </div>
                    </div>
                </div>

                <div class="description__product padding__10px">
                    <div class="title__product">
                       {{ $post->title }}
                    </div>
                </div>
                 <div class="calander__post" style="color: rgb(119 110 107)">
                    <i class="fa fa-calendar"></i>
                    <span >
                        {{date('d-m-Y',strtotime($post->updated_at))}}
                    </span>
                </div>
            </div>
        </div>
    </a>
</div>