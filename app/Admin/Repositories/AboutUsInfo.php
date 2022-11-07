<?php

namespace App\Admin\Repositories;

use App\Models\AboutUsInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AboutUsInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
