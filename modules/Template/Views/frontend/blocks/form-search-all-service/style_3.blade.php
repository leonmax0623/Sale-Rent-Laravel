{{--  <div class="bravo-form-search-all hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2" style="background-image: url('{{$bg_image_url}}') !important;">

    <div class="container space-2 space-top-xl-4">

        <div class="row justify-content-center pb-xl-2">

            <div class="py-8 py-xl-10 pb-5 home__info">

                <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold ">{{$title ?? ''}}</h1>

                <p class="font-size-20 font-weight-normal text-white">{{$sub_title ?? ''}}</p>

            </div>

        </div>

        @if(empty($hide_form_search))

            <div class="mb-lg-n1">

                <ul class="nav tab-nav flex-nowrap tab-nav-shadow justify-content-start @if(!empty($single_form_search)) d-none @endif" role="tablist" style="padding-left:100px;">

                    @if(!empty($service_types))

                        @php $number = 0; @endphp

                        @foreach ($service_types as $service_type)

                            @php

                                $allServices = get_bookable_services();
                                
                                if(empty($allServices[$service_type])) continue;

                                $module = new $allServices[$service_type];
                                $slug = ($module->moduleSlug ?? null) ? $module->moduleSlug : $service_type;
                            @endphp

                            <li class="nav-item" role="property-{{$slug}}">

                                <a class="nav-link font-weight-medium @if($number == 0) active @endif pl-md-5 pl-3" id="property_{{$slug}}-tab" data-toggle="pill" href="#property-{{$slug}}" role="tab" aria-controls="property-{{$slug}}" aria-selected="true">

                                    <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">

                                        <figure class="ie-height-40 d-md-block mr-md-3">

                                            <i class="icon {{ $module->getServiceIconFeatured() }} font-size-3"></i>

                                        </figure>

                                        <span class="tabtext mt-2 mt-md-0" style="padding-top:3px;font-size:18px;font-weight:600;">

                                              {{ !empty($modelBlock["title_for_".$service_type]) ? $modelBlock["title_for_".$service_type] : $module->getModelName() }}

                                        </span>

                                    </div>

                                </a>

                            </li>

                            @php $number++; @endphp

                        @endforeach

                    @endif

                </ul>

                <div class="tab-content hero-tab-pane">

                    @if(!empty($service_types))

                        @php $number = 0; @endphp

                        @foreach ($service_types as $service_type)

                            @php

                                $allServices = get_bookable_services();

                                if(empty($allServices[$service_type])) continue;

                                $module = new $allServices[$service_type];
                                $slug = ($module->moduleSlug ?? null) ? $module->moduleSlug : $service_type;
                            @endphp

                            <div class="tab-pane fade @if($number == 0) active show @endif" id="property-{{$slug}}" role="tabpanel" aria-labelledby="property-{{$slug}}-tab">

                                <div class="p-3 gradient-overlay-half-white-gradient">

                                    <div class="card border-0">

                                        <div class="card-body">

                                            @include(ucfirst($service_type).'::frontend.layouts.search.form-search')

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @php $number++; @endphp

                        @endforeach

                    @endif

                </div>

            </div>

        @endif

    </div>

</div>  --}}

@if($bg_video) 
    <div style="width:100%; margin:auto; display:block; position: relative;">

        <video preload="none" id="showcase-video-1" autoplay="" muted="" playsinline="" loop="" style="width:100%; height:auto">
            <source src="{{$bg_image_url}}" type="video/webm">
        </video> 
        
        <div id="videoMessage2" class="styling" style=" position: absolute; top: 0; left: 0; display: flex; flex-direction: column;  justify-content: center; align-items: center;  width: 100%; height: 100%;">
            @endif
                <div class="bravo-form-search-all hero-block hero-v1 text-center z-index-2" @if(!$bg_video) style="background-image: url('{{$bg_image_url}}') !important;" @endif>

                    <div class="container space-2 space-top-xl-4">
                
                        <div class="row justify-content-center pb-xl-2">
                
                            <div class="py-8 py-xl-10 pb-5 home__info">
                
                                <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold ">{{$title ?? ''}}</h1>
                
                                <p class="font-size-20 font-weight-normal text-white">{{$sub_title ?? ''}}</p>
                
                            </div>
                
                        </div>
                
                        @if(empty($hide_form_search))
                
                            <div class="mb-lg-n1">
                
                                <ul class="nav tab-nav flex-nowrap tab-nav-shadow justify-content-start @if(!empty($single_form_search)) d-none @endif" role="tablist" style="padding-left:100px;">
                
                                    @if(!empty($service_types))
                
                                        @php $number = 0; @endphp
                
                                        @foreach ($service_types as $service_type)
                
                                            @php
                
                                                $allServices = get_bookable_services();
                                                
                                                if(empty($allServices[$service_type])) continue;
                
                                                $module = new $allServices[$service_type];
                                                $slug = ($module->moduleSlug ?? null) ? $module->moduleSlug : $service_type;
                                            @endphp
                
                                            <li class="nav-item" role="property-{{$slug}}">
                
                                                <a class="nav-link font-weight-medium @if($number == 0) active @endif pl-md-5 pl-3" id="property_{{$slug}}-tab" data-toggle="pill" href="#property-{{$slug}}" role="tab" aria-controls="property-{{$slug}}" aria-selected="true">
                
                                                    <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                
                                                        <figure class="ie-height-40 d-md-block mr-md-3">
                
                                                            <i class="icon {{ $module->getServiceIconFeatured() }} font-size-3"></i>
                
                                                        </figure>
                
                                                        <span class="tabtext mt-2 mt-md-0" style="padding-top:3px;font-size:18px;font-weight:600;">
                
                                                            {{ !empty($modelBlock["title_for_".$service_type]) ? $modelBlock["title_for_".$service_type] : $module->getModelName() }}
                
                                                        </span>
                
                                                    </div>
                
                                                </a>
                
                                            </li>
                
                                            @php $number++; @endphp
                
                                        @endforeach
                
                                    @endif
                
                                </ul>
                
                                <div class="tab-content hero-tab-pane">
                
                                    @if(!empty($service_types))
                
                                        @php $number = 0; @endphp
                
                                        @foreach ($service_types as $service_type)
                
                                            @php
                
                                                $allServices = get_bookable_services();
                
                                                if(empty($allServices[$service_type])) continue;
                
                                                $module = new $allServices[$service_type];
                                                $slug = ($module->moduleSlug ?? null) ? $module->moduleSlug : $service_type;
                                            @endphp
                
                                            <div class="tab-pane fade @if($number == 0) active show @endif" id="property-{{$slug}}" role="tabpanel" aria-labelledby="property-{{$slug}}-tab">
                
                                                <div class="p-3 gradient-overlay-half-white-gradient">
                
                                                    <div class="card border-0">
                
                                                        <div class="card-body">
                
                                                            @include(ucfirst($service_type).'::frontend.layouts.search.form-search')
                
                                                        </div>
                
                                                    </div>
                
                                                </div>
                
                                            </div>
                
                                            @php $number++; @endphp
                
                                        @endforeach
                
                                    @endif
                
                                </div>
                
                            </div>
                
                        @endif
                
                    </div>
                
                </div> 
            @if ($bg_video)
            
        </div>
    </div>
@endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var video_jq = $('#showcase-video-1')
        var video_node = video_jq.get(0);
    
        video_jq.on("canplaythrough", function(e){
    
            // Video is downloaded, trigger playing
            video_node.play();
    
        });
    
        // All resources are ready, trigger video downloading
        video_node.load();
    
    });
</script>
