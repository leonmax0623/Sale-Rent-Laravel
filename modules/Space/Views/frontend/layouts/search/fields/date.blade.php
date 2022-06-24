@php
    $first = "";
    $second = "";
    if($title) {
        $title = trim($title);
        list($first,$second) = explode('$',$title);
    }
@endphp
<div class="item">
    <div class="mb-4 form-content">
        <div class="row u-datepicker form-date-search">
            <input type="text" class="check-in-out" name="date" value="">
            <div class="col-md-6 mb-4">
                <div class="main_search_wrap input-group flex-nowrap">
                    <span class="main_search_label">{{ $first }}</span>
                    <input type="hidden" class="check-in-input" value="" name="start">
                    <input type="text" class="scroll_body main_search_input check-in scroll_body" readonly
                           placeholder="{{ __('Select Dates') }}" value="">
                </div>
            </div>
            <div class="col-md-6 mt-md-0 mt-2">
                <div class="main_search_wrap  input-group flex-nowrap">
                    <span class="main_search_label">{{ $second }}</span>
                    <input type="hidden" class="check-out-input" value="" name="end">
                    <input type="text" class="scroll_body main_search_input check-out scroll_body" readonly
                           placeholder="{{ __('Select Dates') }}" value="">
                </div>
            </div>
        </div>
    </div>
</div>