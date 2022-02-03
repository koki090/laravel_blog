<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PushImageRequest extends FormRequest
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
            'files.*' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                'dimensions:max_width=1000,max_height=1000']
        ];
    }
}
