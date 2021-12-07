<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradingSystemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create grading systems');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'system_name'   => 'required|string',
            'class_id'      => 'required|integer',
            'semester_id'   => 'required|integer',
            'session_id'    => 'required|integer'
        ];
    }
}
