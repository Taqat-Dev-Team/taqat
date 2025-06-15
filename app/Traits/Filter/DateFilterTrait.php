<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Filter;

use Illuminate\Validation\Rule;

trait DateFilterTrait
{

    public function scopeFilterDate($query ,$column , $start , $end) {
        if(checkCanFilter($start)) {
            $query->whereDate($column , '>=' , $start);
        }
        if(checkCanFilter($end)) {
            $query->whereDate($column , '<=' , $end);
        }
    }
}