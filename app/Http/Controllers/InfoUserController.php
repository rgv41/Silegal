<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{
    public function index()
    {
        // Ambil semua data user dari database
        $users = User::all();

        // Kirimkan data user ke view 'admin.laravel-examples.user-list'
        return view('admin.user_management.index', compact('users'));
    }

    public function created()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Tampilkan view dengan data user
        return view('admin.user_management.user-profile', ['user' => $user]);
    }

    public function create()
    { {
            return view('admin.user_management.create');
        }
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'role' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        // Buat user baru
        User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'role' => $attributes['role'],
            'password' => Hash::make($attributes['password']),
        ]);

        return redirect()->route('admin.user_management.index')->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        // Ambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengembalikan data user sebagai response JSON
        return response()->json($user);
    }


    // Memperbarui user setelah edit
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($id)],
            'role' => ['required'],
        ]);

        // Ambil user yang ingin diperbaruiz`
        $user = User::find($id);

        // Update data user
        $user->update($attributes);

        // Redirect ke halaman user management dengan pesan sukses
        return redirect()->route('admin.user_management.index')->with('success', 'User updated successfully');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user_management.index')->with('success', 'User deleted successfully');
    }
}
