<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RecommendedItineraryInfo extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'recommended_itinerary_infos';
    
}
