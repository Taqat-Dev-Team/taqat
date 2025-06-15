<?php

namespace App\Http\Requests\Api\GeneratorSubscriptions;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class GeneratorReceiptRequest extends BaseApiRequest
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
            'generator_receipts' => 'required|array',
            'generator_receipts.*.generator_subscription_id' => 'required|exists:generator_subscriptions,id',
            'generator_receipts.*.amount' => 'required|numeric|min:0',
            'generator_receipts.*.date' => 'required|date',

        ];
    }
}
