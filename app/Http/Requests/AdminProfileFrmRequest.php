<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileFrmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.auth()->guard('admin')->user()->uuid.',uuid',
            'password' => 'nullable|confirmed|min:6',
            'profile_photo' => 'nullable|image|dimensions:max_width=300,max_height=300',
        ];
        return $rules;
    }
}
