<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstitutionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => [
                'required',
                Rule::unique('institutions', 'name->ar')->where(function ($query) {
                    return $query->where('name->ar', $this->input('nameAr'));
                }),

            ],
            'name_en' => [
                'required',
                Rule::unique('institutions', 'name->en')->where(function ($query) {
                    return $query->where('name->en', $this->input('nameEn'));
                }),
            ],

            // 'name' =>  ['required',Rule::unique('institutions','name')->ignore($this->institution_id)],

        ];
    }
}
