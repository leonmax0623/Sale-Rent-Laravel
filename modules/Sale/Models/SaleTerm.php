<?php
namespace Modules\Sale\Models;

use App\BaseModel;
use Modules\Core\Models\Terms;

class SaleTerm extends BaseModel
{
    protected $table = 'bc_sale_term';
    protected $fillable = [
        'term_id',
        'target_id'
    ];

    function term()
    {
        return $this->hasOne(Terms::class, 'id', 'term_id');
    }
}
