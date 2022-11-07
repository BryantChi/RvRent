<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class AboutUsInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'about_us_infos';
    
}
