@php
    $content = StringHelpers::parseFootnotes($block->present()->input('text'));
@endphp

<div class="m-tombstone-block">
    @component('components.atoms._title')
        @slot('font', 'f-secondary')
        @slot('tag', 'div')
            {{ $block->input('heading') }}
    @endcomponent

    @component('components.atoms._short-description')
        @slot('font', 'f-body-editorial')
        @slot('tag', 'div')
            {!! $content !!}
    @endcomponent
</div>
