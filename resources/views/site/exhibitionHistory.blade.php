@extends('layouts.app')

@section('content')

    @component('components.molecules._m-header-block')
        {{ $title }}
    @endcomponent

    @component('components.molecules._m-intro-block')
        {!! $intro !!}
    @endcomponent

    @component('components.organisms._o-grid-listing')
        @slot('variation', 'o-grid-listing--gridlines-rows')
        @slot('cols_medium','2')
        @slot('cols_large','2')
        @slot('cols_xlarge','2')
        @slot('tag', 'div')

        <div class="o-blocks">
          @component('components.molecules._m-media')
            @slot('item', $media)
            @slot('imageSettings', array(
                'srcset' => array(108,216,400,600),
                'sizes' => aic_imageSizes(array(
                      'xsmall' => 58,
                      'small' => 58,
                      'medium' => 28,
                      'large' => 28,
                      'xlarge' => 28,
                )),
            ))
          @endcomponent
        </div>
        <div class="o-blocks">
            @component('components.blocks._blocks')
                @slot('blocks', $blocks)
            @endcomponent
        </div>
    @endcomponent

    @component('components.molecules._m-links-bar')
        @slot('variation','m-links-bar--filters')
        @slot('primaryHtml')
            <li class="m-links-bar__item m-links-bar__item--primary">
                @component('components.atoms._dropdown')
                  @slot('prompt', 'Decade: '.$decade_prompt)
                  @slot('ariaTitle', 'Select decade')
                  @slot('variation','dropdown--filter f-link')
                  @slot('font', null)
                  @slot('options', $decades)
                @endcomponent
            </li>
            <li class="m-links-bar__item m-links-bar__item--primary">
                @component('components.atoms._dropdown')
                  @slot('prompt', 'Year: '.$year)
                  @slot('ariaTitle', 'Select decade')
                  @slot('variation','dropdown--filter f-link')
                  @slot('font', null)
                  @slot('options', $years)
                @endcomponent
            </li>
            <li class="m-links-bar__item m-links-bar__item--search">
                @component('components.molecules._m-search-bar')
                    @slot('variation', 'm-search-bar--subtle')
                    @slot('placeholder','Keyword')
                    @slot('name', 'keyword')
                    @slot('action', '/statics/exhibition_history')
                    @slot('clearLink', '/statics/exhibition_history')
                    @slot('value', $_GET['keyword'] ?? null)
                @endcomponent
            </li>
        @endslot
    @endcomponent

    @component('components.molecules._m-title-bar')
        @if (isset($exhibitions) and sizeof($exhibitions) > 0)
            @slot('links', array(array('label' => 'Showing '.$exhibitions->count().' out of '.$exhibitions->total().' Exhibitions')))
        @endif
        @slot('titleFont', 'f-numeral-date')
        {{ $year }}
    @endcomponent

    @if (isset($exhibitions) and sizeof($exhibitions) > 0)
        @component('components.atoms._hr')
        @endcomponent
        @component('components.organisms._o-row-listing')
            @foreach ($exhibitions as $item)
                @component('components.molecules._m-listing----exhibition-history-row')
                    @slot('variation', 'm-listing--row')
                    @slot('item', $item)
                    @slot('imageSettings', array(
                        'srcset' => array(108,216,400,600),
                        'sizes' => aic_imageSizes(array(
                              'xsmall' => 58,
                              'small' => 58,
                              'medium' => 13,
                              'large' => 13,
                              'xlarge' => 13,
                        )),
                    ))
                @endcomponent
            @endforeach
        @endcomponent
    @else
        @component('components.molecules._m-no-results')
        @endcomponent
    @endif

    {!! $exhibitions->appends(['year' => $year])->links() !!}

    @component('components.organisms._o-recently-viewed')
        @slot('artworks',$recentlyViewedArtworks ?? null)
    @endcomponent

    @component('components.organisms._o-interested-themes')
        @slot('themes',$interestedThemes ?? null)
    @endcomponent

@endsection
