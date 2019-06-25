@extends('twill::layouts.form')

@section('contentFields')
    @formField('browser', [
        'routePrefix' => 'collection.articles_publications',
        'moduleName' => 'videos',
        'max' => 1,
        'name' => 'videos',
        'label' => 'Related video'
    ])

    @formField('browser', [
        'routePrefix' => 'collection.articles_publications',
        'moduleName' => 'articles',
        'max' => 1,
        'name' => 'sidebarArticle',
        'label' => 'Related article',
    ])

    @formField('browser', [
        'routePrefix' => 'exhibitions_events',
        'max' => 1,
        'name' => 'sidebarExhibitions',
        'label' => 'Related Exhibition',
        'moduleName' => 'exhibitions',
    ])

    @formField('browser', [
        'routePrefix' => 'exhibitions_events',
        'moduleName' => 'events',
        'name' => 'sidebarEvent',
        'label' => 'Related event',
        'max' => 1
    ])
    
    @formField('browser', [
        'routePrefix' => 'collection',
        'max' => 1,
        'name' => 'sidebarInteractiveFeatures',
        'label' => 'Related Interactive Features',
        'moduleName' => 'interactiveFeatures.experiences',
    ])
@stop


@section('fieldsets')

    @include('admin.partials.meta')


    <a17-fieldset id="api" title="Datahub fields">
        @formField('input', [
            'name' => 'datahub_id',
            'label' => 'Datahub ID',
            'disabled' => true
        ])
    </a17-fieldset>
@stop
