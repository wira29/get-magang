@extends('dashboard.layout.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman Sekolah</h1>

        <div class="row">
            <div class="col-12">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <h5 class="card-title mb-0">Edit Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('school.update', $school->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nama Sekolah</label>
                                    <input type="text" value="{{ $school->school_name }}" name="school_name" class="form-control" placeholder="SMK Negeri 1 Konoha" >
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" value="{{ $school->email }}" name="email" class="form-control" placeholder="smkn1konoha@gmail.com" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" value="{{ $school->contact }}" name="contact" class="form-control" placeholder="083xxxxxxxxx" >
                                </div>
                                
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="address" rows="4" placeholder="alamat...">{{ $school->address }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection