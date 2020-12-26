<?php

namespace App\Http\Controllers\Site;

use App\category_product;
use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\DeliveryAddress;
use App\Entity\DetailOrder;
use App\Entity\HistoryOrder;
use App\Entity\ItemOrder;
use App\Entity\Notification;
use App\Entity\Order;
use App\Entity\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ultility\Constant;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $cart;
    private $category;
    private $product;
    private $category_product;
    private $order;
    private $itemOrder;
    private $detailOrder;
    private $deliveryAddress;
    private $historyOrder;
    private $constant;
    

    public function __construct(DeliveryAddress $deliveryAddress, 
    Category $category, 
    Product $product, 
    category_product $category_product, 
    Cart $cart,
    Order $order,
    ItemOrder $itemOrder,
    HistoryOrder $historyOrder,
    Constant $constant,
    DetailOrder $detailOrder)
    {
        $this->cart = $cart;
        $this->category = $category;
        $this->category_product = $category_product;
        $this->product = $product;
        $this->order = $order;
        $this->itemOrder = $itemOrder;
        $this->detailOrder = $detailOrder;
        $this->deliveryAddress = $deliveryAddress;
        $this->historyOrder = $historyOrder;
        $this->constant = $constant;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOrder($product_id)
    {
        //
        $this->cart->checkOrder($product_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        //
        $user_id = Auth::user()->id;
        // dd($user_id);
        $orderWaitConfirm = $this->order->getOrderByStatus(0,$user_id);
        $orderWaitGetItem = $this->order->getOrderByStatus(1,$user_id);
        $orderDelivering = $this->order->getOrderByStatus(2,$user_id);
        $orderDelivered = $this->order->getOrderByStatus(3,$user_id);
        $orderCancelled = $this->order->getOrderByStatus(4,$user_id);
        $orderAll = $this->order->getOrderAll($user_id);
        // dd(json_decode($orderWaitConfirm));
        return view('site.defaults.order',compact(
            'orderAll', 
            'orderWaitConfirm', 
            'orderWaitGetItem',
            'orderDelivering',
            'orderDelivered',
            'orderCancelled'
        ));
    }

    public function detailOrder($order_id){
        $user_id = Auth::user()->id;
        $notices = Notification::where('order_id',$order_id)->get();
        foreach($notices as $noti){
            $noti->status = 1;
            $noti->save();
        }
       
        $order = $this->detailOrder->getOrderById($order_id,$user_id); 
       

        $totalMoney =null;
        foreach($order as $item){
            $totalMoney = $item->money+ $totalMoney;
        }
        // dd($order);
        $delivery_address = $this->deliveryAddress->getDeliverAddressDetail($order[0]->delivery_address_id,$user_id);
        
        return view('site.defaults.detail-order',compact('delivery_address','order','totalMoney'));
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
    public function paymentOrder(Request  $request)
    {
        try {
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $cart_id = $request->cart_id;
            $deliver_address = DeliveryAddress::where(['user_id'=>$user_id,'status'=>1])->first();
            $delivery_address_id = $deliver_address->id;

            // create order
            $createOrder = [
                'user_id' => $user_id,
                'status' => 0,
                'delivery_address_id' => $delivery_address_id
            ];
            $order = $this->order->create($createOrder);
            $createHistory = [
                'order_id' => $order->id,
                // 'status' => 0,
                'status' => 0
            ];
            $this->historyOrder->create($createHistory);
            if(!empty($cart_id)){
               $this->addOrder($cart_id,$user_id,$order->id);
            }else{
                foreach($request->listCart as $cart){
                    $this->addOrder($cart,$user_id,$order->id);
                }
            }
            $statusUpdate = 0;
            $this->createNotification($order->id,$statusUpdate);
            DB::commit();
            $url = redirect()->route('users.order')->getTargetUrl();
            return response()->json([
                'status' => 200,
                'url' => $url
            ]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500
            ]);
        }
    }
    public function addOrder($cart_id,$user_id,$order_id){
        $cart = $this->cart->find($cart_id);
        $cart->status = 0;
        $cart->save();
        $product = $this->product->detailProductById($cart->product_id);
        $money = !empty($product->price_sale) ? $product->price_sale : $product->price_buy;

        $createOrderDetail = [
            'user_id' => $user_id,
            'product_id' => $cart->product_id,
            'total' => $cart->total,
            'money' => $money
        ];
        
        $orderDetail = $this->detailOrder->create($createOrderDetail);
        
        $createItemOrder = [
            'order_id' => $order_id,
            'detail_order_id' => $orderDetail->id,
        ];
        $this->itemOrder->create($createItemOrder);
       
    }

    public function updateCancelled($order_id)
    {
        //
        // dd(1);
        // try {


            $statusUpdate = 4;
            DB::beginTransaction();
            
            $this->order->updateStatusOrder($order_id,$statusUpdate );
            $historyOrder = $this->historyOrder->updateStatusOrder($order_id, $statusUpdate);
            $statusOrder = $this->constant->getStatusOrder();
            $statusContent = '';
            foreach ($statusOrder as $key => $content) {
                if ($key == $statusUpdate) {
                    $statusContent = $content;
                }
            }
            $content = "Đơn hàng số " . $order_id . " của bạn " . $statusContent;
            $order = $this->order->findOrderById($order_id);
            $notification = [
                'user_id' => $order->user_id,
                'order_id' => $order_id,
                'content' => $content,
                'status' => 0
            ];
            Notification::create($notification);
            DB::commit();
            session()->flash('success', 'Hủy đơn đơn hàng thành công');

        // } catch (Exception $e) {
        //     DB::rollback();
        //     session()->flash('success', 'Hủy đơn đơn hàng thất bại');

        // }
        return redirect()->route('users.order');
    }
    public function createNotification($order_id,$statusUpdate)
    {
        $statusOrder = $this->constant->getStatusOrder();
        $statusContent = '';
        foreach ($statusOrder as $key => $content) {
            if ($key == $statusUpdate) {
                $statusContent = $content;
            }
        }
        $content = "Đơn hàng số " . $order_id . " của bạn " . $statusContent;
        $order = $this->order->findOrderById($order_id);
        $notification = [
            'user_id' => $order->user_id,
            'order_id' => $order_id,
            'content' => $content,
            'status' => 0
        ];
        Notification::create($notification);
    }
}
