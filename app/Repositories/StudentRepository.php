<?php 

namespace App\Repositories;

use App\Models\Dashboard\Student;

class StudentRepository extends BaseRepository
{
    public function __construct(Student $student)
    {
        $this->model = $student;
    }
}