@php
$print = isset($_GET['print']);
@endphp
<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js{{ (isset($contrastHeader) and $contrastHeader) ? ' s-contrast-header' : '' }}{{ (isset($filledLogo) and $filledLogo) ? ' s-filled-logo' : '' }}{{ $print ? ' s-print' : '' }}  {{ !empty($roadblock) ? 's-roadblock-active' : '' }}{{ isset($_COOKIE["A17_fonts_cookie_serif"]) ? ' s-serif-loaded' : '' }}{{ isset($_COOKIE["A17_fonts_cookie_sans-serif"]) ? ' s-sans-serif-loaded' : '' }} s-env-{{ app()->environment() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="format-detection" content="telephone=no">

  <title>AIC</title>

  <!-- Main Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{revAsset('images/favicon-16.png')}}">
  <!-- Apple Touch Icons (ipad/iphone standard+retina) -->
  <link rel="apple-touch-icon-precomposed" href="{{revAsset('images/favicon-152.png')}}"> <!-- General use iOS/Android icon, auto-downscaled by devices. -->
  <link rel="apple-touch-icon-precomposed" type="image/png" href="{{revAsset('images/favicon-120.png')}}" sizes="120x120"> <!-- iPhone retina touch icon -->
  <link rel="apple-touch-icon-precomposed" type="image/png" href="{{revAsset('images/favicon-76.png')}}" sizes="76x76"> <!-- iPad home screen icons -->

    @if (config('services.google_tag_manager.enabled'))
      <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','{!! config('services.google_tag_manager.id') !!}');</script>
      <!-- End Google Tag Manager -->
    @endif

  <!--[if lt IE 9]>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <![endif]-->

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @include('layouts._head-js')
  @if ($print)
      <script>A17.print = true;</script>
  @endif
  <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/612324/7579192/css/fonts.css" />
  <style>
  @import url("//hello.myfonts.net/count/3545d5");
  @font-face {font-family: 'Sabon';src: url({{revAsset('fonts/3545D5_0_0.eot')}});src: url({{revAsset('fonts/3545D5_0_0.eot?#iefix')}}) format('embedded-opentype'),url({{revAsset('fonts/3545D5_0_0.woff2')}}) format('woff2'),url({{revAsset('fonts/3545D5_0_0.woff')}}) format('woff'),url({{revAsset('fonts/3545D5_0_0.ttf')}}) format('truetype');font-weight:normal;font-weight:400;font-style:normal;}
  @font-face {font-family: 'Sabon';src: url({{revAsset('fonts/3545D5_1_0.eot')}});src: url({{revAsset('fonts/3545D5_1_0.eot?#iefix')}}) format('embedded-opentype'),url({{revAsset('fonts/3545D5_1_0.woff2')}}) format('woff2'),url({{revAsset('fonts/3545D5_1_0.woff')}}) format('woff'),url({{revAsset('fonts/3545D5_1_0.ttf')}}) format('truetype');font-weight:normal;font-weight:400;font-style:italic;}
  @font-face {font-family: 'Sabon';src: url({{revAsset('fonts/3545D5_2_0.eot')}});src: url({{revAsset('fonts/3545D5_2_0.eot?#iefix')}}) format('embedded-opentype'),url({{revAsset('fonts/3545D5_2_0.woff2')}}) format('woff2'),url({{revAsset('fonts/3545D5_2_0.woff')}}) format('woff'),url({{revAsset('fonts/3545D5_2_0.ttf')}}) format('truetype');font-weight:normal;font-weight:500;font-style:normal;}
  </style>
  @if ($print)
  <link href="{{revAsset('styles/print.css')}}" rel="stylesheet" />
  @else
  <link href="{{revAsset('styles/app.css')}}" rel="stylesheet" />
  @endif
</head>

<body>
    @if (config('services.google_tag_manager.enabled'))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={!! config('services.google_tag_manager.id') !!}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

<div id="a17">

  @include('layouts._header')

  <main id="content">
    @yield('content')
  </main>

  @include('layouts._footer')

  @if ( !app()->environment('production'))
    @include('layouts._designgrids')
  @endif
</div>

@include('layouts._mask')
@include('layouts._calendar')
@include('layouts._fullscreenImage')
@include('layouts._share-menu')
@include('layouts._info-button-info')
@include('layouts._nav-mobile')
@include('layouts._search')
@include('layouts._modal')

@if (!empty($roadblock))
    @component('layouts._modal-promo', [ 'modal' => $roadblock])
    @endcomponent
@endif

@include('layouts._scripts')
@if ($print)
    <script>window.print();</script>
@endif
</body>
</html>
