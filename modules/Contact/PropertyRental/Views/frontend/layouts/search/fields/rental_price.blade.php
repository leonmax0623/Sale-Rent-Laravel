<div class="item">
    <div class="mb-4">
        <div class="input-group">
            <?php
            use App\Models\RentalPrice;
            $values = RentalPrice::all()->toArray();
            ?>
            <div class="rental_price main_search_wrap drop-down-input border-0 p-0 form-control">
                <div class="drop-down_rental_price">
                <span class="main_search_label scroll_body">{{ $title ?? " " }}</span>
                <input type="text"
                       class="scroll_body main_search_input drop-down-input__field parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                       placeholder="{{__("All Prices/Month")}}" style="padding: 18px 30px 0 !important;" readonly/>
                <input type="hidden"/>
                </div>
                <ul class="drop-down-input__list rental_price_body">
                    @foreach($values as $item)
                        <li class="drop-down-input__item" data-value-id="{{$item['id']}}"
                            data-value="{{$item['name']}}">{{$item['name']}}
                            <i class="drop-down-input__item-check fa fa-check"></i>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
