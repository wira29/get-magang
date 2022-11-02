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
                        <h5 class="card-title mb-0">Tambah Siswa</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('student.store') }}"
                            method="POST"
                        >
                            @method('POST') @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">RFID</label>
                                    <input
                                        type="text"
                                        value="{{ old('rfid') }}"
                                        name="rfid"
                                        class="form-control"
                                        placeholder="Scan Kartu"
                                        autofocus
                                        id="rfid"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input
                                        type="text"
                                        value="{{ old('student_name') }}"
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
                                                <option value="{{ $school->id }}" {{ (old('school_id') == $school->id) ? 'selected' : '' }}>{{ $school->school_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label"
                                        >Jenis Kelamin</label
                                    >
                                    <label class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            value="male"
                                            name="gender"
                                            {{ (old('gender') == 'male') ? 'checked' : '' }}
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
                                            {{ (old('gender') == 'female') ? 'checked' : '' }}
                                        />
                                        <span class="form-check-label">
                                            Perempuan
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

        $('#rfid').keydown(function(e) {
            if(e.keyCode == 13){
                e.preventDefault();
                $("input[name='student_name']").focus()
                $(this).attr('readonly', true)
                return false;
            }
        })
    });
</script>
@endsection
