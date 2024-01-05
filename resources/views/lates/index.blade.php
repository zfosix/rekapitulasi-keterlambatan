@extends('layouts.template')
@section('content')
    @if (Auth::check() && Auth::user()->role == 'ps')
        <div class="container mx-6">
            @if (Session::get('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (Session::get('deleted'))
                <div class="alert alert-warning">{{ session('deleted') }}</div>
            @endif

            <div class="text-dark">
                <h1>Data Keterlambatan</h1>
                <p>Home / Data Keterlambatan</p>
            </div>

            <a href="{{ route('lates-ps.index') }}" class="btn btn-dark mb-3">Keseluruhan Data</a>
            <a href="{{ route('lates-ps.rekap') }}" class="btn btn-outline-dark  mb-3">Rekapitulasi Data</a>

            <div class="d-flex justify-content-between mb-3">
                <form action="{{ route('lates.search') }}" method="GET" class="flex-grow-1 me-2">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control bg-primary-subtle"
                            placeholder="Cari Rombel">
                        <button type="submit" class="btn btn-info rounded-end-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg> Search
                        </button>
                    </div>
                </form>

                <form action="{{ route('lates-ps.index') }}" method="get" class="d-flex align-items-center ">
                    <select name="perPage" class="form-control text-center me-2 bg-primary-subtle" id="perPage"
                        onchange="this.form.submit()" style="width: 50px">
                        <option value="7" {{ $perPage == 7 ? 'selected' : '' }}>7</option>
                        <option value="14" {{ $perPage == 14 ? 'selected' : '' }}>14</option>
                        <option value="24" {{ $perPage == 24 ? 'selected' : '' }}>24</option>
                        <option value="all" {{ $perPage === 'all' ? 'selected' : '' }}>All</option>
                    </select>
                    <div class="form-control text-center bg-primary-subtle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg> Entries per page
                    </div>
                </form>

            </div>


            @if (!isset($searchQuery))
                <table class="table table-primary table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Siswa</th>
                            <th class="text-center">Tanggal Terlambat</th>
                            <th class="text-center">Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($lates as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                @php $isUserDisplayed = false; @endphp
                                @foreach ($students as $student)
                                    @if ($student['id'] == $item['student_id'])
                                        @if (!$isUserDisplayed)
                                            <td class="text-center">
                                                {{ $student['name'] }}
                                                <br>
                                                <em>
                                                    ({{ $student['nis'] }})
                                                </em>
                                            </td>
                                            @php $isUserDisplayed = true; @endphp
                                        @endif
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $item['date_time_late'] ?? 'N/A' }}</td>
                                <td class="text-center">{{ $item['information'] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    @endif
    @if (Auth::check() && Auth::user()->role == 'admin')
        <div class="container mx-6">
            @if (Session::get('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (Session::get('deleted'))
                <div class="alert alert-warning">{{ session('deleted') }}</div>
            @endif

            <div class="text-dark">
                <h1>Data Keterlambatan</h1>
                <p>Home / Data Keterlambatan</p>
            </div>

            <a href="{{ route('lates.index') }}" class="btn btn-dark mb-3">Keseluruhan Data</a>
            <a href="{{ route('lates.rekap') }}" class="btn btn-outline-dark  mb-3">Rekapitulasi Data</a>

            <div class="d-flex justify-content-between mb-3">
                <form action="{{ route('lates.search') }}" method="GET" class="flex-grow-1 me-2">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control bg-primary-subtle"
                            placeholder="Cari Rombel">
                        <button type="submit" class="btn btn-info rounded-end-2"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg> Search</button>
                        <a class="btn btn-primary rounded mx-2" href="{{ route('lates.create') }}">
                            <span class="me-1">Add Data</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bookmark-plus-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5z" />
                            </svg>
                        </a>
                    </div>
                </form>

            </div>

            @if (!isset($searchQuery))
                <table class="table table-primary table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Siswa</th>
                            <th class="text-center">Tanggal Terlambat</th>
                            <th class="text-center">Informasi</th>
                            {{-- <th class="text-center">Bukti</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($lates as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                @php $isUserDisplayed = false; @endphp
                                @foreach ($students as $student)
                                    @if ($student['student']['id'] == $item['student_id'])
                                        @if (!$isUserDisplayed)
                                            <td class="text-center">
                                                {{ $student['student']['name'] }}
                                                <br>
                                                <em>
                                                    ({{ $student['student']['nis'] }})
                                                </em>
                                            </td>
                                            @php $isUserDisplayed = true; @endphp
                                        @endif
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $item['date_time_late'] }}</td>
                                <td class="text-center">{{ $item['information'] }}</td>
                                {{-- <td class="text-center"><img src="{{ asset('images/' . $item['bukti']) }}"
                                        style="width: 100px; height:auto; border-radius:10px;" alt=""></td> --}}
                                <td class="text-center">
                                    <a href="{{ route('lates.edit', $item->id) }}" class="btn btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmation{{ $item->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </button>

                                    <div class="modal fade" id="deleteConfirmation{{ $item->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 text-light" id="deleteConfirmationLabel">
                                                        Delete
                                                        Data?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-light">
                                                    Yakin Anda Ingin Menghapus Data Keterlambatan Ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('lates.delete', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    @endif
@endsection
