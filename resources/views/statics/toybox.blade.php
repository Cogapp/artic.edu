@extends('layouts.app')

@section('content')

<p>
  @component('components.atoms._radio')
    @slot('id', 'roption1')
    @slot('value', 'roption1')
    @slot('name', 'roptions')
    @slot('label', 'Option 1')
  @endcomponent
  @component('components.atoms._radio')
    @slot('id', 'roption2')
    @slot('value', 'roption2')
    @slot('name', 'roptions')
    @slot('label', 'Option 2 checked')
    @slot('checked', 'checked')
  @endcomponent
  @component('components.atoms._radio')
    @slot('id', 'roption3')
    @slot('value', 'roption3')
    @slot('name', 'roptions')
    @slot('label', 'Option 3 disabled')
    @slot('disabled', 'disabled')
  @endcomponent
  @component('components.atoms._radio')
    @slot('id', 'roption4')
    @slot('value', 'roption4')
    @slot('name', 'roptions')
    @slot('label', 'Option 4 error')
    @slot('error', 'Error message')
  @endcomponent
</p>
<p>
  @component('components.atoms._checkbox')
    @slot('id', 'coption1')
    @slot('value', 'coption1')
    @slot('name', 'coption1')
    @slot('label', 'Option 1')
  @endcomponent
  @component('components.atoms._checkbox')
    @slot('id', 'coption2')
    @slot('value', 'coption2')
    @slot('name', 'coption2')
    @slot('label', 'Option 2 checked')
    @slot('checked', 'checked')
  @endcomponent
  @component('components.atoms._checkbox')
    @slot('id', 'coption3')
    @slot('value', 'coption3')
    @slot('name', 'coption3')
    @slot('label', 'Option 3 disabled')
    @slot('disabled', 'disabled')
  @endcomponent
  @component('components.atoms._checkbox')
    @slot('id', 'coption4')
    @slot('value', 'coption4')
    @slot('name', 'coption4')
    @slot('label', 'Option 4 error')
    @slot('error', 'Error message')
  @endcomponent
</p>
<p>
  @component('components.atoms._input')
    @slot('id', 'tinput1')
    @slot('name', 'tinput1')
    @slot('placeholder', 'Placeholder')
    Label
  @endcomponent
</p>
<p>
    @component('components.atoms._input')
      @slot('id', 'tinput2')
      @slot('name', 'tinput2')
      @slot('placeholder', 'Placeholder')
      @slot('textCount', true)
      Label
    @endcomponent
</p>
<p>
  @component('components.atoms._input')
    @slot('id', 'tinput3')
    @slot('name', 'tinput3')
    @slot('placeholder', 'Placeholder')
    @slot('value', 'Value')
    @slot('error', 'Error message')
    Label
  @endcomponent
</p>
<p>
    @component('components.atoms._input')
      @slot('id', 'tinput4')
      @slot('name', 'tinput4')
      @slot('placeholder', 'Disabled')
      @slot('disabled', true)
      Label
    @endcomponent
</p>
<p>
    @component('components.atoms._textarea')
      @slot('id', 'textarea1')
      @slot('name', 'textarea1')
      @slot('value', 'Mon jinn chewbacca darth darth kenobi. Moff fett hutt cade dantooine organa skywalker. Yavin darth calamari dagobah. Maul tusken raider hutt grievous.')
      Label
    @endcomponent
</p>
<p>
    @component('components.atoms._select')
      @slot('id', 'select1')
      @slot('name', 'select1')
      @slot('options', array(array('value' => '1', 'label' => 'Option 1'), array('value' => '2', 'label' => 'Option 2'), array('value' => '3', 'label' => 'Option 3')))
      @slot('error', 'Error message')
      Label
    @endcomponent
</p>
<p>
    @component('components.atoms._select')
      @slot('id', 'select2')
      @slot('name', 'select2')
      @slot('options', array(array('value' => '1', 'label' => 'Option 1'), array('value' => '2', 'label' => 'Option 2'), array('value' => '3', 'label' => 'Option 3')))
      @slot('error', 'Error message')
      Label
    @endcomponent
</p>
<p>
  @component('components.atoms._select')
    @slot('id', 'select1')
    @slot('name', 'select1')
    @slot('options', array(array('value' => '1', 'label' => 'Option 1'), array('value' => '2', 'label' => 'Option 2'), array('value' => '3', 'label' => 'Option 3')))
    @slot('disabled', true)
    Label
  @endcomponent
</p>
<p>
    @component('components.atoms._btn')
      Action
    @endcomponent
    @component('components.atoms._btn')
        @slot('variation', 'btn--secondary')
        Action
    @endcomponent
    @component('components.atoms._btn')
        @slot('variation', 'btn--tertiary')
        Action
    @endcomponent
    @component('components.atoms._btn')
        @slot('variation', 'btn--quaternary')
        Action
    @endcomponent
    @component('components.atoms._btn')
        @slot('variation', 'btn--secondary')
        @slot('icon', 'icon--new-window')
        Action
    @endcomponent
    @component('components.atoms._btn')
        @slot('disabled', true)
        Action
    @endcomponent
    @component('components.atoms._btn')
        @slot('loading', true)
        Action
    @endcomponent
</p>
<p>
    @component('components.atoms._tag')
        Kanan Jarrus
    @endcomponent
    @component('components.atoms._tag')
        Caleb Dume
    @endcomponent
</p>

<div style="margin-top: 0; padding-top: 20px;">
  <span aria-title="sort by" class="dropdown" data-behavior="dropdown">
    <button class="f-secondary">Dropdown<svg class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></button>
    <ul class="f-secondary">
      <li><a href="#">Option 1</a></li>
      <li><a href="#">Option 2</a></li>
      <li><a href="#">Option 3</a></li>
      <li><a href="#">Option 4</a></li>
      <li><a href="#">Option 5</a></li>
      <li><a href="#">Option 6</a></li>
      <li><a href="#">Option 7</a></li>
      <li><a href="#">Option 8</a></li>
      <li><a href="#">Option 9</a></li>
      <li><a href="#">Option 10</a></li>
    </ul>
  </span>
</div>
<div style="margin-top: 0; padding-top: 20px;">
  <span aria-title="sort by" class="dropdown" data-behavior="dropdown" data-dropdown-hoverable>
    <button class="f-secondary">Dropdown Hoverable<svg class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></button>
    <ul class="f-secondary">
      <li><a href="#">Newest</a></li>
      <li><a href="#">Oldest</a></li>
    </ul>
  </span>
</div>
<div style="margin-top: 0; padding-top: 20px;">
  <span aria-title="sort by" class="dropdown dropdown--filter" data-behavior="dropdown">
    <button class="f-secondary">Dropdown<svg class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></button>
    <ul class="f-secondary">
      <li class="s-active"><a href="#">Dropdown</a></li>
      <li><a href="#">Option 1</a></li>
      <li><a href="#">Option 2</a></li>
      <li><a href="#">Option 3</a></li>
      <li><a href="#">Option 4</a></li>
      <li><a href="#">Option 5</a></li>
      <li><a href="#">Option 6</a></li>
      <li><a href="#">Option 7</a></li>
      <li><a href="#">Option 8</a></li>
      <li><a href="#">Option 9</a></li>
      <li><a href="#">Option 10</a></li>
    </ul>
  </span>
</div>

<p>
  <a class="arrow-link" href="#">Forward<svg aria-hidden="true" class="icon--arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon--arrow"></use></svg></a> <br>
  <a class="arrow-link arrow-link--back" href="#">Back<svg aria-hidden="true" class="icon--arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon--arrow"></use></svg></a> <br>
  <a class="arrow-link arrow-link--up" href="#">Up<svg aria-hidden="true" class="icon--arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon--arrow"></use></svg></a> <br>
  <a class="arrow-link arrow-link--down" href="#">Down<svg aria-hidden="true" class="icon--arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon--arrow"></use></svg></a>
</p>

@include('shared._intro-block', array('intro' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget laoreet tortor.'))

@php
$introBlockActionsPrimary = array();
array_push($introBlockActionsPrimary, array('text' => 'Plan your visit', 'href' => '#'));
$introBlockActionsSecondary = array();
array_push($introBlockActionsSecondary, array('text' => 'Hours and admission', 'href' => '#'));
array_push($introBlockActionsSecondary, array('text' => 'Directions and parking', 'href' => '#'));
@endphp
@include('shared._intro-block', array('intro' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget laoreet tortor.', 'primaryActions' => $introBlockActionsPrimary, 'secondaryActions' => $introBlockActionsSecondary))

@php
$titleBarLinks = array();
array_push($titleBarLinks, array('text' => 'Explore What&rsquo;s on', 'href' => '#'));
@endphp
@include('shared._title-bar', array('title' => 'What&rsquo;s on Today', 'links' => $titleBarLinks))

@php
$navTabPrimaryLinksPrimary = array();
array_push($navTabPrimaryLinksPrimary, array('text' => 'Exhibitions', 'href' => '#', 'active' => true));
array_push($navTabPrimaryLinksPrimary, array('text' => 'Events', 'href' => '#', 'active' => false));
@endphp
@include('shared._links-bar', array('variation' => 'tabs', 'linksPrimary' => $navTabPrimaryLinksPrimary))

@php
$navTabPrimaryLinksPrimary = array();
array_push($navTabPrimaryLinksPrimary, array('text' => 'Exhibitions', 'href' => '#', 'active' => true));
array_push($navTabPrimaryLinksPrimary, array('text' => 'Events', 'href' => '#', 'active' => false));
$navTabPrimaryLinksSecondary = array();
array_push($navTabPrimaryLinksSecondary, array('text' => 'Exhibitions', 'href' => '#'));
@endphp
@include('shared._links-bar', array('variation' => 'tabs', 'linksPrimary' => $navTabPrimaryLinksPrimary, 'linksSecondary' => $navTabPrimaryLinksSecondary))

@php
$linksBarPrimary = array();
array_push($linksBarPrimary, array('text' => 'Exhibitions', 'href' => '#', 'active' => true));
array_push($linksBarPrimary, array('text' => 'Events', 'href' => '#', 'active' => false));
@endphp
@include('shared._links-bar', array('linksPrimary' => $linksBarPrimary))

@php
$linksBarPrimary = array();
array_push($linksBarPrimary, array('text' => 'Exhibitions', 'href' => '#', 'active' => true));
array_push($linksBarPrimary, array('text' => 'Events', 'href' => '#', 'active' => false));
$linksBarPrimarySecondary = array();
array_push($linksBarPrimarySecondary, array('text' => 'Archive', 'href' => '#'));
@endphp
@include('shared._links-bar', array('linksPrimary' => $linksBarPrimary, 'linksSecondary' => $linksBarPrimarySecondary))

@php
$linksBarPrimary = array();
array_push($linksBarPrimary, array('text' => 'Exhibitions', 'href' => '#', 'active' => true, 'icon' => 'icon--arrow'));
array_push($linksBarPrimary, array('text' => 'Events', 'href' => '#', 'active' => false, 'icon' => 'icon--arrow'));
$linksBarPrimarySecondary = array();
array_push($linksBarPrimarySecondary, array('text' => 'Archive', 'href' => '#', 'icon' => 'icon--arrow'));
@endphp
@include('shared._links-bar', array('linksPrimary' => $linksBarPrimary, 'linksSecondary' => $linksBarPrimarySecondary))

@php
$linksBarPrimary = array();
array_push($linksBarPrimary, array('text' => 'Btn 1', 'href' => '#', 'variation' => ''));
array_push($linksBarPrimary, array('text' => 'Btn 2', 'href' => '#', 'variation' => 'btn--secondary'));
array_push($linksBarPrimary, array('text' => 'Btn 3', 'href' => '#', 'variation' => 'btn--tertiary'));
array_push($linksBarPrimary, array('text' => 'Btn 4', 'href' => '#', 'variation' => 'btn--quaternary'));
array_push($linksBarPrimary, array('text' => 'Btn 5', 'href' => '#', 'variation' => 'btn--secondary btn--w-icon', 'icon' => 'icon--new-window'));
@endphp
@include('shared._links-bar', array('variation' => 'buttons', 'linksPrimary' => $linksBarPrimary))

@php
$linksBarPrimary = array();
array_push($linksBarPrimary, array('text' => 'Upcoming Exhibits', 'href' => '#', 'variation' => ''));
$linksBarPrimarySecondary = array();
array_push($linksBarPrimarySecondary, array('text' => 'Archive', 'href' => '#'));
@endphp
@include('shared._links-bar', array('variation' => 'buttons', 'linksPrimary' => $linksBarPrimary, 'linksSecondary' => $linksBarPrimarySecondary))


@include('shared._aside-newsletter')
@include('shared._aside-newsletter', array('error' => true))
@include('shared._aside-newsletter', array('success' => true))

<p class="f-body">Inline calendar</p>
<div class="m-calendar m-calendar--inline" style="margin-top: 20px;" data-behavior="calendar" data-calendar-url="/events">
  <b class="m-calendar__title f-caption" data-calendar-title></b>
  <table>
    <thead class="f-caption">
      <tr>
        <th title="Sunday">S</th>
        <th title="Monday">M</th>
        <th title="Tuesday">T</th>
        <th title="Wednesday">W</th>
        <th title="Thursday">T</th>
        <th title="Friday">F</th>
        <th title="Saturday">S</th>
      </tr>
    </thead>
    <tbody class="f-secondary">
    </tbody>
  </table>
  <button class="m-calendar__next" data-calendar-next><svg aria-title="Next month" class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></button>
  <button class="m-calendar__prev" data-calendar-prev><svg aria-title="Previous month" class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></button>
</div>

<p class="f-secondary">
  <span class="date-select-trigger" data-behavior="selectDate">
    <button class="date-select-trigger__open" data-selectDate-open>
      <svg class="icon--calendar"><use xlink:href="#icon--calendar" /></svg>
      <span class="date-select-trigger__label f-buttons">Choose date</span>
      <span class="date-select-trigger__selected-date f-buttons" data-selectDate-display></span>
    </button>
    <button class="date-select-trigger__clear" data-selectDate-clear><svg class="icon--close-circle"><use xlink:href="#icon--close-circle" /></svg></button>
    <input type="hidden">
  </span>
</p>

<p class="f-secondary">
  <span class="date-select-trigger" data-behavior="selectDate" data-selectDate-range="true" data-selectDate-id="cal01" data-selectDate-role="start" data-selectDate-linkedId="cal02">
    <button class="date-select-trigger__open" data-selectDate-open>
      <svg class="icon--calendar"><use xlink:href="#icon--calendar" /></svg>
      <span class="date-select-trigger__label f-buttons">Start date</span>
      <span class="date-select-trigger__selected-date f-buttons" data-selectDate-display></span>
    </button>
    <button class="date-select-trigger__clear" data-selectDate-clear><svg class="icon--close-circle"><use xlink:href="#icon--close-circle" /></svg></button>
    <input type="hidden">
  </span>
  <span class="date-select-trigger" data-behavior="selectDate" data-selectDate-range="true" data-selectDate-id="cal02" data-selectDate-role="end" data-selectDate-linkedId="cal01">
    <button class="date-select-trigger__open" data-selectDate-open>
      <svg class="icon--calendar"><use xlink:href="#icon--calendar" /></svg>
      <span class="date-select-trigger__label f-buttons">End date</span>
      <span class="date-select-trigger__selected-date f-buttons" data-selectDate-display></span>
    </button>
    <button class="date-select-trigger__clear" data-selectDate-clear><svg class="icon--close-circle"><use xlink:href="#icon--close-circle" /></svg></button>
    <input type="hidden">
  </span>
</p>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing, no cols</p>
<ul class="o-grid-listing">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing, no cols, o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--gridlines-top">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing, no cols, o-grid-listing--gridlines-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-rows">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing, no cols, o-grid-listing--gridlines-split-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-split-rows">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing, 2 cols at small, 3 cols at medium, 4 cols large+ (most examples follow this)</p>
<ul class="o-grid-listing o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--keyline-top</p>
<ul class="o-grid-listing o-grid-listing--keyline-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-right</p>
<ul class="o-grid-listing o-grid-listing--gridlines-right o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-cols</p>
<ul class="o-grid-listing o-grid-listing--gridlines-cols o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--keyline-top o-grid-listing--gridlines-cols</p>
<ul class="o-grid-listing o-grid-listing--keyline-top o-grid-listing--gridlines-cols o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--gridlines-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--keyline-top o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--keyline-top o-grid-listing--gridlines-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-right o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--gridlines-right o-grid-listing--gridlines-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--keyline-top o-grid-listing--gridlines-right o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--keyline-top o-grid-listing--gridlines-right o-grid-listing--gridlines-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-right o-grid-listing--gridlines-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-right o-grid-listing--gridlines-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-cols o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--gridlines-cols o-grid-listing--gridlines-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--keyline-top o-grid-listing--gridlines-cols o-grid-listing--gridlines-top</p>
<ul class="o-grid-listing o-grid-listing--keyline-top o-grid-listing--gridlines-cols o-grid-listing--gridlines-top o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-cols o-grid-listing--gridlines-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-cols o-grid-listing--gridlines-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-split-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-split-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-right o-grid-listing--gridlines-split-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-right o-grid-listing--gridlines-split-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">o-grid-listing--gridlines-cols o-grid-listing--gridlines-split-rows</p>
<ul class="o-grid-listing o-grid-listing--gridlines-cols o-grid-listing--gridlines-split-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  @include('shared._listitems')
</ul>

<hr class="hr--big-break">
<p class="f-secondary">4 col at large+</p>
<ul class="o-grid-listing o-grid-listing--gridlines-cols o-grid-listing--gridlines-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--4-col@xlarge o-grid-listing--4-col@xxlarge">
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/400x225">
      </span>
      <span class="m-listing__meta">
        <em class="m-listing__type f-tag">Special Exhibition</em> <br>
        <strong class="m-listing__title f-list-3">Cauleen Smith: Human_3.0 Reading Listz</strong> <br>
        <span class="m-listing__bottom m-listing__date f-secondary">Oct 29, 2017</span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/400x225">
      </span>
      <span class="m-listing__meta">
        <em class="m-listing__type f-tag">Ongoing</em> <br>
        <strong class="m-listing__title f-list-3">Along the Lines: Selected drawings by Saul Steinberg</strong> <br>
        <span class="m-listing__bottom m-listing__date f-secondary">Oct 29, 2017</span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/400x225">
      </span>
      <span class="m-listing__meta">
        <em class="m-listing__type f-tag">Ongoing</em> <br>
        <strong class="m-listing__title f-list-3">Charles White Murals</strong> <br>
        <span class="m-listing__bottom m-listing__date f-secondary">Through Nov 29, 2017</span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/400x225">
      </span>
      <span class="m-listing__meta">
        <em class="m-listing__type f-tag">Ongoing</em> <br>
        <strong class="m-listing__title f-list-3">Moholy-Nagy&mdash;Future Present</strong> <br>
        <span class="m-listing__bottom m-listing__date f-secondary">Through Nov 29, 2017</span>
      </span>
    </a>
  </li>
</ul>

<hr class="hr--big-break">
<p class="f-secondary">5 col at xlarge+</p>

<ul class="o-grid-listing o-grid-listing--gridlines-cols o-grid-listing--gridlines-rows o-grid-listing--2-col@small o-grid-listing--3-col@medium o-grid-listing--4-col@large o-grid-listing--5-col@xlarge o-grid-listing--5-col@xxlarge">
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/300x300">
      </span>
      <span class="m-listing__meta">
        <strong class="m-listing__title f-list-2">Resin Elephant</strong> <br>
        <span class="m-listing__bottom m-listing__price f-secondary">$19.99</span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/300x300">
      </span>
      <span class="m-listing__meta">
        <strong class="m-listing__title f-list-2">Autumn Glass Leaves</strong> <br>
        <span class="m-listing__bottom m-listing__price f-secondary">$68</span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/300x300">
      </span>
      <span class="m-listing__meta">
        <strong class="m-listing__title f-list-2">Modern Cuff Bracelet</strong> <br>
        <span class="m-listing__bottom m-listing__price f-secondary"><strike>$80</strike> <span class="m-listing__sale-price">$59.99</span></span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/300x300">
      </span>
      <span class="m-listing__meta">
        <strong class="m-listing__title f-list-2">Tapestry Duffle</strong> <br>
        <span class="m-listing__bottom m-listing__price f-secondary">$150</span>
      </span>
    </a>
  </li>
  <li class="m-listing">
    <a href="#" class="m-listing__link">
      <span class="m-listing__img">
        <img src="http://placehold.dev.area17.com/image/300x300">
      </span>
      <span class="m-listing__meta">
        <strong class="m-listing__title f-list-2">Glass Pumpkin</strong> <br>
        <span class="m-listing__bottom m-listing__price f-secondary">$79</span>
      </span>
    </a>
  </li>
</ul>

@endsection
