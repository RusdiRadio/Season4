<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Sesuaikan model kamu
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'username' => 'required|string|unique:user,username',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        DB::table('user')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

}
