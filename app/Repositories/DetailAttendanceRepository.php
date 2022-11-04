<?php 

namespace App\Repositories;

use App\Models\DetailAttendance;

class DetailAttendanceRepository extends BaseRepository
{
    public function __construct(DetailAttendance $model)
    {
        $this->model = $model;
    }

    /**
     * update or create detail attendance
     * 
     * @param array $condition
     * @param array $data
     * 
     * @return mixed
     */
    public function updateOrCreate(array $condition, array $data): mixed
    {
        return $this->model->updateOrCreate($condition, $data);
    }
}