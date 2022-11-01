<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Dashboard\School;
use App\Models\Dashboard\Student;
use App\Services\SchoolService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private SchoolService $schoolService;
    private StudentService $service;

    public function __construct(SchoolService $schoolService, StudentService $service)
    {
        $this->schoolService = $schoolService;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) return $this->service->handleGetAll();
        return view('dashboard.students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'schools'   => $this->schoolService->handleGetAllSchool()
        ];
        return view('dashboard.students.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $this->service->handleStoreStudent($request);

        return to_route('student.index')->with('success', 'Berhasil menambahkan siswa!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $data = [
            'student'   => $student,
            'schools'   => $this->schoolService->handleGetAllSchool()
        ];
        return view('dashboard.students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentRequest  $request
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $this->service->handleUpdateStudent($request, $student->id);

        return to_route('student.index')->with('success', 'Berhasil mengedit siswa!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $destroy = $this->service->handleDeleteStudent($student->id);

        if (!$destroy) return back()->with('errors', 'Gagal menghapus siswa!');

        return back()->with('success', 'Berhasil menghapus siswa!');
    }
}
