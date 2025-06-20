<?php

namespace App\Http\Requests\Front\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title'=>'required',
            'description'=>'required',
            ''
        ];
    }

    public function messages()
    {
        return [
            'title'=>'العنوان مطلوب',
            'url'=>'الرابط مطلوب',
            'description'=>'الوصف مطلوب'
        ];
    }
}
