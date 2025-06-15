<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class storeUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' =>  ['required',Rule::unique('users','name')],
            'profession_id'=>'required',
            'interest_id'=>'required',
        ];
    }

    public function messages()
    {

        return [
            'email.required' =>'الرجاء ادخل الايميل' ,
            'email.required' =>'انت مسجل لدينا من قبل' ,

            'profession_id'=>'ادخل الوظيفة الخاصة بك',
            'interest_id'=>'ادخل الاهتمام الخاص بك',
        ];

    }
}
