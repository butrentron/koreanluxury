<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SlideRequest extends Request
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
            'title' => ['required', 'unique:slides,title,'.$this->route('slides')],
            'image' => ['mimes:jpeg,jpg,png,gif,bmp', 'required'],
        ];
    }
}
