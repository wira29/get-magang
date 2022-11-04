<?php

namespace App\Repositories;

use App\Models\Dashboard\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentRepository extends BaseRepository
{
    public function __construct(Student $student)
    {
        $this->model = $student;
    }

    /**
     * get all student for yajra table
     * 
     * @return mixed
     */
    public function getAllStudent(): mixed
    {
        return $this->model->query()
            ->with('school');
    }

    /**
     * get student by rfid
     * 
     * @param string $rfid
     * 
     * @return object|null
     */
    public function getStudentByRfid(string $rfid): object|null
    {
        try {
            return $this->model->where('rfid', $rfid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(
                response()->json(['status' => 'Gagal', 'message' => 'Siswa tidak ditemukan!'])
            );
        }
    }
}
