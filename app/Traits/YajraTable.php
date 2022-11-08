<?php

namespace App\Traits;

use Carbon\Carbon;
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
            ->addColumn('status', function ($data) {
                return view('dashboard.students.status', compact('data'));
            })
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
            ->editColumn('created_at', function ($data) {
                return date('d F Y', $data->ccreated_at);
            })
            ->addColumn('action', function ($data) {
                return view('dashboard.journals.datatables', compact('data'));
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

    public function AttendanceMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->editColumn('present', function ($data) {
                $attendances = $data->attendances?->first();
                return view('dashboard.attendances.status.present', compact('attendances'));
            })
            ->editColumn('break', function ($data) {
                $attendances = $data->attendances?->first()?->detail_attendances;
                return view('dashboard.attendances.status.break', compact('attendances'));
            })
            ->editColumn('return_break', function ($data) {
                $attendances = $data->attendances?->first()?->detail_attendances;
                return view('dashboard.attendances.status.return_break', compact('attendances'));
            })
            ->editColumn('return', function ($data) {
                $attendances = $data->attendances?->first()?->detail_attendances;
                return view('dashboard.attendances.status.return', compact('attendances'));
            })
            ->addColumn('action', function ($data) {
                return view('dashboard.attendances.datatables', compact('data'));
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

    public function MyAttendanceMockup($collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.attendances.status.myAttendance', compact('data'));
            })
            ->toJson();
    }
}
