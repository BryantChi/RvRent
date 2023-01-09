<?php

namespace App\Admin\Repositories;

use App\Models\RecommendedItineraryInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RecommendedItineraryInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    protected $cast = [
        'itinerary_imgs' => 'json'
    ];
}
