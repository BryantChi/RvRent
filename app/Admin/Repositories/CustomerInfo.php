<?php

namespace App\Admin\Repositories;

use App\Models\CustomerInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CustomerInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
