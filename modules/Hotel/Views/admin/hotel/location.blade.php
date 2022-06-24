<div class="panel">
    <div class="panel-title"><strong>{{__("Property Location ")}}</strong></div>
    <div class="panel-body">
        {{--
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Location of Your Property ")}}</label>
                @if(!empty($is_smart_search))
                    <div class="form-group-smart-search">
                        <div class="form-content">
                            <?php
                            $location_name = "";
                            $list_json = [];
                            $traverse = function ($locations, $prefix = '') use (&$traverse, &$list_json , &$location_name,$row) {
                                foreach ($locations as $location) {
                                    $translate = $location->translateOrOrigin(app()->getLocale());
                                    if ($row->location_id == $location->id){
                                        $location_name = $translate->name;
                                    }
                                    $list_json[] = [
                                        'id' => $location->id,
                                        'title' => $prefix . ' ' . $translate->name,
                                    ];
                                    $traverse($location->children, $prefix . '-');
                                }
                            };
                            $traverse($space_location);
                            ?>
                            <div class="smart-search">
                                <input type="text" class="smart-search-location parent_text form-control" placeholder="{{__("-- Please Select --")}}" value="{{ $location_name }}" data-onLoad="{{__("Loading...")}}"
                                       data-default="{{ json_encode($list_json) }}">
                                <input type="hidden" class="child_id" name="location_id" value="{{$row->location_id ?? Request::query('location_id')}}">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="">
                        <select name="location_id" class="form-control">
                            <option value="">{{__("-- Please Select --")}}</option>
                            <?php
                            $traverse = function ($locations, $prefix = '') use (&$traverse, $row) {
                                foreach ($locations as $location) {
                                    $selected = '';
                                    if ($row->location_id == $location->id)
                                        $selected = 'selected';
                                    printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                                    $traverse($location->children, $prefix . '-');
                                }
                            };
                            $traverse($space_location);
                            ?>
                        </select>
                    </div>
                @endif
            </div>
        @endif
        --}}
        
        <div class="form-group" style="display: none;">
            <label class="control-label">{{__("Autocomplete")}}</label>
            <input type="text" name="autocomplete" id="customPlaceLoacation" class="form-control" placeholder="" value="{{$row->autocomplete}}">
        </div>
        <div class="form-group" style="display: none;">
            <label class="control-label">{{__("Autocomplete2")}}</label>
            <input type="text" name="autocomplete_n" class="form-control" placeholder="" value="{{$row->autocomplete}}">
        </div>
        
        <div class="form-group">
            <label class="control-label">{{__("Country")}}</label>
            <input type="text" name="country" class="form-control" placeholder="" value="{{$row->country}}" disabled="">
        </div>
        @if($row->id) 
            <a class="btn btn-primary btn-sm mb-3 js__edit_location" href="#">{{__("Edit Location")}}</a>
        @endif
        <div class="form-group form-group--autocomplete">
            <label class="control-label">{{__("Postal Code")}}</label>
            <input type="text" name="postal_code" class="form-control @if($errors->has('postal_code') || $errors->has('postal_code_autocomplete')) is-invalid @endif" 
                   placeholder="" value="{{$row->postal_code}}" autocomplete="off" @if($row->id) readonly="" @endif>
            <input type="hidden" name="postal_code_autocomplete" value="{{$row->postal_code}}">
        </div>
        <div class="form-group form-group--autocomplete">
            <label class="control-label">{{__("City")}}</label>
            <input type="text" name="city" class="form-control @if($errors->has('city') || $errors->has('city_autocomplete')) is-invalid @endif" placeholder="" value="{{$row->city}}" autocomplete="off" @if($row->id) readonly="" @endif>
            <input type="hidden" name="city_autocomplete" value="{{$row->city}}">
        </div>
        <div class="form-group form-group--autocomplete">
            <label class="control-label">{{__("State")}}</label>
            <input type="text" name="state" class="form-control @if($errors->has('state') || $errors->has('state_autocomplete')) is-invalid @endif" placeholder="" value="{{$row->state}}" autocomplete="off" @if($row->id) readonly="" @endif>
            <input type="hidden" name="state_autocomplete" value="{{$row->state}}">
        </div>
        <div class="form-group form-group--autocomplete">
            <label class="control-label">{{__("District")}}</label>
            <input type="text" name="district" class="form-control @if($errors->has('district') || $errors->has('district_autocomplete')) is-invalid @endif" placeholder="" value="{{$row->district}}" autocomplete="off" @if($row->id) readonly="" @endif>
            <input type="hidden" name="district_autocomplete" value="{{$row->district}}">
        </div>
        <div class="form-group form-group--autocomplete">
            <label class="control-label">{{__("Street")}}</label>
            <input type="text" name="street" class="form-control @if($errors->has('street') || $errors->has('street_autocomplete')) is-invalid @endif" placeholder="" value="{{$row->street}}" autocomplete="off" @if($row->id) readonly="" @endif>
            <input type="hidden" name="street_autocomplete" value="{{$row->street}}">
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-group--autocomplete">
                    <label>{{__("Building Number")}}:</label>
                    <input type="text" name="building_number" placeholder="" class="form-control @if($errors->has('building_number') || $errors->has('building_number_autocomplete')) is-invalid @endif" value="{{$row->building_number}}" autocomplete="off" @if($row->id) readonly="" @endif>
                    <input type="hidden" name="building_number_autocomplete" value="{{$row->building_number}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{__("Building Body Number")}}:</label>
                    <input type="text" name="building_body_number" class="form-control" value="{{$row->building_body_number}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{__("Apartment Number")}}:</label>
                    <input type="text" name="apartment_number" class="form-control" value="{{$row->apartment_number}}">
                </div>
            </div>
        </div>
        {{--
        <div class="form-group">
            <label class="control-label">{{__("Real Address of Your Property")}}</label>
            <input type="text" name="address" id="customPlaceAddress" class="form-control" placeholder="{{__("Real address")}}" value="{{$translation->address}}">
        </div>--}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__("Map Latitude")}}:</label>
                        <input type="text" name="map_lat" class="form-control @if($errors->has('map_lat') || $errors->has('map_lat_autocomplete')) is-invalid @endif" value="{{$row->map_lat}}" onkeydown="return event.key !== 'Enter';" autocomplete="off" @if($row->id) readonly="" @endif>
                        <input type="hidden" name="map_lat_autocomplete" value="{{$row->map_lat}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__("Map Longitude")}}:</label>
                        <input type="text" name="map_lng" class="form-control @if($errors->has('map_lng') || $errors->has('map_lng_autocomplete')) is-invalid @endif" value="{{$row->map_lng}}" onkeydown="return event.key !== 'Enter';" autocomplete="off" @if($row->id) readonly="" @endif>
                        <input type="hidden" name="map_lng_autocomplete" value="{{$row->map_lng}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__("Map Zoom")}}:</label>
                        <input type="text" name="map_zoom" class="form-control" value="{{$row->map_zoom ?? "8"}}" onkeydown="return event.key !== 'Enter';">
                    </div>
                </div>



            </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("The geographic coordinate")}}</label>
                <div class="control-map-group">
                    <div id="map_content" style="margin: 0"></div>
                    <input type="text" placeholder="{{__("Search by name...")}}" class="bravo_searchbox form-control" autocomplete="off" onkeydown="return event.key !== 'Enter';">
                    {{--<div class="g-control">
                        <div class="form-group">
                            <label>{{__("Map Latitude")}}:</label>
                            <input type="text" name="map_lat" class="form-control" value="{{$row->map_lat}}" onkeydown="return event.key !== 'Enter';">
                        </div>
                        <div class="form-group">
                            <label>{{__("Map Longitude")}}:</label>
                            <input type="text" name="map_lng" class="form-control" value="{{$row->map_lng}}" onkeydown="return event.key !== 'Enter';">
                        </div>
                        <div class="form-group">
                            <label>{{__("Map Zoom")}}:</label>
                            <input type="text" name="map_zoom" class="form-control" value="{{$row->map_zoom ?? "8"}}" onkeydown="return event.key !== 'Enter';">
                        </div>
                    </div>--}}
                </div>
            </div>
        @endif
    </div>
</div>
