<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPTPerorangan;
use App\Models\KBLICategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PTPeroranganController extends Controller
{
    // Tampilkan Form PT Perorangan
    public function showForm($id = null)
    {
        // Ambil data kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get(); // Ambil semua kategori dan relasi KBLI jika ada

        // Ambil form PT Perorangan jika id ada (untuk menampilkan gambar yang di-upload)
        $form = $id ? FormPTPerorangan::find($id) : null;

        // Kembalikan view dengan data kategori KBLI dan form PT Perorangan
        return view('forms.pt_perorangan', compact('kbliCategories', 'form'));
    }

    // Simpan Data PT Perorangan
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'nama_pt' => 'required|string',
            'no_telp' => 'required|string',
            'alamat_pt' => 'required|string',
            'modal_usaha' => 'required|numeric',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file NPWP
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id', // Validasi KBLI harus ada di tabel KBLI
        ]);

        try {
            // Buat form baru
            $form = new FormPTPerorangan();
            $form->nama_pt = $validated['nama_pt'];
            $form->no_telp = $validated['no_telp'];
            $form->alamat_pt = $validated['alamat_pt'];
            $form->modal_usaha = $validated['modal_usaha'];

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

            // Buat password acak untuk form ini
            $form->password = Hash::make(Str::random(8));
            $form->save();

            // Simpan pilihan KBLI ke tabel pivot
            $form->kbli()->sync($validated['kbli_ids']);

            // Log keberhasilan
            Log::info('Data form berhasil disimpan. ID: ' . $form->id);

            // Redirect ke form lagi dengan ID untuk menampilkan data yang baru di-upload
            return redirect()->route('pt_perorangan.form', ['id' => $form->id])->with('success', 'Form PT Perorangan berhasil disimpan.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error saving form: ' . $e->getMessage());

            // Kembali ke form dengan pesan error
            return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function index()
    {
        $ptPeroranganEntries = FormPTPerorangan::all();
        return view('admin.pt-perorangan.index', compact('ptPeroranganEntries'));
    }

    public function create()
    {
        return view('admin.pt-perorangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pt' => 'required|string',
            'no_telp' => 'required|string',
            'alamat_pt' => 'required|string',
            'modal_usaha' => 'required|numeric',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file NPWP
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id', // Validasi KBLI harus ada di tabel KBLI
        ]);

        FormPTPerorangan::create($validated);
        return redirect()->route('admin.pt-perorangan.index')->with('success', 'PT Perorangan created successfully.');
    }

    public function show($id)
    {
        $FormPTPerorangan = FormPTPerorangan::findOrFail($id);
        return view('admin.pt-perorangan.show', compact('FormPTPerorangan'));
    }

    public function edit($id)
    {
        $FormPTPerorangan = FormPTPerorangan::findOrFail($id);
        return view('admin.pt-perorangan.edit', compact('FormPTPerorangan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pt' => 'required|string',
            'no_telp' => 'required|string',
            'alamat_pt' => 'required|string',
            'modal_usaha' => 'required|numeric',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file NPWP
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id', // Validasi KBLI harus ada di tabel KBLI
        ]);

        $FormPTPerorangan = FormPTPerorangan::findOrFail($id);
        $FormPTPerorangan->update($validated);

        return redirect()->route('admin.pt-perorangan.index')->with('success', 'PT Perorangan updated successfully.');
    }
    public function destroy($id)
    {
        // Cari entri PT perorangan berdasarkan ID
        $ptPerorangan = FormPTPerorangan::findOrFail($id);

        // Hapus entri
        $ptPerorangan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.pt-perorangan.index')->with('success', 'PT Perorangan deleted successfully.');
    }
}
