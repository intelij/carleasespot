<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFrmRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|confirmed|min:6',
        ];
        if($this->user || $this->dealer){
            $uuid = $this->user ? $this->user : $this->dealer;
            $rules['email'] .= ','.$uuid.',uuid';
        }
        else{
            $rules['password'] .= '|required';
        }
        return $rules;
    }
}
