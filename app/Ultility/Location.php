<?php

namespace App\Ultility;


class Location 
{
    //
    private $locationMenu = array(
        'menu-chinh' => 'Menu chính',
        'menu-product' => 'Menu sản phẩm',
        'menu-cate-product' => 'Menu nhóm sản phẩm',
        'menu-category_product' => 'Menu danh mục sản phẩm',
        'menu_category_product_top' => 'Menu danh mục sản phẩm top',
        'menu_product_home' => 'Menu gợi ý sản phẩm',

        //          'menu-phu-tren-cung' => 'menu phụ trên cùng',
        //          'side-left-menu' => 'sidebar menu trái',
        //          'side-right-menu' => 'sidebar menu phải',
        'new' => 'Tin tức',
        'footer-first' => 'Chân trang 1',
        'footer-sm-first' => 'Danh sách bài viết cho mobile',
        // 'footer-second' => 'chân trang thứ 2',
        // 'footer-third' => 'chân trang thứ 3',
        'notification' => 'Thông báo',
        'help' => 'Trợ giúp',
        //          'menu-footer' => 'menu cuối trang',
        //
        //
        //          'anh-menu' => 'ảnh menu',
        //          'sider-bar-blog' => 'sidebar blog menu trái',
        //          'menu-tab-index' => 'Tab menu sản phẩm trang chủ',
        //          'show-category-index' => 'hiển thị danh mục trang chủ',
    );

    public function getLocationMenu()
    {
        return $this->locationMenu;
    }
    private $typeCategory=[
        'Sản phẩm',
        'Danh mục',
    ];
    public   function getTypeCategory(){
        return $this->typeCategory;
    }
}
