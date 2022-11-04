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
     * @param string $attendance_id
     * @param array $data
     * @param mixed $time
     * 
     * @return mixed
     */
    public function doAttendance(string $attendance_id, mixed $time): mixed
    {
        if ($time >= '07:00:00' && $time <= '09:00:00') {
            return $this->model->query()
                ->updateOrCreate(
                    ['attendance_id' => $attendance_id, 'status' => 'present'],
                    ['status' => 'present']
                );
        } else if ($time >= '11:30:00' && $time <= '12:30:00') {
            return $this->model->query()
                ->updateOrCreate(
                    ['attendance_id' => $attendance_id, 'status' => 'break'],
                    ['status' => 'break']
                );
        } else if ($time >= '12:30:00' && $time <= '13:30:00') {
            return $this->model->query()
                ->updateOrCreate(
                    ['attendance_id' => $attendance_id, 'status' => 'return_break'],
                    ['status' => 'return_break']
                );
        } else if ($time >= '15:30:00' && $time <= '16:00:00') {
            return $this->model->query()
                ->updateOrCreate(
                    ['attendance_id' => $attendance_id, 'status' => 'return'],
                    ['status' => 'return']
                );
        }

        return null;
    }
}
