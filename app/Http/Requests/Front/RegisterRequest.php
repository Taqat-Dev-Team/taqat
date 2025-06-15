<?php

namespace App\Http\Requests\Front;

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
            'email' => 'required|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'whatsapp' =>'required',
            'displacement_place' => 'required',
            'original_place' => 'required',

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

            'whatsapp' =>'الواتس اب مطلوب',
            'job' => 'الوظيفة مطلوبة',
            'sallary' => 'الراتب مطلوب',
            'marital_status' => 'الحالة الاجتماعية مطلوب',
            'displacement_place' => 'مكان النزوح مطلوب',
            'original_place' => 'مكان الاصلي مطلوب',
        ];
    }

}
