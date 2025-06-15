<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\BaseApiRequest;
use App\Models\Admin;
use Faker\Provider\Base;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends BaseApiRequest
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
            'email'=>'required|exists:admins,email',
            'password' => 'required|string|min:6|max:20',
        ];
    }

    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $user = Admin::where('email', $this->email)->first();

            if (!$user || !Hash::check($this->password, $user->password)) {
                $validator->errors()->add('email', 'Invalid credentials.');
                return; // No need to check further if credentials are invalid
            }

          
        });
    }
}
