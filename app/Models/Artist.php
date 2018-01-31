<?php

namespace App\Models;

use A17\CmsToolkit\Models\Behaviors\HasSlug;
use A17\CmsToolkit\Models\Model;
use App\Models\Behaviors\HasApiModel;

class Artist extends Model
{
    use HasSlug, HasApiModel, Transformable;

    protected $apiModel = 'App\Models\Api\Artist';

    protected $fillable = [
        'also_known_as',
        'intro_copy',
        'datahub_id',
        'title'
    ];

    public $slugAttributes = [
        'title',
    ];

    // those fields get auto set to null if not submited
    public $nullable = [];

    // those fields get auto set to false if not submited
    public $checkboxes = [];

    public function siteTags()
    {
        return $this->morphToMany(\App\Models\SiteTag::class, 'site_taggable', 'site_tagged');
    }

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'article_artist')->withPivot('position')->orderBy('position');
    }

    protected function transformMappingInternal()
    {
        return [
            [
                "name" => 'also_known_as',
                "doc" => "Also Known As",
                "type" => "string",
                "value" => function() { return $this->also_known_as; }
            ],
            [
                "name" => 'intro_copy',
                "doc" => "Intro Copy",
                "type" => "string",
                "value" => function() { return $this->intro_copy; }
            ],
            [
                "name" => 'datahub_id',
                "doc" => "Type",
                "type" => "string",
                "value" => function() { return $this->datahub_id; }
            ]
        ];
    }

}
