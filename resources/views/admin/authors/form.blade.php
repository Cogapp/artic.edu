@extends('twill::layouts.form')

@section('contentFields')
    @formField('wysiwyg', [
        'name' => 'description',
        'label' => 'Description',
        'maxlength' => 1000,
        'type' => 'textarea',
        'rows' => 6,
        'toolbarOptions' => [
            'bold', 'italic', 'link'
        ],
    ])

    @formField('medias', [
        'label' => 'Hero Image',
        'name' => 'hero',
        'note' => 'Minimum image width 2000px'
    ])
@stop
