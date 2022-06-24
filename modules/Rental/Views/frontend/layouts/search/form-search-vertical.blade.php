<div class="sidebar border border-color-1 rounded-xs">
    <div class="p-4 mb-1">
        <form action="{{ route("rental.search") }}" name="rental_search_form" class="bravo_form" method="get">
            @php $search_fields = setting_item_array('property_rental_search_fields');
            $search_fields = array_values(\Illuminate\Support\Arr::sort($search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
            @endphp
            @if(!empty($search_fields))
                @foreach($search_fields as $field)
                    @php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" @endphp
                    @switch($field['field'])
                        @case ('deal_type')
                            @include('Rental::frontend.layouts.search.fields.deal_type', ['title' => $field['title']])
                        @break
                        @case ('service_name')
                            @include('Rental::frontend.layouts.search.fields.service_name', ['title' => $field['title']])
                        @break
                        @case ('location')
                            @include('Rental::frontend.layouts.search.fields.location',  ['title' => $field['title']])
                        @break
                        @case ('date')
                            @include('Rental::frontend.layouts.search.fields.date',  ['title' => $field['title']])
                        @break
                        @case ('attr')
                            @include('Rental::frontend.layouts.search.fields.attr',  ['title' => $field['title']])
                        @break
                        @case ('property_type')
                            @include('Rental::frontend.layouts.search.fields.property_type', ['title' => $field['title']])
                        @break
                        @case ('rental_price')
                            @include('Rental::frontend.layouts.search.fields.rental_price', ['title' => $field['title']])
                        @break
                        @case ('guests')
                          @include('Rental::frontend.layouts.search.fields.guests',  ['title' => $field['title']])
                        @break
                    @endswitch
                @endforeach
            @endif
            <div class="text-center">
                <button id="rental_search_button" type="submit" class="btn btn-primary height-60 w-100 font-weight-bold mb-xl-0 mb-lg-1 transition-3d-hover"><i class="flaticon-magnifying-glass mr-2 font-size-17"></i>Search</button>
            </div>
        </form>
    </div>
</div>
