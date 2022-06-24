@php
    $actives = \App\Currency::getActiveCurrency();
    $current = \App\Currency::getCurrent('currency_main');
@endphp
@if(!empty($actives) and count($actives) > 1)
    <div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider currency-select">
        <div class="d-flex align-items-center text-white dropdown">
            <span class="d-inline-block font-size-16 mr-1 dropdown-nav-link px-3 py-3" data-toggle="dropdown" style="cursor: pointer; font-weight: 600 !important;">
                @foreach($actives as $currency)
                    @if($current == $currency['currency_main'])
                        <?php
                            $currency_symbol = '$';
                            if ( $currency['currency_main'] == 'eur' ) {
                                $currency_symbol = '€';
                            }
                        ?>
                        {{$currency_symbol}} {{strtoupper($currency['currency_main'])}}
                    @endif
                @endforeach
            </span>
            <ul class="dropdown-menu text-left width-auto min-width-100">
                @foreach($actives as $currency)
                    @if($current != $currency['currency_main'])
                        <?php
                            $currency_symbol = '$';
                            if ( $currency['currency_main'] == 'eur' ) {
                                $currency_symbol = '€';
                            }
                        ?>
                        <li>
                            <a href="{{get_currency_switcher_url($currency['currency_main'])}}">
                                {{$currency_symbol}} {{strtoupper($currency['currency_main'])}} &nbsp;<i class="topbar_check_icon fa fa-check"></i>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif