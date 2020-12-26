<?php

namespace App\Http\Controllers\Admin;

use App\Entity\HistoryOrder;
use App\Entity\Notification;
use App\Entity\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ultility\Constant;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $order;
    private $historyOrder;
    private $constant;

    public function __construct(
        Order $order,
        HistoryOrder $historyOrder,
        Constant $constant
    ) {
        $this->order = $order;
        $this->historyOrder = $historyOrder;
        $this->constant = $constant;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orderWaitConfirm = $this->order->getStatusmAll(0);
        $orderWaitGetItem = $this->order->getStatusmAll(1);
        $orderDelivering = $this->order->getStatusmAll(2);
        $orderDelivered = $this->order->getStatusmAll(3);
        $orderCancelled = $this->order->getStatusmAll(4);
        // dd($orderWaitConfirm);
        return view('admin.orders.index', compact('orderWaitConfirm', 'orderWaitGetItem', 'orderDelivering', 'orderDelivered', 'orderCancelled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function updateStatus($order_id)
    {
        //
        try {
            $statusUpdate = 1;
            DB::beginTransaction();
            $this->order->updateStatusOrder($order_id, $statusUpdate);
            $historyOrder = $this->historyOrder->updateStatusOrder($order_id, $statusUpdate);
            $this->createNotification($order_id,$statusUpdate);

            DB::commit();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thất bại');
        }
        return redirect()->route('admin.orders.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTransporting($order_id)
    {
        //
        try {
            $statusUpdate = 2;
            DB::beginTransaction();
            $this->order->updateStatusOrder($order_id, $statusUpdate);
            $historyOrder = $this->historyOrder->updateStatusOrder($order_id, $statusUpdate);
            $this->createNotification($order_id,$statusUpdate);
            DB::commit();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thất bại');
        }
        return redirect()->route('admin.orders.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDelivered($order_id)
    {
        //
        try {
            $statusUpdate = 3;
            DB::beginTransaction();
            $this->order->updateStatusOrder($order_id, $statusUpdate);

            $historyOrder = $this->historyOrder->updateStatusOrder($order_id, $statusUpdate);
            $this->createNotification($order_id,$statusUpdate);
            DB::commit();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thất bại');
        }


        return redirect()->route('admin.orders.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCancelled($order_id)
    {
        //
        try {


            $statusUpdate = 4;
            DB::beginTransaction();
            $this->order->updateStatusOrder($order_id, $statusUpdate);
            $historyOrder = $this->historyOrder->updateStatusOrder($order_id, $statusUpdate);
            $this->createNotification($order_id,$statusUpdate);
            DB::commit();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thành công');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('success', 'Cập nhật trạng thái đơn hàng thất bại');
        }
        return redirect()->route('admin.orders.index');
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
