@section('contentFields')

    @formField('browser', [
        'routePrefix' => 'collection.articles_publications',
        'max' => 5,
        'moduleName' => 'articles',
        'name' => 'articles',
        'label' => 'Featured articles'
    ])

    @formField('browser', [
        'routePrefix' => 'collection.articles_publications',
        'max' => 3,
        'moduleName' => 'digitalPublications',
        'name' => 'digitalPublications',
        'label' => 'Digital Publications'
    ])

    @formField('browser', [
        'routePrefix' => 'collection.articles_publications',
        'max' => 4,
        'moduleName' => 'printedPublications',
        'name' => 'printedPublications',
        'label' => 'Print Publications'
    ])

    @formField('input', [
        'type' => 'textarea',
        'name' => 'printed_publications_intro',
        'label' => 'Print Publications intro text',
    ])
@stop
