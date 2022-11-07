<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class FirmInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'firm_infos';
    
}
