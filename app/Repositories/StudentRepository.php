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
     * get all Attendances for yajra table
     * 
     * @return mixed
     */

    public function getAllAttendances(): mixed
    {
        return $this->model->query()
            ->with(['school', 'attendances' => function ($q) {
                return $q->whereDate('created_at', now()->format('Y-m-d'))
                    ->with('detail_attendances');
            }])
            ->get();
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

    /**
     * get attendance by id
     * 
     * @param string $id
     * @param string $date
     * 
     * @return object|null
     */

    public function getAttendanceByStudentId(string $id, string $date): object|null
    {
        return $this->model->query()
            ->with(['attendances' => function ($q) use ($date) {
                $q->whereDate('created_at', $date);
            }, 'attendances.detail_attendances'])
            ->where('id', $id)
            ->first();
    }

    /**
     * get attendance by id
     * 
     * @param string $id
     * @param string $date
     * 
     * @return object|null
     */

    public function getStudentAttendanceToday(string $id, string $date): object|null
    {
        return $this->model->query()
            ->with('attendances', function ($q) use ($date) {
                $q->whereDate('created_at', $date)
                    ->with('detail_attendances');
            })
            ->where('user_id', $id)
            ->first();
    }
}
