<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'job_requirements' => 'required',
            'specialization_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'title'=>__('vaildation.title_required'),
            'description'=>__('vaildation.description_required'),
            'job_requirements'=>__('vaildation.job_requirements_required'),
            'specialization_id'=>__('vaildation.specialization_required'),

        ];
    }
}
