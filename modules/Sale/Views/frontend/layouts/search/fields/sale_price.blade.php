<div class="item">
    <div class="mb-4">
        <div class="input-group">
            <?php
            use App\Models\SalePrice;
            $values = SalePrice::all()->toArray();
            ?>
            <div class="sale_price main_search_wrap drop-down-input border-0 p-0 form-control">
                <div class="drop-down_sale_price">
                    <span class="main_search_label scroll_body">{{ $title ?? " " }}</span>
                    <input type="text"
                           class="scroll_body main_search_input drop-down-input__field parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0"
                           placeholder="{{__("All Prices")}}" style="padding: 18px 30px 0 !important;" readonly/>
                    <input type="hidden" name="sale_price_id" class="drop-down-input__hidden_field"/>
                </div>
                <ul class="drop-down-input__list sale_price_body">
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
