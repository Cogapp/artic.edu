<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\Sortable;

class FeeAge extends AbstractModel implements Sortable
{
    use HasPosition, HasTranslation;

    protected $fillable = [
        'position',
    ];

    public $translatedAttributes = ['title'];
}
