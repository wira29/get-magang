@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Absensi Siswa</h1>

            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <x-alert-success></x-alert-success>
                    @elseif(session('errors'))
                        <x-alert-failed></x-alert-failed>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-12 d-flex flex-column align-items-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Tambah Absensi</button>

                                    <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('updateByAdmin') }}" method="POST">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Absensi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label class="form-label">Siswa</label>
                                                                <select
                                                                    class="form-control select2"
                                                                    data-toggle="select2"
                                                                    name="student_id"
                                                                >
                                                                    @foreach($students as $student)
                                                                        <option value="{{ $student->id }}" {{ (old('student_id') == $student->id) ? 'selected' : '' }}>{{ $student->student_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="masuk">Masuk</option>
                                                                    <option value="izin">Izin</option>
                                                                    <option value="sakit">Sakit</option>
                                                                    <option value="alpha">Alpha</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="datatables-responsive" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Siswa</th>
                                        <th>Sekolah</th>
                                        <th>Masuk</th>
                                        <th>Istirahat</th>
                                        <th>Kembali</th>
                                        <th>Pulang</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
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
            $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })

            $(document).on('click', '.delete', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('journal.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
            // Datatables Responsive
            $("#datatables-responsive").DataTable({
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: false,
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('attendance.today') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'student_name',
                        name: 'student_name'
                    },
                    {
                        data: 'school.school_name',
                        name: 'school.school_name'
                    },
                    {
                        data: 'present',
                        name: 'present'
                    },
                    {
                        data: 'break',
                        name: 'break'
                    },
                    {
                        data: 'return_break',
                        name: 'return_break'
                    },
                    {
                        data: 'return',
                        name: 'return'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
