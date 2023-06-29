<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Services\AttendanceService;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchAttendanceController extends Controller
{
    private StudentService $studentService;
    private AttendanceService $attendanceService;

   public function __construct(StudentService $studentService, AttendanceService $attendanceService)
   {
       $this->studentService = $studentService;
       $this->attendanceService = $attendanceService;
   }

    public function index(Request $request)
    {
        $bg = [
            'masuk' => 'bg-success',
            'izin'  => 'bg-warning',
            'sakit' => 'bg-warning',
            'alpha' => 'bg-danger'
        ];
        $data = [
            'students' => $this->studentService->handleGetAllStudent(),
            'bg' => $bg,
        ];

        if(isset($request->student_id)){
            $data['attendances'] = $this->attendanceService->handleGetAttendanceByStudent($request);
        }
        return view('dashboard.searchAttendance.index', $data);
    }

    public function detailAttendance(Attendance $attendance): View
    {
        $bg = [
            'masuk' => 'bg-success',
            'izin'  => 'bg-warning',
            'sakit' => 'bg-warning',
            'alpha' => 'bg-danger'
        ];
        $data = [
            'attendance' => $this->attendanceService->handleGetAttendanceById($attendance->id),
            'bg' => $bg
        ];
        return view('dashboard.searchAttendance.detail', $data);
    }
}
