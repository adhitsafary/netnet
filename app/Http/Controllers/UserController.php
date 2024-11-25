<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file foto
        ]);

        // Simpan foto
        $path = $request->file('foto')->store('foto_users', 'public');

        // Simpan data pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'foto' => $path, // Simpan path foto ke database
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }


    // Menampilkan form input user baru
    public function create()
    {
        return view('users.create');
    }



    // Menampilkan daftar user
    public function index()
    {
        $users = User::whereNotIn('name', ['devine'])->get();

        return view('users.index', compact('users'));
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:teknisi,admin,superadmin',
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto baru
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update foto jika ada foto baru
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_users', 'public');
            $user->foto = $path;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }


    // Menghapus data user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
