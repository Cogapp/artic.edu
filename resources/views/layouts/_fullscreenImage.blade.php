<div class="o-fullscreen-image" id="fullscreenImage" data-behavior="imageZoomArea">
    <img>
    <ul class="o-fullscreen-image__img-actions">
      <li>
        @component('components.atoms._btn')
            @slot('variation', 'btn--septenary btn--icon-sq')
            @slot('font', '')
            @slot('icon', 'icon--plus--24')
            @slot('dataAttributes', 'data-fullscreen-zoom-in')
        @endcomponent
      </li>
      <li>
        @component('components.atoms._btn')
            @slot('variation', 'btn--septenary btn--icon-sq')
            @slot('font', '')
            @slot('icon', 'icon--minus--24')
            @slot('dataAttributes', 'data-fullscreen-zoom-out')
        @endcomponent
      </li>
      {{-- <li>
        @component('components.atoms._btn')
            @slot('variation', 'btn--septenary btn--icon-sq')
            @slot('font', '')
            @slot('icon', 'icon--share--24')
            @slot('dataAttributes', 'data-fullscreen-share')
            @slot('behavior', 'sharePage')
        @endcomponent
      </li> --}}
    </ul>
</div>
