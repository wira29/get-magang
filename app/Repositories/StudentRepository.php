<?php 

namespace App\Repositories;

use App\Models\Dashboard\Student;

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
        return $this->model->where('rfid', $rfid)->first();
    }
}