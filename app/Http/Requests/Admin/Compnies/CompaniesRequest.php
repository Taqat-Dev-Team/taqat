<?php

namespace App\Http\Requests\Admin\Compnies;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
            'email'=>'required|unique:companies,email,except,'.$this->company_id,
            'mobile'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name'=>'الاسم مطلوب',
            'email.required'=>'الايميل مطلوب',
            'email.unique'=>'الايميل مستخدم من قبل',
            'mobile'=>'رقم الجوال مطلوب',
        ];
    }
}
