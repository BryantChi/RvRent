<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
}
