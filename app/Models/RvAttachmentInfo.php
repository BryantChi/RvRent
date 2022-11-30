<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class RvAttachmentInfo extends Model implements Sortable
{
	use HasDateTimeFormatter;
    use SortableTrait;
    protected $table = 'rv_attachment_infos';

    protected $casts = [
        'attachment_icon' => 'json',
    ];

    protected $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

}
