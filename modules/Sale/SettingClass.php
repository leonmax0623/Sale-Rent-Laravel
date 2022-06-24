<?php

namespace  Modules\Sale;

use Modules\Core\Abstracts\BaseSettingsClass;
use Modules\Core\Models\Settings;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'sale',
                'slug'   => 'property-sale',
                'title' => __("Property Sale Settings"),
                'position'=>10,
                'view'=>"Sale::admin.settings.space",
                "keys"=>[
                    'property_sale_disable',
                    'property_sale_page_search_title',
                    'property_sale_page_search_banner',
                    'property_sale_layout_search',
                    'property_sale_location_search_style',
                    'property_sale_page_limit_item',

                    'property_sale_enable_review',
                    'property_sale_review_approved',
                    'property_sale_enable_review_after_booking',
                    'property_sale_review_number_per_page',
                    'property_sale_review_stats',

                    'property_sale_page_list_seo_title',
                    'property_sale_page_list_seo_desc',
                    'property_sale_page_list_seo_image',
                    'property_sale_page_list_seo_share',

                    'property_sale_booking_buyer_fees',
                    'property_sale_vendor_create_service_must_approved_by_admin',
                    'property_sale_allow_vendor_can_change_their_booking_status',
                    'property_sale_allow_vendor_can_change_paid_amount',
                    'property_sale_allow_vendor_can_add_service_fee',
                    'property_sale_search_fields',
                    'property_sale_map_search_fields',

                    'property_sale_allow_review_after_making_completed_booking',
                    'property_sale_deposit_enable',
                    'property_sale_deposit_type',
                    'property_sale_deposit_amount',
                    'property_sale_deposit_fomular',

                    'property_sale_layout_map_option',
                    'property_sale_icon_marker_map',
                    'property_sale_booking_type',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
