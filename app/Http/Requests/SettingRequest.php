<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingRequest extends Request
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
            'name' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phone_at' => 'required',
            'address' => 'required',
        ];
    }
}
