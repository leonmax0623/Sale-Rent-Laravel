<?php
namespace Modules\Space\Models;

use App\BaseModel;
use Modules\Core\Models\Terms;

class SpaceTerm extends BaseModel
{
    protected $table = 'bc_space_term';
    protected $fillable = [
        'term_id',
        'target_id'
    ];

    function term()
    {
        return $this->hasOne(Terms::class, 'id', 'term_id');
    }
}
