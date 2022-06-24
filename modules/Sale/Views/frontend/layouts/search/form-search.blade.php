<form action="{{ route("sale.search") }}" name="sale_search_form" class="form bravo_form d-flex mb-1 py-2" method="get">
    <div class="g-field-search">
        <div class="row d-block nav-select d-flex align-items-end">
            @php $space_search_fields = setting_item_array('property_sale_search_fields');
            $space_search_fields = array_values(\Illuminate\Support\Arr::sort($space_search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
            @endphp
            @if(!empty($space_search_fields))
                @foreach($space_search_fields as $field)
                    @php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" @endphp
                    @switch($field['field'])
                        @case ('service_name')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.service_name', ['title' => $field['title']])
                            </div>
                        @break
                        @case ('location')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.location', ['title' => $field['title']])
                            </div>
                        @break
                        @case ('date')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.date', ['title' => $field['title']])
                            </div>
                        @break
                        @case ('guests')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.guests', ['title' => $field['title']])
                            </div>
                        @break
                        @case ('property_type')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.property_type', ['title' => $field['title']])
                            </div>
                        @break
                        @case ('sale_price')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.sale_price', ['title' => $field['title']])
                            </div>
                        @break
                        @case ('attr')
                            <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-lg-0 text-left">
                            @include('Sale::frontend.layouts.search.fields.attr', ['title' => $field['title']])
                            </div>
                        @break
                    @endswitch
                @endforeach
            @endif
        </div>
    </div>
    <div class="g-button-submit align-self-lg-end">
        <button id="sale_search_button" type="button" class="btn btn-primary btn-md border-radius-3 mb-xl-0 mb-lg-1 transition-3d-hover">
            <i class="flaticon-magnifying-glass font-size-20 mr-2"></i>{{ __("Search") }}
        </button>
    </div>
</form>
