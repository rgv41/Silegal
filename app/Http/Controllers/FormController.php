<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPTBiasa;
use App\Models\FormPTPerorangan;
use App\Models\FormCV;
use App\Models\FormYayasan;
use App\Models\FormFirma;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormController extends Controller
{
    // Tampilkan Form PT Biasa
    public function showPTBiasa()
    {
        return view('forms.pt_biasa');
    }

    // Simpan Data PT Biasa
    public function storePTBiasa(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_pt' => 'required|string',
            'modal_dasar' => 'required|numeric',
            'modal_setor' => 'required|numeric',
            'nilai_nominal_per_saham' => 'required|numeric',
            'pemegang_saham_pertama' => 'required|numeric',
            'pemegang_saham_kedua' => 'required|numeric',
            'direktur_nama' => 'required|string',
            'direktur_email' => 'required|email',
            'direktur_telp' => 'required|string',
            'foto_ktp' => 'required|file|mimes:jpg,png',
            'foto_npwp' => 'required|file|mimes:jpg,png',
        ]);

        // Simpan Data ke Database
        $form = new FormPTBiasa();
        $form->nama_pt = $request->nama_pt;
        $form->modal_dasar = $request->modal_dasar;
        $form->modal_setor = $request->modal_setor;
        $form->nilai_nominal_per_saham = $request->nilai_nominal_per_saham;
        $form->pemegang_saham_pertama = $request->pemegang_saham_pertama;
        $form->pemegang_saham_kedua = $request->pemegang_saham_kedua;
        $form->direktur_nama = $request->direktur_nama;
        $form->direktur_email = $request->direktur_email;
        $form->direktur_telp = $request->direktur_telp;

        // Simpan file
        if ($request->hasFile('foto_ktp')) {
            $form->foto_ktp = $request->file('foto_ktp')->store('uploads/ktp');
        }
        if ($request->hasFile('foto_npwp')) {
            $form->foto_npwp = $request->file('foto_npwp')->store('uploads/npwp');
        }

        // Simpan password random
        $form->password = Hash::make(Str::random(8));
        $form->save();

        return redirect()->route('pt_biasa.form')->with('success', 'Form PT Biasa berhasil disimpan.');
    }

    // Tampilkan Form PT Perorangan
    public function showPTPerorangan()
    {
        return view('forms.pt_perorangan');
    }

    // Simpan Data PT Perorangan
    public function storePTPerorangan(Request $request)
    {
        $request->validate([
            'nama_pt' => 'required|string',
            'no_telp' => 'required|string',
            'alamat_pt' => 'required|string',
            'modal_usaha' => 'required|numeric',
            'foto_ktp' => 'required|file|mimes:jpg,png',
            'foto_npwp' => 'required|file|mimes:jpg,png',
        ]);

        $form = new FormPTPerorangan();
        $form->nama_pt = $request->nama_pt;
        $form->no_telp = $request->no_telp;
        $form->alamat_pt = $request->alamat_pt;
        $form->modal_usaha = $request->modal_usaha;

        if ($request->hasFile('foto_ktp')) {
            $form->foto_ktp = $request->file('foto_ktp')->store('uploads/ktp');
        }
        if ($request->hasFile('foto_npwp')) {
            $form->foto_npwp = $request->file('foto_npwp')->store('uploads/npwp');
        }

        $form->password = Hash::make(Str::random(8));
        $form->save();

        return redirect()->route('pt_perorangan.form')->with('success', 'Form PT Perorangan berhasil disimpan.');
    }

    // Tampilkan Form CV
    public function showCV()
    {
        return view('forms.cv');
    }

    // Simpan Data CV
    public function storeCV(Request $request)
    {
        $request->validate([
            'nama_cv' => 'required|string',
            'modal_cv' => 'required|numeric',
            'pemegang_saham_pertama' => 'required|numeric',
            'pemegang_saham_kedua' => 'required|numeric',
            'direktur' => 'required|string',
            'email_direktur' => 'required|email',
            'foto_ktp' => 'required|file|mimes:jpg,png',
            'foto_npwp' => 'required|file|mimes:jpg,png',
        ]);

        $form = new FormCV();
        $form->nama_cv = $request->nama_cv;
        $form->modal_cv = $request->modal_cv;
        $form->pemegang_saham_pertama = $request->pemegang_saham_pertama;
        $form->pemegang_saham_kedua = $request->pemegang_saham_kedua;
        $form->direktur = $request->direktur;
        $form->email_direktur = $request->email_direktur;

        if ($request->hasFile('foto_ktp')) {
            $form->foto_ktp = $request->file('foto_ktp')->store('uploads/ktp');
        }
        if ($request->hasFile('foto_npwp')) {
            $form->foto_npwp = $request->file('foto_npwp')->store('uploads/npwp');
        }

        $form->password = Hash::make(Str::random(8));
        $form->save();

        return redirect()->route('cv.form')->with('success', 'Form CV berhasil disimpan.');
    }

    // Tampilkan Form Yayasan
    public function showYayasan()
    {
        return view('forms.yayasan');
    }

    // Simpan Data Yayasan
    public function storeYayasan(Request $request)
    {
        $request->validate([
            'nama_yayasan' => 'required|string',
            'modal' => 'required|numeric',
            'pendiri' => 'required|string',
            'pembina' => 'required|string',
            'no_hp_pembina' => 'required|string',
            'email_pembina' => 'required|email',
            'ketua_pengurus' => 'required|string',
            'no_hp_ketua_pengurus' => 'required|string',
            'email_ketua_pengurus' => 'required|email',
            'sekretaris' => 'required|string',
            'no_hp_sekretaris' => 'required|string',
            'email_sekretaris' => 'required|email',
            'bendahara' => 'required|string',
            'no_hp_bendahara' => 'required|string',
            'email_bendahara' => 'required|email',
            'pengawas' => 'required|string',
            'no_hp_pengawas' => 'required|string',
            'email_pengawas' => 'required|email',
            'alamat_lengkap' => 'required|string',
            'rt_rw' => 'required|string',
            'kode_pos' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'no_telp_hk_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_yayasan' => 'required|string',
            'foto_ktp' => 'required|file|mimes:jpg,png',
            'foto_npwp' => 'required|file|mimes:jpg,png',
        ]);

        try {
            $form = new FormYayasan();
            $form->nama_yayasan = $request->nama_yayasan;
            $form->modal = $request->modal;
            $form->pendiri = $request->pendiri;
            $form->pembina = $request->pembina;
            $form->no_hp_pembina = $request->no_hp_pembina;
            $form->email_pembina = $request->email_pembina;
            $form->ketua_pengurus = $request->ketua_pengurus;
            $form->no_hp_ketua_pengurus = $request->no_hp_ketua_pengurus;
            $form->email_ketua_pengurus = $request->email_ketua_pengurus;
            $form->sekretaris = $request->sekretaris;
            $form->no_hp_sekretaris = $request->no_hp_sekretaris;
            $form->email_sekretaris = $request->email_sekretaris;
            $form->bendahara = $request->bendahara;
            $form->no_hp_bendahara = $request->no_hp_bendahara;
            $form->email_bendahara = $request->email_bendahara;
            $form->pengawas = $request->pengawas;
            $form->no_hp_pengawas = $request->no_hp_pengawas;
            $form->email_pengawas = $request->email_pengawas;
            $form->alamat_lengkap = $request->alamat_lengkap;
            $form->rt_rw = $request->rt_rw;
            $form->kode_pos = $request->kode_pos;
            $form->kelurahan = $request->kelurahan;
            $form->kecamatan = $request->kecamatan;
            $form->kabupaten = $request->kabupaten;
            $form->no_telp_hk_kantor = $request->no_telp_hk_kantor;
            $form->email_kantor = $request->email_kantor;
            $form->bidang_yayasan = $request->bidang_yayasan;

            if ($request->hasFile('foto_ktp')) {
                $form->foto_ktp = $request->file('foto_ktp')->store('uploads/ktp');
            }
            if ($request->hasFile('foto_npwp')) {
                $form->foto_npwp = $request->file('foto_npwp')->store('uploads/npwp');
            }

            $form->password = Hash::make(Str::random(8));
            $form->save();

            return redirect()->route('yayasan.form')->with('success', 'Form Yayasan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan form: ' . $e->getMessage()]);
        }
    }

    // Tampilkan Form Firma
    public function showFirma()
    {
        return view('forms.firma');
    }

    // Simpan Data Firma
    public function storeFirma(Request $request)
    {
        $request->validate([
            'nama_firma' => 'required|string',
            'modal' => 'required|numeric',
            'managing_partner' => 'required|string',
            'foto_ktp' => 'required|file|mimes:jpg,png',
            'foto_npwp' => 'required|file|mimes:jpg,png',
        ]);

        $form = new FormFirma();
        $form->nama_firma = $request->nama_firma;
        $form->modal = $request->modal;
        $form->managing_partner = $request->managing_partner;

        if ($request->hasFile('foto_ktp')) {
            $form->foto_ktp = $request->file('foto_ktp')->store('uploads/ktp');
        }
        if ($request->hasFile('foto_npwp')) {
            $form->foto_npwp = $request->file('foto_npwp')->store('uploads/npwp');
        }

        $form->password = Hash::make(Str::random(8));
        $form->save();

        return redirect()->route('firma.form')->with('success', 'Form Firma berhasil disimpan.');
    }
}
