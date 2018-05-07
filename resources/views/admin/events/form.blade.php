@extends('cms-toolkit::layouts.form', [
    'additionalFieldsets' => [
        ['fieldset' => 'attributes', 'label' => 'Attributes'],
        ['fieldset' => 'dates', 'label' => 'Date Rules'],
        ['fieldset' => 'sponsors', 'label' => 'Sponsors'],
        ['fieldset' => 'related_elements', 'label' => 'Related elements'],
    ]
])

@section('contentFields')
    @formField('checkbox', [
        'name' => 'hidden',
        'label' => 'Hidden from listings?',
    ])

    @formField('select', [
        'name' => 'layout_type',
        'label' => 'Hero type',
        'options' => $eventLayoutsList,
        'default' => '0'
    ])

    @formField('select', [
        'name' => 'type',
        'label' => 'Event type',
        'options' => $eventTypesList,
        'default' => '1'
    ])

    @formField('select', [
        'name' => 'audience',
        'label' => 'Event audience',
        'options' => $eventAudiencesList,
        'default' => '1'
    ])

    @formField('medias', [
        'with_multiple' => false,
        'no_crop' => false,
        'label' => 'Hero Image',
        'name' => 'hero'
    ])

    @formField('input', [
        'name' => 'hero_caption',
        'label' => 'Hero image Caption',
        'note' => 'Usually used for copyright',
        'maxlength' => 150
    ])

    @formField('input', [
        'name' => 'description',
        'label' => 'Header',
        'type' => 'textarea'
    ])

    @formField('input', [
        'name' => 'short_description',
        'label' => 'Short description',
        'note' => 'Used for SEO'
    ])

    @formField('input', [
        'name' => 'list_description',
        'label' => 'List description',
        'type' => 'textarea'
    ])

    @formField('input', [
        'name' => 'location',
        'label' => 'Location'
    ])

    @formField('block_editor', [
        'blocks' => [
            'paragraph', 'image', 'video', 'gallery', 'media_embed', 'quote',
            'list', 'newsletter_signup_inline', 'timeline', 'link', 'shop_items',
            'artworks', 'artwork'
        ]
    ])
@stop

@section('fieldsets')

    <a17-fieldset id="attributes" title="Event entrance attributes">
        @formField('checkbox', [
            'name' => 'is_private',
            'label' => 'Is Private',
        ])

        @formField('input', [
            'name' => 'rsvp_link',
            'label' => 'External RSVP Link',
            'note' => 'URL used when an event is private for the RSVP link'
        ])

        @formField('checkbox', [
            'name' => 'is_member_exclusive',
            'label' => 'Members exclusive event'
        ])

        @formField('checkbox', [
            'name' => 'is_after_hours',
            'label' => 'After Hours'
        ])

        @formField('checkbox', [
            'name' => 'is_sold_out',
            'label' => 'Sold Out',
        ])

        @formField('checkbox', [
            'name' => 'is_free',
            'label' => 'Free Event'
        ])

        @formField('checkbox', [
            'name' => 'is_ticketed',
            'label' => 'Ticketed Event'
        ])

        @formField('input', [
            'name' => 'buy_tickets_link',
            'label' => 'Buy tickets link'
        ])

        @formField('input', [
            'name' => 'buy_button_text',
            'label' => 'Button text',
            'note' => 'E.G. Buy Tickets'
        ])

        @formField('wysiwyg', [
            'name' => 'buy_button_caption',
            'label' => 'Pricing or attendance information',
            'toolbarOptions' => ['bold']
        ])

        @formField('checkbox', [
            'name' => 'is_boosted',
            'label' => 'Boost this event on search results'
        ])
    </a17-fieldset>

    <a17-fieldset id="dates" title="Date rules">
        @formField('input', [
            'name' => 'all_dates_cms',
            'label' => 'All computed dates',
            'note' => 'Dates built using all rules below.',
            'type' => 'textarea',
            'disabled' => true,
            'rows' => 2
        ])

        @component('cms-toolkit::partials.form.utils._columns')
            @slot('left')
                @formField('select', [
                    'name' => 'start_time',
                    'label' => 'Start Time',
                    'options' => hoursSelectOptions()
                ])
            @endslot
            @slot('right')
                @formField('select', [
                    'name' => 'end_time',
                    'label' => 'End Time',
                    'options' => hoursSelectOptions()
                ])
            @endslot
        @endcomponent

        @formField('input', [
            'name' => 'forced_date',
            'label' => 'Force the event to show this text as date',
            'note' => 'Optional, the event will show this instead of the automatic computed date',
            'type' => 'text'
        ])

        @formField('repeater', [
            'type' => 'dateRules',
            'title' => 'Date rule',
        ])
    </a17-fieldset>

    <a17-fieldset id="sponsors" title="Sponsors">
        @formField('input', [
            'name' => 'sponsors_description',
            'label' => 'Sponsors section description',
            'type' => 'textarea'
        ])

        @formField('input', [
            'name' => 'sponsors_sub_copy',
            'label' => 'Sponsors sub copy',
            'note' => 'Default: Further support has been provided by'
        ])

        @formField('browser', [
            'routePrefix' => 'exhibitions_events',
            'moduleName' => 'sponsors',
            'name' => 'sponsors',
            'label' => 'Sponsors',
            'note' => 'Select Sponsors',
            'max' => 20
        ])
    </a17-fieldset>

    <a17-fieldset id="related_elements" title="Related elements">
        @formField('browser', [
            'routePrefix' => 'exhibitions_events',
            'moduleName' => 'events',
            'name' => 'events',
            'label' => 'Related Events',
            'note' => 'Select upto 4 events',
            'max' => 4
        ])
    </a17-fieldset>
@endsection
