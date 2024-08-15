<script type="module" src="{{FrontendHelpers::revAsset('scripts/app.js')}}" type="module"></script>

@if (!config('aic.disable_extra_scripts'))
    @yield('extra_scripts')
@endif
