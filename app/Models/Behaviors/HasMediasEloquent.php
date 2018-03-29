<?php

namespace App\Models\Behaviors;

use Illuminate\Support\Facades\App;
use LakeviewImageService;

trait HasMediasEloquent
{

    // Implement an image helper to avoid overwriting the CMS-TOOLKIT ones.
    // If it has an image run it through aic_convertFromImage

    public function imageFront( ...$parameters ) {
        $imageObject = $this->imageObject(...$parameters);
        if ($imageObject) {
            $cropParams = [
                'crop_x' => $imageObject->pivot->crop_x,
                'crop_y' => $imageObject->pivot->crop_y,
                'crop_w' => $imageObject->pivot->crop_w,
                'crop_h' => $imageObject->pivot->crop_h
            ];

            return aic_convertFromImage($imageObject, $cropParams);
        }
    }

}
