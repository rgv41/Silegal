<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormYayasan;
use App\Models\KBLICategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class YayasanController extends Controller
{
    // Tampilkan Form Yayasan
    public function showForm($id = null)
    {
        // Ambil data kategori KBLI
        $kbliCategories = KBLICategory::with('kblis')->get(); // Ambil semua kategori dan relasi KBLI jika ada

        // Ambil form PT Biasa jika id ada (untuk menampilkan gambar yang di-upload)
        $form = $id ? FormYayasan::find($id) : null;

        // Kembalikan view dengan data kategori KBLI dan form Yayasan
        return view('forms.yayasan', compact('kbliCategories', 'form'));
    }

    // Simpan Data Yayasan
    public function submitForm(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
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
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'nullable|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        try {
            // Buat instance FormYayasan dan simpan data
            $form = new FormYayasan();
            $form->nama_yayasan = $validated['nama_yayasan'];
            $form->modal = $validated['modal'];
            $form->pendiri = $validated['pendiri'];
            $form->pembina = $validated['pembina'];
            $form->no_hp_pembina = $validated['no_hp_pembina'];
            $form->email_pembina = $validated['email_pembina'];
            $form->ketua_pengurus = $validated['ketua_pengurus'];
            $form->no_hp_ketua_pengurus = $validated['no_hp_ketua_pengurus'];
            $form->email_ketua_pengurus = $validated['email_ketua_pengurus'];
            $form->sekretaris = $validated['sekretaris'];
            $form->no_hp_sekretaris = $validated['no_hp_sekretaris'];
            $form->email_sekretaris = $validated['email_sekretaris'];
            $form->bendahara = $validated['bendahara'];
            $form->no_hp_bendahara = $validated['no_hp_bendahara'];
            $form->email_bendahara = $validated['email_bendahara'];
            $form->pengawas = $validated['pengawas'];
            $form->no_hp_pengawas = $validated['no_hp_pengawas'];
            $form->email_pengawas = $validated['email_pengawas'];
            $form->alamat_lengkap = $validated['alamat_lengkap'];
            $form->rt_rw = $validated['rt_rw'];
            $form->kode_pos = $validated['kode_pos'];
            $form->kelurahan = $validated['kelurahan'];
            $form->kecamatan = $validated['kecamatan'];
            $form->kabupaten = $validated['kabupaten'];
            $form->no_telp_hk_kantor = $validated['no_telp_hk_kantor'];
            $form->email_kantor = $validated['email_kantor'];
            $form->bidang_yayasan = $validated['bidang_yayasan'];

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

            // Simpan pilihan KBLI hanya jika ada
            if (!empty($validated['kbli_ids'])) {
                $form->kbli()->sync($validated['kbli_ids']);
            }
            Log::info('Data form berhasil disimpan. ID: ' . $form->id);

            return redirect()->route('yayasan.form')->with('success', 'Form Yayasan berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving form: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat menyimpan form.']);
        }
    }
    public function index()
    {
        $YayasanEntries = FormYayasan::all();
        return view('admin.yayasan.index', compact('YayasanEntries'));
    }

    public function create()
    {
        return view('admin.yayasan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'nullable|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        FormYayasan::create($validated);
        return redirect()->route('admin.yayasan.index')->with('success', 'Yayasan created successfully.');
    }

    public function show($id)
    {
        $FormYayasan = FormYayasan::findOrFail($id);
        return view('admin.yayasan.show', compact('FormYayasan'));
    }

    public function edit($id)
    {
        $FormYayasan = FormYayasan::findOrFail($id);
        return view('admin.yayasan.edit', compact('FormYayasan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
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
            'foto_ktp.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi setiap file KTP
            'foto_npwp.*' => 'required|file|mimes:jpg,png|max:2048',
            'kbli_ids' => 'nullable|array',
            'kbli_ids.*' => 'exists:kbli,id',
        ]);

        $FormYayasan = FormYayasan::findOrFail($id);
        $FormYayasan->update($validated);

        return redirect()->route('admin.yayasan.index')->with('success', 'Yayasan updated successfully.');
    }
    public function destroy($id)
    {
        // Cari entri Yayasan berdasarkan ID
        $yayasan = FormYayasan::findOrFail($id);

        // Hapus entri
        $yayasan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.yayasan.index')->with('success', 'Yayasan deleted successfully.');
    }
}
