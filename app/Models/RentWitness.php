<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RentWitness extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'rent_witness_infos';

    protected $casts = [
        'path' => 'json',
    ];

}
