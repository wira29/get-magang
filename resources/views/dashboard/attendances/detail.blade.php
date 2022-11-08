@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Detail Absensi</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>{{ $student->student_name }}</h3>
                                        <span class="badge {{ $bg[$student->attendances[0]->status] }}" >{{ $student->attendances[0]->status }}</span>
                                    </div>
                                    <div class="col-6 d-flex flex-column align-items-end">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Edit Status</button>

                                        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('attendance.editAttendance', $student->attendances[0]->id) }}" method="POST">
                                                    @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body m-3">
                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-control" name="status" id="">
                                                                    <option {{ $student->attendances[0]->status == 'masuk' ? 'selected' : '' }} value="masuk">Masuk</option>
                                                                    <option {{ $student->attendances[0]->status == 'izin' ? 'selected' : '' }} value="izin">Izin</option>
                                                                    <option {{ $student->attendances[0]->status == 'sakit' ? 'selected' : '' }} value="sakit">Sakit</option>
                                                                    <option {{ $student->attendances[0]->status == 'alpha' ? 'selected' : '' }} value="alpha">Alpha</option>
                                                                </select>
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
                            </div>
                            <div class="col-12 my-3">
                                <strong>Absensi</strong>
                                <ul class="timeline mt-2 mb-0">
                                    @foreach($student->attendances[0]->detail_attendances as $detail)
                                    <li class="timeline-item">
                                        <strong style="display: block;">{{ $detail->status }}</strong>
                                        <span class="float-end text-muted text-sm">pukul {{ date('H:i', strtotime($detail->created_at)) }}</span>
                                        @if ($detail->photo)
                                            <img src="{{ asset('storage/' . $detail->photo) }}" alt="" width="250">
                                            <p>photo saat absensi</p>
                                        @else
                                            <p>photo tidak ditemukan .</p> 
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
