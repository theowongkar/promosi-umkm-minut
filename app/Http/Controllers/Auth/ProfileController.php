<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        // Ambil User
        $user = Auth::user();

        return view('auth.profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Ambil User
        $user = Auth::user();

        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update User
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Jika password diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);

            // Logout User
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

        // Simpan User
        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }
}
