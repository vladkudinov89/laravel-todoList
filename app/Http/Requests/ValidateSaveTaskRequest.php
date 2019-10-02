<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSaveTaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'description' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A title is required',
            'description.required' => 'A description is required',
            'name.min' => 'Must be min 2 letters in task\'s name',
            'description.min' => 'Must be min 5 letters in task\'s description',
        ];
    }
}
