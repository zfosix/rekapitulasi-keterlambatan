@extends('layouts.template')

@section('content')
    <div class="container mx-6">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (Session::get('deleted'))
            <div class="alert alert-warning">{{ session('deleted') }}</div>
        @endif

        @if (Auth::check() && Auth::user()->role == 'admin')
            <div class="text-dark">
                <h1>Detail Data Keterlambatan</h1>
                <p>Home / <a class="text-dark" href="{{ route('lates.rekap') }}">Data Keterlambatan</a> / Detail Data
                    Keterlambatan</p>
            </div>
        @endif
        @if (Auth::check() && Auth::user()->role == 'ps')
            <div class="text-dark">
                <h1>Detail Data Keterlambatan</h1>
                <p>Home / <a class="text-dark" href="{{ route('lates-ps.rekap') }}">Data Keterlambatan</a> / Detail Data
                    Keterlambatan</p>
            </div>
        @endif

        <hr class="text-dark text-bold">

        <h4 class="text-dark fs-4 text-bold">
            {{ $student->name }} | {{ $student->nis }} | {{ $student->rombel->rombel }} | {{ $student->rayon->rayon }}
        </h4>

        <div class="row mt-3">
            @foreach ($lates as $item)
                <div class="col-md-3 mb-3">
                    <div class="card bg-info-subtle">
                        <div class="card-body">
                            <h4>Keterlambatan Ke - {{ $loop->iteration }}</h4>
                            <h5>{{ $item['date_time_late'] }}</h5>
                            <p>{{ $item['information'] }}</p>
                            <img width="270" class="rounded img-fluid" src="{{ asset('images/' . $item['bukti']) }}"
                                alt="">
                        </div>
                    </div>
                </div>
            @endforeach

            @if (Auth::check() && Auth::user()->role == 'admin')
                <a href="{{ route('lates.rekap') }}" c>
                    <button type="submit" class="btn btn-info mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                        </svg>
                        Back
                    </button>
                </a>
            @endif
            @if (Auth::check() && Auth::user()->role == 'ps')
                <a href="{{ route('lates-ps.rekap') }}" c>
                    <button type="submit" class="btn btn-info mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                        </svg>
                        Back
                    </button>
                </a>
            @endif
        </div>
    </div>
@endsection
