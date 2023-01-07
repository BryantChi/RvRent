<?php

namespace App\Admin\Repositories;

use App\Models\RvVehicleInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RvVehicleInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
