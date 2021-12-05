<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
        $id = request()->getMethod() === 'PUT' ? request()->segment(2) : null;

        return [
            'name' => 'required|unique:customers,name,' . $id,
            'phone' => 'required|min:10'
        ];
    }
}
