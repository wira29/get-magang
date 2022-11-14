<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    private AttendanceService $service;

    public function __construct(AttendanceService $service)
    {
        $this->service = $service;
    }

    /**
     * edit status function
     * 
     * @param Request $request
     * @param Attendance $attendance
     */
    public function editStatus(Request $request, Attendance $attendance)
    {
        $this->service->handleEditStatus($request, $attendance->id);

        return back();
    }

    /**
     * update attendace by admin function
     * 
     * @param Request $request
     */

    public function updateAttendanceByAdmin(Request $request)
    {
        $this->service->handleUpdateStatusByAdmin($request);
        return back()->with('success', 'Berhasil mengedit absensi siswa !');
    }
    
    /**
     * get my attendance 
     * 
     * @param Request $request
     */

    public function myAttendance(Request $request): mixed
    {
        if ($request->ajax()) return $this->service->handleGetMyAttendances();

        return view('dashboard.attendances.my-attendance');
    }

    /**
     * delete directory
     */
    public function deleteDirectory()
    {
        $this->service->handleDeleteDirectory();
        return back()->with('success', 'Berhasil menghapus foto absensi !');
    }
}
