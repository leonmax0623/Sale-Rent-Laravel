@php
    $request_query_autocomplete = '';
    $request_query_autocomplete_items = [];
    if(Request::query('postal_code')) {
        $request_query_autocomplete_items[] = Request::query('postal_code');
    }
    if(Request::query('state')) {
        $request_query_autocomplete_items[] = Request::query('state');
    }
    if(Request::query('city')) {
        $request_query_autocomplete_items[] = Request::query('city');
    }
    if(Request::query('district')) {
        $request_query_autocomplete_items[] = Request::query('district');
    }
    if(Request::query('street')) {
        $request_query_autocomplete_items[] = Request::query('street');
    }
    
    if($request_query_autocomplete_items) {
        $request_query_autocomplete = implode(', ', $request_query_autocomplete_items);
    }
    
    $request_query_autocomplete_old = $request_query_autocomplete;
    if(!$request_query_autocomplete_old) {
        $request_query_autocomplete_old = Request::query('location');
    }
@endphp

<div class="item">
    <div class="mb-4">
        <div class="input-group">
            <div class="main_search_wrap border-0 p-0 form-control">
                <span class="main_search_label location scroll_body">{{ $title ?? "" }} </span>
                <input type="text"  name="location" id="ac1"
                       class="autocomplete google_map_city  form-control scroll_body main_search_input smart-search-location
                       parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("Cities in the United States")}}" value="{{$request_query_autocomplete_old}}" data-latest-search="{{$request_query_autocomplete}}" style="padding: 18px 30px 0 !important;">
                
                <input type="hidden" name="postal_code" value="{{Request::query('postal_code')}}">
                <input type="hidden" name="state" value="{{Request::query('state')}}">
                <input type="hidden" name="city" value="{{Request::query('city')}}">
                <input type="hidden" name="district" value="{{Request::query('district')}}">
                <input type="hidden" name="street" value="{{Request::query('street')}}">
                <input type="hidden" name="autocomplete_formatted" value="{{Request::query('autocomplete_formatted')}}" disabled="">
                <span class="main_search_close" style="display: none"></span>
            </div>
        </div>
    </div>
</div>
