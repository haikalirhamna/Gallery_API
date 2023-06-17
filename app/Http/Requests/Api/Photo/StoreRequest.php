<?php

namespace App\Http\Requests\Api\Photo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'album_id' => 'required',
            'photo_name' => 'required',
            'content' => 'required:mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'mimes' => ':attribute harus berekstensi jpg, jpeg, atau png'
        ];
    }
}
