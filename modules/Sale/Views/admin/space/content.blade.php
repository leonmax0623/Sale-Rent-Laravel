<div class="panel">
    <div class="panel-title"><strong>{{__("Property Features for Sale")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="form-group">
                <label>{{__("Property Type")}}</label>
                <div class="">
                    <select name="property_type_id" class="form-control @if($errors->has('property_type_id')) is-invalid @endif">
                        <option value="">{{__("-- Select Property Type --")}}</option>
                        @if(count($types) > 0))
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @if($row->property_type_id && $row->property_type_id == $type->id) selected @endif>{{ $type->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group">
            <label>{{__("Property Name")}}</label>
            <input type="text" value="{!! clean($translation->title) !!}"
                   placeholder="{{__("Write the Name of Your Property ")}}" name="title" class="form-control @if($errors->has('title')) is-invalid @endif">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Property Description")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("YouTube Video Property")}}</label>
                <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("YouTube Link Video")}}">
            </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('FAQs Property')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Questions")}}</div>
                    <div class="col-md-5">{{__('Answers')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($translation->faqs))
                    @php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); @endphp
                    @foreach($translation->faqs as $key=>$faq)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('Write a Useful Question for Your Customer')}}">
                                </div>
                                <div class="col-md-6">
                                    <textarea name="faqs[{{$key}}][content]" class="form-control" placeholder="Write a Useful Answer for Your Customer">{{$faq['content']}}</textarea>
                                </div>
                                <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add Question')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Eg: Can I bring my pet?')}}" style="height: 54px">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Main Photo Property")}}</label>
                <div class="form-group-image">
                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">{{__("Photo Gallery of Your Property")}}</label>
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
            </div>
        @endif
    </div>
</div>
@if(is_default_lang())
<div class="panel">
    <div class="panel-title"><strong>{{__("Additional Property Information")}}</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{__("No. Bed")}}</label>
                    <input type="number" value="{{$row->bed}}" placeholder="{{__("Example: 3")}}" name="bed" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{__("No. Bathroom")}}</label>
                    <input type="number" value="{{$row->bathroom}}" placeholder="{{__("Example: 5")}}" name="bathroom" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{__("Square")}}</label>
                    <input type="number" value="{{$row->square}}" placeholder="{{__("Example: 100")}}" name="square" class="form-control">
                </div>
            </div>
        </div>
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Min day before booking")}}</label>
                        <input type="number" name="min_day_before_booking" class="form-control" value="{{$row->min_day_before_booking}}" placeholder="{{__("Ex: 3")}}">
                        <i>{{ __("Leave blank if you dont need to use the min day option") }}</i>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Min day stays")}}</label>
                        <input type="number" name="min_day_stays" class="form-control" value="{{$row->min_day_stays}}" placeholder="{{__("Ex: 2")}}">
                        <i>{{ __("Leave blank if you dont need to use the min day stays option") }}</i>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endif
