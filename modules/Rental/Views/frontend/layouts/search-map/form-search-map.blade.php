<form action="{{url( app_get_locale(false,false,'/').config('space.rental_route_prefix') )}}" class="form bravo_form d-flex justify-content-start" method="get" onsubmit="return false;">
    @php $space_map_search_fields = setting_item_array('property_rental_map_search_fields');

    $space_map_search_fields = array_values(\Illuminate\Support\Arr::sort($space_map_search_fields, function ($value) {
        return $value['position'] ?? 0;
    }));

    @endphp
    @if(!empty($space_map_search_fields))
        @foreach($space_map_search_fields as $field)
            @switch($field['field'])
                @case ('location')
                    @include('Rental::frontend.layouts.search-map.fields.location')
                @break
                @case ('attr')
                    @include('Rental::frontend.layouts.search-map.fields.attr')
                @break
                @case ('date')
                    @include('Rental::frontend.layouts.search-map.fields.date')
                @break
                @case ('price')
                    @include('Rental::frontend.layouts.search-map.fields.price')
                @break
                @case ('advance')
                    <div class="filter-item filter-simple advance-filters">
                        <div class="form-group">
                            <span class="filter-title toggle-advance-filter" data-target="#advance_filters">{{__('More filters')}} <i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                @break

            @endswitch
        @endforeach
    @endif



</form>
