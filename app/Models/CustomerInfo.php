<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'customer_infos';
    
}
