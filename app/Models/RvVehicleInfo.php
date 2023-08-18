<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Models\RentOrderInfo as Order;

class RvVehicleInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_vehicle_infos';

    public static function getRandomVehicle($model_id) {
        $order_vehicle = Order::where('order_rv_model_id', $model_id)->whereIn('order_status', [Order::ORDER_STATUS['os1'], Order::ORDER_STATUS['os2'], Order::ORDER_STATUS['os3'], Order::ORDER_STATUS['os4'], Order::ORDER_STATUS['os10']])->get('order_rv_vehicle');
        $vehicle = static::where('model_id', $model_id)->whereIn('vehicle_status', ['rent_stay', 'rent_out'])->get('vehicle_num');
        $vehicle_nums = array();

        foreach ($vehicle as $v) {
            if(!in_array($v->vehicle_num, $order_vehicle->toArray())) {
                array_push($vehicle_nums, $v);
            }
        }

        if (count($vehicle_nums) == 0) {
            $vehicle_num = null;
        } else {
            $vehicle_random =  Arr::random($vehicle_nums);
            $vehicle_num = $vehicle_random['vehicle_num'];
        }
        return $vehicle_num;
    }

}
