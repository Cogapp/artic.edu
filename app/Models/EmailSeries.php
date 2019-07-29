<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;

class EmailSeries extends AbstractModel implements Sortable
{
    use Transformable;
    use HasPosition;

    protected $fillable = [
        'title',
        'alert_message',
        'show_affiliate_member',
        'affiliate_member_copy',
        'show_member',
        'member_copy',
        'show_sustaining_fellow',
        'sustaining_fellow_copy',
        'show_non_member',
        'non_member_copy',
        'use_short_description',
        'position',
        'published',
    ];

    public $checkboxes = [
        'show_affiliate_member',
        'show_member',
        'show_sustaining_fellow',
        'show_non_member',
        'use_short_description',
        'published',
    ];

    public $casts = [
        'show_affiliate_member' => 'boolean',
        'show_member' => 'boolean',
        'show_sustaining_fellow' => 'boolean',
        'show_non_member' => 'boolean',
        'use_short_description' => 'boolean',
        'published' => 'boolean',
    ];

    protected function transformMappingInternal()
    {
        return [
            [
                "name" => 'title',
                'doc' => 'Name of this email series',
                'type' => 'string',
                'value' => function () {return $this->title;},
            ],
            [
                "name" => 'alert_message',
                'doc' => 'Custom notice to display above the copy selection options',
                'type' => 'string',
                'value' => function () {return $this->alert_message;},
            ],
            [
                "name" => 'show_affiliate_member',
                'doc' => 'Whether to show the "Include affiliate-specific copy" option',
                'type' => 'boolean',
                'value' => function () {return $this->show_affiliate_member;},
            ],
            [
                "name" => 'affiliate_member_copy',
                'doc' => 'Default copy for emails to Affiliate Members',
                'type' => 'string',
                'value' => function () {return $this->affiliate_member_copy;},
            ],
            [
                "name" => 'show_member',
                'doc' => 'Whether to show the "Include member-specific copy" option',
                'type' => 'boolean',
                'value' => function () {return $this->show_member;},
            ],
            [
                "name" => 'member_copy',
                'doc' => 'Default copy for emails to Members',
                'type' => 'string',
                'value' => function () {return $this->member_copy;},
            ],
            [
                "name" => 'show_sustaining_fellow',
                'doc' => 'Whether to show the "Include sustaining fellow-specific copy" option',
                'type' => 'boolean',
                'value' => function () {return $this->show_sustaining_fellow;},
            ],
            [
                "name" => 'sustaining_fellow_copy',
                'doc' => 'Default copy for emails to Sustaining Fellows',
                'type' => 'string',
                'value' => function () {return $this->sustaining_fellow_copy;},
            ],
            [
                "name" => 'show_non_member',
                'doc' => 'Whether to show the "Include nonmember-specific copy" option',
                'type' => 'boolean',
                'value' => function () {return $this->show_non_member;},
            ],
            [
                "name" => 'non_member_copy',
                'doc' => 'Default copy for emails to Nonmembers',
                'type' => 'string',
                'value' => function () {return $this->non_member_copy;},
            ],
            [
                "name" => 'use_short_description',
                'doc' => 'Whether to use the event short description as the default copy',
                'type' => 'boolean',
                'value' => function () {return $this->use_short_description;},
            ],
        ];
    }

}
