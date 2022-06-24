<?php

namespace  Modules\PropertyRental;

use Modules\Core\Abstracts\BaseSettingsClass;
use Modules\Core\Models\Settings;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'rental',
                'title' => __("Property Rental Settings"),
                'position'=>20,
                'view'=>"PropertyRental::admin.settings.space",
                "keys"=>[
                    'property_rental_disable',
                    'property_rental_page_search_title',
                    'property_rental_page_search_banner',
                    'property_rental_layout_search',
                    'property_rental_location_search_style',
                    'property_rental_page_limit_item',

                    'property_rental_enable_review',
                    'property_rental_review_approved',
                    'property_rental_enable_review_after_booking',
                    'property_rental_review_number_per_page',
                    'property_rental_review_stats',

                    'property_rental_page_list_seo_title',
                    'property_rental_page_list_seo_desc',
                    'property_rental_page_list_seo_image',
                    'property_rental_page_list_seo_share',

                    'property_rental_booking_buyer_fees',
                    'property_rental_vendor_create_service_must_approved_by_admin',
                    'property_rental_allow_vendor_can_change_their_booking_status',
                    'property_rental_allow_vendor_can_change_paid_amount',
                    'property_rental_allow_vendor_can_add_service_fee',
                    'property_rental_search_fields',
                    'property_rental_map_search_fields',

                    'property_rental_allow_review_after_making_completed_booking',
                    'property_rental_deposit_enable',
                    'property_rental_deposit_type',
                    'property_rental_deposit_amount',
                    'property_rental_deposit_fomular',

                    'property_rental_layout_map_option',
                    'property_rental_icon_marker_map',
                    'property_rental_booking_type',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
