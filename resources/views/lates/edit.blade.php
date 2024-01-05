@extends('layouts.template')
@section('content')
    <div class="container mt-1">
        <div class="text-dark">
            <h1>Update Data Keterlambatan</h1>
            <p>Home / <a class="text-dark" href="{{ route('lates.index') }}">Data Keterlambatan</a> / Update Data
                Keterlambatan</p>
        </div>
        <a href="{{ route('lates.index') }}">
            <button type="submit" class="btn btn-info mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                </svg>
                Back
            </button>
        </a>
        <div class="card bg-primary-subtle mt-3 p-4">
            <h3>Form Update Data Keterlambatan</h3>
            <form action="{{ route('lates.update', $lates['id']) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                @if (Session::get('success'))
                    <div class="alert">{{ Session::get('success') }}</div>
                @endif
                @if ($errors->any())
                    <ul>
                        <li>
                            @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
                </li>
                </ul>
                @endif
                <label for="student_id" class="mt-3 mb-3">Siswa :</label>
                <select class="form-select" aria-label="Default select example" name="student_id">
                    @foreach ($students as $item)
                        @if ($item['id'] === $lates['student_id'])
                            <option value="{{ $lates['student_id'] }}">{{ $item['name'] }}</option>
                        @else
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="exampleInputEmail1" class="form-label mt-3 mb-3">Tanggal Keterlambatan :</label>
                <input type="datetime-local" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="date_time_late" value="{{ $lates['date_time_late'] }}">

                <label for="exampleFormControlTextarea1" class="form-label mt-3 mb-3">Informasi :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="information">{{ $lates['information'] }}</textarea>

                <div class="mt-3">
                    <label for="formFile" class="form-label">Bukti :</label>
                    <input class="form-control" type="file" id="bukti" name="bukti" value="{{ $lates['bukti'] }}">
                    <label for="" class="" style="margin-right: 20px;">Bukti Sebelumnya :</label>
                    <img src="{{ asset('images/' . $lates['bukti']) }}"
                        style="width: 100px; height:auto; margin-bottom:20px;" class="img-fluid rounded-start mt-4"
                        alt="">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Data Keterlambatan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
