<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'user', 'as' => 'users.'], function () {
        Route::get('login', 'UserController@showLoginForm')->name('showLoginForm');
        Route::post('login', 'UserController@login')->name('login');
        Route::get('index', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::get('edit/{slug}', 'UserController@edit')->name('edit');
        Route::post('update/{slug}', 'UserController@update')->name('update');
        Route::post('store', 'UserController@store')->name('store');
    });

    Route::group(['prefix' => 'post', 'as' => 'posts.'], function () {
        Route::get('index', 'PostController@index')->name('index');
        Route::get('create', 'PostController@create')->name('create');
        Route::get('edit/{slug}', 'PostController@edit')->name('edit');
        Route::post('update/{slug}', 'PostController@update')->name('update');
        Route::post('store', 'PostController@store')->name('store');
    });
    Route::group(['prefix' => 'product', 'as' => 'products.'], function () {
        Route::get('index', 'ProductController@index')->name('index');
        Route::get('create', 'ProductController@create')->name('create');
        Route::get('edit/{slug}', 'ProductController@edit')->name('edit');
        Route::post('update/{slug}', 'ProductController@update')->name('update');
        Route::post('store', 'ProductController@store')->name('store');
    });
    Route::group(['prefix' => 'category', 'as' => 'categorys.'], function () {
        Route::get('index', 'CategoryController@index')->name('index');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::get('edit/{slug}', 'CategoryController@edit')->name('edit');
        Route::post('update/{slug}', 'CategoryController@update')->name('update');
        Route::post('store', 'CategoryController@store')->name('store');
    });
    Route::group(['prefix' => 'order', 'as' => 'orders.'], function () {
        Route::get('index', 'OrderController@index')->name('index');
        Route::get('create', 'OrderController@create')->name('create');
        Route::get('edit/{slug}', 'OrderController@edit')->name('edit');
        Route::post('updateStatus/{order_id}', 'OrderController@updateStatus')->name('updateStatus');
        Route::get('updateStatus/{order_id}', 'OrderController@updateStatus')->name('updateStatus');
        Route::get('updateTransporting/{order_id}', 'OrderController@updateTransporting')->name('updateTransporting');
        Route::get('updateDelivered/{order_id}', 'OrderController@updateDelivered')->name('updateDelivered');
        Route::get('updateCancelled/{order_id}', 'OrderController@updateCancelled')->name('updateCancelled');
        Route::post('store', 'OrderController@store')->name('store');
    });
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'menu', 'as' => 'menus.'], function () {
        Route::get('index', 'MenuController@index')->name('index');
        Route::get('create', 'MenuController@create')->name('create');
        Route::get('edit/{slug}', 'MenuController@edit')->name('edit');
        Route::post('update/{slug}', 'MenuController@update')->name('update');
        Route::post('store', 'MenuController@store')->name('store');
    });
    // Route::fallback(function(){
    //     return redirect()->route('admin.users.showLoginForm');
    // });
});
Route::group(['namespace' => 'Site'], function () {
    Route::group(['as' => 'users.'], function () {
        Route::get('/dang-ky-tai-khoan', 'UserController@register')->name('register');
        Route::get('/dang-nhap', 'UserController@login')->name('login');

        Route::get('dang-xuat', 'UserController@logout')->name('logout');
        Route::get('quen-mat-khau', 'UserController@forget_password')->name('forget_password');

        Route::post('store', 'UserController@store')->name('store');
        Route::post('loginPost', 'UserController@loginPost')->name('loginPost');
        Route::get('/gio-hang',  'CartController@cart')->name('cart')->middleware('checkUserLogin');
        Route::post('/dat-hang/{product_id}',  'CartController@buyNow')->name('buyNow')->middleware('checkUserLogin');
        Route::get('/dat-hang/{product_id}',  'CartController@buyNow')->name('buyNow')->middleware('checkUserLogin');
        Route::post('/update-cart',  'CartController@updateCart')->name('updateCart')->middleware('checkUserLogin');

        Route::get('/don-hang',  'OrderController@order')->name('order')->middleware('checkUserLogin');
        Route::get('/chi-tiet-don-hang/{detail_order_id}',  'OrderController@detailOrder')->name('detailOrder')->middleware('checkUserLogin');


        Route::get('/get-total-money-cart',  'CartController@getTotalMoneyCart')->name('getTotalMoneyCart')->middleware('checkUserLogin');
        Route::post('/thanh-toan',  'OrderController@paymentOrder')->name('paymentOrder')->middleware('checkUserLogin');


        Route::post('/xoa-san-pham/{cart_id}',  'CartController@cancelCart')->name('cancelCart')->middleware('checkUserLogin');
        Route::get('/checkout/{cart_id}',  'CartController@checkOut')->name('checkOut')->middleware('checkUserLogin');
        Route::get('/checkout-carts',  'CartController@checkOutCart')->name('checkOutCart')->middleware('checkUserLogin');
        Route::get('/checkout-list-cart',  'CartController@checkOutListCart')->name('checkOutListCart')->middleware('checkUserLogin');
        Route::get('checkout/ajax-district/{province_id}', 'ProvinceController@districtByProvinceId')->name('districtByProvinceId');
        Route::get('checkout/ajax-community/{district_id}', 'DistrictController@communityByDistrictId')->name('communityByDistrictId');

        Route::post('save-delivery-address', 'UserController@saveDeliveryAddress')->name('save-delivery-address');
        Route::post('update-delivery-address', 'UserController@updateDeliveryAddress')->name('choose-delivery-address');

        Route::get('thong-bao/{user_id}', 'NotificationController@notification')->name('notification');

        Route::get('updateCancelled/{product_id}', 'OrderController@updateCancelled')->name('updateCancelled');

        Route::get('/san-pham/danh-gia/{product_slug}', 'ProductController@review')->name('review');
        Route::post('/san-pham/danh-gia/{product_id}', 'ProductController@postReview')->name('postReview');
    });


    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/bai-viet/{slug}', 'PostController@index')->name('post.detail');
    Route::get('/danh-muc/{slug}', 'CategoryController@index')->name('category');
    Route::get('/san-pham/{product_slug}', 'ProductController@index')->name('product');
    // Route::fallback(function(){
    //     return \Response::view('errors._404');
    // });

});
// Route::fallback(function () {
//     view('errors._404');
// });

// Route::any('{any}', function(){
//     return response()->json([
//         'status'    => false,
//         'message'   => 'Page Not Found.',
//     ], 404);
// })->where('any', '.*');
// Route::any('{url?}/{sub_url?}', function(){
//     return response()->json([
//         'status'    => false,
//         'message'   => 'Page Not Found.',
//     ], 404);
// });
