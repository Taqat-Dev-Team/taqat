<?php

namespace App\Http\Requests\Admin\WorkSpaceMangments\RoomMangments;

use Illuminate\Foundation\Http\FormRequest;

class RoomMangmentsRequest extends FormRequest
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
            // 'code'=>'required',
            'capacity'=>'required|min:1',
            // 'work_space_id'=>'required|exists:work_spaces,id',

        ];
    }
}
