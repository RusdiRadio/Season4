<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Kamu lupa import model Edukasi
use App\Models\Edukasi;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::all(); // Ambil semua data dari tabel edukasi
        return view('edukasi', compact('edukasi')); // View bernama edukasi.blade.php
    }

     public function tambah()
    {
        return view('tambahedukasi');
    }

    public function store(Request $request)
    {
        // // validasi input
        // dd($request->all());

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // sesuai nama kolom untuk gambar
        ]);

        // proses upload gambar jika ada
        if ($request->hasFile('konten')) {
            $file = $request->file('konten');
            $filename = time() . '_' . $file->getClientOriginalName();
            // simpan di storage/app/public/images
            $file->storeAs('public/images', $filename);
        } else {
            $filename = null;
        }

        // simpan ke database
        Edukasi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'konten' => $filename,  // simpan nama file gambar di kolom konten
        ]);

        return redirect()->route('edukasi')->with('success', 'Data edukasi berhasil ditambahkan.');
    }

public function edit($id_edukasi)
{
    $edukasi = Edukasi::findOrFail($id_edukasi);
    return view('EditEdukasi', compact('edukasi'));
}

public function update(Request $request, $id)
{
    $edukasi = Edukasi::findOrFail($id);
    $edukasi->judul = $request->judul;
    $edukasi->deskripsi = $request->deskripsi;

    // handle file jika diganti
    if ($request->hasFile('konten')) {
        $file = $request->file('konten');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/images', $filename);
        $edukasi->konten = $filename;
    }

    $edukasi->save();

    return redirect()->route('edukasi')->with('success', 'Data edukasi berhasil diperbarui.');
}



    public function destroy($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        $edukasi->delete();
        return redirect()->route('edukasi')->with('success', 'Data berhasil dihapus.');
    }

    
    }