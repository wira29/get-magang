@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Cari Absensi Siswa</h1>

            <div class="row">
                <div class="col-4">
                    <form action="{{ route('searchAttendance.index') }}" method="GET">
                        <div class="card">
                            <div class="card-header">
                                <h4>Cari Siswa</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Siswa</label>
                                        <div class="mb-3">
                                            <select
                                                class="form-control select2"
                                                data-toggle="select2"
                                                name="student_id"
                                            >
                                                @foreach($students as $student)
                                                    <option value="{{ $student->id }}" {{ (request()->student_id == $student->id) ? 'selected' : '' }}>{{ $student->student_name }} ({{$student->school->school_name}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input class="form-control" type="text" value="{{ request()->daterange }}" name="daterange" />
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-search me-2"></i> Cari Siswa</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-8">
                    @if (session('success'))
                        <x-alert-success></x-alert-success>
                    @elseif(session('errors'))
                        <x-alert-failed></x-alert-failed>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-responsive" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($attendances))
                                    @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($attendance->created_at)->format('d F Y') }}</td>
                                        <td><span class="badge {{ $bg[$attendance->status] }}" >{{ $attendance->status }}</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Opsi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('searchAttendance.detail', $attendance->id) }}">Detail </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-delete-modal></x-delete-modal>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select2
            $(".select2").each(function () {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })

            // Daterangepicker
            $("input[name=\"daterange\"]").daterangepicker({
                opens: "left"
            });
        })
    </script>
@endsection
