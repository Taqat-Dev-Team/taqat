<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email'=>'unique:users,email',
            'name'=>'required',
            'mobile'=>'required|unique:users,mobile',
            'whatsapp'=>'required',
            'specialization_id'=>'required|exists:specializations,id'




        ];
    }

    public function messages()
    {
        return [
            'name'=>'الاسم مطلوب',
            'email.required'=>'الايميل مطلوب',
            'mobile.required'=>'رقم الجوال مطلوب',
            'email.unique'=>'الايميل مستخدم من قبل',
            'mobile.unique'=>'رقم الجوال مستخدم من قبل',




        ];
    }

}
