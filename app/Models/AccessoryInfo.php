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

        $accessory_info = static::find($id);

        $total_count = $accessory_info->accessory_quantity;

        $count = 0;

        foreach ($orders as $order) {

            $checkDate = $inputDate->between($order->order_get_date, $order->order_back_date);

            if (count(json_decode($order->order_accessory_info)) == 0) {
                // $accessory = static::find($id);
                $count += 0;
            }

            foreach (json_decode($order->order_accessory_info) as $aci) {
                if ($id == $aci->equipment_id) {
                    // $accessory = static::find($aci->equipment_id);
                    if ($checkDate) {
                        $count += (int)$aci->equipment_count;
                    } else {
                        $count += 0;
                    }
                }
            }
        }

        return (Int)$total_count - (Int)$count;
    }
}
