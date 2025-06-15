<?php

namespace App\Http\Requests\Admin\Agreement;

use Illuminate\Foundation\Http\FormRequest;

class AgreementController extends FormRequest
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
            'value' => 'required|string|max:255',
            'agreement_id' => 'sometimes|exists:constants,id',
        ];
    }
}
