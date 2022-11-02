<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JournalService;
use App\Models\Dashboard\Journal;
use App\Http\Requests\JournalRequest;

class JournalController extends Controller
{
    private JournalService $service;

    public function __construct(JournalService $service)
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
        if (request()->ajax()) return $this->service->handleGetAll(auth()->user()->student->id);
        return view('dashboard.journals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.journals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JournalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JournalRequest $request)
    {
        $this->service->handleStoreJournal($request, auth()->user()->student->id);

        return response()->json(['message' => 'Berhasil menambahkan jurnal!']);
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
     * @param  Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        return view('dashboard.journals.edit', compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  JournalRequest  $request
     * @param  Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(JournalRequest $request, Journal $journal)
    {
        $this->service->handleStoreJournal($request, $journal->id);

        return response()->json(['message' => 'Berhasil mengedit jurnal!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        $destroy = $this->service->handleDeleteJournal($journal->id);

        if (!$destroy) return back()->with('errors', 'Gagal menghapus jurnal!');

        return back()->with('success', 'Berhasil menghapus jurnal!');
    }
}
