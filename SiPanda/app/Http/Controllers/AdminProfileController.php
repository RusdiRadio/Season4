<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;

class AdminProfileController extends Controller
{
    // Tampilkan halaman pengaturan profil
    public function index()
    {
        $admin = Auth::user(); // Tidak pakai guard admin
        return view('pengaturan', compact('admin'));
    }

    // Update profil admin
    public function update(Request $request)
    {
        $admin = Auth::user();

        // Validasi data
        $request->validate([
            'pekerjaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hapus foto jika user minta
        if ($request->has('delete_photo') && $admin->foto) {
            Storage::disk('public')->delete('profile/' . $admin->foto);
            $admin->foto = null;
        }

        // Upload foto baru jika ada
        if ($request->hasFile('image')) {
            if ($admin->foto) {
                Storage::disk('public')->delete('profile/' . $admin->foto);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile', $imageName, 'public');
            $admin->foto = $imageName;
        }

        // Simpan perubahan
        $admin->pekerjaan = $request->input('pekerjaan');
        $admin->alamat = $request->input('alamat');
        $admin->no_hp = $request->input('no_hp');
        $admin->save();

        return redirect()->route('pengaturan.index')->with('success', 'Profil berhasil diperbarui.');
    }

    // Hapus foto profil
    public function delete()
    {
        $admin = Auth::user();

        if ($admin->foto) {
            Storage::disk('public')->delete('profile/' . $admin->foto);
            $admin->foto = null;
            $admin->save();
        }

        return redirect()->route('pengaturan.index')->with('success', 'Foto profil berhasil dihapus.');
    }
}
