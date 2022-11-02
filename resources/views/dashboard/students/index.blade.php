@extends('dashboard.layout.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman Siswa</h1>

        <div class="row">
            <div class="col-12">
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
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Sekolah</th>
                                <th>Aksi</th>
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
    document.addEventListener("DOMContentLoaded", function () {
        $(document).on('click', '.delete', function () {
            $('#exampleModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('student.destroy', ':id') }}`.replace(':id', id);
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
            ajax: "{{ route('student.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'student_name',
                    name: 'student_name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'school.school_name',
                    name: 'school.school_name'
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