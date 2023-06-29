<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\StudentRepository;
use App\Repositories\AttendanceRepository;
use App\Repositories\DetailAttendanceRepository;
use App\Traits\YajraTable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Storage;

class AttendanceService
{
    use YajraTable;

    private AttendanceRepository $repository;
    private StudentRepository $studentRepository;
    private DetailAttendanceRepository $detailAttendanceRepository;

    public function __construct(AttendanceRepository $repository, StudentRepository $studentRepository, DetailAttendanceRepository $detailAttendanceRepository)
    {
        $this->repository = $repository;
        $this->studentRepository = $studentRepository;
        $this->detailAttendanceRepository = $detailAttendanceRepository;
    }

    /**
     * handle submit attendance student
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function handleAttendance(Request $request): JsonResponse
    {
        $now = now()->format('H:i:s');

        $student = $this->studentRepository->getStudentByRfid($request->rfid);

        if (!$attendance = $this->repository->getAttendanceByDate($student->id, now()->format('Y-m-d'))) {

            $attendance = $this->repository->store([
                'student_id' => $student->id
            ]);
        }

        $action = $this->detailAttendanceRepository->doAttendance($attendance->id, $now);

        if (!$action) {
            throw new HttpResponseException(response()->json(['status' => 'Gagal', 'message' => 'Jam absensi tidak tersedia']));
        }

        if (!$action->wasRecentlyCreated) {
            throw new HttpResponseException(response()->json(['status' => 'Gagal', 'message' => 'Anda telah absensi pada jam ini']));
        }

        $action->update([
            'photo' => $request->file('photo')->store('attendance_photo', 'public')
        ]);

        return response()->json(['status' => 'Berhasil', 'message' => 'Berhasil absensi']);
    }

    /**
     * handle get attendance by id
     *
     * @param string $attendanceId
     * @return mixed
     */
    public function handleGetAttendanceById(string $attendanceId): mixed
    {
        return $this->repository->getById($attendanceId);
    }

    /**
     * handle get attendance by student
     *
     * @param Request $request
     * @return mixed
     */
    public function handleGetAttendanceByStudent(Request $request): mixed
    {
        return $this->repository->getAttendanceByStudent($request);
    }

    /**
     * handle edit status
     *
     * @param Request $request
     * @param string $id
     *
     * @return void
     */
    public function handleEditStatus(Request $request, string $id): void
    {

        $data = [
            'status' => $request->status,
        ];

        $this->repository->update($id, $data);
    }

    /**
     * handle update status by admin
     *
     * @param Request $request
     *
     * @return void
     */
    public function handleUpdateStatusByAdmin(Request $request): void
    {
        $data = [
            'student_id' => $request->student_id,
            'status'    => $request->status
        ];

        if (!$attendance = $this->repository->getAttendanceByDate($request->student_id, now()->format('Y-m-d'))) {

            $this->repository->store($data);
        } else {
            $this->repository->update($attendance->id, $data);
        }
    }

    /**
     * handle get my attendance
     *
     * @param Request $request
     *
     * @return mixed
     */

    public function handleGetMyAttendances(): mixed
    {
        return $this->MyAttendanceMockup($this->repository->getMyAttendance());
    }

    /**
     * handle delete directory
     *
     * @return void
     */
    public function handleDeleteDirectory(): void
    {
        Storage::disk('public')->deleteDirectory('attendance_photo');
    }
}
