<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    // Menampilkan form untuk mengupload file baru
    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|max:10240', // Maksimal 10MB
        ]);

        // Simpan file
        $filePath = $request->file('file')->store('uploads', 'public');

        // Simpan informasi file ke database jika perlu
        $file = new File();
        $file->file_name = $request->file('file')->getClientOriginalName();
        $file->file_path = $filePath;
        $file->file_size = $request->file('file')->getSize();
        $file->save();

        return redirect()->route('file.index')->with('success', 'File uploaded successfully!');
    }


    // Menampilkan form untuk mengedit file
    public function edit($id)
    {
        $file = File::findOrFail($id);
        return view('files.edit', compact('file'));
    }

    // Mengupdate data file
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,zip|max:2048',
        ]);

        $file = File::findOrFail($id);

        // Update file jika ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($file->file_path);

            // Upload file baru
            $uploadedFile = $request->file('file');
            $filePath = $uploadedFile->store('uploads', 'public');
            $fileSize = $uploadedFile->getSize();

            // Update data file
            $file->update([
                'file_name' => $uploadedFile->getClientOriginalName(),
                'file_path' => $filePath,
                'file_size' => $fileSize,
            ]);
        }

        return redirect()->route('file.index')->with('success', 'File updated successfully');
    }

    // Menghapus file
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Hapus file dari storage
        Storage::disk('public')->delete($file->file_path);

        // Hapus data dari database
        $file->delete();

        return redirect()->route('file.index')->with('success', 'File deleted successfully');
    }

    public function download($id)
    {
        // Cari file berdasarkan ID
        $file = File::findOrFail($id);

        // Ambil path file dari storage
        $filePath = storage_path('app/public/' . $file->file_path);

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Return response download
        return response()->download($filePath, $file->file_name);
    }
}
