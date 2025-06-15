<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait MultiLangValidationTrait
{

    public function getLangData($fields) {
        $data = [];
        foreach ($fields as $filed) {
            $name = json_decode($this->request->get($filed));
            $names =[];
            foreach ($name as $key=>$lang_name) {
                $names[$key]= $lang_name;
            }
            $data[$filed] = $names;
        }
        return $data;

    }
}
