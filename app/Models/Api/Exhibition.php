<?php

namespace App\Models\Api;

use App\Libraries\Api\Models\BaseApiModel;
use Illuminate\Support\Carbon;
use App\Models\Api\Asset;

class Exhibition extends BaseApiModel
{
    protected $endpoints = [
        'collection' => '/api/v1/exhibitions',
        'resource' => '/api/v1/exhibitions/{id}',
        'search' => '/api/v1/exhibitions/search',
    ];

    protected $appends = ['date'];

    protected $augmented = true;
    protected $augmentedModelClass = 'App\Models\Exhibition';

    protected $presenter = 'App\Presenters\Admin\ExhibitionPresenter';
    protected $presenterAdmin = 'App\Presenters\Admin\ExhibitionPresenter';

    // Fields used when performing a search so we avoid a double call retrieving the complete entities
    const SEARCH_FIELDS = ['id', 'title', 'status', 'aic_start_at', 'aic_end_at', 'is_boosted', 'thumbnail', 'short_description', 'start_at', 'end_at', 'department_display', 'gallery_title', 'gallery_id', 'image_id', 'api_model'];

    // Generates the id-slug type of URL
    public function getRouteKeyName()
    {
        return 'id_slug';
    }

    public function getTypeAttribute()
    {
        return 'exhibition';
    }

    public function getIsClosedAttribute()
    {
        if (empty($this->aic_end_at)) {
            if (empty($this->aic_start_at)) {
                return true;
            } else {
                return $this->dateStart->year < 2010;
            }
        } else {
            return Carbon::now()->gt($this->dateEnd->endOfDay());
        }
    }

    public function getIdSlugAttribute()
    {
        return join(array_filter([$this->id, $this->getSlug()]), '/');
    }

    public function getTitleSlugAttribute()
    {
        return getUtf8Slug($this->title);
    }

    public function getAicDateStartAttribute()
    {
        if (!empty($this->aic_start_at)) {
            return new Carbon($this->aic_start_at);
        }

    }

    public function getDateStartAttribute()
    {
        if (!empty($this->aic_start_at)) {
            return new Carbon($this->aic_start_at);
        }

    }

    public function getDateEndAttribute()
    {
        if (!empty($this->aic_end_at)) {
            return new Carbon($this->aic_end_at);
        }

    }

    public function getIsClosingSoonAttribute()
    {
        if (!empty($this->dateEnd)) {
            return Carbon::now()->between($this->dateEnd->endOfDay()->subWeeks(2), $this->dateEnd->endOfDay());
        }

    }

    public function getIsNowOpenAttribute()
    {
        if (!empty($this->dateStart) && !empty($this->dateEnd)) {
            return Carbon::now()->between($this->dateStart->startOfDay(), $this->dateStart->startOfDay()->addWeeks(2));
        }

    }

    // See exhibitionType() in ExhibitionPresenter
    public function getIsOngoingAttribute()
    {
        if (empty($this->aic_end_at)) {
            if (isset($this->aic_start_at)) {
                if ($this->dateStart->year > 2010) {
                    return Carbon::now()->gt($this->dateStart->startOfDay());
                }
            }
        }

        return false;
    }

    public function getListDescriptionAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        if (!empty($this->short_description)) {
            return $this->short_description;
        }

        if (!empty($this->description)) {
            return truncateStr($this->description);
        }

        return null;
    }

    public function getDescriptionAttribute($value)
    {
        $desc = nl2br($value);
        return '<p>' . preg_replace('#(<br>[\r\n\s]+){2}#', "</p>\n\n<p>", $desc) . '</p>';
    }

    public function scopeOrderBy($query, $field, $direction = 'asc')
    {
        $params = [
            "sort" => [
                "{$field}.keyword" => $direction
            ]
        ];

        return $query->rawQuery($params);
    }

    public function scopeOrderByDate($query, $direction = 'asc')
    {
        $params = [
            "sort" => [
                'aic_start_at' => $direction
            ]
        ];

        return $query->rawQuery($params);
    }

    // EXAMPLE SCOPE:
    // Search for all exhibitions for the next 2 weeks, not closed
    public function scopeCurrent($query)
    {
        $params = [
            'bool' => [
                'must' => [
                    0 => [
                        'range' => [
                            'aic_end_at' => [
                                'gte' => 'now',
                            ],
                        ],
                    ],
                    1 => [
                        'range' => [
                            'aic_start_at' => [
                                'lte' => 'now',
                            ],
                        ],
                    ],
                ],
                'must_not' => [
                    'term' => [
                        'status' => 'Closed',
                    ],
                ],
            ],
        ];

        return $query->rawSearch($params);
    }

    public function scopeUpcoming($query)
    {
        $params = [
            'bool' => [
                'must' => [
                    0 => [
                        'range' => [
                            'aic_start_at' => [
                                'gte' => 'now',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return $query->rawSearch($params);
    }

    public function scopeHistory($query, $year = null)
    {
        if ($year == null) {
            $params = [
                'bool' => [
                    'must' => [
                        0 => [
                            'range' => [
                                'aic_end_at' => [
                                    'lte' => 'now',
                                ],
                            ],
                        ],
                    ],
                ],
            ];
        } else {
            $start = $year . '-01-01';
            $end = $year . '-12-31';
            $params = [
                'bool' => [
                    'must' => [
                        [
                            'range' => [
                                'aic_start_at' => [
                                    'lte' => $end,
                                ],
                            ],
                        ],
                        [
                            'range' => [
                                'aic_start_at' => [
                                    'gte' => $start,
                                ],
                            ],
                        ],
                        [
                            'bool' => [
                                'should' => [
                                    [
                                        'range' => [
                                            'aic_end_at' => [
                                                'lte' => 'now',
                                            ],
                                        ],
                                    ],
                                    [
                                        'range' => [
                                            'aic_start_at' => [
                                                'lt' => '2011-01-01',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ];
        }

        return $query->orderByDate('asc')->rawSearch($params);
    }

    // Solve this using casts. Because it returns an object it can't be used on the CMS
    // A value option could be added when showing
    // public function getStartAtAttribute($value) {
    //     return $this->asDateTime($value)->format("Y-m-d h:m:s T");
    // }

    // public function getEndAtAttribute($value) {
    //     return $this->asDateTime($value)->format("Y-m-d h:m:s T");
    // }

    public function artworks()
    {
        return $this->hasMany(\App\Models\Api\Artwork::class, 'artwork_ids');
    }

    public function artists()
    {
        return $this->hasMany(\App\Models\Api\Artist::class, 'artist_ids');
    }

    public function historyImages()
    {
        return $this->hasMany(\App\Models\Api\Asset::class, 'alt_image_ids');
    }

    public function historyDocuments()
    {
        return $this->hasMany(\App\Models\Api\Asset::class, 'document_ids');
    }
}
