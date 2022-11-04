@extends('dashboard.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Halaman Siswa</h1>

        <div class="row">
            <div class="col-12">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                    <div class="alert-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Siswa</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('student.update', $student->id) }}"
                            method="POST"
                        >
                            @method('PATCH') @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">RFID</label>
                                    <input
                                        type="text"
                                        value="{{ $student->rfid }}"
                                        name="rfid"
                                        class="form-control"
                                        placeholder="Scan Kartu"
                                        readonly
                                        id="rfid"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input
                                        type="text"
                                        value="{{ $student->student_name }}"
                                        name="student_name"
                                        class="form-control"
                                        placeholder="John Doe"
                                    />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sekolah</label>
                                    <div class="mb-3">
                                        <select
                                            class="form-control select2"
                                            data-toggle="select2"
                                            name="school_id"
                                        >
                                            @foreach($schools as $school)
                                                <option value="{{ $school->id }}" {{ ($student->school_id == $school->id) ? 'selected' : '' }}>{{ $school->school_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"
                                        >Jenis Kelamin</label
                                    >
                                    <label class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            value="male"
                                            name="gender"
                                            {{ ($student->gender == 'male') ? 'checked' : '' }}
                                        />
                                        <span class="form-check-label">
                                            Laki-Laki
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            value="female"
                                            name="gender"
                                            {{ ($student->gender == 'female') ? 'checked' : '' }}
                                        />
                                        <span class="form-check-label">
                                            Perempuan
                                        </span>
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"
                                        >Status</label
                                    >
                                    <label class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            value="aktif"
                                            name="status"
                                            {{ ($student->status == 'aktif') ? 'checked' : '' }}
                                        />
                                        <span class="form-check-label">
                                            Aktif
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            value="nonaktif"
                                            name="status"
                                            {{ ($student->status == 'nonaktif') ? 'checked' : '' }}
                                        />
                                        <span class="form-check-label">
                                            Nonaktif
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            <button
                                type="reset"
                                class="btn btn-outline-secondary"
                            >
                                Reset
                            </button>
                        </form>
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
        // Select2
        $(".select2").each(function() {
            $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
        })
    });
</script>
@endsection
