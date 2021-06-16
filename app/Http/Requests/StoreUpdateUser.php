<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
        $userId = $this->segment(3);

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'min:3', 'email', 'max:255', "unique:users,email,{$userId},id"],
            'password' => ['required', 'string', 'min:6', 'max:50'],
        ];
        
        if($this->isMethod("PUT")) {
            $rules['password'] = ['nullable', 'string', 'min:6', 'max:50'];
        }

        return $rules;
    }
}
