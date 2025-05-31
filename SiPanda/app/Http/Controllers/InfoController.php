<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    public function index()
    {
        $info = Info::all(); // Ambil semua data dari tabel info
        return view('edukasi', compact('info')); // View bernama info.blade.php
    }

    public function tambah()
    {
        return view('tambahinfo'); // View untuk form tambah data info
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // kolom gambar
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('konten')) {
            $file = $request->file('konten');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $filename);
        } else {
            $filename = null;
        }

        // Simpan ke database
        Info::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'konten' => $filename,
        ]);

        return redirect()->route('edukasi')->with('success', 'Data info berhasil ditambahkan.');
    }

    public function edit($id_info)
    {
        $info = Info::findOrFail($id_info);
        return view('editinfo', compact('info')); // View untuk edit info
    }

    public function update(Request $request, $id)
    {
        $info = Info::findOrFail($id);
        $info->judul = $request->judul;
        $info->deskripsi = $request->deskripsi;

        // Handle file jika diganti
        if ($request->hasFile('konten')) {
            $file = $request->file('konten');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $filename);
            $info->konten = $filename;
        }

        $info->save();

        return redirect()->route('edukasi')->with('success', 'Data info berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $info = Info::findOrFail($id);
        $info->delete();
        return redirect()->route('edukasi')->with('success', 'Data berhasil dihapus.');
    }
}
