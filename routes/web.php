<?php

use App\Http\Controllers\TampilData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\StudentsController;

Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UsersController::class, 'loginAuth'])->name('login.auth');

Route::middleware(['IsLogin'])->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home.page');

    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/home-ps', [TampilData::class, 'indexPs'])->name('homeps');
    Route::get('/home', [TampilData::class, 'index'])->name('home');

    Route::middleware(['IsPs', 'CheckRoleAndRayon'])->group(function () {

        Route::prefix('lates-ps')->name('lates-ps.')->group(function () {
            Route::get('/index-ps', [LatesController::class, 'indexPs'])->name('index');
            Route::get('/rekap-ps', [LatesController::class, 'rekapPs'])->name('rekap');
            Route::get('/search', [LatesController::class, 'search'])->name('search');
            Route::get('/detail/{nis}', [LatesController::class, 'detail'])->name('detail');
            Route::get('/download/{id}', [LatesController::class, 'downloadPdf'])->name('download');
            Route::get('/export-excel-ps', [LatesController::class, 'exportExcelPs'])->name('export-excel-ps');
        });

        Route::prefix('students-ps')->name('students-ps.')->group(function () {
            Route::get('/index', [StudentsController::class, 'indexPs'])->name('index');
        });
    });

    Route::middleware(['IsAdmin'])->group(function () {

        Route::prefix('/rombels')->name('rombels.')->group(function () {
            Route::get('/', [RombelsController::class, 'index'])->name('index');
            Route::get('/create', [RombelsController::class, 'create'])->name('create');
            Route::post('/store', [RombelsController::class, 'store'])->name('store');
            Route::get('/search', [RombelsController::class, 'search'])->name('search');
            Route::get('/edit/{rombel}', [RombelsController::class, 'edit'])->name('edit');
            Route::patch('/update/{rombel}', [RombelsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RombelsController::class, 'delete'])->name('delete');
        });

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/search', [UsersController::class, 'search'])->name('search');
            Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('edit');
            Route::patch('/update/{user}', [UsersController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
        });

        Route::prefix('/rayons')->name('rayons.')->group(function () {
            Route::get('/', [RayonsController::class, 'index'])->name('index');
            Route::get('/create', [RayonsController::class, 'create'])->name('create');
            Route::post('/store', [RayonsController::class, 'store'])->name('store');
            Route::get('/search', [RayonsController::class, 'search'])->name('search');
            Route::get('/edit/{id}', [RayonsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RayonsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RayonsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/students')->name('students.')->group(function () {
            Route::get('/', [StudentsController::class, 'index'])->name('index');
            Route::get('/create', [StudentsController::class, 'create'])->name('create');
            Route::post('/store', [StudentsController::class, 'store'])->name('store');
            Route::get('/search', [StudentsController::class, 'search'])->name('search');
            Route::get('/edit/{id}', [StudentsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [StudentsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [StudentsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/lates')->name('lates.')->group(function () {
            Route::get('/', [LatesController::class, 'index'])->name('index');
            Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
            Route::get('/create', [LatesController::class, 'create'])->name('create');
            Route::post('/store', [LatesController::class, 'store'])->name('store');
            Route::get('/search', [LatesController::class, 'search'])->name('search');
            Route::get('/detail/{nis}', [LatesController::class, 'detail'])->name('detail');
            Route::get('/download/{id}', [LatesController::class, 'downloadPdf'])->name('download');
            Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
            Route::get('/edit/{id}', [LatesController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [LatesController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [LatesController::class, 'destroy'])->name('delete');
        });
    });
});
