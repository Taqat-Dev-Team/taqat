<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class IncomeMomveMentRequest extends BaseApiRequest
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
            'income_movement_id' => 'required|exists:income_movements,id',
            'amount' => 'required|numeric',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'note' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ];
    }
}
