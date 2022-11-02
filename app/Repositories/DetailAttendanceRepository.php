<?php 

namespace App\Repositories;

use App\Models\DetailAttendance;

class DetailAttendanceRepository extends BaseRepository
{
    public function __construct(DetailAttendance $model)
    {
        $this->model = $model;
    }
}