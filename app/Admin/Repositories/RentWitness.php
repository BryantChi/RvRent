<?php

namespace App\Admin\Repositories;

use App\Models\RentWitness as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RentWitness extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
