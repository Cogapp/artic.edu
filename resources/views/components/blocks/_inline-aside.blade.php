@component('components.molecules._m-inline-aside')
    @slot('variation', $variation ?? null)
    @if (sizeof($items) === 1)
        @slot('title', 'Related '.ucfirst($type))
        @component('components.molecules.'.$itemsMolecule)
            @slot('tag', 'p')
            @slot('variation', $itemsVariation ?? null)
            @slot('item', $items[0])
            @slot('imageSettings', $imageSettings ?? null)
        @endcomponent
    @else
        @slot('title', 'Related '.ucfirst($type).'s')
        @component('components.organisms._o-row-listing')
            @foreach ($items as $item)
                @component('components.molecules.'.$itemsMolecule)
                    @slot('variation', $itemsVariation ?? null)
                    @slot('item', $item)
                    @slot('imageSettings', $imageSettings ?? null)
                @endcomponent
            @endforeach
        @endcomponent
    @endif
@endcomponent
