<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RvModelInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_model_infos';
    
}
