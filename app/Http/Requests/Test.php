<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Test extends FormRequest
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
            'status' => [
                'required',
                'in:C,S'
            ],
            'name' => [
                'required',
            ],
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            'remain_count' => [
                'required',
                'integer',
                'min:0',
            ]
        ];
    }
}
