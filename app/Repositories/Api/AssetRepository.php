<?php

namespace App\Repositories\Api;

use App\Models\Api\Asset;

class AssetRepository extends BaseApiRepository
{
    const ALL = 100;

    public function __construct(Asset $model)
    {
        $this->model = $model;
    }

    // public function multimediaForArtwork($id) {
    //     return $this->model->query()
    //         ->multimediaForArtwork($id)
    //         ->getSearch(self::ALL);
    // }

    // public function classroomResources($id) {
    //     return $this->model->query()
    //         ->classroomResources($id)
    //         ->resources(['sections'])
    //         ->getSearch(self::ALL);
    // }

}
