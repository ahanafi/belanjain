<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nama' => 'required|max:50',
            'level' => 'required',
        ];

        if($this->getMethod() == 'POST'){
            $rules += [
                'password' => 'required|min:8|confirmed',
                'email' => 'required|max:50|unique:users,email',
            ];
        }

        if($this->getMethod() == 'PATCH'){
            $user_id = $this->route('user')->id;

            $rules += [
                'email' => 'required|max:50|unique:users,email,'.$user_id,
            ];

            if($this->password != null){
                $rules += ['password' => 'required|min:8|confirmed'];
            }
        }

        return $rules;
    }
}
