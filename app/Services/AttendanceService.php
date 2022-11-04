<?php 

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttendanceRepository;
use App\Repositories\DetailAttendanceRepository;

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
        $now = Carbon::now()->isoFormat('H:i:s');

        $student = $this->studentRepository->getStudentByRfid($request->rfid);

        if($student){
            $data = [
                'student_id'    => $student->id,
                'status'        => 'masuk',
            ];

            $attendance = $this->repository->getAttendanceByDate($student->id, Carbon::now()->isoFormat('Y-M-DD'));
            $photo = $request->file('photo')->store('attendance_photo', 'public');
            
            if(!$attendance){
                $attendance = $this->repository->store($data);
            }else{
                Storage::delete('public/' . $photo);
            }

    
            $dataDetail = [
                'attendance_id' => $attendance->id,
                'photo'     => $photo,
            ];

            $checkDetail = [
                'attendance_id' => $attendance->id
            ];

            if($now >= '07:00:00' && $now <= '08:15:00'){
                $dataDetail['status'] = 'present';
                $checkDetail['status'] = 'present';

                $this->detailAttendanceRepository->updateOrCreate($checkDetail, $dataDetail);

                return response()->json(['status' => 'Berhasil', 'message' => 'Berhasil absen masuk']);
            }
            else if($now >= '12:00:00' && $now <= '12:30:00'){
                $dataDetail['status'] = 'break';
                $checkDetail['status'] = 'break';

                $this->detailAttendanceRepository->updateOrCreate($checkDetail, $dataDetail);

                return response()->json(['status' => 'Berhasil', 'message' => 'Berhasil absen istirahat']);
            }
            else if($now >= '12:35:00' && $now <= '13:15:00'){
                $dataDetail['status'] = 'return_break';
                $checkDetail['status'] = 'return_break';

                $this->detailAttendanceRepository->updateOrCreate($checkDetail, $dataDetail);

                return response()->json(['status' => 'Berhasil', 'message' => 'Berhasil absen kembali dari istirahat']);
            }
            else if($now >= '16:00:00' && $now <= '18:00:00'){
                $dataDetail['status'] = 'return';
                $checkDetail['status'] = 'return';

                $this->detailAttendanceRepository->updateOrCreate($checkDetail, $dataDetail);

                return response()->json(['status' => 'Berhasil', 'message' => 'Berhasil absen pulang']);
            }else {
                Storage::delete('public/' . $photo);
                return response()->json(['status' => 'Gagal', 'message' => 'Absen diluar jam absensi']);
            }
        }
        
        return response()->json(['status' => 'Gagal', 'message' => 'Siswa tidak ditemukan!']);
    }
}