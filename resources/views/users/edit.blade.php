@extends('layouts.template')

@section('content')
    <div class="container mt-3">

        <div class="text-dark">
            <h1>Update Data User</h1>
            <p>Home / <a class="text-dark" href="{{ route('users.index') }}">Data User</a> / Update User</p>
        </div>

        <form action="{{ route('users.update', $user['id']) }}" method="POST" class="card bg-primary-subtle p-5">
            @csrf
            @method('PATCH')

            @if ($errors->any())
                <div class="alert alert-danger p-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="mb-5">Form Update Data User</h1>

            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control bg-secondary-subtle" name="name" id="name"
                        value="{{ $user->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control bg-secondary-subtle" name="email" id="email"
                        value="{{ $user->email }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role :</label>
                <div class="col-sm-10">
                    <select class="form-select" name="role" id="role" required>
                        <option value="" selected disabled hidden>Pilih</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="ps" {{ $user->role == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password :</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control bg-light-subtle" name="password" id="password"
                        value="">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Ubah Data Rombel</button>
        </form>
        <a href="{{ route('users.index') }}">
            <button type="submit" class="btn bg-info-subtle mt-1"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                </svg> Back To Table User</button>
        </a>
    </div>
@endsection
