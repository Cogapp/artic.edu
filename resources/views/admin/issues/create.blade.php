@formField('input', [
    'name' => 'issue_number',
    'label' => 'Issue number',
    'required' => true,
    'type' => 'number',
    'note' => 'Required',
])

@formField('input', [
    'name' => $titleFormKey ?? 'title',
    'label' => ucfirst($titleFormKey ?? 'title'),
    'translated' => $translateTitle ?? false,
    'required' => true,
    'onChange' => 'formatPermalink'
])

@if ($permalink ?? true)
    @formField('input', [
        'name' => 'slug',
        'label' => 'Permalink',
        'ref' => 'permalink',
        'prefix' => $permalinkPrefix ?? ''
    ])
@endif
