@extends('layouts.app',['container_class'=>'container-fluid'])
@section('head')
    <link href="{{ asset('dist/frontend/module/space/css/space.css?_ver='.config('app.version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <style type="text/css">
        .bravo_footer {
            display: none
        }
    </style>
@endsection
@section('content')
    <div class="bravo_search_tour bravo_search_space">
        <h1 class="d-none">
            {{setting_item_with_lang("property_sale_page_search_title")}}
        </h1>
        <div class="bravo_form_search_map">
            @include('Sale::frontend.layouts.search-map.form-search-map')
        </div>
        <div class="bravo_search_map {{ setting_item_with_lang("property_sale_layout_map_option",false,"map_left") }}">
            <div class="results_map">
                <div class="map-loading d-none">
                    <div class="st-loader"></div>
                </div>
                <div id="bravo_results_map" class="results_map_inner"></div>
            </div>
            <div class="results_item">
                @include('Sale::frontend.layouts.search-map.advance-filter')
                <div class="listing_items">
                    @include('Sale::frontend.layouts.search-map.list-item')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        var bravo_map_data = {
            markers:{!! json_encode($markers) !!}
        };
    </script>
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('module/space/js/space-map.js?_ver='.config('app.version')) }}"></script>
@endsection
