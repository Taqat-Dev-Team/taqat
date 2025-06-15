<?php

namespace App\Http\Requests\Companies\Products;

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
            'title' =>'required',
'description' => 'required',
            'received_required'=>'required',
            'skills'=>'required',
            'expected_budget'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'title' =>__('vaildation.title_required'),
            'description' => __('vaildation.description_required'),
            'received_required'=>__('vaildation.job_requirements_required'),
            'skills'=>__('vaildation.skills_required'),
            'expected_budget'=>__('vaildation.expected_budget_required'),

        ];
    }
}
