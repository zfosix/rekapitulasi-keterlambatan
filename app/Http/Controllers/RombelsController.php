<?php

namespace App\Http\Controllers;

use App\Models\Rombels;
use Illuminate\Http\Request;

class RombelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombel = Rombels::with('rombel')->simplePaginate(7);
        return view('rombels.index', compact('rombel'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $request->session()->put('search_query', $query);

        // Use the correct model name 'Rombel' instead of 'rombels'
        $rombel = Rombels::where('rombel', 'LIKE', "%$query%")->get();

        return view('rombels.index', compact('rombel', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required',
        ]);

        Rombels::create([
            'rombel' => $request->rombel,
        ]);

        return redirect()->back()->with('Success', 'Berhasil Menambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rombels $rombels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombel = Rombels::find($id);
        return view('rombels.edit', compact('rombel'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombel' => 'required',
        ]);

        Rombels::where('id', $id)->update([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombels.index')->with('success', 'berhasil mengubah data!');
    }

    public function delete($id)
    {
        Rombels::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'berhasil menghapus data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rombels $rombels)
    {
        //
    }
}
