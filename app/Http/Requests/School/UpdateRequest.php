<?php

namespace App\Http\Requests\School;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'school_name'   => 'required',
            'email'         => ['required', Rule::unique('schools')->ignore($this->school)],
            'contact'       => 'required|numeric',
            'address'       => 'required'
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
            'school_name.required'  => 'Nama sekolah tidak boleh kosong!',
            'email.required'        => 'Email tidak boleh kosong!',
            'email.unique'          => 'Email sudah digunakan!',
            'contact.required'      => 'Kontak harus diisi!',
            'contact.numeric'       => 'Kontak harus berupa angka!',
            'address.required'      => 'Alamat tidak boleh kosong!'
        ];
    }
}
