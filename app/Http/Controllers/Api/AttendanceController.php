<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private AttendanceService $service;

    public function __construct(AttendanceService $service) 
    {
        $this->service = $service;
    }

    /**
     * attendance student
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function attendance(Request $request): JsonResponse
    {
        if($request->hasFile('photo')){
            return $this->service->handleAttendance($request);
        }

        return response()->json(['status' => 'Gagal', 'message' => 'Ulangi absen anda!' ]);
    }
}
