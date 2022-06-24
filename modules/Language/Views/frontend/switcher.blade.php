@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
    <div class="position-relative u-header__login-form dropdown-connector-xl u-header__topbar-divider currency-select">
        <div class="d-flex align-items-center text-white dropdown">
            <span class="d-inline-block font-size-16 mr-1 dropdown-nav-link px-3 py-3" data-toggle="dropdown" style="cursor: pointer; font-weight: 600 !important;">
                @foreach($languages as $language)
                    @if($locale == $language->locale)
                        @if($language->flag)<span class="flag-icon flag-icon-{{$language->flag}}" style="margin-right:3px;"></span>
                        @endif
                            {{$language->name}}
                    @endif
                @endforeach
            </span>
            <ul class="dropdown-menu dropdown-menu-user text-left width-auto">
                @foreach($languages as $language)
                    @if($locale != $language->locale)
                        <li>
                            <a href="{{get_lang_url($language->locale)}}">
                                @if($language->flag)
                                    <span class="flag-icon flag-icon-{{$language->flag}} mr-2"></span>
                                @endif
                                {{$language->name}} &nbsp;<i class="topbar_check_icon fa fa-check"></i>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif