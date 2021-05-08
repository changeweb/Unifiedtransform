<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class SaveConfigurationRequest extends FormRequest
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
            'grade_system_name' => 'required|string',
            'quiz_count' => 'required|numeric|min:0|max:5',
            'assignment_count' => 'required|numeric|min:0|max:3',
            'ct_count' => 'required|numeric|min:0|max:5',
            'quiz_percent' => 'required|numeric|min:0|max:100',
            'attendance_percent' => 'required|numeric|min:0|max:100',
            'assignment_percent' => 'required|numeric|min:0|max:100',
            'ct_percent' => 'required|numeric|min:0|max:100',
            'final_exam_percent' => 'required|numeric|min:0|max:100',
            'practical_percent' => 'required|numeric|min:0|max:100',
            'att_fullmark' => 'required|numeric|min:0|max:100',
            'quiz_fullmark' => 'required|numeric|min:0|max:100',
            'a_fullmark' => 'required|numeric|min:0|max:100',
            'ct_fullmark' => 'required|numeric|min:0|max:100',
            'final_fullmark' => 'required|numeric|min:0|max:100',
            'practical_fullmark' => 'required|numeric|min:0|max:100',
        ];
    }
}
