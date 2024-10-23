<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPTBiasa;
use App\Models\KBLICategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PTBiasaController extends Controller
{
    // Tampilkan Form PT Biasa
    public function showForm($id = null)
    {
        // Ambil data kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get(); // Ambil semua kategori dan relasi KBLI jika ada

        // Ambil form PT Biasa jika id ada (untuk menampilkan gambar yang di-upload)
        $form = $id ? FormPTBiasa::find($id) : null;

        // Kembalikan view dengan data kategori KBLI dan form PT Biasa
        return view('forms.pt_biasa', compact('kbliCategories', 'form'));
    }

    public function submitForm(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pt' => 'required|string',
            'modal_dasar' => 'required|numeric',
            'modal_setor' => 'required|numeric',
            'nilai_nominal_per_saham' => 'required|numeric',
            'pemegang_saham_pertama_persen' => 'required|numeric',
            'pemegang_saham_kedua_persen' => 'required|numeric',
            'direktur_nama' => 'required|string',
            'direktur_email' => 'required|email',
            'direktur_telp' => 'required|string',
            'komisaris_nama' => 'required|string',
            'komisaris_email' => 'required|email',
            'komisaris_telp' => 'required|string',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_usaha' => 'required|string',
            'alamat_pt' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        // Simpan Data Form
        try {
            $form = new FormPTBiasa();
            $form->nama_pt = $validated['nama_pt'];
            $form->modal_dasar = $validated['modal_dasar'];
            $form->modal_setor = $validated['modal_setor'];
            $form->nilai_nominal_per_saham = $validated['nilai_nominal_per_saham'];
            $form->pemegang_saham_pertama_persen = $validated['pemegang_saham_pertama_persen'];
            $form->pemegang_saham_kedua_persen = $validated['pemegang_saham_kedua_persen'];
            $form->direktur_nama = $validated['direktur_nama'];
            $form->direktur_email = $validated['direktur_email'];
            $form->direktur_telp = $validated['direktur_telp'];
            $form->komisaris_nama = $validated['komisaris_nama'];
            $form->komisaris_email = $validated['komisaris_email'];
            $form->komisaris_telp = $validated['komisaris_telp'];
            $form->no_telp_kantor = $validated['no_telp_kantor'];
            $form->email_kantor = $validated['email_kantor'];
            $form->bidang_usaha = $validated['bidang_usaha'];
            $form->alamat_pt = $validated['alamat_pt'];

            // Array untuk menyimpan path dari file yang diupload
            $ktpPaths = [];
            $npwpPaths = [];

            // Proses upload KTP jika ada
            if ($request->hasFile('foto_ktp')) {
                foreach ($request->file('foto_ktp') as $ktp) {
                    $path = $ktp->store('uploads/ktp'); // Simpan file
                    $ktpPaths[] = $path; // Tambahkan path ke array
                }
                // Simpan path KTP dalam format JSON
                $form->foto_ktp = json_encode($ktpPaths);
            }

            // Proses upload NPWP jika ada
            if ($request->hasFile('foto_npwp')) {
                foreach ($request->file('foto_npwp') as $npwp) {
                    $path = $npwp->store('uploads/npwp'); // Simpan file
                    $npwpPaths[] = $path; // Tambahkan path ke array
                }
                // Simpan path NPWP dalam format JSON
                $form->foto_npwp = json_encode($npwpPaths);
            }

            // Simpan password random
            $form->password = Hash::make(Str::random(8));
            $form->save();

            // Simpan pilihan KBLI ke tabel pivot
            $form->kbli()->sync($validated['kbli_ids']);

            Log::info('Data form berhasil disimpan. ID: ' . $form->id);

            return redirect()->route('pt_biasa.form')->with('success', 'Form PT Biasa berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving form: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        $ptBiasaEntries = FormPTBiasa::all();
        return view('admin.pt-biasa.index', compact('ptBiasaEntries'));
    }

    // Tampilkan Form PT Biasa
    public function create($id = null)
    {
        // Ambil data kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get(); // Ambil semua kategori dan relasi KBLI jika ada

        dd($kbliCategories);

        // Ambil form PT Biasa jika id ada (untuk menampilkan gambar yang di-upload)
        $form = $id ? FormPTBiasa::find($id) : null;

        // Kembalikan view dengan data kategori KBLI dan form PT Perorangan
        return view('admin.pt-biasa.create', compact('kbliCategories', 'form'));
    }


    public function getKbliByCategory($categoryId)
    {
        // Ambil kategori beserta kblis terkait
        $kbliCategories = KBLICategory::find($categoryId)->kblis;

        // Kembalikan sebagai response JSON
        return response()->json($kbliCategories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pt' => 'required|string',
            'modal_dasar' => 'required|numeric',
            'modal_setor' => 'required|numeric',
            'nilai_nominal_per_saham' => 'required|numeric',
            'pemegang_saham_pertama_persen' => 'required|numeric',
            'pemegang_saham_kedua_persen' => 'required|numeric',
            'direktur_nama' => 'required|string',
            'direktur_email' => 'required|email',
            'direktur_telp' => 'required|string',
            'komisaris_nama' => 'required|string',
            'komisaris_email' => 'required|email',
            'komisaris_telp' => 'required|string',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_usaha' => 'required|string',
            'alamat_pt' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048',
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kblis,id',
        ]);

        $form = FormPTBiasa::create($validated);

        // Upload multiple files
        $form->saveFiles($request);

        // Sync KBLI categories
        $form->kbli()->sync($validated['kbli_ids']);

        return redirect()->route('admin.pt-biasa.index')->with('success', 'PT Biasa created successfully.');
    }

    public function show($id)
    {
        $FormPTBiasa = FormPTBiasa::findOrFail($id);
        return view('admin.pt-biasa.show', compact('FormPTBiasa'));
    }

    public function edit($id)
    {
        // Ambil form PT Biasa berdasarkan ID
        $FormPTBiasa = FormPTBiasa::findOrFail($id);

        // Ambil kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get();

        // Kembalikan view dengan data PT Biasa dan KBLI Categories
        return view('admin.pt-biasa.edit', compact('FormPTBiasa', 'kbliCategories'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pt' => 'required|string',
            'modal_dasar' => 'required|numeric',
            'modal_setor' => 'required|numeric',
            'nilai_nominal_per_saham' => 'required|numeric',
            'pemegang_saham_pertama_persen' => 'required|numeric',
            'pemegang_saham_kedua_persen' => 'required|numeric',
            'direktur_nama' => 'required|string',
            'direktur_email' => 'required|email',
            'direktur_telp' => 'required|string',
            'komisaris_nama' => 'required|string',
            'komisaris_email' => 'required|email',
            'komisaris_telp' => 'required|string',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_usaha' => 'required|string',
            'alamat_pt' => 'required|string',
            'foto_ktp.*' => 'file|mimes:jpg,png|max:2048',
            'foto_npwp.*' => 'file|mimes:jpg,png|max:2048',
        ]);

        $formPTBiasa = FormPTBiasa::findOrFail($id);

        // Update data
        $formPTBiasa->update($validated);

        // Jika ada file KTP dan NPWP yang diunggah, simpan
        if ($request->hasFile('foto_ktp')) {
            $ktpPaths = [];
            foreach ($request->file('foto_ktp') as $ktp) {
                $path = $ktp->store('uploads/ktp');
                $ktpPaths[] = $path;
            }
            $formPTBiasa->foto_ktp = json_encode($ktpPaths);
        }

        if ($request->hasFile('foto_npwp')) {
            $npwpPaths = [];
            foreach ($request->file('foto_npwp') as $npwp) {
                $path = $npwp->store('uploads/npwp');
                $npwpPaths[] = $path;
            }
            $formPTBiasa->foto_npwp = json_encode($npwpPaths);
        }

        // Simpan perubahan
        $formPTBiasa->save();

        return redirect()->route('admin.pt-biasa.index')->with('success', 'PT Biasa updated successfully.');
    }

    public function destroy($id)
    {
        // Cari entri PT Biasa berdasarkan ID
        $ptBiasa = FormPTBiasa::findOrFail($id);

        // Hapus entri
        $ptBiasa->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.pt-biasa.index')->with('success', 'PT Biasa deleted successfully.');
    }
}
