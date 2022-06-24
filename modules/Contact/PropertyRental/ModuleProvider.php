<?php
namespace Modules\PropertyRental;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\PropertyRental\Models\Rental;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed() and Rental::isEnable()){
            $sitemapHelper->add("rental",[app()->make(Rental::class),'getForSitemap']);
        }
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        if(!Rental::isEnable()) return [];
        return [
            'property_rental'=>[
                "position"=>32,
                'url'        => 'admin/module/property-rental',
                'title'      => __('Property Rental'),
                'icon'       => 'ion ion-md-home',
                'permission' => 'space_view',
                'children'   => [
                    'add'=>[
                        'url'        => 'admin/module/property-rental',
                        'title'      => __('All Property'),
                        'permission' => 'space_view',
                    ],
                    'create'=>[
                        'url'        => 'admin/module/property-rental/create',
                        'title'      => __('Add new Property'),
                        'permission' => 'space_create',
                    ],
                    'attribute'=>[
                        'url'        => 'admin/module/property-rental/attribute',
                        'title'      => __('Attributes'),
                        'permission' => 'space_manage_attributes',
                    ],
                    'availability'=>[
                        'url'        => 'admin/module/property-rental/availability',
                        'title'      => __('Availability'),
                        'permission' => 'space_create',
                    ],
                    'recovery'=>[
                        'url'        => 'admin/module/property-rental/recovery',
                        'title'      => __('Recovery'),
                        'permission' => 'space_view',
                    ],

                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if(!Rental::isEnable()) return [];
        return [
            'rental'=>Rental::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if(!Rental::isEnable()) return [];
        return [
            'rental'=>[
                'class' => Rental::class,
                'name'  => __("Rentals"),
                'items' => Rental::searchForMenu(),
                'position'=>41
            ]
        ];
    }

    public static function getUserMenu()
    {
        $res = [];
        if (Rental::isEnable()) {
            $res['rental'] = [
                'url'        => route('rental.vendor.index'),
                'title'      => __("Manage Property Rental"),
                'icon'       => Rental::getServiceIconFeatured(),
                'position'   => 32,
                'permission' => 'space_view',
                'children'   => [
                    [
                        'url'   => route('rental.vendor.index'),
                        'title' => __("All Property Rental"),
                    ],
                    [
                        'url'        => route('rental.vendor.create'),
                        'title'      => __("Add Property Rental"),
                        'permission' => 'space_create',
                    ],
                    [
                        'url'        => route('rental.vendor.availability.index'),
                        'title'      => __("Availability"),
                        'permission' => 'space_create',
                    ],
                    [
                        'url'   => route('rental.vendor.recovery'),
                        'title'      => __("Recovery"),
                        'permission' => 'space_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks(){
        if(!Rental::isEnable()) return [];
        return [
            'list_space'=>"\\Modules\\PropertyRental\\Blocks\\ListSpace",
            'space_term_featured_box'=>"\\Modules\\PropertyRental\\Blocks\\SpaceTermFeaturedBox",
        ];
    }
}
