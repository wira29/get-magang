<?php 

namespace App\Repositories;

use App\Models\Dashboard\School;

class SchoolRepository extends BaseRepository
{
    public function __constructc(School $school)
    {
        $this->model = $school;
    }
}