<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'  => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->users)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->users)]
        ];
    }

    /**
     * custom messages
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.unique'   => 'Username telah digunakan',
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique'   => 'Email telah digunakan',
        ];
    }
}
