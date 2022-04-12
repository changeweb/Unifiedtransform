<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherAssignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('assign teachers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_id'             => 'required|integer',
            'semester_id'           => 'required|integer',
            'class_id'              => 'required|integer',
            'section_id'            => 'required|integer',
            'teacher_id'            => 'required|integer',
            'session_id'            => 'required|integer',
        ];
    }
}
