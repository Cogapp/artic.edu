<span class="date-select-trigger {{ $font ?? 'f-buttons' }}{{ (isset($variation)) ? ' '.$variation : '' }}" data-behavior="selectDate">
  <button class="date-select-trigger__open" data-selectDate-open>
    <svg class="icon--calendar"><use xlink:href="#icon--calendar" /></svg>
    <span class="date-select-trigger__label">{{ $slot }}</span>
    <span class="date-select-trigger__selected-date" data-selectDate-display></span>
  </button>
</span>
