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
                                        <p class="fs-6 ">
                                            {{ Auth::user()->name }} Dashboard Lorem ipsum, dolor sit am
                                            provident sapiente consequatur rerum ullam maxime illum odit maiores quaerat
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @php
                $admin = 0;
                $ps = 0;

                foreach ($data_users as $user) {
                    if ($user->role === 'admin') {
                        $admin++;
                    } elseif ($user->role === 'ps') {
                        $ps++;
                    }
                }
            @endphp

            <div class="card border-0 " style="color: #000000;">
                <div class="px-4 bg-secondary-subtle rounded-5">
                    <div class="row g-3 my-2 mb-4">
                        <div class="col-md-5">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $jumlah_data_students }}</h3>
                                    <p class="fs-5">Peserta Didik</p>
                                </div>
                                <i class="ri-user-fill fs-1"></i>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $jumlah_data_users1 }}</h3>
                                    <p class="fs-5">Administrator</p>
                                </div>
                                <i class="ri-user-fill fs-1"></i>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $jumlah_data_users2 }}</h3>
                                    <p class="fs-5">Pembimbing Siswa</p>
                                </div>
                                <i class="ri-user-fill fs-1"></i>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $jumlah_data_rombels }}</h3>
                                    <p class="fs-5">Rombel</p>
                                </div>
                                <i class="ri-bookmark-fill fs-1"></i>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="p-5 bg-info shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">{{ $jumlah_data_rayons }}</h3>
                                    <p class="fs-5">Rayon</p>
                                </div>
                                <i class="ri-bookmark-fill fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
