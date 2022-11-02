@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Selamat Datang, {{ auth()->user()->name }}</h1>

            <div class="row">
                <div class="col-md-4">
                    @if (auth()->user()->role->role_name === 'siswa')
                        @if (!auth()->user()->github)
                            <div class="card bg-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Link Github belum dikaitkan!</h5>
                                </div>
                            </div>
                        @else
                            <div class="card bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Link Github berhasil dikaitkan!</h5>
                                    <p class="card-text text-white">url : {{ auth()->user()->github }}</p>
                                </div>
                            </div>
                        @endif
                    @endif


                </div>
            </div>

        </div>
    </main>
@endsection
