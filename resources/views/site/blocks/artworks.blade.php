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
        $item['figureNumber'] = $figureNumber = getFigureNumber();
        $item['captionTitle'] = getTitleWithFigureNumber($title, $figureNumber, $urlTitle);
        $item['caption'] = getSubtitleWithFigureNumber($caption, $title, $figureNumber);
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
    @if ($subtype === 'mosaic')
        @slot('imageSettings', array(
            'srcset' => array(200,400,600,800,1200),
            'sizes' => aic_imageSizes(array(
                  'xsmall' => '58',
                  'small' => '28',
                  'medium' => '28',
                  'large' => '28',
                  'xlarge' => '21',
            )),
        ))
    @endif
    @if ($subtype === 'slider')
        @slot('imageSettings', array(
            'srcset' => array(200,400,600,800,1200),
            'sizes' => aic_imageSizes(array(
                  'xsmall' => '50',
                  'small' => '35',
                  'medium' => '23',
                  'large' => '23',
                  'xlarge' => '18',
            )),
        ))
    @endif

    @slot('variation', 'o-blocks__block o-gallery----theme-' . ($block->input('theme') ?? 'dark'))
    @slot('title', $block->present()->input('title'))
    @slot('caption', $block->present()->input('subhead'))
    @slot('items', $items)
@endcomponent
