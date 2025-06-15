<?php

namespace App\Http\Requests\Api\GeneratorSubscriptions;

use App\Http\Requests\BaseApiRequest;
use Faker\Provider\Base;
use Illuminate\Foundation\Http\FormRequest;

class GeneratorSubscriptionRequest extends BaseApiRequest
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
            'generator_subscriptions' => 'required|array',
            'generator_subscriptions.*.name' => 'required|string|max:255',
            'generator_subscriptions.*.mobile' => 'required|string',
            'generator_subscriptions.*.address' => 'required|string|max:255',
            'generator_subscriptions.*.latitude' => 'required|numeric',
            'generator_subscriptions.*.longitude' => 'required|numeric',
            'generator_subscriptions.*.killo_watt_cost' => 'required|numeric',
            'generator_subscriptions.*.initial_reading' => 'required|numeric',
            'generator_subscriptions.*.photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // تحقق من الصورة

        ];
    }
}
