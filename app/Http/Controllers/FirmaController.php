<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormFirma;
use App\Models\KBLICategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FirmaController extends Controller
{
    // Tampilkan Form Firma
    public function showForm($id = null)
    {
        // Ambil data kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get(); // Ambil semua kategori dan relasi KBLI jika ada

        // Ambil form PT Biasa jika id ada (untuk menampilkan gambar yang di-upload)
        $form = $id ? FormFirma::find($id) : null;

        // Kembalikan view dengan data kategori KBLI dan form Firma
        return view('forms.firma', compact('kbliCategories', 'form'));
    }

    // Simpan Data Firma
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'nama_firma' => 'required|string',
            'modal' => 'required|numeric',
            'managing_partner' => 'required|string',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'managing_partner_telp' => 'required|string',
            'managing_partner_email' => 'required|email',
            'partner_telp' => 'required|string',
            'partner_email' => 'required|email',
            'alamat_firma' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'password' => 'nullable|string|min:8',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        try {
            $form = new FormFirma();
            $form->nama_firma = $validated['nama_firma'];
            $form->modal = $validated['modal'];
            $form->managing_partner = $validated['managing_partner'];
            $form->no_telp_kantor = $validated['no_telp_kantor'];
            $form->email_kantor = $validated['email_kantor'];
            $form->managing_partner_telp = $validated['managing_partner_telp'];
            $form->managing_partner_email = $validated['managing_partner_email'];
            $form->partner_telp = $validated['partner_telp']; // Optional
            $form->partner_email = $validated['partner_email']; // Optional
            $form->alamat_firma = $validated['alamat_firma'];


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

            // Jika password disediakan
            if ($request->password) {
                $form->password = Hash::make($request->password);
            } else {
                // Jika password tidak disediakan, maka buat random password
                $form->password = Hash::make(Str::random(8));
            }

            $form->save();
            // Simpan pilihan KBLI ke tabel pivot
            $form->kbli()->sync($validated['kbli_ids']);

            Log::info('Data form firma berhasil disimpan. ID: ' . $form->id);

            return redirect()->route('firma.form')->with('success', 'Form Firma berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving form: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function index()
    {
        $ptFirmaEntries = FormFirma::all();
        return view('admin.firma.index', compact('ptFirmaEntries'));
    }

    public function create()
    {
        return view('admin.firma.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_firma' => 'required|string',
            'modal' => 'required|numeric',
            'managing_partner' => 'required|string',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'managing_partner_telp' => 'required|string',
            'managing_partner_email' => 'required|email',
            'partner_telp' => 'required|string',
            'partner_email' => 'required|email',
            'alamat_firma' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'password' => 'nullable|string|min:8',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        FormFirma::create($validated);
        return redirect()->route('admin.firma.index')->with('success', 'PT Firma created successfully.');
    }

    public function show($id)
    {
        $FormFirma = FormFirma::findOrFail($id);
        return view('admin.firma.show', compact('FormFirma'));
    }

    public function edit($id)
    {
        $FormFirma = FormFirma::findOrFail($id);
        return view('admin.firma.edit', compact('FormFirma'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_firma' => 'required|string',
            'modal' => 'required|numeric',
            'managing_partner' => 'required|string',
            'no_telp_kantor' => 'required|string',
            'email_kantor' => 'required|email',
            'managing_partner_telp' => 'required|string',
            'managing_partner_email' => 'required|email',
            'partner_telp' => 'required|string',
            'partner_email' => 'required|email',
            'alamat_firma' => 'required|string',
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'password' => 'nullable|string|min:8',
            'kbli_ids' => 'required|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        $FormFirma = FormFirma::findOrFail($id);
        $FormFirma->update($validated);

        return redirect()->route('admin.firma.index')->with('success', 'PT Firma updated successfully.');
    }
    public function destroy($id)
    {
        // Cari entri Firma berdasarkan ID
        $Firma = FormFirma::findOrFail($id);

        // Hapus entri
        $Firma->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.firma.index')->with('success', 'PT Firma deleted successfully.');
    }
}
