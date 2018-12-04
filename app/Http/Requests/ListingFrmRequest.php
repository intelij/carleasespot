<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ListingFrmRequest extends FormRequest
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
            'make' => 'required',
            'model' => 'required',
            'down_payment' => 'required',
            'mileage' => 'required',
            'type' => 'required',
            'year' => 'required',
            'state' => 'required',
        ];
        if($this->type == 2){
            $rules['sell_price'] = 'required';
            $rules['price'] = 'required';
        }elseif($this->type == 1){
            $rules['sell_price'] = 'required';
        }else{
            $rules['price'] = 'required';
        }
        return $rules;
    }
}
