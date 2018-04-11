@extends('layouts.app')

@section('content')

@component('components.organisms._o-features')
    @foreach ($mainFeatures as $item)
        @component('components.molecules._m-listing----'.$item->type)
            @slot('item', $item)
            @if ($item->type === 'selection')
                @slot('singleImage',true)
            @endif
            @slot('image', $item->feature_image)
            @slot('variation', ($loop->first) ? 'm-listing--hero' : 'm-listing--feature')
            @slot('titleFont', ($loop->first) ? 'f-display-1' : 'f-module-title-2')
            @slot('imageSettings', array(
                'srcset' => array(300,600,1000,1500,3000),
                'sizes' => '100vw',
            ))
        @endcomponent
    @endforeach
@endcomponent

@component('components.molecules._m-intro-block')
    @slot('links', array(array('label' => 'Plan your visit', 'href' => $_pages['visit'], 'variation' => 'btn')))
    {{ $intro }}
@endcomponent

@component('components.molecules._m-links-bar')
    @slot('linksPrimary', array(
        array('label' => 'Hours and admission fees&nbsp;&nbsp;&rsaquo;', 'href' => $_pages['hours'], 'variation' => 'arrow-link'),
        array('label' => 'Directions and parking&nbsp;&nbsp;&rsaquo;', 'href' => $_pages['directions'], 'variation' => 'arrow-link')
    ))
@endcomponent

@component('components.molecules._m-title-bar')
    @slot('links', array(
        array(
            'label' => 'All current exhibitions and events',
            'href' => $_pages['exhibitions'],
        ),
    ))
    Exhibitions and Events
@endcomponent

@component('components.atoms._hr')
@endcomponent

@component('components.organisms._o-grid-listing')
    @slot('variation', 'o-grid-listing--gridlines-cols o-grid-listing--gridlines-top')
    @slot('cols_small','2')
    @slot('cols_medium','2')
    @slot('cols_large','2')
    @slot('cols_xlarge','2')
    @foreach ($exhibitions as $item)
        @component('components.molecules._m-listing----exhibition')
            @slot('titleFont', 'f-list-4')
            @slot('item', $item)
            @slot('imageSettings', array(
                'fit' => 'crop',
                'ratio' => '16:9',
                'srcset' => array(200,400,600,1000,1500),
                'sizes' => aic_gridListingImageSizes(array(
                      'xsmall' => '1',
                      'small' => '2',
                      'medium' => '2',
                      'large' => '2',
                      'xlarge' => '2',
                )),
            ))
        @endcomponent
    @endforeach
@endcomponent

@component('components.atoms._hr')
@endcomponent

@component('components.organisms._o-grid-listing')
    @slot('variation', 'o-grid-listing--single-row o-grid-listing--scroll@xsmall o-grid-listing--scroll@small o-grid-listing--hide-extra@medium o-grid-listing--gridlines-cols')
    @slot('cols_medium','3')
    @slot('cols_large','4')
    @slot('cols_xlarge','4')
    @slot('behavior','dragScroll')
    @foreach ($events as $item)
        @component('components.molecules._m-listing----event')
            @slot('item', $item)
            @slot('imageSettings', array(
                'fit' => 'crop',
                'ratio' => '16:9',
                'srcset' => array(200,400,600),
                'sizes' => aic_gridListingImageSizes(array(
                      'xsmall' => '1',
                      'small' => '1',
                      'medium' => '4',
                      'large' => '4',
                      'xlarge' => '4',
                )),
            ))
        @endcomponent
    @endforeach
@endcomponent

@component('components.molecules._m-links-bar')
    @slot('variation', 'm-links-bar--title-bar-companion')
    @slot('linksPrimary', array(
        array(
            'label' => 'All current exhibitions and events',
            'href' => $_pages['exhibitions'],
            'variation' => 'btn btn--secondary f-buttons',
        ),
    ))
@endcomponent

@component('components.molecules._m-cta-banner----become-a-member')
    @slot('image', $membership_module_image)
    @slot('href', $membership_module_url)
    @slot('headline', $membership_module_headline)
    @slot('short_copy', $membership_module_short_copy)
    @slot('button_text', $membership_module_button_text)
@endcomponent


@component('components.molecules._m-title-bar')
    @slot('links', array(array('label' => 'Explore the collection', 'href' => $_pages['collection'])))
    From the Collection
@endcomponent

@component('components.organisms._o-pinboard')
    @slot('cols_small','2')
    @slot('cols_medium','3')
    @slot('cols_large','3')
    @slot('cols_xlarge','3')
    @slot('maintainOrder','false')
    @foreach ($theCollection as $item)
        @component('components.molecules._m-listing----'.$item->type)
            @slot('variation', 'o-pinboard__item')
            @slot('item', $item)
            @slot('imageSettings', array(
                'fit' => ($item->type !== 'selection' and $item->type !== 'artwork') ? 'crop' : null,
                'ratio' => ($item->type !== 'selection' and $item->type !== 'artwork') ? '16:9' : null,
                'srcset' => array(200,400,600,1000),
                'sizes' => aic_gridListingImageSizes(array(
                      'xsmall' => '1',
                      'small' => '2',
                      'medium' => '3',
                      'large' => '3',
                      'xlarge' => '3',
                )),
            ))
        @endcomponent
    @endforeach
@endcomponent

@component('components.molecules._m-links-bar')
    @slot('variation', 'm-links-bar--title-bar-companion')
    @slot('linksPrimary', array(array('label' => 'Explore the collection', 'href' => $_pages['collection'], 'variation' => 'btn btn--secondary f-buttons')))
@endcomponent



@component('components.molecules._m-title-bar')
    @slot('links', array(array('label' => 'Explore the shop', 'href' => $_pages['shop'])))
    From the Shop
@endcomponent

@component('components.organisms._o-grid-listing')
    @slot('variation', 'o-grid-listing--single-row o-grid-listing--scroll@xsmall o-grid-listing--scroll@small o-grid-listing--hide-extra@medium o-grid-listing--gridlines-cols')
    @slot('cols_medium','4')
    @slot('cols_large','5')
    @slot('cols_xlarge','5')
    @slot('behavior','dragScroll')
    @foreach ($products as $item)
        @component('components.molecules._m-listing----product')
            @slot('simple', true)
            @slot('item', $item)
            @slot('imageSettings', array(
                'fit' => 'clamp',
                'ratio' => '3:4',
                'srcset' => array(200,400,600),
                'sizes' => aic_imageSizes(array(
                      'xsmall' => '216px',
                      'small' => '216px',
                      'medium' => '18',
                      'large' => '13',
                      'xlarge' => '13',
                )),
            ))
        @endcomponent
    @endforeach
@endcomponent

@component('components.molecules._m-links-bar')
    @slot('variation', 'm-links-bar--title-bar-companion')
    @slot('linksPrimary', array(array('label' => 'Explore the shop', 'href' => $_pages['shop'], 'variation' => 'btn btn--secondary f-buttons')))
@endcomponent

@endsection
