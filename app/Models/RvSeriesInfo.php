<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RvSeriesInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_series_infos';

    protected $cast = [
        'rv_series_package' => 'json',
    ];
}
