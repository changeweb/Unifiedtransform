<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRuleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create grading systems rule');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'point'             => 'required',
            'grade'             => 'required',
            'start_at'          => 'required',
            'end_at'            => 'required',
            'grading_system_id' => 'required',
            'session_id'        => 'required',
        ];
    }
}
