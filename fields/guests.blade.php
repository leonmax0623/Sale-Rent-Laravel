<div class="item">
    <div class="main_search_wrap default col dropdown-custom px-0 mb-4 form-select-guests">
        <span class="main_search_label">{{  $title ?? " " }}</span>
        <div class="flex-horizontal-center d-flex  dropdown-toggle" data-toggle="dropdown">
            @php
                $adults = request()->query('adults',1);
                $children = request()->query('children',0);
            @endphp
            <div class="main_search_input text-black font-size-16 font-weight-semi-bold mr-auto" style="line-height:36px;font-size:16px!important;">
               <div class="render" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    <span class="adults" ><span class="one @if($adults >1) d-none @endif">{{__('1 Adult')}}</span> <span class="@if($adults <= 1) d-none @endif multi" data-html="{{__(':count Adults')}}">{{__(':count Adults',['count'=>request()->query('adults',1)])}}</span></span>
                    -
                    <span class="children" >
                        <span class="one @if($children >1) d-none @endif" data-html="{{__(':count Child')}}">{{__(':count Child',['count'=>request()->query('children',0)])}}</span>
                        <span class="multi @if($children <=1) d-none @endif" data-html="{{__(':count Children')}}">{{__(':count Children',['count'=>request()->query('children',0)])}}</span>
                    </span>
               </div>
            </div>
        </div>
        <div class="dropdown-menu select-guests-dropdown" style="border-radius:25px;">
            <div class="dropdown-item-row">
                <div class="label">{{  $title ?? " " }}</div>
                <div class="val">
                    <span class="btn-minus" data-input="adults"><i class="icon ion-md-remove"></i></span>
                    <span class="count-display"><input type="number" name="adults" value="{{request()->query('adults',1)}}" min="1"></span>
                    <span class="btn-add" data-input="adults"><i class="icon ion-ios-add"></i></span>
                </div>
            </div>
            <div class="dropdown-item-row">
                <div class="label">{{__('Children')}}</div>
                <div class="val">
                    <span class="btn-minus" data-input="children"><i class="icon ion-md-remove"></i></span>
                    <span class="count-display"> <input type="number" name="children" value="{{request()->query('children',0)}}" min="0"> </span>
                    <span class="btn-add" data-input="children"><i class="icon ion-ios-add"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
