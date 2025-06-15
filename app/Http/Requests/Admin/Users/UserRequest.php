<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $id = request('user_id'); // Get the user ID from the route (if it's an update)

        return [
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id)->whereNull('deleted_at'),
            ],
            'mobile' => [
                'required',
                Rule::unique('users', 'mobile')->ignore($id)->whereNull('deleted_at'),
            ],
            'whatsapp' => 'required|numeric|min:10',
            'user_type_cd_id' => 'required',
            'specialization_id' => 'required_if:user_type_cd_id,20',
            'initial_reading' => 'required_if:user_type_cd_id,21',
            'university_cd_id' => 'required_if:user_type_cd_id,31',
            'password' => 'nullable|min:6',
            'original_place' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required',
            'branch_id' => 'nullable|exists:branches,id|required_if:status,1',

        ];
    }
}
