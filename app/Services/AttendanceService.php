<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttendanceRepository;
use App\Repositories\DetailAttendanceRepository;
use Illuminate\Http\Exceptions\HttpResponseException;

class AttendanceService
{
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

        throw_if(!$action, response()->json(['status' => 'Gagal', 'message' => 'Jam absensi tidak tersedia']));

        if (!$action->wasRecentlyCreated) {
            return response()->json(['status' => 'Gagal', 'message' => 'Anda telah absensi pada jam ini']);
        }

        $action->update([
            'photo' => $request->file('photo')->store('attendance_photo', 'public')
        ]);

        return response()->json(['status' => 'Berhasil', 'message' => 'Berhasil absensi']);
    }
}
