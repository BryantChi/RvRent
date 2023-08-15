<?php

namespace App\Admin\Repositories;

use App\Models\RentOrderInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RentOrderInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
