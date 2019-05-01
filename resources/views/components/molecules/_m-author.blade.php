<div class="m-author{{ (isset($editorial) and $editorial) ? ' m-author--editorial' : '' }}{{ (isset($variation)) ? ' '.$variation : '' }}">
    @if (isset($img))
        <div class="m-author__img">
            @component('components.atoms._img')
                @slot('image', $img)
                @slot('settings', array(
                    'fit' => 'crop',
                    'ratio' => '1:1',
                    'srcset' => array(40,88,176),
                    'sizes' => aic_imageSizes(array(
                      'xsmall' => '40px',
                      'small' => '40px',
                      'medium' => '40px',
                      'large' => '40px',
                      'xlarge' => '88px',
                    )),
                ))
            @endcomponent
        </div>
    @endif
    @component('components.blocks._text')
        @slot('font', 'f-secondary')
        @if (isset($name))
            @if (isset($link))
                <a href="{{ $link ?? '#' }}">{!! $name ?? '' !!}</a>
            @else
                {!! $name ?? '' !!}
            @endif
        @endif
        @if (isset($name) and isset($date))
        <br>
        @endif
        @if (isset($date))
            {{ $date->format('F j, Y') ?? '' }}
        @endif
    @endcomponent
</div>
