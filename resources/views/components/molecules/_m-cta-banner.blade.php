@php
    $tag = $tag ?? 'aside';

    $href = $href ?? '#';
    $image = $image ?? null;
    $header = $header ?? null;
    $body = $body ?? null;
    $button_text = $button_text ?? null;
    $custom_tours = $custom_tours ?? false;

    // TODO: Make this an option?
    $isBigLink = isset($image);
@endphp

@if ($header)
    <div class="{{ isset($image) && $custom_tours ? 'm-cta-banner--aic-ct--container' : '' }}">
        <{{ $tag }} class="m-cta-banner{{ isset($image) ? ' m-cta-banner--with-image' : '' }}{{ (isset($variation)) ? ' '.$variation : '' }}{{ $custom_tours ? ' m-cta-banner--aic-ct' : ''}}{{ isset($image) && $custom_tours ? ' m-cta-banner--aic-ct-with-image' : '' }}{{ !isset($image) && $custom_tours ? ' m-cta-banner--aic-ct--no-image' : '' }}"{!! isset($image) ? ' data-behavior="bannerParallax"' : '' !!}>
            @if ($isBigLink)
                <a href="{{ $href }}" class="m-cta-banner__link"{!! (isset($gtmAttributes)) ? ' '.$gtmAttributes.'' : '' !!}>
            @endif
                @if (isset($image))
                    <div class="m-cta-banner__img" data-parallax-img>
                        @component('components.atoms._img')
                            @slot('image', $image)
                            @slot('settings', array(
                                'fit' => 'crop',
                                'ratio' => '25:4',
                                'srcset' => array(300,600,1000,1500,2000),
                                'sizes' => ImageHelpers::aic_imageSizes(array(
                                      'xsmall' => '58',
                                      'small' => '58',
                                      'medium' => '58',
                                      'large' => '58',
                                      'xlarge' => '58',
                                )),
                            ))
                        @endcomponent
                        @if ($custom_tours)
                            <div class="m-cta-banner--aic-ct__overlay">
                            </div>
                        @endif
                    </div>
                @endif
                <div class="m-cta-banner__txt">
                    <div class="m-cta-banner__title{{ $custom_tours ? ' f-headline' :  ' f-module-title-2' }}">{!! SmartyPants::defaultTransform($header) !!}</div>
                    @if ($body)
                        <div class="m-cta-banner__msg{{ $custom_tours ? ' m-cta-banner__msg--aic-ct f-body' :  ' f-list-2' }}">{!! SmartyPants::defaultTransform($body) !!}</div>
                    @endif
                    @if ($button_text)
                        <div class="m-cta-banner__action">
                            @if (!$isBigLink)
                                <a href="{{ $href }}">
                            @endif

                            <span class="btn f-buttons{{ isset($image) && !$custom_tours ? ' btn--contrast' : '' }}{{ !isset($image) && $custom_tours ? ' btn--quaternary' : '' }}">{!! SmartyPants::defaultTransform($button_text) !!}</span>
                            @if (!$isBigLink)
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @if ($isBigLink)
                </a>
            @endif
        </{{ $tag }}>
    </div>
@endif
