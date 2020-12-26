<div class="shop-top shop-top768 sticky-top background_top_header">
    <div class="container mbdsNone">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-12 mbds_none_770">
                <ul class="navbar__links">
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav__link__header color-white text_top_header pjy1mut-background pjy1mut-ic_facebook-2x-png text_top_header" title="Kết nối Facebook" target="_blank">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-12 mbdsNone mbds_none_770">
                <ul class="navbar__links float-right navbar__links768">

                    <li class="nav-item">
                        <a href="#" onclick="notify();" class="nav-link nav__link__header color-white text_top_header">
                            Thông báo
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a href="#" onclick="help();" class="nav-link nav__link__header color-white text_top_header">
                                Trợ giúp
                            </a>
                        </li>
                        <li class="nav-item relative">
                            <a href="#" onclick="userCall();" class="nav-link nav__link__header color-white text_top_header" style="display: inline-block">
                            {{Auth::user()->name}}
                            </a>
                            <span style="color: #fff !important;">|</span>
                            <a href="{{route('users.order')}}" class="nav-link nav__link__header color-white text_top_header" style="display: inline-block">Đơn hàng</a>

                            <span style="color: #fff !important;">|</span>

                            <a href="{{route('users.logout')}}" class="nav-link nav__link__header color-white text_top_header" style="display: inline-block">Thoát</a>
                            {{-- <div class="item__notify item__user  ">
                                <a href="{{route('users.logout')}}" title="Đăng xuất">
                                    <div class="item__data_notify">
                                        <div class="box__content_notify">
                            
                                            <div class="title__product_search color-white text_top_header">
                                                <i class="fa fa-sign-out"></i>
                                                Đăng xuất
                                            </div>
                            
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                        </li>
                    @else
                         <li class="nav-item">
                            <a href="{{route('users.register')}}" class="nav-link nav__link__header color-white text_top_header">
                                Đăng ký
                            </a>
                        </li>
                        <div class="navbar__link-separator"></div>

                        <li class="nav-item">
                            <a href="{{route('users.login')}}" class="nav-link nav__link__header color-white text_top_header" >
                                Đăng nhập
                            </a>
                            {{-- <a href="{{route('users.login')}}" class="nav-link nav__link__header color-white text_top_header" data-toggle="modal"
                            data-target="#loginForm">
                                Đăng nhập
                            </a> --}}
                        </li> 
                    @endif
                  


                    
                    <li class="nav-item">
                        <div class="col-md-1 col-2 cart_user li_cart_user d-none">
                            <a href="javascript:;">
                                <div class="cart">
                                    <i class="fa fa-shopping-cart icon__cart"></i>
                                </div>
                            </a>
                            <div>
                                <div class="cart">
                                    <i class="fa fa-user-circle icon__cart d-none"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row_index header_search cus_header_search">
            <div class="col-xl-2 col-lg-2 col-md-2 mbdsNone mbds_none_770">
                <a href="/">
                    <img src="{{asset('images/Hình ảnh CLB/huyhieu.jpg')}}" style="border-radius: 5px;height: 100px;" class="logoSite" alt="Logo" title="Logo">
                </a>
            </div>
            <div class="col-xl-9 col-lg-9  col-md-9 col-sm-9 col-9 ">
                <div class="section-header-search">

                    <div class="form-search__input" style="position: relative">
                        <input type="text" name="keySearch" placeholder="Tìm kiếm sản phẩm" autocomplete="off" class="input__header__search" value="">
                        <span class="box__header__search">
                            <button type="button" class="btn__header__search background_top_header"
                                onclick="document.getElementById('formSearchHeader').submit();">
                                <i class="fa fa-search icon__header__search" style="color:red"></i>
                            </button>
                        </span>
                    </div>
                    </form>
                    <div class="show__data__search_header"></div>
                </div>
                <div class="list__cate__product mbdsNone mbds_none_770">
                    @php
                        $cateProductHeader = \App\Entity\Category::getCategoryHeader();
                        $cateProductHeader = json_decode($cateProductHeader);
                    @endphp
                    @foreach ($cateProductHeader as $cate)
                    @php
                        $active = null;
                        if(URL::current() == route('category',$cate->id)){

                            $active = 'active-header';
                        }
                        
                    @endphp
                    <a href="{{route('category',$cate->id)}}" class="item__cate text_top_header <?php echo $active; ?>" title=" ">
                      {{ $cate->title}}
                    </a>
                    @endforeach
                   
                </div>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-3 col-sm-3 col-3 cart_user mb_icon_header">
                <a href="{{route('users.cart')}}">
                    <div class="cart">
                        <i class="fa fa-shopping-cart icon__cart text_top_header"></i>
                    </div>
                </a>
                <a class="dsNone mbdsBlock mbds_inline_block_770" href="#" data-toggle="modal" data-target="#loginForm">
                    <div class="cart">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </div>
                </a>

            </div>
        </div>
    </div>

</div>
