<div class="item d-flex justify-content-sm-between">
    <div class="mb-4 ">
        <div class="input-group">
            <?php
            $values = \Modules\Space\Models\SpaceTerm::query()->with('term')->get()->all();
            ?>
            <div class="main_search_wrap drop-down-input border-0 p-0 form-control">
                <span class="main_search_label location">{{ $title ?? ''}}</span>
                <input type="text"
                       class="main_search_input drop-down-input__field parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("All Types of Property")}}" style="padding: 18px 30px 0 !important;"/>
                <input type="hidden"/>
                <ul class="drop-down-input__list">
                    @foreach($values as $item)
                        <li class="drop-down-input__item" data-value-id="{{$item->term->id}}"
                            data-value="{{$item->term->name}}">{{$item->term->name}}<i
                                class="drop-down-input__item-check fa fa-check"></i></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

