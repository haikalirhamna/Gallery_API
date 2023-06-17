<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'username' => 'required|unique:admins,username,'.auth('admin')->id(),
            'password' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus di isi',
            'unique' => ':attribute sudah dipakai',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'password' => 'Kata sandi',
            'name' =>'Nama',
        ];
    }
}
