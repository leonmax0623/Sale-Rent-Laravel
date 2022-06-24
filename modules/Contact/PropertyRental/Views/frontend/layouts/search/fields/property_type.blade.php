<div class="item">
    <div class="mb-4 ">
        <div class="input-group">
            <?php
            $values = \Modules\Space\Models\SpaceTerm::query()->with('term', function($query) {
                $query->where('attr_id', 3);
            })->whereHas('term', function ($query) {
                $query->where('attr_id', 3);
            })->groupBy('term_id')->orderBy('id', 'DESC')->get();
            ?>
            <div class="property_type main_search_wrap drop-down-input border-0 p-0 form-control">
                <div class="drop-down-input-inner">
                <span class="main_search_label location scroll_body">{{ $title ?? ''}}</span>
                <input type="text"
                       class="scroll_body main_search_input drop-down-input__field parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("All Types of Property")}}" style="padding: 18px 30px 0 !important;" readonly/>
                <input type="hidden"/>
                </div>
                <ul class="drop-down-input__list property_type_body">
                    @foreach($values as $item)
                        <li class="drop-down-input__item " data-value-id="{{$item->term->id}}"
                            data-value="{{$item->term->name}}">{{$item->term->name}}<i
                                class="drop-down-input__item-check fa fa-check"></i></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

