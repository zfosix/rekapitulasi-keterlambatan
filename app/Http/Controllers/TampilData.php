<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rayons;
use App\Models\Rombels;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;

class TampilData extends Controller
{
    public function index()
    {
        $data_rayons = Rayons::all();
        $jumlah_data_rayons = $data_rayons->count();

        // Mengambil data dari Database Kedua
        $data_rombels = Rombels::all();
        $jumlah_data_rombels = $data_rombels->count();

        // Mengambil data dari Database Ketiga
        $data_students = Students::all();
        $jumlah_data_students = $data_students->count();

        $data_users = User::all();
        // Menghitung jumlah data berdasarkan tipe 'admin'
        $jumlah_data_users1 = 0;

        // Menghitung jumlah data berdasarkan tipe 'ps'
        $jumlah_data_users2 = 0;

        foreach ($data_users as $user) {
            if ($user->role === 'admin') {
                $jumlah_data_users1++;
            } elseif ($user->role === 'ps') {
                $jumlah_data_users2++;
            }
        }

        // pass data to the view
        return view('home', compact('jumlah_data_rayons', 'jumlah_data_rombels', 'jumlah_data_students', 'jumlah_data_users1', 'jumlah_data_users2', 'data_users'));
    }


    /**
     * Display a listing of the resource.
     */
    public function indexPs()
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');
        $totalStudents = students::where('rayon_id', $rayonIdLogin)->count();
        $totalLates = students::where('rayon_id', $rayonIdLogin)->with('lates')->get()->sum(function ($student) {
            return $student->lates->count();
        });
        $todayLates = students::where('rayon_id', $rayonIdLogin)
            ->whereHas('lates', function ($query) {
                $query->whereDate('created_at', now()->toDateString());
            })
            ->count();

        return view('homeps', compact('totalStudents', 'totalLates', 'todayLates', 'rayonIdLogin'));
    }


    /**
     * Show the form for creating a new resource.
     */
}
