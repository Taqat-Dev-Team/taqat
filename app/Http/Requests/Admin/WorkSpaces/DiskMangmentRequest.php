<?php

namespace App\Http\Requests\Admin\WorkSpaces;

use Illuminate\Foundation\Http\FormRequest;

class DiskMangmentRequest extends FormRequest
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
            'work_space_id'=>'required',
            'name'=>'required',
            // 'code'=>'required',
            'capcity'=>'required',


        ];
    }
}
