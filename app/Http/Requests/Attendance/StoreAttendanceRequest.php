<?php

namespace App\Http\Requests\Attendance;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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
            'students' => 'required|array',
            'attendances' => 'required|array',
            'section_id' => 'required',
            'exam_id' => 'required',
            'update' => 'required',
            'isPresent*' => 'required',
        ];
    }
}
