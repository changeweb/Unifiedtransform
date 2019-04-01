<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\User
 */
class UpdateUserRequest extends FormRequest
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
        $rules = [
            'user_id' => 'required|numeric',
            'email' => 'required|email|max:255|' . Rule::unique('users')->ignore($this->get('user_id')),
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|' . Rule::unique('users')->ignore($this->get('user_id')),
        ];

        if ($this->get('user_role') == 'teacher') {
            $rules['department_id'] = 'required|numeric';
        }

        return $rules;
    }
}
