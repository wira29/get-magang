<?php 

namespace App\Repositories;

use App\Models\Dashboard\School;

class SchoolRepository extends BaseRepository
{
    public function __construct(School $school)
    {
        $this->model = $school;
    }
}