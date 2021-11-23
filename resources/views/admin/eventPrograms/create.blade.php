{{-- Copied from resources/views/admin/partials/create.blade.php --}}
@formField('input', [
    'name' => $titleFormKey ?? 'title',
    'label' => ucfirst($titleFormKey ?? 'title'),
    'translated' => $translateTitle ?? false,
    'required' => true,
    'onChange' => 'formatPermalink',
    'note' => 'Avoid HTML in this field. Use the "Title formatting (optional)" field for italics.',
])

@if ($permalink ?? true)
    @formField('input', [
        'name' => 'slug',
        'label' => 'Permalink',
        'translated' => true, # WEB-2347
        'ref' => 'permalink',
        'prefix' => $permalinkPrefix ?? '',
    ])
@endif

{{-- Custom fields below --}}

@formField('checkbox', [
    'name' => 'is_affiliate_group',
    'label' => 'This program represents an affiliate group',
])


@formField('checkbox', [
    'name' => 'is_event_host',
    'label' => 'This program represents an event host',
])
