@extends('layouts.template')

@section('content')
    <main class="content px-3 py-3">
        <div class="container-fluid">
            @if (Session::get('cantAccess'))
                <div class="alert alert-danger">{{ Session::get('cantAccess') }}</div>
            @endif
            <div class="row">
                <div class="col-12 col-md-24 d-flex">
                    <div class="card flex-fill border-0">
                        <div class="card-body p-0 d-flex flex-fill">
                            <div class="row g-0 w-100 bg-secondary-subtle rounded-2">
                                <div class="col-6">
                                    <div class="p-3 m-1">
                                        <h4 class="fs-1">Welcome Back, {{ Auth::user()->name }}!</h4>
                                        <p class="mb-0 fs-6">{{ Auth::user()->name }} Dashboard Lorem ipsum, dolor sit amet
                                            consectetur adipisicing elit. provident sapiente consequatur rerum ullam maxime
                                            illum odit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="color: #000000;">
                <div class="px-4 bg-dark rounded-5">
                    <div class="row g-3 my-2 mb-4">
                        <div class="col-md-6">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $totalStudents }}</h3>
                                    <p class="fs-5">Peserta Didik Rayon
                                        {{ App\Models\rayons::find($rayonIdLogin)->rayon }}
                                    </p>
                                </div>
                                <i class="ri-user-fill fs-1 border border-dark rounded-4 border-5 p-2"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $totalLates }}</h3>
                                    <p class="fs-5">
                                        Jumlah Keterlambatan {{ App\Models\rayons::find($rayonIdLogin)->rayon }}
                                    </p>
                                </div>
                                <i class="ri-user-fill fs-1 border border-dark rounded-4 border-5 p-2"></i>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="p-3 shadow-sm d-flex justify-content-around align-items-center rounded"
                                style="background-color: #0B2447">
                                <h4 class="card-title fs-6 mx-4 text-light"> Keterlambatan
                                    {{ App\Models\rayons::find($rayonIdLogin)->rayon }}
                                    Hari ini </h4>
                                <h4 class="card-title fs-5 mx-3 text-light"> {{ \Carbon\Carbon::now()->format('Y-m-d') }}
                                </h4>
                                <div class="card-body">
                                    <h4><i class="fas fa-users fs-6"></i> {{ $totalLates }}</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
