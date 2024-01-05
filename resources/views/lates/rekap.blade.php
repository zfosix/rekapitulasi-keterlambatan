@extends('layouts.template')

@section('content')
    @if (Auth::check() && Auth::user()->role == 'admin')
        <div class="container mx-6">
            @if (Session::get('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (Session::get('deleted'))
                <div class="alert alert-warning">{{ session('deleted') }}</div>
            @endif

            <div class="text-dark">
                <h1>Data Rekapitulasi</h1>
                <p>Home / Data Rekapitulasi</p>
            </div>

            <a href="{{ route('lates.index') }}" class=" btn btn-outline-dark mb-3">Keseluruhan Data</a>
            <a href="{{ route('lates.rekap') }}" class="btn btn-dark mb-3 ">Rekapitulasi Data</a>

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
                        <a class="btn btn-success rounded mx-2" href="{{ route('lates.export-excel') }}">
                            <span class="me-1">Export Excel</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path
                                    d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z" />
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
                            <th class="text-center">Nis</th>
                            <th class="text-center">Nama Siswa</th>
                            <th class="text-center">Jumlah Keterlambatan</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($grup as $nis => $group)
                            @php
                                $total = $group->where('student.nis')->count();
                            @endphp
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center fst-italic ">({{ $nis }})</td>
                                <td class="text-center">{{ $group->first()->student->name }}</td>
                                <td class="text-center">{{ $total }}</td>
                                <td class="text-center">
                                    <a href="{{ route('lates.detail', ['nis' => $nis]) }}" class="btn btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path
                                                d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z" />
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($group->first())
                                        <a href="{{ route('lates.download', ['id' => $group->first()->id]) }}"
                                            class="btn btn-danger">Download PDF
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                                <path
                                                    d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif
    @if (Auth::check() && Auth::user()->role == 'ps')
        <div class="container mx-6">
            @if (Session::get('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (Session::get('deleted'))
                <div class="alert alert-warning">{{ session('deleted') }}</div>
            @endif

            <div class="text-dark">
                <h1>Data Rekapitulasi</h1>
                <p>Home / Data Rekapitulasi</p>
            </div>

            <a href="{{ route('lates-ps.index') }}" class=" btn btn-outline-dark mb-3">Keseluruhan Data</a>
            <a href="{{ route('lates-ps.rekap') }}" class="btn btn-dark mb-3 ">Rekapitulasi Data</a>

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
                        <a class="btn btn-success rounded mx-2" href="{{ route('lates-ps.export-excel-ps') }}">
                            <span class="me-1">Export Excel</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path
                                    d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z" />
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
                            <th class="text-center">Nis</th>
                            <th class="text-center">Nama Siswa</th>
                            <th class="text-center">Jumlah Keterlambatan</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($students as $student)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center fst-italic ">({{ $student->nis }})</td>
                                <td class="text-center">{{ $student->name }}</td>
                                <td class="text-center">{{ $student->latesCount }}</td>
                                <td class="text-center">
                                    <a href="{{ route('lates-ps.detail', ['nis' => $student->nis]) }}"
                                        class="btn btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path
                                                d="M4 5.5a.5.5 0 1 1 .5-.5h7a.5.5 0 1 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 1 1 .5-.5h7a.5.5 0 1 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z" />
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($student->latesCount > 2)
                                        <a href="{{ route('lates-ps.download', ['id' => $student->lates->first()->id]) }}"
                                            class="btn btn-danger">
                                            Download PDF
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                                <path
                                                    d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif

@endsection
