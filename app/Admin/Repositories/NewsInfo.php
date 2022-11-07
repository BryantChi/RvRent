<?php

namespace App\Admin\Repositories;

use App\Models\NewsInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class NewsInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
