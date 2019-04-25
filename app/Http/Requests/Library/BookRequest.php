<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'     => 'required',
            'book_code' => 'required|unique:books,book_code',
            'author'    => 'required',
            'quantity'  => 'required',
            'rackNo'    => 'required',
            'rowNo'     => 'required',
            'type'      => 'required',
            'about'     => 'required',
            'price'     => 'required',
            'img_path'  => 'required',
            'class_id'  => 'required',
        ];
    }
}
