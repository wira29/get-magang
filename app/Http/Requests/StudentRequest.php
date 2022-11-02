<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        if(request()->routeIs('student.store')){
            return [
                'student_name' => 'required',
                'gender'    => 'required',
                'school_id' => 'required',
                'rfid'      => 'required|unique:students,rfid'
            ];
        }
        else if(request()->routeIs('student.update')){
            return [
                'student_name' => 'required',
                'gender'    => 'required',
                'school_id' => 'required',
                'rfid'      => ['required', Rule::unique('students', 'rfid')->ignore($this->student->id)]
            ];
        }
    }

    /**
     * custom messages
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            'student_name.required' => 'Nama siswa tidak boleh kosong!',
            'gender.required'       => 'Jenis kelamin tidak boleh kosong!',
            'school_id.required'    => 'Sekolah tidak boleh kosong!',
            'rfid.required'    => 'RFID tidak boleh kosong!',
            'rfid.unique'    => 'RFID sudah digunakan!'
        ];
    }
}
