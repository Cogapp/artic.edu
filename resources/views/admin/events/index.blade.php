@extends('cms-toolkit::layouts.resources.index', [
    'title' => 'Events',
    'create' => true,
    'edit' => true,
    'delete' => true,
    'sort' => false,
    'search' => false,
    'publish' => true,
    'toggle_columns' => [
        [
            'toggle_title' => 'Landing page',
            'toggle_field' => 'landing',
            'icon_class'   => 'icon-feature'
        ]
    ],
    'columns' => [
        'image' => [
            'title' => 'Hero',
            'thumb' => true,
            'variant' => [
                'role' => 'hero',
                'crop' => 'square',
            ],
        ],
        'title' => [
            'title' => 'Title',
            'edit_link' => true,
            'sort' => true,
            'field' => 'title',
        ]
    ]
])
