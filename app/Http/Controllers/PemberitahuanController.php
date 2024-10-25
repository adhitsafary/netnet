<?php

namespace App\Http\Controllers;

use App\Models\Pemberitahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemberitahuanController extends Controller
{
    public function index()
    {
        $pemberitahuan = Pemberitahuan::all();
        return view('pemberitahuan.index', compact('pemberitahuan'));
    }

    public function create()
    {
        return view('pemberitahuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string',
        ]);

        $adminName = Auth::user() ? Auth::user()->name : 'Unknown Admin';

        Pemberitahuan::create([
            'nama' => $adminName,  // Mengisi nama admin
            'pesan' => $request->input('pesan'),
        ]);

        return redirect()->route('pemberitahuan.index')->with('success', 'Pemberitahuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemberitahuan = Pemberitahuan::findOrFail($id);
        return view('pemberitahuan.edit', compact('pemberitahuan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $pemberitahuan = Pemberitahuan::findOrFail($id);
        $pemberitahuan->update($request->all());

        return redirect()->route('pemberitahuan.index')->with('success', 'Pemberitahuan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $pemberitahuan = Pemberitahuan::findOrFail($id);
        $pemberitahuan->delete();

        return redirect()->route('pemberitahuan.index')->with('success', 'Pemberitahuan berhasil dihapus.');
    }
}
