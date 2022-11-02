@extends('dashboard.layout.app') @section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Profile</h1>

            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <x-alert-success></x-alert-success>
                    @endif
                    @if ($errors->any())
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
                            <h5 class="card-title mb-0">Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form id="form" action="{{ route('profile.update', $user->id) }}" method="POST">
                                @method('POST') @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" value="{{ $user->name }}" name="name"
                                            class="form-control" placeholder="Nama" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" value="{{ $user->username }}" name="username"
                                            class="form-control" placeholder="Username" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="mb-3">
                                            <input type="email" value="{{ $user->email }}" name="email"
                                                class="form-control" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Link Repository Github</label>
                                        <div class="mb-3">
                                            <input autocomplete="off" type="text" value="{{ $user->github }}"
                                                name="github" class="form-control"
                                                placeholder="https://github.com/Yudas1337/repository" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    Reset
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Reset Password</h5>
                        </div>
                        <div class="card-body">
                            <form id="form" action="{{ route('profile.reset-password') }}" method="POST">
                                @method('POST') @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Password Lama</label>
                                        <input type="password" value="{{ old('old_password') }}" name="old_password"
                                            class="form-control" placeholder="Password Lama" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" value="{{ old('password') }}" name="password"
                                            class="form-control" placeholder="Password Baru" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <div class="mb-3">
                                            <input type="password" value="{{ old('password_confirmation') }}"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi Password" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
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

            $('#form').on('reset', function() {
                $('#rfid').attr('readonly', false)
                $('#rfid').focus()
            })

            $('#rfid').keydown(function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    $("input[name='student_name']").focus()
                    $(this).attr('readonly', true)
                    return false;
                }
            })
        });
    </script>
@endsection
