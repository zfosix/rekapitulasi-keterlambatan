<?php

namespace App\Http\Controllers;


use PDF;
use Excel;
use App\Models\Lates;
use App\Models\Students;
use App\Models\Rayons;
use App\Exports\LatesExport;
use App\Exports\LatesExportPs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lates = Lates::all();
        $students = Lates::with('student')->simplePaginate(10);
        return view('lates.index', compact('lates', 'students'));
    }

    public function indexPs(Request $request)
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = Rayons::where('user_id', $userIdLogin)->value('id');

        $perPage = $request->input('perPage', 7);
        $search = $request->input('search');

        // query dasar untuk data siswa
        $query = students::with(['rayon', 'rombel'])
            ->where('rayon_id', $rayonIdLogin);

        $query->when($search, function ($query) use ($search) {
            $query->where('nis', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%');
        });

        $students = $query->get();

        $students->each(function ($student) {
            $student->lates = lates::where('student_id', $student->id)->get();
        });

        $latesQuery = lates::whereIn('student_id', $students->pluck('id'))->orderBy('created_at', 'ASC');

        $lates = ($perPage === 'all') ? $latesQuery->get() : $latesQuery->simplePaginate($perPage);

        return view('lates.index', compact('students', 'lates', 'search', 'perPage'));
    }

    public function rekap()
    {
        $lates = Lates::all();
        $students = Lates::with('student')->simplePaginate(10);
        $grup = $lates->groupBy('student.nis');
        return view('lates.rekap', compact('lates', 'students', 'grup'));
    }
    public function rekapPs(Request $request)
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = Rayons::where('user_id', $userIdLogin)->value('id');

        $perPage = $request->input('perPage', 7);
        $search = $request->input('search');

        $query = students::with(['rayon', 'rombel'])
            ->where('rayon_id', $rayonIdLogin);

        $query->when($search, function ($query) use ($search) {
            $query->where('nis', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%');
        });

        $students = $query->get();

        $students->each(function ($student) {
            $student->lates = lates::where('student_id', $student->id)->get();
            $student->latesCount = $student->lates->count();
        });

        $total = $students->sum('latesCount');

        $latesQuery = lates::whereIn('student_id', $students->pluck('id'))->orderBy('created_at', 'ASC');

        $lates = ($perPage === 'all') ? $latesQuery->get() : $latesQuery->simplePaginate($perPage);

        return view('lates.rekap', compact('students', 'lates', 'search', 'perPage', 'total'));
    }

    private function calculateJumlahKeterlambatan($nis)
    {
        $jumlahKeterlambatan = 1;

        return $jumlahKeterlambatan;
    }


    public function detail($nis)
    {
        $student = Students::where('nis', $nis)->firstOrFail();
        $lates = $student->lates;
        return view('lates.detail', compact('lates', 'student'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $lates = lates::all();
        $lates = lates::with('student')->simplePaginate(10);
        $latesearch = lates::whereHas('student', function ($studentQuery) use ($searchQuery) {
            $studentQuery->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('nis', 'like', '%' . $searchQuery . '%');
        })
            ->orWhere('date_time_late', 'like', '%' . $searchQuery . '%')
            ->orWhere('information', 'like', '%' . $searchQuery . '%')
            ->get();

        return view('lates.index', compact('latesearch', 'lates', 'students', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        $lates = lates::all();
        return view('lates.create', compact('students', 'lates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'student_id' => 'required',
        ]);
        $imageName = time() . '.' . $request->bukti->extension();

        $request->bukti->move(public_path('images'), $imageName);

        lates::create([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $imageName,
            'student_id' => $request->student_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data keterlambatan!');
    }

    /**
     * Display the specified resource.
     */



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = students::all();
        $lates = lates::find($id);

        return view('lates.edit', compact('students', 'lates'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'student_id' => 'required',
        ]);

        $imageName = time() . '.' . $request->bukti->extension();

        $request->bukti->move(public_path('images'), $imageName);

        lates::where('id', $id)->update([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $imageName,
            'student_id' => $request->student_id
        ]);

        return redirect()->route('lates.index')->with('success', 'Berhasil mengupdate data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        lates::where('id', $id)->delete();
        return redirect()->back()->with('Deleted', 'Berhasil menghapus data');
    }

    public function downloadPDF($id)
    {
        $lates = Lates::find($id);

        $currentTime = now();

        $pdf = PDF::loadView('lates.download-pdf', compact('lates', 'currentTime'));

        return $pdf->download('suratpernyataan.pdf');
    }


    public function exportExcel()
    {
        $fileName = 'data_keterlambatan.xlsx';
        return Excel::download(new LatesExport, $fileName);
    }

    public function exportExcelPs(Request $request)
    {
        $rayon = $request->get('rayon');
        $rayonNumber = $request->get('rayonNumber');

        $fileName = 'data_keterlambatan_ps.xlsx';
        return Excel::download(new LatesExportPs($rayon, $rayonNumber), $fileName);
    }
}
