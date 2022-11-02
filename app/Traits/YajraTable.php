<?php 

namespace App\Traits;

use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;

trait YajraTable 
{
    /**
     * Datatable mockup for school resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function SchoolMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.schools.datatables', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Datatable mockup for student resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function StudentMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.students.datatables', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Datatable mockup for journal resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function JournalMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->editColumn('created_at', function($data){
                return date('d F Y', $data->ccreated_at);
            })
            ->addColumn('action', function ($data) {
                return view('dashboard.journals.datatables', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}