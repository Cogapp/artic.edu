<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;

class Issue extends AbstractModel implements Sortable
{
    use HasSlug, HasMedias, HasRevisions, HasPosition;

    protected $presenter = 'App\Presenters\Admin\IssuePresenter';
    protected $presenterAdmin = 'App\Presenters\Admin\IssuePresenter';

    protected $fillable = [
        'published',
        'title',
        'title_display',
        'description',
        'list_description',
        'issue_number',
        'license_text',
        'publish_start_date',
        'position',
    ];

    public $slugAttributes = [
        'title',
    ];

    public $checkboxes = [
        'published'
    ];

    public $dates = [
        'publish_start_date',
    ];

    public $mediasParams = [
        'hero' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
            'special' => [
                [
                    'name' => 'default',
                    'ratio' => 21 / 9,
                ],
            ],
        ],
        'license' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
        ],
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\IssueArticle', 'issue_id');
    }

    // Generates the id-slug type of URL
    public function getRouteKeyName()
    {
        return 'issue_slug';
    }

    public function getIssueSlugAttribute()
    {
        return join([$this->issue_number, $this->getSlug()], '/');
    }
}
