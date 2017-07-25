<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurvey extends FormRequest
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
            'title' => 'required|max:140',
            'questions' => 'array|min:1',
            'questions.*.order' => 'required|integer|min:1',
            'questions.*.type_id' => 'required|integer|between:1,9',
            'questions.*.title' => 'required|max:140',
            'questions.*.description' => 'present|max:255',
            'questions.*.required' => 'required|boolean',
            'questions.*.options' => 'required_if:questions.*.type_id,2|required_if:questions.*.type_id,3required_if:questions.*.type_id,4',
            'questions.*.options.*.order' => 'required|integer|min:1',
            'questions.*.options.*.answer' => 'required|max:140',
            'questions.*.options.*.canComment' => 'required|boolean'
        ];
    }
}
