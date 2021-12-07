<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'email'             => 'required|string|email|max:255|unique:users',
            'gender'            => 'required|string',
            'nationality'       => 'required|string',
            'phone'             => 'required|string',
            'address'           => 'required|string',
            'address2'          => 'nullable|string',
            'city'              => 'required|string',
            'zip'               => 'required|string',
            'photo'             => 'nullable|string',
            'birthday'          => 'required|date',
            'religion'          => 'required|string',
            'blood_type'        => 'required|string',
            'password'          => 'required|string|min:8',

            // Parents' information
            'father_name'       => 'required|string',
            'father_phone'      => 'required|string',
            'mother_name'       => 'required|string',
            'mother_phone'      => 'required|string',
            'parent_address'    => 'required|string',

            // Academic information
            'class_id'          => 'required',
            'section_id'        => 'required',
            'board_reg_no'      => 'string',
            'session_id'        => 'required',
            'id_card_number'    => 'required',
        ];
    }
}
