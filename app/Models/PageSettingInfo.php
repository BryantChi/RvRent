<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class PageSettingInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'page_setting_infos';

    protected $casts = [
        'page_banner_img' => 'json',
        'page_banner_img_mob' => 'json',
    ];

}
