<?php

namespace App\Http\Requests\Api\User;

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
            'username' => 'required|unique:users,username,'.auth()->id(),
            'email' => 'required|unique:users,email,'.auth()->id(),
            'password' => '',
            'name' => 'required',
            'gender' => 'required|in:male,female',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus di isi',
            'unique' => ':attribute sudah dipakai',
            'in' => ':attribute harus bernilai antara :values',
            'email' => ':attribute tidak memenuhi format email yang benar',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'E-mail',
            'username' => 'Username',
            'password' => 'Kata sandi',
            'name' =>'Nama',
            'gender' => 'Jenis kelamin',
        ];
    }
}
