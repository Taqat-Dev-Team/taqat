<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Filter;

use Illuminate\Validation\Rule;

trait ActiveTrait
{

    public function scopeActive($query) {
        $query->where($this->getTable().".status" , '=' , 1);
    }
}