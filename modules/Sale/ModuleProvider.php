<?php
namespace Modules\Sale;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Sale\Models\Sale;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed() and Sale::isEnable()){
            $sitemapHelper->add("sale",[app()->make(Sale::class),'getForSitemap']);
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
        if(!Sale::isEnable()) return [];
        return [
            'property_sale'=>[
                "position"=>31,
                'url'        => 'admin/module/property-sale',
                'title'      => __('Property Sale'),
                'icon'       => 'ion ion-md-home',
                'permission' => 'space_view',
                'children'   => [
                    'add'=>[
                        'url'        => 'admin/module/property-sale',
                        'title'      => __('All Property'),
                        'permission' => 'space_view',
                    ],
                    'create'=>[
                        'url'        => 'admin/module/property-sale/create',
                        'title'      => __('Add new Property'),
                        'permission' => 'space_create',
                    ],
                    'attribute'=>[
                        'url'        => 'admin/module/property-sale/attribute',
                        'title'      => __('Attributes'),
                        'permission' => 'space_manage_attributes',
                    ],
                    /*'availability'=>[
                        'url'        => 'admin/module/property-sale/availability',
                        'title'      => __('Availability'),
                        'permission' => 'space_create',
                    ],*/
                    'recovery'=>[
                        'url'        => 'admin/module/property-sale/recovery',
                        'title'      => __('Recovery'),
                        'permission' => 'space_view',
                    ],

                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if(!Sale::isEnable()) return [];
        return [
            'sale'=>Sale::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if(!Sale::isEnable()) return [];
        return [
            'sale'=>[
                'class' => Sale::class,
                'name'  => __("Sales"),
                'items' => Sale::searchForMenu(),
                'position'=>31
            ]
        ];
    }

    public static function getUserMenu()
    {
        $res = [];
        if (Sale::isEnable()) {
            $res['sale'] = [
                'url'        => route('sale.vendor.index'),
                'title'      => __('Property Sale'),
                'icon'       => 'ion ion-md-home',
                'position'   => 31,
                'permission' => 'space_view',
                'children'   => [
                    [
                        'url'   => route('sale.vendor.index'),
                        'title' => __("All Property Sales"),
                    ],
                    [
                        'url'        => route('sale.vendor.create'),
                        'title'      => __("Add Property Sale"),
                        'permission' => 'space_create',
                    ],
                    /*[
                        'url'        => route('sale.vendor.availability.index'),
                        'title'      => __("Availability"),
                        'permission' => 'space_create',
                    ],*/
                    [
                        'url'   => route('sale.vendor.recovery'),
                        'title'      => __("Recovery"),
                        'permission' => 'space_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks(){
        if(!Sale::isEnable()) return [];
        return [
            'list_space'=>"\\Modules\\Sale\\Blocks\\ListSpace",
            'space_term_featured_box'=>"\\Modules\\Sale\\Blocks\\SpaceTermFeaturedBox",
        ];
    }
}
