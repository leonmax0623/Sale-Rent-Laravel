<?php
namespace Modules\Rental\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Core\Models\Terms;

class SpaceTermFeaturedBox extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'           => 'term_space',
                    'type'         => 'select2',
                    'label'        => __('Select term rental'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('rental.admin.attribute.term.getForSelect2', ['type' => 'space']),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                    ],
                    'pre_selected' => route('rental.admin.attribute.term.getForSelect2', [
                        'type'         => 'rental',
                        'pre_selected' => 1
                    ])
                ],
            ],
            'category'=>__("Rental Blocks")
        ]);
    }

    public function getName()
    {
        return __('Rental: Term Featured Box');
    }

    public function content($model = [])
    {
        if (empty($term_space = $model['term_space'])) {
            return "";
        }
        $list_term = Terms::whereIn('id',$term_space)->with('rental')->get();
        $model['list_term'] = $list_term;
        return view('Rental::frontend.blocks.term-featured-box.index', $model);
    }

    public function contentAPI($model = []){
        $model['list_term'] = null;
        if (!empty($term_space = $model['term_space'])) {
            $list_term = Terms::whereIn('id',$term_space)->get();
            if(!empty($list_term)){
                foreach ( $list_term as $item){
                    $model['list_term'][] = [
                        "id"=>$item->id,
                        "attr_id"=>$item->attr_id,
                        "name"=>$item->name,
                        "image_id"=>$item->image_id,
                        "image_url"=>get_file_url($item->image_id,"full"),
                        "icon"=>$item->icon,
                    ];
                }
            }
        }
        return $model;
    }
}
