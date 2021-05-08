<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;

class CalculateMarksRequest extends FormRequest
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
            'teacher_id' => 'required|numeric',
            'grade_system_name' => 'required|string',
            'exam_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'section_id' => 'required|numeric',
        ];
    }
}
