<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use App\Models\RentOrderInfo as Order;
use Carbon\Carbon;

class AccessoryInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'accessory_infos';

    protected $casts = [
        'accessory_specification' => 'json',
    ];

    public static function getAccessoryInfoByDate($id, $date)
    {
        $orders = Order::all();

        $inputDate = Carbon::parse($date);

        foreach ($orders as $order) {

            $checkDate = $inputDate->between($order->order_get_date, $order->order_back_date);

            if ($checkDate) {

                foreach (json_decode($order->order_accessory_info) as $aci) {
                    if ($id == $aci->equipment_id) {
                        $accessory = static::find($aci->equipment_id);
                        $count = (int)$accessory->accessory_quantity - (int)$aci->equipment_count;
                        return $count;
                    }
                }
            }
        }
    }
}
