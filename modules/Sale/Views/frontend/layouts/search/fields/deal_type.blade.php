@php
if( request()->input('lang') && !is_default_lang(request()->input('lang')) ) {
    $locale_prefix = request()->input('lang');
} else {
    $locale_prefix = app_get_locale(false, false);
}
@endphp
<div class="item">
    <div class="mb-4 ">
        <div class="input-group">
            <div class="property_type main_search_wrap drop-down-input border-0 p-0 form-control">
                <div class="drop-down-input-inner">
                <span class="main_search_label location scroll_body">{{ $title ?? ''}}</span>
                <input type="text"
                       class="scroll_body main_search_input drop-down-input__field parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("Property Sale")}}" style="padding: 18px 30px 0 !important;" readonly/>
                <input type="hidden" name="deal_type" value="{{ url($locale_prefix . '/property-sale') }}" class="drop-down-input__hidden_field"/>
                </div>
                <ul class="drop-down-input__list deal_type_body">
                    <li class="drop-down-input__item" data-value-id="{{ url($locale_prefix . '/property-sale') }}" data-value="{{__("Property Sale")}}">{{__("Property Sale")}}<i class="drop-down-input__item-check fa fa-check"></i></li>
                    <li class="drop-down-input__item" data-value-id="{{ url($locale_prefix . '/property-rental') }}" data-value="{{__("Property Rental")}}">{{__("Property Rental")}}<i class="drop-down-input__item-check fa fa-check"></i></li>
                    <li class="drop-down-input__item" data-value-id="{{ url($locale_prefix . '/property-hotels') }}" data-value="{{__("Property Hotels")}}">{{__("Property Hotels")}}<i class="drop-down-input__item-check fa fa-check"></i></li>
                    <li class="drop-down-input__item" data-value-id="{{ url($locale_prefix . '/property-vacation') }}" data-value="{{__("Property Vacation")}}">{{__("Property Vacation")}}<i class="drop-down-input__item-check fa fa-check"></i></li>
                </ul>
            </div>
        </div>
    </div>
</div>

