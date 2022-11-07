<?php

namespace App\Admin\Repositories;

use App\Models\FirmInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FirmInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
