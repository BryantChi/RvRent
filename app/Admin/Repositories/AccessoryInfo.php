<?php

namespace App\Admin\Repositories;

use App\Models\AccessoryInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AccessoryInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
