<?php

namespace App\Http\Controllers\Site;

use App\category_product;
use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\Community;
use App\Entity\DeliveryAddress;
use App\Entity\District;
use App\Entity\Product;
use App\Entity\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    private $cart;
    private $category;
    private $product;
    private $category_product;
    private $deliveryAddress;
    private $province;
    private $district;
    private $community;
    public function __construct(Category $category,Product $product,category_product $category_product,Cart $cart,DeliveryAddress $deliveryAddress,Province $province,District $district,Community $community){
        $this->cart = $cart;
        $this->category = $category;
        $this->category_product = $category_product;
        $this->product = $product;
        $this->deliveryAddress = $deliveryAddress;
        $this->province = $province;
        $this->district = $district;
        $this->community = $community;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        //
        $user_id = Auth::user()->id;
        $carts = $this->cart->getCartByUserId($user_id)->toJson();
       
        return view('site.defaults.cart',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyNow($product_id)
    {
        //
        try {
            $user_id = Auth::user()->id;
            $data['total'] = 1;
            $checkCart = $this->cart->checkCart($product_id,$user_id); 
            // dd($checkCart);
    
            if($checkCart){
                $checkCart->total = $checkCart->total + $data['total'];
                $checkCart->save();
                $url = redirect()->route('users.cart')->getTargetUrl();
                return redirect($url);
            }else{
                $data['product_id'] = $product_id;
                $data['user_id'] = $user_id;
                $data['status'] = 1;
                $cart = $this->cart->create($data);
                $url = redirect()->route('users.cart')->getTargetUrl();
                return redirect($url);
            }
            
           
        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->back();
        }
        
    }
    /**
     * @param $data
     * **/
    public function updateCart(Request  $request){
        $check = $this->cart->updateCart($request->cart_id, $request->total);
        return $check;
    }

    /**
     * @param Request $request
     * @param  int  $cart_id
     * @return \Illuminate\Http\Response $cart
     * **/
    public function checkOut($cart_id){
        try{
            $user_id =Auth::user()->id;
            $cart = $this->cart->getDetailCartById($cart_id);
            $listAddressDelivery = $this->deliveryAddress->getDeliverAddressUser($user_id);
            $chooseAddress = $this->deliveryAddress->chooseDeliveryAddress($user_id);
            // dd($chooseAddress);
            return view('site.defaults.checkout-order',compact('cart','listAddressDelivery','chooseAddress'));
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->back();
        }
       
    }
    /**
     * @param Request $request
     * @param  int  $arr
     * @return \Illuminate\Http\Response $cart
     * **/
    public function checkOutCart(Request $request){
        $user_id = Auth::user()->id;
        $provinces = $this->province->get_all();
        $districts = $this->district->get_all();
        $communities = $this->community->get_all();
        $arrCart = $request->listCart;
        $listCart = $this->cart->getArrCart($arrCart);
        $listAddressDelivery = $this->deliveryAddress->getDeliverAddressUser($user_id);
        $chooseAddress = $this->deliveryAddress->chooseDeliveryAddress($user_id);

        return view('site.defaults.checkout-orders',compact('listCart','listAddressDelivery','provinces','districts','communities','chooseAddress'));
        // return redirect()->route('users.checkOutListCart')->with( ['arrCart' => $arrCart] );
    }
    public function checkOutListCart($arrCart){
        
        dd(1);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTotalMoneyCart(Request $request){
        $checkedCart = $request->listCart;
        $user_id = Auth::user()->id;
        $listCart = $totalMoney = $this->cart->getUserTotalMoneyCart($checkedCart,$user_id);
        $totalMoney = null;
        foreach($listCart as $cart){
            $money = !empty($cart->price_sale) ? $cart->price_sale * $cart->total : $cart->price_buy * $cart->total;
            $totalMoney = $totalMoney + $money;
        }
        return $totalMoney;
    }
}
