@if ($bgcolor ?? false)
    <style>
        .m-article-header--digital-publication-article ~ .m-article-header__text::before,
        .m-article-actions--publication__logo {
            background-color: {{ $bgcolor }};
            transition: background-color 1s;
        }
    </style>
@endif

<header class="m-article-header m-article-header--feature m-article-header--digital-publication-article">
    <div class="m-article-header__img">
        @if ($img)
            @component('components.atoms._img')
                @slot('image', $img)
                @slot('class', 'img-hero-desktop')
                @slot('settings', array(
                    'srcset' => array(300,600,1000,1500,3000),
                    'sizes' => '100vw',
                ))
            @endcomponent
            @component('components.atoms._img')
                @slot('image', !empty($imgMobile) ? $imgMobile : $img)
                @slot('class', 'img-hero-mobile')
                @slot('settings', array(
                    'srcset' => array(300,600,1000,1500,3000),
                    'sizes' => '100vw',
                ))
            @endcomponent
        @endif
    </div>
    <div class="m-article-actions--publication__logo u-show@medium-">
        {!! $title_display ?? $title !!}
    </div>
</header>
