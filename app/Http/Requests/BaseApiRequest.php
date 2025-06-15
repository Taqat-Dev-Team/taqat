<?php

namespace App\Http\Requests;

use App\Traits\Validation\CustomFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class BaseApiRequest extends FormRequest
{
    use CustomFailedValidationTrait;

}
