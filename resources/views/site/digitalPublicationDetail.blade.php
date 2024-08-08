@php
    use App\Enums\DigitalPublicationArticleType;
@endphp

@extends('layouts.app')

@section('content')

<article class="o-article">
    @component('components.molecules._m-article-header----feature')
        @slot('variation', 'm-article-header--digital-publication')
        @slot('title', $item->present()->title)
        @slot('title_display', $item->present()->headerTitle())
        @slot('subtitle_display', $item->present()->headerSubtitle())
        @slot('img', $item->imageFront('listing'))
        @slot('imgMobile', $item->imageFront('mobile_listing'))
        @slot('credit', $item->hero_caption ?? null)
        @slot('editorial', true)
        @slot('bgcolor', $item->bgcolor)
    @endcomponent

    @component('components.molecules._m-sidebar-toggle')
        @slot('title', 'Table of Contents')
    @endcomponent

    <div class="o-article__primary-actions o-article__primary-actions--digital-publication">
        @component('components.molecules._m-article-actions----digital-publication')
            @slot('digitalPublication', $item)
            @slot('isLogoAnimated', true)
            @slot('citeAs', $item->cite_as)
        @endcomponent
    </div>

    <div class="o-article__body o-blocks">
        @if ($item->welcome_note_display && $welcomeNote)
            <div class="o-issue__intro">
                @component('components.organisms._o-editors-note----publication')
                    @slot('description', $item->welcome_note_display)
                    @slot('articleLink', $welcomeNote->present()->getArticleUrl($item))
                @endcomponent
            </div>
        @endif

        @foreach ($item->present()->topLevelArticles() as $topLevelArticle)
            @component('components.molecules._m-title-bar', [
                'variation' => 'm-title-bar--compact m-title-bar--light',
            ])
                @slot('links', $topLevelArticle->present()->getBrowseMoreLink($showAll))
                {!! $topLevelArticle->title !!}
            @endcomponent

            @switch($topLevelArticle->listing_display)

                @case('feature')
                    @foreach ($topLevelArticle->children as $item)
                        @if ($loop->iteration <= 4 || $showAll == true)
                            @if($loop->first && $showAll == false)
                                @component('components.molecules._m-showcase')
                                    @slot('variation', 'showcase--digital-publication')
                                    @slot('tag', $topLevelArticle->present()->type)
                                    @slot('title', $topLevelArticle->present()->title_display ?? $topLevelArticle->present()->title)
                                    @slot('author_display', $topLevelArticle->showAuthors())
                                    @slot('description', $topLevelArticle->present()->list_description)
                                    @slot('linkLabel', 'Read full ' . Str::singular(Str::lower($topLevelArticle->present()->type)))
                                    @slot('linkUrl', $topLevelArticle->present()->url)
                                    @slot('image', $topLevelArticle->imageFront('hero'))
                                    @slot('imageSettings', array(
                                        'fit' => 'crop',
                                        'ratio' => '16:9',
                                        'srcset' => array(200,400,600),
                                        'sizes' => ImageHelpers::aic_imageSizes(array(
                                            'xsmall' => '216px',
                                            'small' => '216px',
                                            'medium' => '18',
                                            'large' => '13',
                                            'xlarge' => '13',
                                        )),
                                    ))
                                @endcomponent
                            @else
                                @if($loop->first || ($loop->iteration == 2 && $showAll == false)) 
                                    @component('components.organisms._o-grid-listing')
                                        @slot('cols_small','2')
                                        @slot('cols_medium','3')
                                        @slot('cols_large','3')
                                        @slot('cols_xlarge','3')
                                @endif
                                    @component('components.molecules._m-listing----digital-publication-article')
                                        @slot('href', $item->present()->url)
                                        @slot('image', $item->imageFront('hero'))
                                        @slot('type', $item->present()->type)
                                        @slot('title', $item->present()->title)
                                        @slot('title_display', $item->present()->title_display)
                                        @slot('list_description', $item->present()->list_description)
                                        @slot('author_display', $item->showAuthors())
                                        @slot('imageSettings', array(
                                            'fit' => 'crop',
                                            'ratio' => '16:9',
                                            'srcset' => array(200,400,600),
                                            'sizes' => ImageHelpers::aic_imageSizes(array(
                                                'xsmall' => '216px',
                                                'small' => '216px',
                                                'medium' => '18',
                                                'large' => '13',
                                                'xlarge' => '13',
                                            )),
                                        ))
                                    @endcomponent
                                @if($loop->last || ($loop->iteration == 4 && $showAll == false))
                                    @endcomponent
                                @endif
                            @endif
                        @endif
                    @endforeach
                @break

                @case('3-across')
                    @component('components.organisms._o-grid-listing')
                        @slot('cols_small','2')
                        @slot('cols_medium','3')
                        @slot('cols_large','3')
                        @slot('cols_xlarge','3')

                        @foreach ($topLevelArticle->children as $item)
                            @if ($loop->iteration <= 3 || $showAll == true)
                            @component('components.molecules._m-listing----digital-publication-article')
                                @slot('href', $item->present()->url)
                                @slot('image', $item->imageFront('hero'))
                                @slot('type', $item->present()->type)
                                @slot('title', $item->present()->title)
                                @slot('title_display', $item->present()->title_display)
                                @slot('list_description', $item->present()->list_description)
                                @slot('author_display', $item->showAuthors())
                                @slot('imageSettings', array(
                                    'fit' => 'crop',
                                    'ratio' => '16:9',
                                    'srcset' => array(200,400,600),
                                    'sizes' => ImageHelpers::aic_imageSizes(array(
                                        'xsmall' => '216px',
                                        'small' => '216px',
                                        'medium' => '18',
                                        'large' => '13',
                                        'xlarge' => '13',
                                    )),
                                ))
                            @endcomponent
                            @endif
                        @endforeach
                    @endcomponent
                @break

                @case('entries')
                    @component('components.organisms._o-grid-listing')
                        @slot('cols_xsmall','2')
                        @slot('cols_small','2')
                        @slot('cols_medium','4')
                        @slot('cols_large','4')
                        @slot('cols_xlarge','4')

                        @foreach ($topLevelArticle->children as $item)
                            @if ($loop->iteration <= 8 || $showAll == true)
                                @component('components.molecules._m-listing----digital-publication-article-entry')
                                    @slot('href', $item->present()->url)
                                    @slot('image', $item->imageFront('hero'))
                                    @slot('title', $item->present()->title)
                                    @slot('title_display', $item->present()->title_display)
                                    @slot('label', $item->present()->label)
                                    @slot('imageSettings', array(
                                        'fit' => 'crop',
                                        'ratio' => '16:9',
                                        'srcset' => array(200,400,600),
                                        'sizes' => ImageHelpers::aic_imageSizes(array(
                                            'xsmall' => '216px',
                                            'small' => '216px',
                                            'medium' => '18',
                                            'large' => '13',
                                            'xlarge' => '13',
                                        )),
                                    ))
                                @endcomponent
                            @endif
                        @endforeach

                    @endcomponent
                @break

                @case('group_entries')
                    @component('components.organisms._o-grid-listing')
                        @slot('cols_xsmall','1')
                        @slot('cols_small','1')
                        @slot('cols_medium','3')
                        @slot('cols_large','3')
                        @slot('cols_xlarge','3')

                        @foreach ($topLevelArticle->children as $item)
                            @component('components.molecules._m-listing----cover')
                                @slot('variation', 'm-listing--cover--digital-publication')
                                @slot('href', $item->present()->url)
                                @slot('image', $item->imageFront('hero'))
                                @slot('title', $item->present()->label)
                            @endcomponent
                        @endforeach

                    @endcomponent
                @break

                @case('list')
                    @component('components.organisms._o-grid-listing')
                        @slot('cols_small','1')

                        @foreach ($topLevelArticle->children as $item)
                            @if ($loop->iteration <= 3 || $showAll == true)
                                @component('components.molecules._m-listing----digital-publication-article')
                                    @slot('variation', 'm-listing--seventy-thirty')
                                    @slot('href', $item->present()->url)
                                    @slot('image', $item->imageFront('hero'))
                                    @slot('type', $item->present()->type)
                                    @slot('title', $item->present()->title)
                                    @slot('title_display', $item->present()->title_display)
                                    @slot('list_description', $item->present()->list_description)
                                    @slot('author_display', $item->showAuthors())
                                    @slot('imageSettings', array(
                                        'fit' => 'crop',
                                        'ratio' => '16:9',
                                        'srcset' => array(200,400,600),
                                        'sizes' => ImageHelpers::aic_imageSizes(array(
                                            'xsmall' => '216px',
                                            'small' => '216px',
                                            'medium' => '18',
                                            'large' => '13',
                                            'xlarge' => '13',
                                        )),
                                    ))
                                @endcomponent
                            @endif
                        @endforeach

                    @endcomponent
                @break
                    @case('simple_list')
                        @foreach($topLevelArticle->children as $item)
                            @component('components.molecules._m-title-bar', [
                                'variation' => 'm-title-bar--compact m-title-bar--no-hr',
                            ])
                                @slot('links', [
                                    [
                                        'label' => 'View all ' . $item->present()->type,
                                        'href'  => $item->present()->url,
                                    ]
                                ])
                                {!! $item->present()->type !!}
                            @endcomponent
                        @endforeach
                @break
            @endswitch
        @endforeach

        @if (isset($item->sponsor_display))
            @component('components.molecules._m-title-bar', [
                'variation' => 'm-title-bar--compact m-title-bar--light',
            ])
                Sponsors
            @endcomponent

            {!! $item->sponsor_display !!}
        @endif

        @if ($item->cite_as)
            @component('components.molecules._m-title-bar', [
                'variation' => 'm-title-bar--compact m-title-bar--light',
            ])
                How to Cite
            @endcomponent

            {!! $item->cite_as !!}
        @endif
    </div>
</article>

@endsection

@section('extra_scripts')
    <script src="{{FrontendHelpers::revAsset('scripts/blocks360.js')}}"></script>
    <script src="{{FrontendHelpers::revAsset('scripts/blocks3D.js')}}"></script>
@endsection
