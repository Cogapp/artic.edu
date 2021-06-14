@php
    $subtype = $block->input('layout') == 1 ? 'mosaic' : 'slider';
    $ids = $block->browserIds('artworks');
    $artworks = \App\Models\Api\Artwork::query()->ids($ids)->get();

    // Sort $artworks to match order of $ids
    $artworks = $artworks->sortBy(function($model) use ($ids) {
        return array_search($model->id, $ids);
    });

    $items = [];
    foreach($artworks as $artwork) {
        $image = $artwork->imageFront('hero', 'thumbnail');

        $title = $artwork->present()->listingTitle;

        $caption = "";
        if (!empty($artwork->artist_title)) {
            $caption = $artwork->present()->artist_title;
        } else if (!empty($artwork->place_of_origin)) {
            $caption = $artwork->present()->place_of_origin;
        }

        $urlTitle = route('artworks.show', $artwork);

        $item = [];
        $item['type'] = 'image';
        $item['fullscreen'] = true;
        $item['size'] = 'gallery';
        $item['media'] = $image;
        $item['captionTitle'] = $title;
        $item['caption'] = $caption;
        $item['url'] = route('artworks.show', $artwork);
        $item['urlTitle'] = isset($figureNumber) ? null : $urlTitle;
        $item['showUrl'] = true;
        $item['isArtwork'] = true;
        $item['isZoomable'] = $artwork->is_zoomable;
        $item['isPublicDomain'] = $artwork->is_public_domain;
        $item['maxZoomWindowSize'] = $artwork->max_zoom_window_size;
        $items[] = $item;
    }
@endphp

@component('components.organisms._o-gallery----'.$subtype)
    @slot('variation', 'o-blocks__block o-gallery----theme-' . ($block->input('theme') ?? 'dark'))
    @slot('title', $block->present()->input('title'))
    @slot('caption', $block->present()->input('subhead'))
    @slot('items', $items)
@endcomponent
