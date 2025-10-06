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

        // Validasi input
        $validated = $request->validate([
            'role' => 'required|in:Pengunjung,Penjual',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update data user
        $user->role = $validated['role'];
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }
}
