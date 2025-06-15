<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Rule;

use Illuminate\Validation\Rule;

trait RuleTrait
{

    public function checkPhone($table ,$add ,$id , $phone_code ,$phone ) {
        $rule = Rule::unique($table)->where(function ($query) use($phone_code , $phone) {
            $query->where('phone_code', '=', $phone_code)
                ->where('phone', '=', $phone);
        })->whereNull('deleted_at');
        if(!$add) {
            $rule = $rule->ignore($id);
        }
        return $rule;
    }
    public function checkExistPhone($table , $phone_code ,$phone ) {
        $rule = Rule::exists($table , 'phone')->where(function ($query) use($phone_code , $phone) {
            $query->where('phone_code', '=', $phone_code)->where('phone', '=', $phone);
        })->whereNull('deleted_at');
        return $rule;
    }
}