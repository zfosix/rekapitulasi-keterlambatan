<?php

namespace App\Http\Controllers;

use App\Models\Rayons;
use App\Models\User;
use Illuminate\Http\Request;

class RayonsController extends Controller
{
    public function index()
    {
        $rayons = Rayons::with('user')->get();
        return view('rayons.index', compact('rayons'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $request->session()->put('search_query', $query);

        $rayon = Rayons::where('rayon', 'LIKE', "%$query%")->get();

        return view('rayons.index', compact('rayon', 'query'));
    }


    public function create()
    {
        $users = User::all();
        return view('rayons.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);


        Rayons::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    public function edit($id)
    {
        $user_id = 0;
        $specificData = User::find($user_id);
        $users = User::where('id', '!=', $user_id)->get();
        $rayon = Rayons::find($id);
        return view('rayons.edit', compact('rayon', 'user_id', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);


        Rayons::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayons.index')->with('success', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        Rayons::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
    }
}
