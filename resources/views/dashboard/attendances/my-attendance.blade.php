@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Riwayat Absensi</h1>

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
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

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
                ajax: "{{ route('myAttendance') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }, {
                        data: 'status',
                        name: 'status'
                    }
                ]
            });
        });
    </script>
@endsection
