<?php
namespace App\Traits\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait CustomFailedValidationTrait
{

    protected function failedValidation(Validator $validator)
    {
        $response['data']=[];
        $response = response_api(false , $validator->errors()->first() , $response , 422);
        throw new ValidationException($validator ,$response);
    }
}
