<?php 

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository extends BaseRepository
{
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    /**
     * handle update or create attendance
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

    /**
     * get attendance by date
     * 
     * @param string $userId
     * @param string $date
     * 
     * @return object|null
     */
    public function getAttendanceByDate(string $userId, string $date): object|null
    {
        return $this->model->where('student_id', $userId)
            ->where('created_at', 'like', '%'.$date.'%')
            ->first();
    }
}