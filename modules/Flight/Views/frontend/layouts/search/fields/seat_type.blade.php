{{--<?php--}}

{{--$minValue = 0;--}}

{{--;?>--}}

{{--<div class="item">--}}

{{--    <div class="dropdown-custom px-0 mb-4 custom-select-dropdown-parent">--}}

{{--        <span class="d-block text-gray-1 text-left font-weight-normal">{{ $field['title'] ?? "" }}</span>--}}

{{--        <div class="flex-horizontal-center border-bottom-1  py-2 d-flex  dropdown-toggle" data-toggle="dropdown">--}}

{{--            <i class="flaticon-plus d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>--}}

{{--            @php--}}

{{--                $seatTypeGet = request()->query('seat_type',[]);--}}

{{--            @endphp--}}

{{--            <div class="text-black font-size-16 font-weight-semi-bold mr-auto height-40 d-flex align-items-center overflow-hidden">--}}

{{--                <div class="render">--}}

{{--                    @foreach($seatType as $type)--}}

{{--                        <?php--}}

{{--                        $inputRender = 'seat_type_'.$type->code.'_render';--}}

{{--                        $inputValue = $seatTypeGet[$type->code] ?? $minValue;--}}

{{--                        ;?>--}}

{{--                        <span class="" id="{{$inputRender}}">--}}

{{--                            <span class="one @if($inputValue > $minValue) d-none @endif">{{__( ':min :name',['min'=>$minValue,'name'=>$type->name])}}</span>--}}

{{--                            <span class="@if($inputValue <= $minValue) d-none @endif multi" data-html="{{__(':count '.$type->name)}}">{{__(':count'.$type->name,['count'=>$inputValue??$minValue])}}</span>--}}

{{--                        </span>--}}

{{--                    @endforeach--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="dropdown-menu custom-select-dropdown">--}}

{{--            @foreach($seatType as $type)--}}

{{--                <?php--}}

{{--                $inputName = 'seat_type_'.$type->code;--}}

{{--                $inputValue = $seatTypeGet[$type->code] ?? $minValue;--}}

{{--                ;?>--}}



{{--                <div class="dropdown-item-row">--}}

{{--                    <div class="label">{{__('Adults :type',['type'=>$type->name])}}</div>--}}

{{--                    <div class="val">--}}

{{--                        <span class="btn-minus" data-input="{{$inputName}}" data-input-attr="id"><i class="icon ion-md-remove"></i></span>--}}

{{--                        <span class="count-display"><input id="{{$inputName}}" type="number" name="seat_type[{{$type->code}}]" value="{{$inputValue}}" min="{{$minValue}}"></span>--}}

{{--                        <span class="btn-add" data-input="{{$inputName}}" data-input-attr="id"><i class="icon ion-ios-add"></i></span>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            @endforeach--}}

{{--        </div>--}}

{{--    </div>--}}

{{--</div>--}}

<?php
$minValue = 0;
$seatTypeGet = request()->query('seat_type', []);
;?>
<div class="item">
    <div class="main_search_wrap main_search_input-block col dropdown-custom px-0 mb-4 form-select-guests mt-md-3 mt-0">
        <div class=" scroll_body dropdown-custom px-0 mb-4 custom-select-dropdown-parent">
            <span class="main_search_label d-block text-gray-1 text-left font-weight-normal">{{ $title ?? "" }}</span>
            <div class="flex-horizontal-center scroll_body py-2 d-flex  dropdown-toggle" data-toggle="dropdown">
                <div class="text-black font-size-16 font-weight-semi-bold mr-auto height-40 d-flex align-items-center overflow-hidden">
                    <div class="main_search_input text-black font-size-16 font-weight-semi-bold mr-auto" style="line-height:36px;font-size:16px!important;">
                        <div class="render d-none">
                            @foreach($seatType as $type)
                                <?php
                                $inputRender = 'seat_type_' . $type->code . '_render';
                                $inputValue = $seatTypeGet[$type->code] ?? $minValue;
                                ;?>
                            <span class="" id="{{$inputRender}}">
                                <span class="one @if($inputValue > $minValue) d-none @endif">
                                    {{__( ':min :name',['min'=>$minValue,'name'=>$type->name])}}
                                </span>
                                <span class="@if($inputValue <= $minValue) d-none @endif multi" data-html="{{__(':count '.$type->name)}}">
                                    {{__(':count'.$type->name,['count'=>$inputValue??$minValue])}}
                                </span>
                             </span>
                            @endforeach
                        </div>
                        <div class="show-block d-block">
                            <span>{{ __('Select Travels') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-menu custom-select-dropdown" style="border-radius:25px;">
                @foreach($seatType as $type)
                    <?php
                    $inputName = 'seat_type_' . $type->code;
                    $inputValue = $seatTypeGet[$type->code] ?? $minValue;
                    ;?>
                    <div class="dropdown-item-row">
                        <div class="label">{{__('Adults :type',['type'=>$type->name])}}</div>
                        <div class="val">
                            <span class="btn-minus" data-input="{{$inputName}}" data-input-attr="id"><i
                                    class="icon ion-md-remove"></i></span>
                            <span class="count-display">
                                <input id="{{$inputName}}" type="number" name="seat_type[{{$type->code}}]"
                                       value="{{$inputValue}}" min="{{$minValue}}">
                            </span>
                            <span class="btn-add" data-input="{{$inputName}}" data-input-attr="id">
                                <i class="icon ion-ios-add"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
