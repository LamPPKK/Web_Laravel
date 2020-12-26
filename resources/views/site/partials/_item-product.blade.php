<div class="box__product js_box_product hover__product hover_item_product">
    <a href="{{ route('product', $product->slug) }}" class="focus-outline-none" title="{{ $product->title }}">
        <div class=" ">
            <div class=" relative">

                <div class="box__image__product">
                    <div class="CropImg CropImg80">
                        <div class="thumbs">
                            @php
                                 $image_url = !empty($product->image) ?  asset($product->image) : asset('clothes-04/img/no-image.png');
                            @endphp
                            <img  class="item__image__product "  src="{{$image_url}}"
                                  alt="{{$product->title}}"/>
                           
                        </div>
                    </div>


                    @if (!empty($percent))
                        <div class="icon__sale">
                            <div class="shop__badge shop__badge__fixed__width shop__badge__promotion">

                                <div class="text-center text-danger">{{round($percent,0)}}%</div>
                                <div class="text-center text-white text__sale">GIẢM</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="description__product padding__10px">
                    <div class="title__product js_title__product">
                        {{$product->title}}
                    </div>
                    <div class=" d-flex justify-content-around">


                    @if(!empty($product->price_sale))
                        <div class=" price__origin ">
                            <span class="text-line-through"><sup class="money-vietnamese">đ</sup>{{ !empty($product->price_buy) ? number_format($product->price_buy) : 'Đang cập nhật'}}</span>
                        </div>
                        <div class=" price__sale m_g_l_8px">
                            <span class="clred "><sup class="money-vietnamese">đ</sup>{{ !empty($product->price_sale) ? number_format($product->price_sale) : 'Đang cập nhật'}}</span>
                        </div>
                    @elseif(!empty($product->price_buy))
                    <div class=" price__sale m_g_l_8px">
                        <span class="clred "><sup class="money-vietnamese">đ</sup>{{ !empty($product->price_buy) ? number_format($product->price_buy) : 'Đang cập nhật'}}</span>
                    </div>
                    @else
                        <div class="box_product_discoun text-rightt">
                           <span style="text-decoration: underline">đ</span> <span class="pr_discout"> Đang cập nhật</span>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
