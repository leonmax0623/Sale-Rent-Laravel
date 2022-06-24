<?php
namespace Modules\Rental\Models;

use App\BaseModel;
use Modules\Core\Models\Terms;

class RentalTerm extends BaseModel
{
    protected $table = 'bc_rental_term';
    protected $fillable = [
        'term_id',
        'target_id'
    ];

    function term()
    {
        return $this->hasOne(Terms::class, 'id', 'term_id');
    }
}
