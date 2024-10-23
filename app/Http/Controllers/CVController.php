<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormCV;
use App\Models\KBLICategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CVController extends Controller
{
    // Tampilkan Form CV
    public function showForm($id = null)
    {
        // Ambil data kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get(); // Ambil semua kategori dan relasi KBLI jika ada

        // Ambil form PT Biasa jika id ada (untuk menampilkan gambar yang di-upload)
        $form = $id ? FormCV::find($id) : null;

        // Kembalikan view dengan data kategori KBLI dan form PT Perorangan
        return view('forms.cv', compact('kbliCategories', 'form'));
    }

    // Simpan Data CV
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'nama_cv' => 'required|string',
            'modal_cv' => 'required|numeric',
            'pemegang_saham_pertama' => 'required|numeric',
            'pemegang_saham_kedua' => 'required|numeric',
            'direktur' => 'required|string',
            'no_telp_direktur' => 'required|string',
            'email_direktur' => 'required|email',
            'komisaris' => 'required|string',
            'no_telp_komisaris' => 'required|string',
            'email_komisaris' => 'required|email',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_usaha' => 'required|string',
            'alamat_cv' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        try {
            $form = new FormCV();
            $form->nama_cv = $validated['nama_cv'];
            $form->modal_cv = $validated['modal_cv'];
            $form->pemegang_saham_pertama = $validated['pemegang_saham_pertama'];
            $form->pemegang_saham_kedua = $validated['pemegang_saham_kedua'];
            $form->direktur = $validated['direktur'];
            $form->no_telp_direktur = $validated['no_telp_direktur'];
            $form->email_direktur = $validated['email_direktur'];
            $form->komisaris = $validated['komisaris'];
            $form->no_telp_komisaris = $validated['no_telp_komisaris'];
            $form->email_komisaris = $validated['email_komisaris'];
            $form->no_telp_kantor = $validated['no_telp_kantor'];
            $form->email_kantor = $validated['email_kantor'];
            $form->bidang_usaha = $validated['bidang_usaha'];
            $form->alamat_cv = $validated['alamat_cv'];

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

            $form->password = Hash::make(Str::random(8));
            $form->save();

            // Simpan pilihan KBLI ke tabel pivot
            $form->kbli()->sync($validated['kbli_ids']);

            Log::info('Data form berhasil disimpan. ID: ' . $form->id);

            // Redirect ke halaman CV setelah berhasil disimpan
            return redirect()->route('cv.form')->with('success', 'Form CV berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving form: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function index()
    {
        $CVEntries = FormCV::all();
        return view('admin.cv.index', compact('CVEntries'));
    }

    public function create()
    {
        return view('admin.cv.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_cv' => 'required|string',
            'modal_cv' => 'required|numeric',
            'pemegang_saham_pertama' => 'required|numeric',
            'pemegang_saham_kedua' => 'required|numeric',
            'direktur' => 'required|string',
            'no_telp_direktur' => 'required|string',
            'email_direktur' => 'required|email',
            'komisaris' => 'required|string',
            'no_telp_komisaris' => 'required|string',
            'email_komisaris' => 'required|email',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_usaha' => 'required|string',
            'alamat_cv' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        FormCV::create($validated);
        return redirect()->route('admin.cv.index')->with('success', 'PT CV created successfully.');
    }

    public function show($id)
    {
        $FormCV = FormCV::findOrFail($id);
        return view('admin.cv.show', compact('FormCV'));
    }

    public function edit($id)
    {
        $FormCV = FormCV::findOrFail($id);
        return view('admin.cv.edit', compact('FormCV'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_cv' => 'required|string',
            'modal_cv' => 'required|numeric',
            'pemegang_saham_pertama' => 'required|numeric',
            'pemegang_saham_kedua' => 'required|numeric',
            'direktur' => 'required|string',
            'no_telp_direktur' => 'required|string',
            'email_direktur' => 'required|email',
            'komisaris' => 'required|string',
            'no_telp_komisaris' => 'required|string',
            'email_komisaris' => 'required|email',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'bidang_usaha' => 'required|string',
            'alamat_cv' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        $FormCV = FormCV::findOrFail($id);
        $FormCV->update($validated);

        return redirect()->route('admin.cv.index')->with('success', 'PT CV updated successfully.');
    }
    public function destroy($id)
    {
        // Cari entri CV berdasarkan ID
        $cv = FormCV::findOrFail($id);

        // Hapus entri
        $cv->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.cv.index')->with('success', 'PT CV deleted successfully.');
    }
}
