<?php

namespace App\Http\Requests\Dashboard\ApprovalApplication;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'consent_id' => ['required'],
            'department_id' => ['required'],
            'evidence_img' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
