<?php

namespace App\Admin\Repositories;

use App\Models\RvModelInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RvModelInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
