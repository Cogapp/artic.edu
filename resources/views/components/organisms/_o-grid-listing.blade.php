<{{ $tag or 'ul' }} class="o-grid-listing{{ (isset($variation)) ? ' '.$variation : '' }}{{ (isset($cols_xsmall) and $cols_xsmall !== '') ? ' o-grid-listing--'.$cols_xsmall.'-col@xsmall' : '' }}{{ (isset($cols_small) and $cols_small !== '') ? ' o-grid-listing--'.$cols_small.'-col@small' : '' }}{{ (isset($cols_medium) and $cols_medium !== '') ? ' o-grid-listing--'.$cols_medium.'-col@medium' : '' }}{{ (isset($cols_large) and $cols_large !== '') ? ' o-grid-listing--'.$cols_large.'-col@large' : '' }}{{ (isset($cols_xlarge) and $cols_xlarge !== '') ? ' o-grid-listing--'.$cols_xlarge.'-col@xlarge' : '' }}"{!! (isset($behavior)) ? ' data-behavior="'.$behavior.'"' : '' !!}{!! (isset($ariaLabel)) ? ' aria-labelledby="'.$ariaLabel.'"' : '' !!}>
    {{ $slot }}
</{{ $tag or 'ul' }}>
