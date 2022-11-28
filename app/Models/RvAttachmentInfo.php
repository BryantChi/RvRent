<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RvAttachmentInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rv_attachment_infos';

    protected $casts = [
        'attachment_icon' => 'json',
    ];

}
