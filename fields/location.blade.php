<div class="item">
	<div class="mb-4">
		<div class="input-group">
			<?php
			$location_name = "";
			$list_json = [];
			$traverse = function ($locations, $prefix = '') use (&$traverse, &$list_json, &$location_name) {
				foreach ($locations as $location) {
					$translate = $location->translateOrOrigin(app()->getLocale());
					if (Request::query('location_id') == $location->id) {
						$location_name = $translate->name;
					}
					$list_json[] = [
							'id'    => $location->id,
							'title' => $prefix.' '.$translate->name,
					];
					$traverse($location->children, $prefix.'-');
				}
			};
			$traverse($list_location);
			?>
			<div class="main_search_wrap smart-search border-0 p-0 form-control">
				<span class="main_search_label location">{{ $title ?? " " }} </span>
				<input type="text" class="main_search_input smart-search-location parent_text font-weight-bold font-size-16 shadow-none hero-form font-weight-bold border-0 p-0" {{ ( empty(setting_item("tour_location_search_style")) or setting_item("tour_location_search_style") == "normal" ) ? "readonly" : ""  }} placeholder="{{__("Cities in the United States")}}" value="{{ $location_name }}" data-onLoad="{{__("Loading...")}}"
					   data-default="{{ json_encode($list_json) }}" style="padding: 18px 30px 0 !important;">
				<input type="hidden" class="child_id" name="location_id" value="{{Request::query('location_id')}}">
			</div>
		</div>
	</div>
</div>
