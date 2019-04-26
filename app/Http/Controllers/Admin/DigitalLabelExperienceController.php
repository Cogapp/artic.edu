<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Models\Experience;
use App\Repositories\DigitalLabelRepository;
use App\Repositories\ExperienceRepository;

class DigitalLabelExperienceController extends ModuleController
{
    protected $moduleName = 'digitalLabels.experiences';
    protected $modelName = 'Experience';
    protected $previewView = 'site.digitalLabelDetail';

    protected function getParentModuleForeignKey()
    {
        return 'digital_label_id';
    }

    protected $indexColumns = [
        'image' => [
            'thumb' => true,
            'variant' => [
                'role' => 'image',
                'crop' => 'default',
            ],
        ],
        'title' => [
            'title' => 'Title',
            'field' => 'title',
            'sort' => true,
        ],
        'experiences' => [
            'title' => 'Slides',
            'nested' => 'slides',
        ],
    ];

    protected function indexData($request)
    {
        $digitalLabel = app(DigitalLabelRepository::class)->getById(request('digitalLabel'));
        return [
            'breadcrumb' => [
                [
                    'label' => 'Groupings',
                    'url' => moduleRoute('digitalLabels', 'collection', 'index'),
                ],
                [
                    'label' => $digitalLabel->title,
                    'url' => moduleRoute('digitalLabels', 'collection', 'edit', $digitalLabel->id),
                ],
                [
                    'label' => 'Experiences',
                ],

            ],
        ];
    }

    protected function formData($request)
    {
        $experience = app(ExperienceRepository::class)->getById(request('experience'));
        return [
            'breadcrumb' => [
                [
                    'label' => 'Groupings',
                    'url' => moduleRoute('digitalLabels', 'collection', 'index'),
                ],
                [
                    'label' => $experience->digitalLabel->title,
                    'url' => moduleRoute('digitalLabels', 'collection', 'edit', $experience->digitalLabel->id),
                ],
                [
                    'label' => 'Experiences',
                    'url' => moduleRoute('digitalLabels.experiences', 'collection', 'index', $request->route('digitalLabel')),
                ],
                [
                    'label' => $experience->title,
                ],

            ],
        ];
    }

    // Intend to override the lines:
    // thumbnail
    // $value .= moduleRoute("experiences.slides", $this->routePrefix, 'index', [$item->id]);
    protected function getItemColumnData($item, $column)
    {
        if (isset($column['thumb']) && $column['thumb']) {
            if (isset($column['present']) && $column['present']) {
                return [
                    'thumbnail' => $item->presentAdmin()->{$column['presenter']},
                ];
            } else {
                $variant = isset($column['variant']);
                $crop = $variant ? $column['variant']['crop'] : head(array_keys(head($item->mediasParams)));
                $params = $variant && isset($column['variant']['params'])
                ? $column['variant']['params']
                : ['w' => 80, 'h' => 80, 'fit' => 'crop'];

                $attract_slide = $item->slides()->where('module_type', 'attract')->first();
                $attract_image = $attract_slide ? $attract_slide->attractExperienceImages()->first() : null;
                $thumbnail_image = $attract_image ? $attract_image->cmsImage('experience_image', 'default', $params) : '';
                return [
                    'thumbnail' => $thumbnail_image,
                ];
            }
        }

        if (isset($column['nested']) && $column['nested']) {
            $field = $column['nested'];
            $nestedCount = $item->{$column['nested']}->count();
            $value = '<a href="';
            $value .= moduleRoute("experiences.slides", $this->routePrefix, 'index', [$item->id]);
            $value .= '">' . $nestedCount . " " . (strtolower($nestedCount > 1
                ? str_plural($column['title'])
                : str_singular($column['title']))) . '</a>';
        } else {
            $field = $column['field'];
            $value = $item->$field;
        }

        if (isset($column['relationship'])) {
            $field = $column['relationship'] . ucfirst($column['field']);
            $value = array_get($item, "{$column['relationship']}.{$column['field']}");
        } elseif (isset($column['present']) && $column['present']) {
            $value = $item->presentAdmin()->{$column['field']};
        }

        return [
            "$field" => $value,
        ];
    }

    protected function getIndexTableMainFilters($items, $scopes = [])
    {
        $statusFilters = parent::getIndexTableMainFilters($items, $scopes);
        array_push($statusFilters, [
            'name' => 'Archived',
            'slug' => 'archived',
            'number' => Experience::archived()->count(),
        ]);
        return $statusFilters;
    }

    protected function getIndexItems($scopes = [], $forcePagination = false)
    {
        $requestFilters = $this->getRequestFilters();
        if (array_key_exists('status', $requestFilters) && $requestFilters['status'] == 'archived') {
            $scopes = $scopes + ['archived' => true];
        } else {
            $scopes = $scopes + ['unarchived' => true];
        }
        return parent::getIndexItems($scopes, $forcePagination);
    }

    protected function getPermalinkBaseUrl()
    {
        return request()->getScheme() . '://' . config('app.url') . '/interactive-features/';
    }
}
