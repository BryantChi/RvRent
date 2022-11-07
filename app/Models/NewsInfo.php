<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class NewsInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'news_infos';
    
}
