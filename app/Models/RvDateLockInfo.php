<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RvDateLockInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_date_lock_infos';

    protected $cast = [
        'date' => 'json',
    ];
}
