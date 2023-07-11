<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class AccessoryInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'accessory_infos';

    protected $casts = [
        'accessory_specification' => 'json',
    ];

}
