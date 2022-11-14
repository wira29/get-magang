<?php

namespace App\Http\Controllers;

use App\Services\StudentService;

class HomeController extends Controller
{
    private StudentService $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StudentService $studentService)
    {
        $this->service = $studentService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $attendances = $this->service->handleStudentAttendanceToday(auth()->id());
        if ($attendances) {
            $attendances = $attendances->attendances?->first();
        }
        return view('dashboard.index', compact('attendances'));
    }
}
