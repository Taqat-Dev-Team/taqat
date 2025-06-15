<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Rule;

use Illuminate\Validation\Rule;

trait CustomValidationRulesTrait
{

    public function checkExistsWithActive($table ,$column ) {
       return Rule::exists($table , $column)->whereNull('deleted_at')->where('status' ,1);
    }
    public function checkUniqueWithActive($table ,$column ) {
        return Rule::unique($table , $column)->whereNull('deleted_at')->where('status' ,1);
    }
    public function checkUniqueIgnoreWithActive($table ,$column , $id ,$ignore_column = 'id' ) {
        return Rule::unique($table , $column)->whereNull('deleted_at')
            ->where('status' ,1)
            ->ignore($id , $ignore_column);
    }


    public function checksendcode($data) {
if ($data){
    return 'nullable';
}else{
    return 'required';
}
    }
}
