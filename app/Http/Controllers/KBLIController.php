<?php

namespace App\Http\Controllers;

use App\Imports\KbliCategoryImport;
use App\Imports\KbliImport;
use App\Models\KBLI;
use App\Models\KBLICategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class KBLIController extends Controller
{
    // Menampilkan halaman utama KBLI
    public function index()
    {
        $kblis = Kbli::with('category')->get();
        $categories = KbliCategory::all();
        return view('admin.kbli.index', compact('kblis', 'categories'));
    }

    // Menampilkan detail dari KBLI yang dipilih
    public function show($id)
    {
        $kbli = Kbli::with('category')->findOrFail($id);
        return view('admin.kbli.show', compact('kbli'));
    }

    // Menampilkan form untuk menambah KBLI
    public function create()
    {
        $categories = KbliCategory::all();
        return view('admin.kbli.create', compact('categories'));
    }

    // Menyimpan KBLI baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_kbli' => 'required|string|max:255',
            'deskripsi_kbli' => 'required|string|max:255',
            'kbli_category_id' => 'required|exists:kbli_categories,id',
        ]);

        Kbli::create($request->all());
        return redirect()->route('admin.kbli.index')->with('success', 'KBLI berhasil ditambahkan.');
    }

    // Menampilkan form untuk edit KBLI
    public function edit(Kbli $kbli)
    {
        $categories = KbliCategory::all();
        return view('admin.kbli.edit', compact('kbli', 'categories'));
    }

    // Memperbarui KBLI
    public function update(Request $request, Kbli $kbli)
    {
        Log::info('KBLI instance:', ['kbli' => $kbli]);

        $request->validate([
            'kode_kbli' => 'required|string|max:255',
            'deskripsi_kbli' => 'required|string|max:255',
            'kbli_category_id' => 'required|exists:kbli_categories,id',
        ]);

        // Coba update manual
        $result = DB::table('kbli')
            ->where('id', $kbli->id)
            ->update([
                'kode_kbli' => $request->kode_kbli,
                'deskripsi_kbli' => $request->deskripsi_kbli,
                'kbli_category_id' => $request->kbli_category_id,
            ]);

        Log::info('KBLI update result: ', ['status' => $result, 'updated_id' => $kbli->id]);

        return redirect()->route('admin.kbli.index')->with('success', 'KBLI berhasil diperbarui.');
    }


    // Menghapus KBLI
    public function destroy($id)
    { // Debug untuk melihat ID yang diterima
        $kbli = Kbli::findOrFail($id);

        $result = $kbli->delete(); // Melakukan penghapusan

        Log::info('KBLI delete result: ', ['status' => $result, 'id' => $kbli->id]);

        if ($result) {
            return redirect()->route('admin.kbli.index')->with('success', 'KBLI berhasil dihapus.');
        } else {
            return redirect()->route('admin.kbli.index')->withErrors('KBLI gagal dihapus.');
        }
    }

    // Menyimpan kategori KBLI baru
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        KbliCategory::create($request->all());
        return redirect()->route('admin.kbli.index')->with('success', 'Kategori KBLI berhasil ditambahkan.');
    }

    // Menampilkan form untuk edit kategori KBLI
    public function editCategory(KbliCategory $category)
    {
        return view('admin.kbli.categories.edit', compact('category'));
    }

    // Memperbarui kategori KBLI
    public function updateCategory(Request $request, KbliCategory $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return redirect()->route('admin.kbli.index')->with('success', 'Kategori KBLI berhasil diperbarui.');
    }

    // Menghapus kategori KBLI
    public function destroyCategory(KbliCategory $category)
    {
        // Memastikan kategori tidak digunakan di tabel KBLI sebelum menghapus
        if ($category->kblis()->count() > 0) {
            return redirect()->route('admin.kbli.index')->withErrors('Kategori ini masih digunakan di KBLI dan tidak dapat dihapus.');
        }

        $category->delete();
        return redirect()->route('admin.kbli.index')->with('success', 'Kategori KBLI berhasil dihapus.');
    }

    // Mengambil KBLI berdasarkan kategori
    public function getKblisByCategory(Request $request)
    {
        $categoryId = $request->get('category_id');
        $kblis = Kbli::where('kbli_category_id', $categoryId)->with('category')->get();
        return response()->json($kblis);
    }

    // Mengimpor data KBLI
    public function importKbli(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new KbliImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data KBLI berhasil diimpor.');
    }

    // Mengimpor data kategori KBLI
    public function importKbliCategory(Request $request)
    {
        DB::beginTransaction();
        try {
            Excel::import(new KbliCategoryImport, $request->file('file'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Data Kategori KBLI berhasil diimpor.');
    }
}
