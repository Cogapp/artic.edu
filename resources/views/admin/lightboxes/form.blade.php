@extends('twill::layouts.form', [
    'additionalFieldsets' => [
        ['fieldset' => 'duration', 'label' => 'Duration'],
        ['fieldset' => 'metadata', 'label' => 'Metadata'],
        ['fieldset' => 'deprecated', 'label' => 'Deprecated'],
    ]
])

@section('contentFields')

    @formField('radios', [
        'name' => 'geotarget',
        'label' => 'Geotargeting',
        'note' => '"Local" refers to Chicago area',
        'default' => \App\Models\Lightbox::GEOTARGET_ALL,
        'inline' => false,
        'options' => [
            [
                'value' => \App\Models\Lightbox::GEOTARGET_ALL,
                'label' => 'All users'
            ],
            [
                'value' => \App\Models\Lightbox::GEOTARGET_LOCAL,
                'label' => 'Local users only'
            ],
            [
                'value' => \App\Models\Lightbox::GEOTARGET_NOT_LOCAL,
                'label' => 'Non-local users only'
            ]
        ],
    ])

    @formField('input', [
        'name' => 'header',
        'label' => 'Header',
        'note' => 'Use "Title Case"',
    ])

    @formField('wysiwyg', [
        'name' => 'body',
        'label' => 'Body',
        'toolbarOptions' => [
            'italic',
        ],
    ])

    @formField('input', [
        'name' => 'lightbox_button_text',
        'label' => 'Button Text',
        'note' => 'Defaults to "Join Now"',
    ])

    @formField('radios', [
        'name' => 'variation',
        'label' => 'Variation',
        'default' => \App\Models\Lightbox::VARIATION_DEFAULT,
        'inline' => false,
        'options' => array_merge([
            [
                'value' => \App\Models\Lightbox::VARIATION_DEFAULT,
                'label' => 'Default (button)'
            ],
            [
                'value' => \App\Models\Lightbox::VARIATION_EMAIL,
                'label' => 'Email capture (button + email input)'
            ],
        ], app()->environment('production') ? [] : [
            [
               'value' => \App\Models\Lightbox::VARIATION_TICKETING,
               'label' => 'Ticketing (button + date select) (WIP)'
            ],
        ]),
    ])
@stop


@section('fieldsets')

    <a17-fieldset id="duration" title="Duration">

        @formField('date_picker', [
            'name' => 'lightbox_start_date',
            'label' => 'Start Date',
            'withTime' => false
        ])

        @formField('date_picker', [
            'name' => 'lightbox_end_date',
            'label' => 'End Date',
            'withTime' => false
        ])

        {{-- Expiry period is in seconds --}}
        @formField('radios', [
            'name' => 'expiry_period',
            'label' => 'Display Frequency',
            'default' => 86400,
            'inline' => true,
            'options' => [
                [
                    'value' => 86400,
                    'label' => 'Every 24 hours'
                ],
                [
                    'value' => 0,
                    'label' => 'Always'
                ],
            ]
        ])

    </a17-fieldset>

    <a17-fieldset id="metadata" title="Metadata">

        @formField('input', [
            'name' => 'action_url',
            'label' => 'Action URL',
            'note' => 'e.g. https://join.artic.edu/secure/holiday-annual-fund',
        ])

        @formField('input', [
            'name' => 'form_tlc_source',
            'label' => 'Form TLC Source',
            'note' => 'e.g. AIC17137L01',
        ])

        @formField('input', [
            'name' => 'form_token',
            'label' => 'Form Token',
            'note' => 'e.g. pa5U17siEjW4suerjWEB5LP7sFJYgAwLZYMS6kNTEag',
        ])

        @formField('input', [
            'name' => 'form_id',
            'label' => 'Form ID',
            'note' => 'e.g. webform_client_form_5111',
        ])

    </a17-fieldset>

    <a17-fieldset id="deprecated" title="Deprecated">

        @formField('medias', [
            'with_multiple' => false,
            'label' => 'Cover Image',
            'name' => 'cover',
        ])

        @formField('wysiwyg', [
            'type' => 'textarea',
            'name' => 'cover_caption',
            'label' => 'Cover Image Caption',
            'note' => 'Usually used for copyright',
            'maxlength' => 255,
            'toolbarOptions' => [
                'italic', 'link',
            ],
        ])

        @formField('input', [
            'name' => 'subheader',
            'label' => 'Subheader',
            'note' => 'Use "Title Case"',
        ])

        @formField('checkbox', [
            'name' => 'hide_fields',
            'label' => 'Hide first name, last name, and email fields',
            'default' => false,
        ])

        @formField('wysiwyg', [
            'name' => 'terms_text',
            'label' => '"Terms and Conditions" Line',
            'note' => 'e.g "By joining you agree to the Terms and Conditions"',
            'toolbarOptions' => [
                'italic',
                'link',
            ],
        ])

        <p>Please use "/terms" as the "Terms and Conditions" link.</p>

    </a17-fieldset>

@endsection
