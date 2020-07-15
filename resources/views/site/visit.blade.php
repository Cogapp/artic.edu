@extends('layouts.app')

@section('content')

  <section class="o-visit" itemscope itemtype="http://schema.org/TouristAttraction">
    <link itemprop="additionalType" href="http://schema.org/Museum" aria-hidden="true"/>
    <link itemprop="additionalType" href="http://schema.org/LandmarksOrHistoricalBuildings" aria-hidden="true"/>
    <link itemprop="additionalType" href="http://schema.org/LocalBusiness" aria-hidden="true"/>
    @component('site.shared._schemaItemProps')
      @slot('itemprops',$itemprops ?? null)
    @endcomponent

    @component('components.molecules._m-media')
        @slot('item', $headerMedia)
        @slot('tag', 'span')
        @slot('imageSettings', array(
            'srcset' => array(300,600,1000,1500,3000),
            'sizes' => '100vw',
        ))
    @endcomponent

    @component('components.molecules._m-links-bar')
        @slot('overflow', true)
        @slot('variation', 'm-links-bar--nav-bar')
        @slot('isPrimaryPageNav', true)
        @slot('linksPrimary', array(
          array('label' => __('Hours'), 'href' => '#hours'),
          array('label' => __('Admission'), 'href' => '#admission'),
          array('label' => __('FAQs'), 'href' => '#faqs'),
          array('label' => __('Accessibility'), 'href' => '#accessibility'),
          array('label' => __('Directions'), 'href' => '#directions'),
          array('label' => __('Explore on your own'), 'href' => '#explore'),
        ))
         @slot('secondaryHtml')
          <li class="m-links-bar__item  m-links-bar__item--primary">
              @component('components.atoms._dropdown')
                @slot('prompt', 'Select language')
                @slot('ariaTitle', 'Select language')
                @slot('variation','dropdown--filter f-link')
                @slot('font', null)
                @slot('options', array(
                  array('active' => request('lang') === 'en', 'href' => currentUrlWithQuery([]), 'label' => 'English'),
                  array('active' => request('lang') === 'es', 'href' => currentUrlWithQuery(['lang' => 'es']), 'lang' => 'es', 'label' => 'Español'),
                  array('active' => request('lang') === 'fr', 'href' => currentUrlWithQuery(['lang' => 'fr']), 'lang' => 'fr', 'label' => 'Français'),
                  array('active' => request('lang') === 'de', 'href' => currentUrlWithQuery(['lang' => 'de']), 'lang' => 'de', 'label' => 'Deutsch'),
                  array('active' => request('lang') === 'zh', 'href' => currentUrlWithQuery(['lang' => 'zh']), 'lang' => 'zh', 'label' => '中文'),
                  array('active' => request('lang') === 'ja', 'href' => currentUrlWithQuery(['lang' => 'ja']), 'lang' => 'ja', 'label' => '日本語'),
                  array('active' => request('lang') === 'pt', 'href' => currentUrlWithQuery(['lang' => 'pt']), 'lang' => 'pt', 'label' => 'Português'),
                ))
              @endcomponent
          </li>
      @endslot

    @endcomponent

    @component('components.molecules._m-header-block')
        {{ $title }}
    @endcomponent

    @component('components.molecules._m-title-bar')
        @slot('id', 'hours')
        @lang('Hours')
    @endcomponent

    @if ($hours['intro'])
        @component('components.atoms._hr')
        @endcomponent

        @component('components.molecules._m-intro-block')
            @slot('itemprop','description')
            {!! SmartyPants::defaultTransform($hours['intro']) !!}
        @endcomponent
    @endif

    @component('components.organisms._o-grid-listing')
        @slot('variation', 'o-grid-listing--gridlines-rows')
        @slot('cols_medium','2')
        @slot('cols_large','2')
        @slot('cols_xlarge','2')
        @slot('tag', 'div')

        <div class="o-blocks">
          @component('components.molecules._m-media')
            @slot('item', $hours['media'])
            @slot('imageSettings', array(
                'fit' => 'crop',
                'ratio' => '16:9',
                'srcset' => array(300,600,800,1200,1600,3000,4500),
                'sizes' => aic_imageSizes(array(
                      'xsmall' => '58',
                      'small' => '58',
                      'medium' => '38',
                      'large' => '28',
                      'xlarge' => '28',
                )),
            ))
          @endcomponent
        </div>
        <div class="o-blocks">
          <div class="m-table m-table--minimal">
            <table>
              <tbody>
                <tr>
                  <th>
                    <span class="f-module-title-1">Monday</span>
                  </th>
                  <td>
                    <span class="f-module-title-1">10:00am&ndash;6:00pm*</span>
                  </td>
                </tr>
                <tr>
                  <th>
                    <span class="f-module-title-1">Tuesday&ndash;Wednesday</span>
                  </th>
                  <td>
                    <span class="f-module-title-1">Closed</span>
                  </td>
                </tr>
                <tr>
                  <th>
                    <span class="f-module-title-1">Thursday&ndash;Friday</span>
                  </th>
                  <td>
                    <span class="f-module-title-1">12:00pm&ndash;8:00pm*</span>
                  </td>
                </tr>
                <tr>
                  <th>
                    <span class="f-module-title-1">Saturday&ndash;Sunday</span>
                  </th>
                  <td>
                    <span class="f-module-title-1">10:00am&ndash;6:00pm*</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          @component('components.blocks._text')
              @slot('font','f-body')
              {!! SmartyPants::defaultTransform($hours['primary']) !!}
          @endcomponent
          @component('components.blocks._text')
              @slot('tag','span')
              @slot('font','f-secondary')
              {!! SmartyPants::defaultTransform($hours['secondary']) !!}
          @endcomponent
        </div>
    @endcomponent

    @foreach($hours['sections'] as $section)

      @component('components.organisms._o-grid-listing')
          @slot('variation', 'o-grid-listing--gridlines-rows o-grid-listing--info-block')
          @slot('cols_small','2')
          @slot('cols_medium','2')
          @slot('cols_large','2')
          @slot('cols_xlarge','2')
          @slot('tag', 'div')
          <div class="o-blocks">
            @component('components.atoms._title')
                @slot('font','f-list-3')
                @slot('tag','h3')
                @component('components.atoms._arrow-link')
                    @slot('font','f-null')
                    @slot('href', $section['external_link'])
                    @slot('gtmAttributes', 'data-gtm-event="'.getUtf8Slug($section['title'] ?? 'unknown title').'" data-gtm-event-action="' . $seo->title . '" data-gtm-event-category="nav-link"')
                    {!! SmartyPants::defaultTransform($section['title']) !!}
                @endcomponent
            @endcomponent
          </div>
          <div class="o-blocks">
            {!! SmartyPants::defaultTransform(preg_replace('/<p>/i', '<p class="f-secondary">', $section['copy'])); !!}
          </div>
      @endcomponent

    @endforeach

    <div class="m-table">
      <table>
        <caption>
            @component('components.molecules._m-title-bar')
                @slot('id', 'admission')
                @lang('Admission')
            @endcomponent
        </caption>
        <thead>
          <tr>
            <th>&nbsp;</th>
            @foreach ($admission['titles'] as $categoryId => $categoryData)
              <th aria-labelledby="h-{{ $categoryData['id'] }}">
                @component('components.blocks._text')
                    @slot('font', 'f-module-title-1')
                    @slot('tag','span')
                    @slot('id', 'h-' .$categoryData['id'])
                    {!! SmartyPants::defaultTransform($categoryData['title']) !!}
                @endcomponent
                @if (isset($categoryData['tooltip']))
                  &nbsp;
                  @component('components.atoms._info-button')
                      @slot('id', $categoryData['id'])
                      {!! SmartyPants::defaultTransform($categoryData['tooltip']) !!}
                  @endcomponent
                @endif
              </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($admission['prices'] as $ageId => $ageData)
            @if (strtolower($ageData['title_en']) !== 'children' and strtolower($ageData['title_en']) !== 'members')
                <tr>
                    <th>
                      @component('components.blocks._text')
                          @slot('font', 'f-module-title-1')
                          @slot('tag','span')
                          {!! SmartyPants::defaultTransform($ageData['title']) !!}
                      @endcomponent
                      @if (isset($ageData['subtitle']))
                        @component('components.blocks._text')
                            @slot('font', 'f-secondary')
                            @slot('tag','em')
                            &nbsp;({!! SmartyPants::defaultTransform($ageData['subtitle']) !!})
                        @endcomponent
                      @endif
                    </th>

                @foreach ($admission['titles'] as $categoryId => $data)
                  <td>
                    @if (strtolower($ageData['title']) === 'free')
                      @component('components.blocks._text')
                          @slot('font','f-tag')
                          @slot('tag','span')
                          @lang('Free')
                      @endcomponent
                    @else
                      @component('components.blocks._text')
                          @slot('font', 'f-secondary')
                          @slot('tag','span')
                          @if($ageData[$categoryId] == 0)
                          @lang('Free')
                          @else
                          ${{ $ageData[$categoryId] }}
                          @endif
                      @endcomponent
                    @endif
                  </td>
                  @endforeach
                </tr>
            @endif
          @endforeach
          <tr>
            <th>
              @component('components.blocks._text')
                  @slot('font', 'f-module-title-1')
                  @slot('tag','span')
                  @lang('Children')
              @endcomponent
            </th>
            <td rowspan="2" colspan="4" aria-label="Children and members are free">
              @component('components.blocks._text')
                  @slot('font','f-tag')
                  @slot('tag','span')
                  @lang('Free')
              @endcomponent
            </td>
          </tr>
          <tr>
            <th>
              @component('components.blocks._text')
                  @slot('font', 'f-module-title-1')
                  @slot('tag','span')
                  @lang('Members')
              @endcomponent
            </th>
          </tr>
        </tbody>
      </table>
    </div>

    @component('components.organisms._o-grid-listing')
        @slot('variation', 'o-grid-listing--info-block')
        @slot('cols_medium','2')
        @slot('cols_large','2')
        @slot('cols_xlarge','2')
        @slot('tag', 'div')

        <div class="o-blocks">
          {!! SmartyPants::defaultTransform($admission['text']) !!}
        </div>
        <div class="o-blocks">
          <h3 class="sr-only" id="h-ticket-actions">Buy ticket options</h3>
          <ul class="m-ticket-actions o-blocks__block" aria-labelledby="h-ticket-actions">
              <li class="m-ticket-actions__action">
                  @component('components.atoms._btn')
                      @slot('variation', 'btn--full')
                      @slot('tag', 'a')
                      @slot('href', $admission['buy_tickets']['link'])
                      @slot('gtmAttributes', 'data-gtm-event="'. getUtf8Slug($admission['buy_tickets']['label']) .'" data-gtm-event-action="' . $seo->title . '" data-gtm-event-category="nav-cta-button"')
                      {!! SmartyPants::defaultTransform($admission['buy_tickets']['label']) !!}
                  @endcomponent
              </li>
              <li class="m-ticket-actions__action">
                  @component('components.atoms._btn')
                      @slot('variation', 'btn--secondary btn--full')
                      @slot('tag', 'a')
                      @slot('href', $admission['become_member']['link'])
                      @slot('gtmAttributes', 'data-gtm-event="become-a-member" data-gtm-event-action="' . $seo->title . '" data-gtm-event-category="nav-cta-button"')
                      {!! SmartyPants::defaultTransform($admission['become_member']['label']) !!}
                  @endcomponent
              </li>
          </ul>
        </div>
    @endcomponent

    @component('components.molecules._m-title-bar')
        @slot('links', array(
        array('label' => __('Accessibility information'), 'href' => $faq['accesibility_link']),
        array('label' => __('More FAQs and guidelines'), 'href' => $faq['more_link'], 'gtmAttributes' => 'data-gtm-event="faq" data-gtm-event-action="' . $seo->title . '" data-gtm-event-category="nav-link"')
        ))
        @slot('id', 'faqs')
        @lang('FAQs')
    @endcomponent

    @component('components.molecules._m-link-list')
        @slot('screenreaderTitle', 'Example questions')
        @slot('links', $faq['questions'])
    @endcomponent

    @component('components.molecules._m-links-bar')
        @slot('variation', 'm-links-bar--title-bar-companion')
        @slot('linksPrimary', array(
        array('label' => __('Accessibility information'), 'href' => $faq['accesibility_link'], 'variation' => 'btn--secondary'),
        array('label' => __('More FAQs and guidelines'), 'href' => $faq['more_link'], 'variation' => 'btn--secondary', 'gtmAttributes' => 'data-gtm-event="faq" data-gtm-event-action="' . $seo->title . '" data-gtm-event-category="nav-link"')
        ))
    @endcomponent

    @component('components.molecules._m-title-bar')
        @slot('id', 'accessibility')
        @lang('Accessibility')
    @endcomponent

    <div class="m-mini-promo">
        @component('components.atoms._img')
            @slot('image', $accessibility['image'])
            @slot('settings', array(
                'fit' => 'crop',
                'ratio' => '9:5',
                'srcset' => array(200,400,600),
                'sizes' => aic_imageSizes(array(
                      'xsmall' => '23',
                      'small' => '13',
                      'medium' => '13',
                      'large' => '13',
                      'xlarge' => '13',
                )),
            ))
        @endcomponent
        <div class="m-mini-promo__text">
            @component('components.atoms._title')
                @slot('font', 'f-module-title-1')
                @slot('tag','h3')
            @endcomponent
            @component('components.blocks._text')
                @slot('font', 'f-secondary')
                {!! SmartyPants::defaultTransform($accessibility['text']) !!}
          @endcomponent
        </div>
        @component('components.atoms._btn')
            @slot('variation', 'btn--secondary')
            @slot('tag', 'a')
            @slot('href', $accessibility['link_url'])
            @slot('gtmAttributes', 'data-gtm-event="' . $accessibility['link_text'] . ' " data-gtm-event-action="' . $seo->title . '"  data-gtm-event-category="nav-cta-button"')
            {!! SmartyPants::defaultTransform($accessibility['link_text']) !!}
        @endcomponent
    </div>

    @component('components.molecules._m-title-bar')
        @slot('id', 'directions')
        @lang('Directions')
    @endcomponent

    @component('components.atoms._hr')
    @endcomponent

    @component('components.molecules._m-intro-block')
        @slot('itemprop','description')
        {!! SmartyPants::defaultTransform($directions['intro']) !!}
    @endcomponent

    <div class="m-directions-block">
      <div class="m-directions-block__map">
        <figure class="m-media">
            <a itemprop="hasMap" href="{{ $directions['links'][0]['href'] ?? '#' }}" class="m-media__img ratio-img ratio-img--16:9" aria-label="Directions to the Art Institute of Chicago">
                @include('partials._map')
            </a>
        </figure>
      </div>
      <div class="m-directions-block__text o-blocks">
        @foreach ($directions['locations'] as $location)
          <div class="f-secondary" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <h3>{!! SmartyPants::defaultTransform($location['name']) !!}</h3>
            <p>
              <span itemprop="streetAddress">{!! $location['street'] !!} {!! $location['addres'] !!}</span><br />
              <span itemprop="addressLocality">{!! $location['city'] !!}</span> <span itemprop="addressRegion">{!! $location['state'] !!}</span> <span itemprop="postalCode">{!! $location['zip'] !!}</span>
            </p>
          </div>
        @endforeach
      </div>
      <div class="m-directions-block__links o-blocks">
        <span class="f-secondary">
          @component('components.atoms._arrow-link')
              @slot('href', $directions['link']['href'])
              @slot('itemprop','hasMap')
              {{ $directions['link']['label'] }}
          @endcomponent

          @component('components.atoms._arrow-link')
              @slot('href', $directions['accessibility_link']['href'])
              @slot('itemprop','hasMap')
              {{ $directions['accessibility_link']['label'] }}
          @endcomponent
        </span>
      </div>
    </div>

    @component('components.molecules._m-title-bar')
        @slot('id', 'explore')
        @lang('Explore on your own')
    @endcomponent

    @component('components.atoms._hr')
    @endcomponent

    @component('components.organisms._o-grid-listing')
        @slot('variation', 'o-grid-listing--gridlines-cols o-grid-listing--gridlines-top')
        @slot('cols_large','3')
        @slot('cols_xlarge','3')
        @slot('ariaLabel', 'h-familes_teens_educators')
        @foreach ($explore as $item)
            @component('components.molecules._m-listing----multi-links')
                @slot('variation', 'm-listing--row@small m-listing--row@medium')
                @slot('item', $item)
                @slot('imageSettings', array(
                    'fit' => 'crop',
                    'ratio' => '16:9',
                    'srcset' => array(200,400,600),
                    'sizes' => aic_imageSizes(array(
                        'xsmall' => '58',
                        'small' => '23',
                        'medium' => '22',
                        'large' => '18',
                        'xlarge' => '18',
                    )),
                ))
                @slot('gtmAttributes', 'data-gtm-event="explore-on-your-own" data-gtm-event-action="' . $seo->title . '"  data-gtm-event-category="nav-link"')
            @endcomponent
        @endforeach
    @endcomponent

  </section>

@endsection
