<?php

namespace App\Http\Resources;

use App\Models\SeamlessImage;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideAsset extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $src = $images->map(function ($image) {
            return [
                'src' => 'https://' . env('IMGIX_SOURCE_HOST', 'artic-web.imgix.net') . '/seq/' . $image->file_name,
                'frame' => $image->frame,
            ];
        })->toArray();
        return [
            'type' => $this->media_type === 'type_image' ? 'image' : 'sequence',
            'title' => $this->media_title,
            'id' => $this->seamless_asset ? (string) $this->seamless_asset['assetId'] : "0",
            'width' => $images->first() ? $images->first()->width : 0,
            'height' => $images->first() ? $images->first()->height : 0,
            'src' => $src,
        ];
    }
}
