<?php

namespace App\Admin\Repositories;

use App\Models\RvSeriesInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RvSeriesInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
