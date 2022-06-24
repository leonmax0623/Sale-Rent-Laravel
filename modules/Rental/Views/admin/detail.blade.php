@extends('admin.layouts.app')

@section('content')
    <form action="{{route('rental.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->title : __('Add new Property')}}</h1>
                    @if($row->uid)
                        {{--<p class="item-url-demo">{{__("Permalink")}}: {{ url('property-rental' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a></p>--}}
                        <p class="item-url-demo">{{__("Permalink")}}: {{$row->getDetailUrl(request()->query('lang'))}}</p>
                    @endif
                </div>
                <div class="">
                    @if($row->uid)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{__("View Rental")}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        @include('Rental::admin.space.content')
                        @include('Rental::admin.space.pricing')
                        @if(is_default_lang())
                        @endif
                        @include('Rental::admin.space.location')
                        @include('Hotel::admin.hotel.surrounding')
                        @include('Core::admin/seo-meta/seo-meta')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('ID Property')}}</strong></div>
                            <div class="panel-body">
                                @if($row->uid)
                                    <div class="text-center">
                                        <h4 class="text-uppercase"><strong>{{$row->uid}}</strong></h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                    <div>
                                        <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                        </label></div>
                                    <div>
                                        <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                        </label></div>
                                @endif
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </div>
                        @if(is_default_lang())
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("Author Setting")}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php
                                    $user = !empty($row->create_user) ? App\User::find($row->create_user) : false;
                                    \App\Helpers\AdminForm::select2('create_user', [
                                        'configs' => [
                                            'ajax'        => [
                                                'url' => url('/admin/module/user/getForSelect2'),
                                                'dataType' => 'json'
                                            ],
                                            'allowClear'  => true,
                                            'placeholder' => __('-- Select User --')
                                        ]
                                    ], !empty($user->id) ? [
                                        $user->id,
                                        $user->getDisplayName() . ' (#' . $user->id . ')'
                                    ] : false)
                                    ?>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Availability")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>{{__('Property Rental Featured')}}</label>
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("Enable featured")}}
                                        </label>
                                    </div>
                                    <div class="form-group d-none">
                                        <label>{{__('Is Instant Booking?')}}</label>
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_instant" @if($row->is_instant) checked @endif value="1"> {{__("Enable instant booking")}}
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label >{{__('Default State')}}</label>
                                        <br>
                                        <select name="default_state" class="custom-select">
                                            <option value="">{{__('-- Please select --')}}</option>
                                            <option value="1" @if(old('default_state',$row->default_state ?? 0) == 1) selected @endif>{{__("Always available")}}</option>
                                            <option value="0" @if(old('default_state',$row->default_state ?? 0) == 0) selected @endif>{{__("Only available on specific dates")}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @include('Rental::admin.space.attributes')
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Feature Image')}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                                    </div>
                                </div>
                            </div>
                            @include('Rental::admin/space/ical')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section ('script.body')
    {!! App\Helpers\MapEngine::scripts() !!}
    <style>
        .form-group--autocomplete {
            position: relative;
        }
        .c_autocomplete {
            position: absolute;
            background: white;
            border: 1px solid #c4cdd5;
            box-shadow: 0px 8px 16px #0000002b;
            border-radius: 5px;
            margin-top: 2px;
            padding: 0;
            z-index: 9;
        }
        .c_autocomplete ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .c_autocomplete li {
            padding: 8px 16px;
            cursor: pointer;
            transition: 0.3s background;
        }
        .c_autocomplete li:hover {
            background: #e9ecef;
            color: #004785;
        }
    </style>
    <script>
        jQuery(function ($) {
            "use strict"
                           
            $(document).click(function(e) {
                $(document).find('.c_autocomplete').hide();
                $(document).find('.c_autocomplete ul').empty();
            });
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat ?? "51.505"}}, {{$row->map_lng ?? "-0.09"}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    var geocoder = new google.maps.Geocoder;
                    @if($row->map_lat && $row->map_lng)
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {}
                    });
                    @endif
                    $('.js__edit_location').on('click', function(e) {
                        e.preventDefault();
                        $(this).hide();
                        $("input[name=postal_code]").attr('readonly', false);
                        $("input[name=state]").attr('readonly', false);
                        $("input[name=city]").attr('readonly', false);
                        $("input[name=district]").attr('readonly', false);
                        $("input[name=street]").attr('readonly', false);
                        $("input[name=building_number]").attr('readonly', false);
                        $("input[name=map_lat]").attr('readonly', false);
                        $("input[name=map_lng]").attr('readonly', false);
                        $("input[name=postal_code]").val('');
                        $("input[name=street]").val('');
                        $("input[name=state]").val('');
                        $("input[name=city]").val('');
                        $("input[name=district]").val('');
                        $("input[name=building_number]").val('');
                        $("input[name=map_lat]").val('');
                        $("input[name=map_lng]").val('');
                        engineMap.clearMarkers();
                    });
                    function getAddressByFields() {
                        var address_items = [];
                        var address = '';
                        if($("input[name=postal_code]").val()) {
                            address_items.push($("input[name=postal_code]").val());
                        }
                        if($("input[name=state]").val()) {
                            address_items.push($("input[name=state]").val());
                        }
                        if($("input[name=city]").val()) {
                            address_items.push($("input[name=city]").val());
                        }
                        if($("input[name=district]").val()) {
                            address_items.push($("input[name=district]").val());
                        }
                        if($("input[name=street]").val()) {
                            address_items.push($("input[name=street]").val());
                        }
                        if($("input[name=building_number]").val()) {
                            address_items.push($("input[name=building_number]").val());
                        }
                        if(address_items) {
                            address = address_items.join(', ');
                        }
                        return address;
                    }
                    function eventInput(el, options) {
                        var $input = $(el);
                        var $input_container = $input.closest('.form-group');
                        var address = getAddressByFields();
                        
                        options.input = address;
                        options.componentRestrictions = { country: 'us' };
                        
                        var autocompleteService = new google.maps.places.AutocompleteService();
                        autocompleteService.getPlacePredictions(options, function(predictions, status) {
                            if (status !== 'OK' || !predictions.length) {
                                $input_container.find('.c_autocomplete ul').empty();
                                $input_container.find('.c_autocomplete').hide();
                            }
                            if (status !== 'OK') {
                                return;
                            }
                            if(predictions.length) {
                                $input_container.find('.c_autocomplete').show();
                                if($input_container.find('.c_autocomplete').length) {
                                    var $wrap = $input_container.find('.c_autocomplete');
                                    $wrap.find('ul').empty();
                                } else {
                                    var $wrap = $(
                                        '<div class="c_autocomplete"><ul></ul></div>'
                                    ).appendTo($input_container);
                                }
                                var $container = $wrap.find('ul');
                                for(var prediction of predictions) {
                                    var $item = $(
                                        '<li data-place_id="'+prediction.place_id+'">'+prediction.description+'</li>'
                                    ).prependTo($container);

                                    $item.on('click', function(e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        var $el = $(this);
                                        engineMap.details($el.attr('data-place_id'), function(res) {
                                            setFields(res[3]);
                                            engineMap.clearMarkers();
                                            engineMap.addMarker(res, {
                                                icon_options: {}
                                            });
                                            $("input[name=map_lat]").val(res[0]);
                                            $("input[name=map_lng]").val(res[1]);
                                            $("input[name=map_lat_autocomplete]").val(res[0]);
                                            $("input[name=map_lng_autocomplete]").val(res[1]);
                                        });
                                        $input_container.find('.c_autocomplete ul').empty();
                                        $input_container.find('.c_autocomplete').hide();
                                    });
                                }
                            }
                        });
                    }
                    function setFields(addr_components) {
                        $("input[name=postal_code]").attr('readonly', false);
                        $("input[name=state]").attr('readonly', false);
                        $("input[name=city]").attr('readonly', false);
                        $("input[name=district]").attr('readonly', false);
                        $("input[name=street]").attr('readonly', false);
                        $("input[name=building_number]").attr('readonly', false);
                        $("input[name=map_lat]").attr('readonly', false);
                        $("input[name=map_lng]").attr('readonly', false);
                        console.log(addr_components);
                        var fields_data = {
                            postal_code: '',
                            state: '',
                            city: '',
                            district: '',
                            street: '',
                            building_number: '',
                        };
                        var city_field_v1 = '';
                        var city_field_v2 = '';
                        var city_field_v3 = '';
                        for(var addr_component of addr_components) {
                            if(addr_component.types.includes('postal_code')) {
                                fields_data['postal_code'] = addr_component.long_name;
                            }
                            if(addr_component.types.includes('administrative_area_level_1')) {
                                fields_data['state'] = addr_component.long_name;
                            }
                            if(addr_component.types.includes('locality')) {
                                city_field_v1 = addr_component.long_name;
                            }
                            if(addr_component.types.includes('administrative_area_level_3')) {
                                city_field_v2 = addr_component.long_name;
                            }
                            if(addr_component.types.includes('neighborhood')) {
                                city_field_v3 = addr_component.long_name;
                            }
                            if(addr_component.types.includes('administrative_area_level_2')) {
                                fields_data['district'] = addr_component.long_name;
                            }
                            if(addr_component.types.includes('route')) {
                                fields_data['street'] = addr_component.long_name;
                            }
                            if(addr_component.types.includes('street_number')) {
                                fields_data['building_number'] = addr_component.long_name;
                            }
                        }
                        if(city_field_v1) {
                            fields_data['city'] = city_field_v1;
                        } else if(city_field_v2) {
                            fields_data['city'] = city_field_v2;
                        } else {
                            fields_data['city'] = city_field_v3;
                        }
                        $("input[name=postal_code]").val(fields_data['postal_code']);
                        $("input[name=state]").val(fields_data['state']);
                        $("input[name=city]").val(fields_data['city']);
                        $("input[name=district]").val(fields_data['district']);
                        $("input[name=street]").val(fields_data['street']);
                        $("input[name=building_number]").val(fields_data['building_number']);
                        
                        $("input[name=postal_code_autocomplete]").val(fields_data['postal_code']);
                        $("input[name=state_autocomplete]").val(fields_data['state']);
                        $("input[name=city_autocomplete]").val(fields_data['city']);
                        $("input[name=district_autocomplete]").val(fields_data['district']);
                        $("input[name=street_autocomplete]").val(fields_data['street']);
                        $("input[name=building_number_autocomplete]").val(fields_data['building_number']);
                    }
                    
                    engineMap.on('click', function (dataLatLng) {
                        console.log('engineMap.on click');
                        console.log(dataLatLng);
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").val(dataLatLng[0]);
                        $("input[name=map_lng]").val(dataLatLng[1]);
                        $("input[name=map_lat_autocomplete]").val(dataLatLng[0]);
                        $("input[name=map_lng_autocomplete]").val(dataLatLng[1]);
                        geocoder.geocode({'location': {lat: parseFloat(dataLatLng[0]), lng: parseFloat(dataLatLng[1])}}, function(results, status) {
                            if (status !== google.maps.GeocoderStatus.OK) {
                                return;
                            }
                            if(results.length) {
                                $("input[name=autocomplete]").val(results[0].formatted_address);
                                setFields(results[0].address_components);
                                $("input[name=map_lat]").val(results[0].geometry.location.lat());
                                $("input[name=map_lng]").val(results[0].geometry.location.lng());
                                $("input[name=map_lat_autocomplete]").val(results[0].geometry.location.lat());
                                $("input[name=map_lng_autocomplete]").val(results[0].geometry.location.lng());
                                
                                console.log(results[0]);
                            }
                            //console.log(results);
                        });
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    });
                    if(myTravel.map_provider === "gmap"){
                        engineMap.searchBox($('#customPlaceAddress'),function (dataLatLng) {
                            $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                            setFields(dataLatLng[3]);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").val(dataLatLng[0]);
                            $("input[name=map_lng]").val(dataLatLng[1]);
                            $("input[name=map_lat_autocomplete]").val(dataLatLng[0]);
                            $("input[name=map_lng_autocomplete]").val(dataLatLng[1]);
                        }, {
                            componentRestrictions: { country: ["us"]},
                        });
                        
                        
                        $('input[name=postal_code]').on('input', function(e) {
                            eventInput(this, {
                                types: ['postal_code'],
                            });
                        });
                        $('input[name=state]').on('input', function(e) {
                            eventInput(this, {
                                types: ['administrative_area_level_1']
                            });
                        });
                        $('input[name=city]').on('input', function(e) {
                            eventInput(this, {
                                types: ['(cities)']
                            });
                        });
                        $('input[name=district]').on('input', function(e) {
                            eventInput(this, {
                                types: ['administrative_area_level_2']
                            });
                        });
                        $('input[name=street]').on('input', function(e) {
                            eventInput(this, {
                                types: ['address']
                            });
                        });
                        $('input[name=building_number]').on('input', function(e) {
                            eventInput(this, {
                                types: ['address']
                            });
                        });
                        $('input[name=map_lat]').on('input', function(e) {
                            engineMap.clearMarkers();
                            var lat = $("input[name=map_lat]").val();
                            var lng = $("input[name=map_lng]").val();
                            engineMap.addMarker([
                                parseFloat(lat), parseFloat(lng), $("input[name=map_zoom]").val()
                            ], {
                                icon_options: {}
                            });
                            geocoder.geocode({'location': {lat: parseFloat(lat), lng: parseFloat(lng)}}, function(results, status) {
                                if (status !== google.maps.GeocoderStatus.OK) {
                                    return;
                                }
                                if(results.length) {
                                    $("input[name=autocomplete]").val(results[0].formatted_address);
                                    setFields(results[0].address_components);
                                }
                            });
                        });
                        $('input[name=map_lng]').on('input', function(e) {
                            engineMap.clearMarkers();
                            var lat = $("input[name=map_lat]").val();
                            var lng = $("input[name=map_lng]").val();
                            engineMap.addMarker([
                                parseFloat(lat), parseFloat(lng), $("input[name=map_zoom]").val()
                            ], {
                                icon_options: {}
                            });
                            geocoder.geocode({'location': {lat: parseFloat(lat), lng: parseFloat(lng)}}, function(results, status) {
                                if (status !== google.maps.GeocoderStatus.OK) {
                                    return;
                                }
                                if(results.length) {
                                    $("input[name=autocomplete]").val(results[0].formatted_address);
                                    setFields(results[0].address_components);
                                }
                            });
                        });
                        
                        
                        /*engineMap.searchBox($('input[name=postal_code]'),function (dataLatLng) {
                            $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                            setFields(dataLatLng[3]);
                            console.log(dataLatLng);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        }, {
                            types: ['postal_code'],
                            componentRestrictions: { country: ["us"]},
                        });
                        engineMap.searchBox($('input[name=state]'),function (dataLatLng) {
                            setFields(dataLatLng[3]);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        }, {
                            types: ['administrative_area_level_1'],
                            componentRestrictions: { country: ["us"]},
                        });
                        engineMap.searchBox($('input[name=city]'),function (dataLatLng) {
                            $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                            setFields(dataLatLng[3]);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        }, {
                            types: ['(cities)'],
                            componentRestrictions: { country: ["us"]},
                        });
                        engineMap.searchBox($('input[name=district]'),function (dataLatLng) {
                            $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                            setFields(dataLatLng[3]);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        }, {
                            types: ['administrative_area_level_2'],
                            componentRestrictions: { country: ["us"]},
                        });
                        engineMap.searchBox($('input[name=street]'),function (dataLatLng) {
                            $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                            setFields(dataLatLng[3]);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        }, {
                            types: ['address'],
                            componentRestrictions: { country: ["us"]},
                        });
                        engineMap.searchBox($('input[name=building_number]'),function (dataLatLng) {
                            $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                            setFields(dataLatLng[3]);
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        }, {
                            types: ['address'],
                            componentRestrictions: { country: ["us"]},
                        });*/
                    }
                    engineMap.searchBox($('.bravo_searchbox'),function (dataLatLng) {
                        $("input[name=autocomplete]").val(dataLatLng[4].formatted_address);
                        setFields(dataLatLng[3]);
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").val(dataLatLng[0]);
                        $("input[name=map_lng]").val(dataLatLng[1]);
                        $("input[name=map_lat_autocomplete]").val(dataLatLng[0]);
                        $("input[name=map_lng_autocomplete]").val(dataLatLng[1]);
                    }, {
                        componentRestrictions: { country: ["us"]},
                    });
                }
            });
        })
    </script>
@endsection
