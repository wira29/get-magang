<?php

namespace App\Repositories;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceRepository extends BaseRepository
{
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    /**
     * get by id
     *
     * @param string $id
     * @return mixed
     */
    public function getById(string $id): mixed
    {
        return $this->model->query()
            ->where('id', $id)
            ->first();
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
        return $this->model->query()
            ->where(['student_id' => $userId])
            ->whereDate('created_at', $date)
            ->first();
    }

    /**
     * get attendance by student
     *
     * @param Request $request
     * @return mixed
     */
    public function getAttendanceByStudent(Request $request): mixed
    {
        $daterange = explode('-', $request->daterange);
        $daterange[0] = Carbon::parse(trim($daterange[0]))->format('Y-m-d');
        $daterange[1] = Carbon::parse(trim($daterange[1]))->format('Y-m-d');
        return $this->model->query()
                ->with('detail_attendances')
                ->where('student_id', $request->student_id)
                ->whereBetween('created_at', ["$daterange[0] 00:00:00", "$daterange[1] 23:59:59"])
                ->get();
    }

    /**
     * get my attendance
     *
     * @param string $userId
     * @param string $date
     *
     * @return object|null
     */

    public function getMyAttendance(): object
    {
        return $this->model->query()
            ->select('attendances.id', 'attendances.created_at', 'student_id', 'attendances.status')
            ->join('students', 'students.id', '=', 'attendances.student_id')
            ->where('user_id', auth()->id())
            ->latest();
    }
}
