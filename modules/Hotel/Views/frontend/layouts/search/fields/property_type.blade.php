<div class="item">
    <div class="mb-4 ">
        <div class="input-group">
            <?php
            $attId = 5;
            $values = \Modules\Core\Models\Terms::where("attr_id", $attId)->orderBy('id', 'DESC')->get();
            ?>
            <div class="property_type main_search_wrap drop-down-input border-0 p-0 form-control">
                <div class="drop-down-input-inner">
                <span class="main_search_label location scroll_body">{{ $title ?? ''}}</span>
                <input type="text"
                       class="scroll_body main_search_input drop-down-input__field parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("All Types of Property")}}" style="padding: 18px 30px 0 !important;" readonly/>
                <input type="hidden" name="property_type" class="drop-down-input__hidden_field"/>
                </div>
                <ul class="drop-down-input__list property_type_body">
                    @foreach($values as $item)
                        <li class="drop-down-input__item " data-value-id="{{$item->id}}"
                            data-value="{{$item->name}}">{{$item->name}}<i
                                class="drop-down-input__item-check fa fa-check"></i></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>