<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required',
            'description' => 'required'
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
            'title.required'        => 'Judul tidak boleh kosong!',
            'description.required'  => 'Deskripsi tidak boleh kosong!'
        ];
    }
}
