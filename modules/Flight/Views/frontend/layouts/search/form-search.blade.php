<form action="{{ route("flight.search") }}" class="form bravo_form d-flex mb-1 py-2" method="get">

    <div class="g-field-search">

        <div class="row ">

            @php $flight_search_fields = setting_item_array('flight_search_fields');

    $flight_search_fields = array_values(\Illuminate\Support\Arr::sort($flight_search_fields, function ($value) {

        return $value['position'] ?? 0;

    }));

            @endphp

            @if(!empty($flight_search_fields))

                @foreach($flight_search_fields as $field)

                    @php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" @endphp

                    <div class="col-md-{{ $field['size'] ?? "6" }} mb-4 mb-xl-0 ">

                        @switch($field['field'])

                            @case ('service_name')

                            @include('Flight::frontend.layouts.search.fields.service_name', ['title' => $field['title']])

                            @break

                            @case ('location')

                            @include('Flight::frontend.layouts.search.fields.location', ['title' => $field['title']])

                            @break

                            @case ('date')

                            @include('Flight::frontend.layouts.search.fields.date', ['title' => $field['title']])

                            @break

                            @case ('guests')

                            @include('Flight::frontend.layouts.search.fields.guests', ['title' => $field['title']])

                            @break

                            @case ('seat_type')

                            @include('Flight::frontend.layouts.search.fields.seat_type', ['title' => $field['title']])

                            @break

                            @case ('from_where')

                            @include('Flight::frontend.layouts.search.fields.from-where', ['title' => $field['title']])

                            @break

                            @case ('to_where')

                            @include('Flight::frontend.layouts.search.fields.to-where', ['title' => $field['title']])

                            @break

                        @endswitch

                    </div>

                @endforeach

            @endif

        </div>

    </div>



    <div class="g-button-submit align-self-lg-end">

        <button class="btn btn-primary btn-md border-radius-3 mb-xl-0 mb-lg-1 transition-3d-hover" type="submit">
            <i class="flaticon-magnifying-glass font-size-20 mr-2"></i> {{__("Search")}}</button>
    </div>

</form>

