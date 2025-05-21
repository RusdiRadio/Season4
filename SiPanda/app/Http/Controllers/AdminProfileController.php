<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;

class AdminProfileController extends Controller
{
    // Tampilkan profil admin
    public function index(){
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

   public function update(Request $request)
{
    $admin = Auth::guard('admin')->user();

    // Validasi data profil
    $request->validate([
        'pekerjaan' => 'nullable|string|max:255',
        'alamat' => 'nullable|string',
        'no_hp' => 'nullable|string|max:20',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Hapus foto jika user klik tombol hapus
    if ($request->has('delete_photo') && $admin->foto) {
        Storage::disk('public')->delete('profile/' . $admin->foto);
        $admin->foto = null;
    }

    // Upload foto jika user memilih file baru
    if ($request->hasFile('image')) {
        // Hapus foto lama jika ada
        if ($admin->foto) {
            Storage::disk('public')->delete('profile/' . $admin->foto);
        }

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('profile', $imageName, 'public');
        $admin->foto = $imageName;
    }

    // Simpan data profil lainnya
    $admin->pekerjaan = $request->input('pekerjaan');
    $admin->alamat = $request->input('alamat');
    $admin->no_hp = $request->input('no_hp');
    $admin->save();

    return back()->with('success', 'Profil berhasil diperbarui.');
}

    }

