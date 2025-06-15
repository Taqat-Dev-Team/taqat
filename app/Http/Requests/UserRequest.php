<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'whatsapp'=>'required',
            'mobile'=>'required|unique:users,mobile',
            'marital_status'=>'required',
            'salary'=>'required',
            'company_name'=>'required',
            'job'=>'required',
            'salary'=>'required',
            'photo'=>'required',



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

            'marital_status'=>'الحالة الاجتماعية مطلوبة',
            'salary'=>'الراتب اكبر من مطلوب',
            'company_name'=>'اسم الشركة مطلوب',
            'job'=>'المسمى الوظيفي مطلوب',
            'photo'=>'الصورة مطلوبة',


        ];
    }
}
