<?php

namespace App\Http\Controllers;

use App\Admin\Controllers\RentOrderInfoController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RentOrderInfo as Order;
use App\Models\RvModelInfo as RvModel;
use App\Models\RvSeriesInfo as RvSeries;
use App\Models\RvAttachmentInfo as RvAttachment;
use App\Models\RvVehicleInfo as RvVehicle;
use App\Models\AccessoryInfo as Accessory;
use App\Admin\Repositories\PageSettingInfo;
use App\Admin\Repositories\RvAttachmentInfo as RvAttachmentRepository;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use stdClass;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class RvRentController extends Controller
{
    protected $title = '即刻租車';

    private $time_start_default = '';
    private $time_end_default = '';
    private $bed_count = 0;
    private $amount_data = null;
    private $order_num = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rvModelInfo = RvModel::all();
        // $model_filter = array_filter($rvModelInfo->toArray(), function ($v) {
        //     $a = json_decode($v["rv_rent_setting"]);
        //     return count(array_filter($a, function ($vi) {
        //         return $vi->week == date('w');
        //     })) > 0 && $v["stock"] >= 0;
        // });
        // dd(json_decode(json_encode($model_filter)));
        $model_filter = array_filter($rvModelInfo->toArray(), function ($v) {
            return $v["stock"] >= 0 && $v["bed_count"] >= 0;
        });
        $rvModelInfo = json_decode(json_encode($model_filter));
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = array();
        foreach ($rvModelInfo as $rvModel) {
            $attachmentInfo->attachments[$rvModel->id] = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
            $attachmentInfo->attachments[$rvModel->id]->ordercount = count(Order::where('order_rv_model_id', $rvModel->id)->get());
        }
        return view('car_rent', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'rvModelInfo' => json_decode(json_encode($rvModelInfo)), 'attachmentInfo' => $attachmentInfo, 'date_get' => $this->time_start_default, 'date_back' => $this->time_end_default, 'bed_count' => $this->bed_count]);
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
        $rvModel = RvModel::find($id);
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
        // dd($attachmentInfo);
        return view('car_rent_details', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'model' => $rvModel, 'attachmentInfo' => $attachmentInfo, 'date_get' => $this->time_start_default, 'date_back' => $this->time_end_default, 'bed_count' => $this->bed_count]);
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

    public function removeCarRentCookie()
    {
        Cookie::queue(\Cookie::forget('date_get'));
        Cookie::queue(\Cookie::forget('date_back'));
        Cookie::queue(\Cookie::forget('bed_count'));
        Cookie::queue(\Cookie::forget('amount_data'));

        return \Response::json(['status' => 'success']);
    }

    public function stepOneShow(Request $request, $rvm_id)
    {
        if (Auth::check() == false) {
            return \Response::json(['status' => 'authFail']);
        }

        $input = $request->all();
        if (count($input) > 0) {
            $this->time_start_default = $input['date_get'];
            $this->time_end_default = $input['date_back'];
            $this->bed_count = $input['bed_count'];
        }

        if ($request->method() == 'GET') {
            if ($request->cookie("date_get") != null && $request->cookie("date_back") != null && $request->cookie("bed_count") != null) {
                $cookies = $request->cookie();
                $this->time_start_default = $cookies['date_get'];
                $this->time_end_default = $cookies['date_back'];
                $this->bed_count = $cookies['bed_count'];
            } else {
                return redirect()->route('car_rent');
            }
        }

        $accessory = Accessory::all();
        $models = RvModel::find($rvm_id);
        $series = RvSeries::find($models->rv_series_id);
        $rv_rent_setting = json_decode($models->rv_rent_setting, true);
        $rent_amount_setting = array_values(array_filter($rv_rent_setting, function ($vi) {
            $week = date('w', strtotime($this->time_start_default));
            $firstDate  = new \DateTime($this->time_start_default);
            $secondDate = new \DateTime($this->time_end_default);
            $intvl = $secondDate->diff($firstDate);
            return $week == $vi["week"] && $intvl->d == $vi["day"];
        }));

        if (count($rent_amount_setting) == 0) {
            Cookie::queue(\Cookie::forget('date_get'));
            Cookie::queue(\Cookie::forget('date_back'));
            Cookie::queue(\Cookie::forget('bed_count'));
            return \Response::json(['status' => 'error']);
        }

        if ($request->ajax()) {
            Cookie::queue('date_get', $this->time_start_default, 30);
            Cookie::queue('date_back', $this->time_end_default, 30);
            Cookie::queue('bed_count', $this->bed_count, 30);
            return \Response::json(['status' => 'success']);
        } else {
            return view('rv_rent_s2', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'accessory' => $accessory, 'rent_amount_setting' => $rent_amount_setting[0], 'model' => $models, 'series' => $series]);
        }
    }

    public function showStepTwo(Request $request, $rvm_id)
    {
        // if (Auth::check() == false) {
        //     return \Response::json(['status' => 'authFail']);
        // }

        $input = $request->all();

        if ($request->method() == 'GET') {
            if (
                $request->cookie("date_get") != null && $request->cookie("date_back") != null &&
                $request->cookie("bed_count") != null && $request->cookie("amount_data") != null
            ) {
                $cookies = $request->cookie();
                $this->time_start_default = $cookies['date_get'];
                $this->time_end_default = $cookies['date_back'];
                $this->bed_count = $cookies['bed_count'];
            } else {
                return redirect()->route('car_rent');
            }
        }

        if ($request->ajax()) {
            if ($input['amount_data'] != null || count($input['amount_data']) != 0) {
                Cookie::queue('amount_data', $input['amount_data'], 30);
                return \Response::json(['status' => 'success']);
            }
            return \Response::json(['status' => 'error']);
        }

        $models = RvModel::find($rvm_id);
        $series = RvSeries::find($models->rv_series_id);

        return view('rv_rent_s3', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'series' => $series->rv_series_file]);
    }

    public function showStepThree(Request $request)
    {
        if ($request->cookie('amount_data') != null) {
            $user = Auth::user();
            $data = json_decode($request->cookie('amount_data'));
            if ($this->order_num == null) {
                $this->order_num = Order::generateOrderNumber();
            }

            $this->amount_data = new \stdClass();
            $this->amount_data->order_num = $this->order_num;
            $this->amount_data->order_status = Order::getOrderStatus('isCreate');
            $this->amount_data->order_user = $user->customer_id; // 是否使用id ??
            $this->amount_data->order_rv_model_id = $data->other->other_model_key;
            $this->amount_data->order_rv_amount_info = $data->other;
            $this->amount_data->order_one_night_rental = $data->rent->rent_base_amount;
            $this->amount_data->order_total_rental = $data->rent->total_rent_amount;
            $this->amount_data->order_night_count = $data->rent->rent_day;
            $this->amount_data->order_get_date = $data->search->date_get;
            $this->amount_data->order_back_date = $data->search->date_back;
            $this->amount_data->order_bed_count = $data->search->bed_count;
            $this->amount_data->order_rv_vehicle = RvVehicle::getRandomVehicle($data->other->other_model_key); // 車牌號
            $this->amount_data->order_rv_vehicle_payment = ''; // 車輛繳費 - 事後
            $this->amount_data->order_rv_vehicle_payment_status = ''; // 車輛繳費狀態 - 事後
            $this->amount_data->order_accessory_info = $data->equipment;
            $this->amount_data->order_mileage_plan_info = $data->plan;
            $this->amount_data->order_pay_way = ''; // 付款方式
            $this->amount_data->order_remit = ''; // 客戶上傳用
            $this->amount_data->order_client_note = ''; // request input
            $this->amount_data->order_company_note = '';
            $this->amount_data->order_other_driver_info = ''; // 客戶上傳用
            $this->amount_data->order_other_driving_licence = ''; // 客戶上傳用

            if ($request->ajax()) {
                $input = $request->all();

                $other_dr_info = [];
                $other_dr_info['customer_id'] = $user->customer_id;
                if (isset($input['same_user'])) {
                    $other_dr_info['dr_name'] = $user->name;
                    $other_dr_info['dr_email'] = $user->email;
                    $other_dr_info['dr_phone'] = $user->phone;
                    $other_dr_info['dr_IDNumber'] = $user->IDNumber;
                } else {
                    $other_dr_info['dr_name'] = $input['dr_name'];
                    $other_dr_info['dr_email'] = $input['dr_email'];
                    $other_dr_info['dr_phone'] = $input['dr_phone'];
                    $other_dr_info['dr_IDNumber'] = $input['dr_IDNumber'];
                }



                $this->amount_data->order_num = $this->order_num;
                $this->amount_data->order_status = Order::getOrderStatus('save');
                $this->amount_data->order_rv_amount_info = json_encode($data->other);
                $this->amount_data->order_accessory_info = json_encode($data->equipment);
                $this->amount_data->order_mileage_plan_info = json_encode($data->plan);
                $this->amount_data->order_pay_way = $input['payway'];
                $this->amount_data->order_other_driver_info = $other_dr_info;
                $this->amount_data->order_other_driver_info = json_encode($other_dr_info);
                $this->amount_data->order_client_note = $input['order_client_note'];

                $image = $request->file('driving_licence');

                if ($image) {
                    $filename = time() . '_' . $user->id . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/images/user_driving_licence/' . $user->id . '/photos'), $filename);

                    $user_info = User::find($user->id);

                    if ($user_info->driving_licence != null) {
                        // 若已存在，則覆蓋原有圖片
                        if (File::exists(public_path('uploads/' . $user_info->driving_licence))) {
                            File::delete(public_path('uploads/' . $user_info->driving_licence));
                        }
                    }
                    $user_info->driving_licence = 'images/user_driving_licence/' . $user->id . '/photos/' . $filename;

                    $user_info->save();
                    // dd($filename);
                }

                if (isset($input['same_user']) == false) {
                    $image_dr = $request->file('dr_driving_licence');

                    if ($image_dr) {
                        $filename_dr = time() . '_' . $this->amount_data->order_num . '_' . $image_dr->getClientOriginalName();
                        $image_dr->move(public_path('uploads/images/order_driving_licence/' . $this->amount_data->order_num . '/photos'), $filename_dr);

                        // if ($this->amount_data->order_other_driving_licence != null) {
                        //     // 若已存在，則覆蓋原有圖片
                        //     if (File::exists(public_path('uploads/' . $this->amount_data->order_other_driving_licence))) {
                        //         File::delete(public_path('uploads/' . $this->amount_data->order_other_driving_licence));
                        //     }
                        // }
                        $this->amount_data->order_other_driving_licence = 'images/order_driving_licence/' . $this->amount_data->order_num . '/photos/' . $filename_dr;
                    }
                }

                // dd((array) $this->amount_data);
                try {
                    $order_save = Order::create((array) $this->amount_data);

                    if ($order_save && $this->amount_data->order_status == Order::ORDER_STATUS['os2']) {
                        RentOrderInfoController::sendOrderPendingPaymentEmail($user->email);
                    }
                } catch (QueryException $e) {
                    //throw $th;
                    dd($e);
                }


                // dd($order_save);

                return \Response::json(['status' => 'success']);
            }


            if ($request->method() == 'GET') {
                $rvModel = RvModel::find($data->other->other_model_key);
                $pageInfo = PageSettingInfo::getBanners('/car_rent');
                return view('rv_rent_s4', ['title' => '即刻租車', 'pageInfo' => $pageInfo, 'amountData' => $this->amount_data, 'rvModel' => $rvModel, 'user' => $user]);
            }
        } else {
            return redirect()->route('car_rent');
        }
    }

    public function filterModelsDefault(Request $request)
    {
        $input = $request->all();
        $models = RvModel::all();
        $this->time_start_default = $input['date_get'];
        $this->time_end_default = $input['date_back'];
        $this->bed_count = $input['bed_count'];

        $model_filter = array_filter($models->toArray(), function ($v) {
            $rv_rent_setting = json_decode($v["rv_rent_setting"]);
            if (!is_null($rv_rent_setting) || is_array($rv_rent_setting)) {
                $checkStock = Order::isBetweenDays($this->time_start_default, $this->time_end_default, $v['id']);
                return count(array_filter($rv_rent_setting, function ($vi) {
                    $week = date('w', strtotime($this->time_start_default));
                    $data_back = date('Y-m-d', strtotime('+' . $vi->day . ' day', strtotime($this->time_start_default))) . ' ' . $vi->back;

                    $firstDate  = new \DateTime($this->time_start_default);
                    $secondDate = new \DateTime($this->time_end_default);
                    $intvl = $secondDate->diff($firstDate);
                    // var_dump($intvl->d);

                    return $vi->week == $week && $intvl->d == $vi->day;
                    // strtotime($this->time_end_default) >= strtotime($data_back)
                })) > 0  && $checkStock && $this->bed_count <= $v["bed_count"];
            }
        });
        $models = json_decode(json_encode($model_filter));
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = array();
        foreach ($models as $rvModel) {
            $attachmentInfo->attachments[$rvModel->id] = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
            $attachmentInfo->attachments[$rvModel->id]->ordercount = count(Order::where('order_rv_model_id', $rvModel->id)->get());
        }

        if ($request->ajax()) {
            return \Response::json(\View::make('car_rent_items', array('rvModelInfo' => json_decode(json_encode($models)), 'attachmentInfo' => $attachmentInfo))->render());
        } else {
            return View::make('car_rent', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'rvModelInfo' => json_decode(json_encode($models)), 'attachmentInfo' => $attachmentInfo, 'date_get' => $this->time_start_default, 'date_back' => $this->time_end_default, 'bed_count' => $this->bed_count]);
        }
    }
}
