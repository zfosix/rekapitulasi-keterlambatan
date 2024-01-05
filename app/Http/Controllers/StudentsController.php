<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Rombels;
use App\Models\Rayons;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan eloquent with() untuk memuat relasi rombels dan rayons
        $students = Students::with('rombel', 'rayon')->get();
        return view('students.index', compact('students'));
    }

    public function indexPs(Request $request)
    {
        $rayon = $request->get('rayon');
        $rayonNumber = $request->get('rayonNumber');

        $filter = $request->input('filter');
        $jumlah_data = $request->input('jumlah_data', 10);

        // Menggunakan eager loading untuk memuat relasi 'rayon'
        $students = students::with('rayon')
            ->whereHas('rayon', function ($query) use ($rayon, $rayonNumber) {
                $query->where('rayon', $rayon . ' ' . $rayonNumber);
            })
            ->when($filter, function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter . '%');
            })->orderBy('name')->paginate($jumlah_data);


        return view('students.index', compact('students'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $request->session()->put('search_query', $query);

        // Menggunakan eloquent with() untuk memuat relasi rombels dan rayons
        $students = Students::where('name', 'LIKE', "%$query%")->with('rombel', 'rayon')->get();

        return view('students.index', compact('students', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rombels = Rombels::all();
        $rayons = Rayons::all();
        return view('students.create', compact('rombels', 'rayons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required|exists:rombels,id',
            'rayon_id' => 'required|exists:rayons,id',
        ]);

        Students::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Berhasil menambahkan data Siswa!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Menggunakan findOrFail untuk menemukan atau melemparkan 404 jika tidak ditemukan
        $student = Students::with('rombel', 'rayon')->findOrFail($id);
        $rombels = Rombels::all();
        $rayons = Rayons::all();

        return view('students.edit', compact('student', 'rombels', 'rayons'));
    }

    // public function show(Students $students)
    // {
    //     // Example logic to get $rombel_id based on the $students model
    //     $rombel_id = $students->rombel_id; // Replace with your actual attribute name

    //     return view('home', ['rombel_id' => $rombel_id]);
    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required|exists:rombels,id',
            'rayon_id' => 'required|exists:rayons,id',
        ]);

        Students::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Berhasil mengupdate data Siswa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Students::destroy($id);
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
    }
}
