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
}