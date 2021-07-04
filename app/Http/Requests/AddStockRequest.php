<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStockRequest extends FormRequest
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
            'ownerId' => 'required|numeric',
            'name' => 'required|min:2',
            'color' => 'required|min:3|max:255',
            'size' => 'required',
            'vendorCode' => 'required',
            'count' => 'required|numeric|min:1'
        ];
    }
}
