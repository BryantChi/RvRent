<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\RvModelInfo as RvModel;
use App\Models\RvVehicleInfo as RvVehicle;
use App\Models\AccessoryInfo as Accessory;

class RentOrderInfo extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const ORDER_STATUS = [
        "os1" => "已成立",
        "os2" => "已成立，待付款",
        "os3" => "已成立，待確認",
        "os4" => "已成立，付款失敗",

        "os5" => "未成立，未付款",
        "os6" => "未成立，取消",
        "os7" => "未成立，進行中",
        "os8" => "未成立，待確認",

        "os9" => "已成立，結束訂單",
        "os10" => "已成立，驗證失敗"
    ];

    const ORDER_STATUS_SELECT = [
        "已成立" => "已成立",
        "已成立，待付款" => "已成立，待付款",
        "已成立，待確認" => "已成立，待確認",
        "已成立，付款失敗" => "已成立，付款失敗",

        "未成立，未付款" => "未成立，未付款",
        "未成立，取消" => "未成立，取消",
        "未成立，進行中" => "未成立，進行中",
        "未成立，待確認" => "未成立，待確認",

        "已成立，結束訂單" => "已成立，結束訂單",
        "已成立，驗證失敗" => "已成立，驗證失敗"
    ];

    protected $table = 'rent_order_infos';

    protected $fillable = [
        'order_num',
        'order_status',
        'order_user',
        'order_rv_model_id',
        'order_rv_amount_info',
        'order_one_night_rental',
        'order_total_rental',
        'order_night_count',
        'order_get_date',
        'order_back_date',
        'order_bed_count',
        'order_rv_vehicle',
        'order_rv_vehicle_payment',
        'order_rv_vehicle_payment_status',
        'order_accessory_info',
        'order_mileage_plan_info',
        'order_pay_way',
        'order_remit',
        'order_client_note',
        'order_company_note',
        'order_other_driver_info',
        'order_other_driving_licence'
    ];

    protected $cast = [
        'order_rv_amount_info' => 'json',
        'order_accessory_info' => 'json',
        'order_mileage_plan_info' => 'json',
        'order_other_driver_info' => 'json'
    ];

    public static function generateOrderNumber()
    {
        $date = Carbon::now()->format('Ymd'); // 取得西元年月日
        do {
            $randomNumber = mt_rand(100000, 999999); // 隨機數字，範圍可自行調整
            $orderNumber = $date . $randomNumber;
        } while (static::where('order_num', $orderNumber)->exists());

        return $orderNumber;
    }

    public static function getOrderStatus($mode = null)
    {
        switch ($mode) {
            case 'isCreate': // 確認訂單頁面
                return self::ORDER_STATUS['os7'];
                break;
            case 'save': // 訂單送出-預設
                return self::ORDER_STATUS['os2'];
                break;
            case 'paid_sucess': // 已成功付款
                return self::ORDER_STATUS['os1'];
                break;
            case 'paid_expired': // 逾期付款、未付款
                return self::ORDER_STATUS['os5'];
                break;
            case 'paid_failed': // 付款失敗，聯絡客服（信用卡）
                return self::ORDER_STATUS['os4'];
                break;
            case 'cancel': // 訂單取消
                return self::ORDER_STATUS['os6'];
                break;
            case 'paid_remit': // 匯款資訊已上傳(匯款)
            case 'certification': // 駕照確認中
                return self::ORDER_STATUS['os3'];
                break;
            case 'ordering': // 訂單進行中(保存至購物車)
            case 'cart': // 訂單進行中(保存至購物車)
                return self::ORDER_STATUS['os8'];
                break;
            default:
                return self::ORDER_STATUS;
                break;
        }
    }

    public static function checkCancelOrderByStatus($status)
    {
        switch ($status) {
            case self::ORDER_STATUS['os1']:
                return false;
                break;
            case self::ORDER_STATUS['os2']:
                return true;
                break;
            case self::ORDER_STATUS['os3']:
                return true;
                break;
            case self::ORDER_STATUS['os4']:
                return true;
                break;
            case self::ORDER_STATUS['os5']:
                return true;
                break;
            case self::ORDER_STATUS['os6']:
                return false;
                break;
            case self::ORDER_STATUS['os7']:
                return true;
                break;
            case self::ORDER_STATUS['os8']:
                return true;
                break;
        }
    }

    public static function setStockBacklog($order_id)
    {
        $order = static::find($order_id);

        // 回歸車輛

        $rvModel = RvModel::find($order->order_rv_model_id);
        $rvModel->in_stock += 1;
        $rvModel->stock += 1;


        $rvVehicle = RvVehicle::where('vehicle_num', $order->order_rv_vehicle)->first();
        if ($rvVehicle->vehicle_status == 'rent_out') {
            $rvVehicle->vehicle_status = 'rent_stay';
            $rvVehicle->save();
        }

        $rvModel->save();

        // 回歸配備

        foreach (json_decode($order->order_accessory_info) as $value) {
            $accessory = Accessory::find($value->equipment_id);
            $accessory->accessory_quantity += $value->equipment_count;
            $accessory->accessory_instock += $value->equipment_count;
            $accessory->save();
        }

        return true;
    }

    public static function setStockRestore($order_id)
    {
        $order = static::withTrashed()->findOrFail($order_id);

        // 復原訂單車輛

        $rvModel = RvModel::find($order->order_rv_model_id);
        $rvModel->stock -= 1;


        $rvVehicle = RvVehicle::where('vehicle_num', $order->order_rv_vehicle)->first();
        if ($rvVehicle->vehicle_status == 'rent_stay') {
            $rvVehicle->vehicle_status = 'rent_out';
            $rvVehicle->save();
        } else {
            return false;
        }

        $rvModel->save();

        // 復原訂單配備

        foreach (json_decode($order->order_accessory_info) as $value) {
            $accessory = Accessory::find($value->equipment_id);
            $accessory->accessory_quantity -= $value->equipment_count;
            $accessory->save();
        }

        return true;
    }

    // 統整庫存&訂單
    public static function setDataReconciliation()
    {
        $today = Carbon::today();
        $rvModels = RvModel::all();
        $orders = static::whereIn('order_status', [self::ORDER_STATUS['os1'], self::ORDER_STATUS['os2'], self::ORDER_STATUS['os3'], self::ORDER_STATUS['os4'], self::ORDER_STATUS['os10']])->get();

        // 車型庫存與最後正確的
        foreach ($rvModels as $model) {
            $checkOutVehicle = RvVehicle::where('model_id', $model->id)->where('vehicle_status', 'rent_out')->get();
            $checkVehicle = RvVehicle::where('model_id', $model->id)->whereIn('vehicle_status', ['rent_stay', 'rent_out'])->get();
            $rvm = RvModel::find($model->id);
            $rvm->stock = count($checkVehicle);
            $rvm->in_stock = count($checkVehicle) - count($checkOutVehicle);
            $rvm->save();
        }

        if (count($orders) > 0) {
            foreach ($orders as $order) {

                foreach (json_decode($order->order_accessory_info) as $aci) {
                    $accessory = Accessory::find($aci->equipment_id);
                    $accessory->accessory_instock = (int)$accessory->accessory_quantity - (int)$aci->equipment_count;
                    $accessory->save();
                }

                $vehicle = RvVehicle::where('vehicle_num', $order->order_rv_vehicle)->first();
                $get = Carbon::parse($order->order_get_date);
                $back = Carbon::parse($order->order_back_date);

                $check = $today->between($get, $back);

                // 今日庫存運算
                if ($check) {
                    $rvms = RvModel::find($order->order_rv_model_id);
                    if ($rvms->in_stock > 0 && $rvms->stock > 0) {
                        $rvms->in_stock -= 1;
                        $rvms->stock -= 1;
                        $rvms->save();
                    }

                    if ($vehicle->vehicle_status == 'rent_stay') {
                        $vehicle->vehicle_status = 'rent_out';
                        $vehicle->save();
                    }


                    foreach (json_decode($order->order_accessory_info) as $ac) {
                        $accessory = Accessory::find($ac->equipment_id);
                        if ($accessory->accessory_quantity > 0) {
                            $accessory->accessory_quantity -= $ac->equipment_count;
                            $accessory->accessory_instock -= $ac->equipment_count;
                            $accessory->save();
                        }
                    }
                }
            }
        }

        // $ordersTrashed = static::onlyTrashed()->get();

        // foreach ($ordersTrashed as $order_t) {

        // }



        return true;
    }

    public static function isBetweenDays($startDate, $endDate, $model_id)
    {
        $orders = static::where('order_rv_model_id', $model_id)->whereIn('order_status', [self::ORDER_STATUS['os1'], self::ORDER_STATUS['os2'], self::ORDER_STATUS['os3'], self::ORDER_STATUS['os4'], self::ORDER_STATUS['os10']])->get();
        // $orders = static::all();

        $get = Carbon::parse($startDate);
        $back = Carbon::parse($endDate);
        $count = 0;
        //
        foreach ($orders as $order) {
            $order_get = Carbon::parse($order->order_get_date);
            $order_back = Carbon::parse($order->order_back_date);

            $isBetween = $get->between($order_get, $order_back);

            if ($isBetween) {
                $count++;
            }
        }

        $vehicle = RvVehicle::where('model_id', $model_id)->get();

        return (count($vehicle) - $count) > 0;
    }
}
