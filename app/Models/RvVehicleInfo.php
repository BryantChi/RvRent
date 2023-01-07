<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RvVehicleInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_vehicle_infos';
    
}
