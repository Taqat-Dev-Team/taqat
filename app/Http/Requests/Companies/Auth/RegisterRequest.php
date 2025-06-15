<?php

namespace App\Http\Requests\Companies\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'email' => 'required|unique:companies,email',
            'mobile' => 'required|unique:companies,mobile',
            'user_name'=>'required',

        ];
    }


    public function messages()
    {
        return [
            'name'=>'الاسم مطلوب',
            'email.required'=>'الايميل مطلوب',
            'email.unique'=>'ايميل مستخدم من قبل',
            'mobile.required'=>'رقم الجوال مطلوب',
            'mobile.unique'=>'رقم الجوال مستخدم من قبل',
            'passsowrd'=>'كلمة المرور مطلوبة',
            'user_name'=>'اسم مطلوب',


    ];
    }
}
