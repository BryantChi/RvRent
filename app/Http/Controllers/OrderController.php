<?php

namespace App\Http\Controllers;

use App\Admin\Repositories\PageSettingInfo;
use Illuminate\Http\Request;
use App\Models\RentOrderInfo as Order;
use App\Models\RvModelInfo as RvModel;
use App\Models\RvVehicleInfo as RvVehicle;
use App\Models\AccessoryInfo as Accessory;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $orders = Order::where('order_user', $user->customer_id)->get();
        $pageInfo = PageSettingInfo::getBanners('/member_center/order');
        return view('member_center.order', ['title' => '訂單資料', 'pageInfo' => $pageInfo, 'user' => $user, 'orders' => $orders]);
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
        $order = Order::find($id);

        $backlog = Order::setStockBacklog($id);

        if ($backlog) {
            $order->delete();

            return \Response::json(['status' => 'success']);
        }

    }

    public function uploadRemit(Request $request, $id)
    {
        $order = Order::find($id);

        $image_remit = $request->file('order_remit');

        if ($image_remit) {
            $filename_remit = time() . '_' . $order->order_num . '_' . $image_remit->getClientOriginalName();
            $image_remit->move(public_path('uploads/images/order_remit/' . $order->order_num . '/photos'), $filename_remit);

            // if ($this->amount_data->order_other_driving_licence != null) {
            //     // 若已存在，則覆蓋原有圖片
            //     if (File::exists(public_path('uploads/' . $this->amount_data->order_other_driving_licence))) {
            //         File::delete(public_path('uploads/' . $this->amount_data->order_other_driving_licence));
            //     }
            // }
            $order->order_remit = 'images/order_remit/' . $order->order_num . '/photos/' . $filename_remit;
            $order->order_status = Order::getOrderStatus('paid_remit');
            $order->save();

            return \Response::json(['status' => 'success']);
        } else {
            return \Response::json(['status' => 'error']);
        }
    }
}
