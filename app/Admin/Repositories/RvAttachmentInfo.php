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

    public static function getAttachment($arr) {
        if (is_array($arr)) {
            $attachmentInfos = new \stdClass();
            $attachmentInfos->attach = array();
            foreach ($arr as $key => $value) {
                $data = Model::find($value);
                array_push($attachmentInfos->attach, $data);
            }

            return $attachmentInfos;
        }
    }
}
