<?php

namespace App\Http\Requests\Admin\Restaurants;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email,' . $this->restaurant_id,
            'mobile' => 'required|string|max:15|unique:restaurants,mobile,' . $this->restaurant_id,
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',

        ];
    }
}
