<div class="item">
    <div class="mb-4 form-content">
        {{--<div class="u-datepicker input-group py-2 flex-nowrap form-date-search">
            <div class="date-wrapper height-40 font-size-16 ml-1 shadow-none font-weight-bold form-control hero-form bg-transparent border-0 flatpickr-input p-0">
                <div class="render check-in-render">{{Request::query('start',display_date(strtotime("today")))}}</div>
                <span> - </span>
                <div class="render check-out-render">{{Request::query('end',display_date(strtotime("+1 day")))}}</div>
            </div>
            <input type="hidden" class="check-in-input" value="{{Request::query('start',display_date(strtotime("today")))}}" name="start">
            <input type="hidden" class="check-out-input" value="{{Request::query('end',display_date(strtotime("+1 day")))}}" name="end">
            <input type="text" class="check-in-out" name="date" value="{{Request::query('date',date("Y-m-d")." - ".date("Y-m-d",strtotime("+1 day")))}}">
        </div>--}}
        <div class="row u-datepicker form-date-search">
            <input type="text" class="check-in-out" name="date" value="{{Request::query('date',date("Y-m-d")." - ".date("Y-m-d",strtotime("+1 day")))}}">
            <div class="col-md-6">
                <div class="main_search_wrap default input-group flex-nowrap">
                    <span class="main_search_label">{{ $title ?? " "}}</span>
                    <input type="hidden" class="check-in-input" value="" name="start">
                    <input type="text" class="main_search_input check-in" value="{{\Carbon\Carbon::now()->format('D, M d, y')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="main_search_wrap default input-group flex-nowrap">
                    <span class="main_search_label">{{ $title ?? " "}}</span>
                    <input type="hidden" class="check-out-input" value="" name="end">
                    <input type="text" class="main_search_input check-out" value="{{\Carbon\Carbon::now()->addDay()->format('D, M d, y')}}">
                </div>
            </div>
        </div>
    </div>
</div>
