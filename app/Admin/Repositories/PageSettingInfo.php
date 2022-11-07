<?php

namespace App\Admin\Repositories;

use App\Models\PageSettingInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PageSettingInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
