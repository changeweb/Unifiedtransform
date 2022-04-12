<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create courses');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_name'  => 'required',
            'course_type'  => 'required',
            'class_id'     => 'required|integer|gt:0',
            'semester_id'  => 'required|integer|gt:0',
            'session_id'   => 'required|integer|gt:0',
        ];
    }
}
