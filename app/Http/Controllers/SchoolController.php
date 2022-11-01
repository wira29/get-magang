<?php

namespace App\Http\Controllers;

use App\Http\Requests\School\CreateRequest;
use App\Http\Requests\School\UpdateRequest;
use App\Models\Dashboard\School;
use App\Services\SchoolService;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private SchoolService $service;

    public function __construct(SchoolService $service)
    {
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
        return view('dashboard.schools.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->service->handleStoreSchool($request);

        return to_route('school.index')->with('success', 'Berhasil menambahkan sekolah!');
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
     * @param  School $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('dashboard.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, School $school)
    {
        $this->service->handleUpdateSchool($request, $school->id);

        return to_route('school.index')->with('success', 'Berhasil mengedit sekolah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $destroy = $this->service->handleDeleteSchool($school->id);

        if (!$destroy) return back()->with('errors', 'Gagal menghapus sekolah!');

        return back()->with('success', 'Berhasil menghapus sekolah!');
    }
}
