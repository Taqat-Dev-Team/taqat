<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'name' => 'required',
            'email' =>  ['required','email',Rule::unique('admins','email')->ignore($this->id)],
            'mobile' =>  ['required','min:6',Rule::unique('admins','mobile')->ignore($this->id)],
            'role_id'=>'required|numeric',
            'password'=>'min:6|nullable',
            // 'branch_id' => 'required_without:admin_id',

        ];
    }
}
