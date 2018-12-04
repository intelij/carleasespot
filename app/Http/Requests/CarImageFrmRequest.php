<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarImageFrmRequest extends FormRequest
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
            'make' => 'required',
            'model' => 'required',
            'trim' => 'required',
        ];
        return $rules;
    }
}
