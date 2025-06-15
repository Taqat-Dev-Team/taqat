<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseApiRequest
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
            'name'=>'required',
            'mobile'=>'required|unique:users,mobile',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'deviceType'=>'required|in:android,ios',
            'userType'=>'required|in:1,2',
            'fcmToken'=>'nullable',
            'commercialLicenseNumber'=>'required_if:userType,2',
            'commercialLicensePhoto'=>'required_if:userType,2',
            'code'=>'required',

        ];
    }
}
