<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = \Auth::id();
        return [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'image' => [
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                'dimensions:max_width=1000,max_height=1000']
        ];
    }
}
