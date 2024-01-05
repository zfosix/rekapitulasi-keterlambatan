<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $request->session()->put('search_query', $query);

        // Use the correct model name 'User' instead of 'rombel'
        $users = User::where('name', 'LIKE', "%$query%")->get();

        // Update the variable name in compact to 'users'
        return view('users.index', compact('users', 'query'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);

        $password = substr($request->email, 0, 3) . substr($request->name, 0, 3);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => $request->role,
        ]);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->filled('password')) {
            // Update the user's password
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update other fields
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            $authenticatedUser = Auth::user();

            if ($authenticatedUser->role == 'admin') {
                return redirect('/home');
            } elseif ($authenticatedUser->role == 'ps') {
                return redirect('/home-ps');
            } else {
                return redirect('/defaultHome');
            }
        } else {
            return redirect()->back()->with('failed', 'Email dan password tidak sesuai! Silahkan coba lagi!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
