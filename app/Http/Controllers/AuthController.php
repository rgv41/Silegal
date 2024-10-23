<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\FormCV;
use App\Models\FormPTBiasa;
use App\Models\FormPTPerorangan;
use App\Models\FormFirma;
use App\Models\FormYayasan;
use App\Models\Admin;

class AuthController extends Controller
{
    /**
     * Handle the login request for admin or customer.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_telp' => 'sometimes|required', // Diperlukan untuk customer
            'username' => 'sometimes|required', // Diperlukan untuk admin
            'password' => 'required',
        ]);

        // Login sebagai Admin
        if ($request->filled('username')) {
            $username = $request->input('username');
            $password = $request->input('password');

            $admin = Admin::where('username', $username)->first();
            if ($admin && Hash::check($password, $admin->password)) {
                // Jika login berhasil
                session(['admin_id' => $admin->id, 'role' => 'admin']);
                return redirect()->route('dashboard')->with('success', 'Login berhasil!'); // Ganti dengan rute dashboard admin
            }

            return back()->withErrors(['message' => 'Username atau password salah.']);
        }

        // Login sebagai Customer
        if ($request->filled('no_telp')) {
            $no_telp = $request->input('no_telp');
            $password = $request->input('password');

            // Cek di form_cv
            $user = FormCV::where('no_telp_direktur', $no_telp)
                ->orWhere('no_telp_kantor', $no_telp)->first();
            if ($user && Hash::check($password, $user->password)) {
                session(['user_id' => $user->id, 'form_type' => 'form_cv']);
                return redirect()->route('customer.dashboard'); // Ganti dengan rute dashboard customer
            }

            // Cek di form_pt_biasa
            $user = FormPTBiasa::where('direktur_telp', $no_telp)
                ->orWhere('no_telp_kantor', $no_telp)->first();
            if ($user && Hash::check($password, $user->password)) {
                session(['user_id' => $user->id, 'form_type' => 'form_pt_biasa']);
                return redirect()->route('customer.dashboard'); // Ganti dengan rute dashboard customer
            }

            // Cek di form_pt_perorangan
            $user = FormPTPerorangan::where('no_telp', $no_telp)->first();
            if ($user && Hash::check($password, $user->password)) {
                session(['user_id' => $user->id, 'form_type' => 'form_pt_perorangan']);
                return redirect()->route('customer.dashboard'); // Ganti dengan rute dashboard customer
            }

            // Cek di form_firma
            $user = FormFirma::where('managing_partner_telp', $no_telp)
                ->orWhere('no_telp_kantor', $no_telp)->first();
            if ($user && Hash::check($password, $user->password)) {
                session(['user_id' => $user->id, 'form_type' => 'form_firma']);
                return redirect()->route('customer.dashboard'); // Ganti dengan rute dashboard customer
            }

            // Cek di form_yayasan
            $user = FormYayasan::where('no_hp_pembina', $no_telp)
                ->orWhere('no_telp_hk_kantor', $no_telp)->first();
            if ($user && Hash::check($password, $user->password)) {
                session(['user_id' => $user->id, 'form_type' => 'form_yayasan']);
                return redirect()->route('customer.dashboard'); // Ganti dengan rute dashboard customer
            }

            return back()->withErrors(['message' => 'Nomor telepon atau password salah.']);
        }

        return back()->withErrors(['message' => 'Input tidak valid.']);
    }

    /**
     * Handle the logout request.
     */
    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect()->route('login'); // Kembali ke halaman login
    }
}
