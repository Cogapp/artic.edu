<?php

namespace App\Models;

use A17\CmsToolkit\Models\Behaviors\HasBlocks;
// use A17\CmsToolkit\Models\Behaviors\HasTranslation;
use A17\CmsToolkit\Models\Behaviors\HasSlug;
use A17\CmsToolkit\Models\Behaviors\HasMedias;
use A17\CmsToolkit\Models\Behaviors\HasFiles;
use A17\CmsToolkit\Models\Behaviors\HasRevisions;
use A17\CmsToolkit\Models\Model;

use App\Models\Behaviors\HasMediasEloquent;

class PressRelease extends Model
{
    use HasBlocks,  HasSlug, HasMedias, HasFiles, HasRevisions, HasMediasEloquent;
    // HasTranslation

    protected $fillable = [
        'short_description',
        'listing_description',
        'title',
        'published',
        'public',
        'publish_start_date',
        'publish_end_date',
    ];

    // public $translatedAttributes = [
    //     'title',
    //     'description',
    //     'active',
    // ];

    public $slugAttributes = [
        'title'
    ];

    public $checkboxes = ['published', 'active', 'public'];
    public $dates = ['publish_start_date', 'publish_end_date'];

    public $mediasParams = [
        'listing' => [
            'default' => [
                [
                    'name' => 'landscape',
                    'ratio' => 16 / 9,
                ],
            ],
            'mobile' => [
                [
                    'name' => 'mobile',
                    'ratio' => 1,
                ],
            ],
        ],
        'banner' => [
            'default' => [
                [
                    'name' => 'landscape',
                    'ratio' => 200 / 24,
                ],
            ]
        ],
    ];

    // protected $presenter = 'App\Presenters\HoursPresenter';
    protected $presenterAdmin = 'App\Presenters\Admin\PressReleasePresenter';

    // Generates the id-slug type of URL
    public function getRouteKeyName()
    {
        return 'id_slug';
    }

    public function getIdSlugAttribute()
    {
        return join([$this->id, $this->getSlug()], '-');
    }

    public function getUrlWithoutSlugAttribute()
    {
        return join([route('articles'), '/', $this->id, '-']);
    }

    public function getSlugAttribute()
    {
        return route('about.press.show', $this);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('publish_start_date', 'desc');
    }

}
