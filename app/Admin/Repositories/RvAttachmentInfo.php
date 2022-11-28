<?php

namespace App\Admin\Repositories;

use App\Models\RvAttachmentInfo as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RvAttachmentInfo extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
