<div class="item">
    <div class="mb-4">
        <div class="input-group">
            <div class="main_search_wrap border-0 p-0 form-control">
                <span class="main_search_label location scroll_body">{{ $title ?? "" }} </span>
                <input type="text"  name="autocomplete" id="ac3"
                       class="autocomplete google_map_city form-control scroll_body main_search_input
                       smart-search-location parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("Cities in the United States")}}" value="" style="padding: 18px 30px 0 !important;">
                <input type="hidden" class="child_id" name="location_id" value="{{Request::query('location_id')}}">
                <span class="main_search_close" style="display: none"></span>
            </div>
        </div>
    </div>

</div>
