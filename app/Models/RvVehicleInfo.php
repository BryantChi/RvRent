<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class RvVehicleInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_vehicle_infos';

    public static function getRandomVehicle($model_id) {
        $vehicle = static::where('model_id', $model_id)->where('vehicle_status', '=', 'rent_stay')->get('vehicle_num');
        if (count($vehicle) == 0) {
            $vehicle_num = null;
        } else {
            $vehicle_random =  Arr::random($vehicle->toArray());
            $vehicle_num = $vehicle_random['vehicle_num'];
        }
        return $vehicle_num;
    }

}
