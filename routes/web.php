<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ProductController,
    PTBiasaController,
    PTPeroranganController,
    CVController,
    YayasanController,
    FirmaController,
    KBLIController,
    ChangePasswordController,
    HomeController,
    InfoUserController,
    RegisterController,
    ResetController,
    SessionsController
};

// Route Homepage
Route::get('/', [ProductController::class, 'chooseService'])->name('home');

// Login Routes
Route::get('/customer/login', function () {
    return view('auth.customer_login');
})->name('customer.login');
Route::post('/customer/login', [AuthController::class, 'login'])->name('customer.login.post');

// Admin Dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Customer Dashboard
Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->name('customer.dashboard');

// Form Routes for PT Biasa
Route::get('/form-pt-biasa', [PTBiasaController::class, 'showForm'])->name('pt_biasa.form');
Route::post('/pt-biasa', [PTBiasaController::class, 'submitForm'])->name('pt_biasa.submit');

// Form Routes for PT Perorangan
Route::get('/form-pt-perorangan', [PTPeroranganController::class, 'showForm'])->name('pt_perorangan.form');
Route::post('/pt-perorangan', [PTPeroranganController::class, 'submitForm'])->name('pt_perorangan.submit');

// Form Routes for CV
Route::get('/form-cv', [CVController::class, 'showForm'])->name('cv.form');
Route::post('/cv', [CVController::class, 'submitForm'])->name('cv.submit');

// Form Routes for Yayasan
Route::get('/form-yayasan', [YayasanController::class, 'showForm'])->name('yayasan.form');
Route::post('/yayasan', [YayasanController::class, 'submitForm'])->name('yayasan.submit');

// Form Routes for Firma
Route::get('/form-firma', [FirmaController::class, 'showForm'])->name('firma.form');
Route::post('/firma', [FirmaController::class, 'submitForm'])->name('firma.submit');

// KBLI Routes
Route::get('/kbli/{categoryId}', [KBLIController::class, 'getKbliByCategory']);

// Admin Group Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('billing', fn() => view('admin.billing'))->name('billing');
    Route::get('profile', fn() => view('admin.profile'))->name('profile');
    Route::get('rtl', fn() => view('admin.rtl'))->name('rtl');
    Route::get('tables', fn() => view('admin.tables'))->name('tables');
    Route::get('virtual-reality', fn() => view('admin.virtual-reality'))->name('virtual-reality');
    Route::get('static-sign-in', fn() => view('admin.static-sign-in'))->name('sign-in');
    Route::get('static-sign-up', fn() => view('admin.static-sign-up'))->name('sign-up');

    // User Management Routes
    Route::get('/user-management', [InfoUserController::class, 'index'])->name('admin.user_management.index');
    Route::get('/user-management/add', [InfoUserController::class, 'create'])->name('admin.user_management.create');
    Route::post('/user-management/adddata', [InfoUserController::class, 'store'])->name('admin.user_management.store');
    Route::get('/user-management/edit/{id}', [InfoUserController::class, 'edit'])->name('admin.user_management.edit');
    Route::post('/user-management/update/{id}', [InfoUserController::class, 'update'])->name('admin.user_management.update');
    Route::delete('/user-management/delete/{id}', [InfoUserController::class, 'destroy'])->name('admin.user_management.delete');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'created']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
});

// Guest Routes (Non-authenticated)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// Admin PT Biasa Routes
Route::get('/pt-biasa', [PTBiasaController::class, 'index'])->name('admin.pt-biasa.index');
Route::get('/pt-biasa/create', [PTBiasaController::class, 'create'])->name('admin.pt-biasa.create');
Route::post('/pt-biasa/store', [PTBiasaController::class, 'store'])->name('admin.pt-biasa.store');
Route::get('/pt-biasa/{id}', [PTBiasaController::class, 'show'])->name('admin.pt-biasa.show');
Route::get('/pt-biasa/edit/{id}', [PTBiasaController::class, 'edit'])->name('admin.pt-biasa.edit');
Route::put('/pt-biasa/update/{id}', [PTBiasaController::class, 'update'])->name('admin.pt-biasa.update');
Route::delete('/pt-biasa/{id}', [PTBiasaController::class, 'destroy'])->name('admin.pt-biasa.destroy');

// Admin PT Perorangan Routes
Route::get('/pt-perorangan', [PTPeroranganController::class, 'index'])->name('admin.pt-perorangan.index');
Route::get('/pt-perorangan/create', [PTPeroranganController::class, 'create'])->name('pt-perorangan.create');
Route::post('/pt-perorangan/store', [PTPeroranganController::class, 'store'])->name('pt-perorangan.store');
Route::get('/pt-perorangan/{id}', [PTPeroranganController::class, 'show'])->name('pt-perorangan.show');
Route::get('/pt-perorangan/{id}/edit', [PTPeroranganController::class, 'edit'])->name('pt-perorangan.edit');
Route::put('/pt-perorangan/{id}', [PTPeroranganController::class, 'update'])->name('pt-perorangan.update');
Route::delete('/pt-perorangan/{id}', [PTPeroranganController::class, 'destroy'])->name('pt-perorangan.destroy');

// Admin Firma Routes
Route::get('/firma', [FirmaController::class, 'index'])->name('admin.firma.index');
Route::get('/firma/create', [FirmaController::class, 'create'])->name('firma.create');
Route::post('/firma/store', [FirmaController::class, 'store'])->name('firma.store');
Route::get('/firma/{id}', [FirmaController::class, 'show'])->name('firma.show');
Route::get('/firma/{id}/edit', [FirmaController::class, 'edit'])->name('firma.edit');
Route::put('/firma/{id}', [FirmaController::class, 'update'])->name('firma.update');
Route::delete('/firma/{id}', [FirmaController::class, 'destroy'])->name('firma.destroy');

// Admin CV Routes
Route::get('/cv', [CVController::class, 'index'])->name('admin.cv.index');
Route::get('/cv/create', [CVController::class, 'create'])->name('admin.cv.create');
Route::post('/cv/store', [CVController::class, 'store'])->name('admin.cv.store');
Route::get('/cv/{id}', [CVController::class, 'show'])->name('admin.cv.show');
Route::get('/cv/{id}/edit', [CVController::class, 'edit'])->name('admin.cv.edit');
Route::put('/cv/{id}', [CVController::class, 'update'])->name('admin.cv.update');
Route::delete('/cv/{id}', [CVController::class, 'destroy'])->name('admin.cv.destroy');

// Admin Yayasan Routes
Route::get('/yayasan', [YayasanController::class, 'index'])->name('admin.yayasan.index');
Route::get('/yayasan/create', [YayasanController::class, 'create'])->name('admin.yayasan.create');
Route::post('/yayasan/store', [YayasanController::class, 'store'])->name('admin.yayasan.store');
Route::get('/yayasan/{id}', [YayasanController::class, 'show'])->name('admin.yayasan.show');
Route::get('/yayasan/{id}/edit', [YayasanController::class, 'edit'])->name('admin.yayasan.edit');
Route::put('/yayasan/{id}', [YayasanController::class, 'update'])->name('admin.yayasan.update');
Route::delete('/yayasan/{id}', [YayasanController::class, 'destroy'])->name('admin.yayasan.destroy');

// Route untuk KBLI
Route::get('/kbli', [KBLIController::class, 'index'])->name('admin.kbli.index');
Route::get('/kbli/{id}', [KBLIController::class, 'show'])->name('admin.kbli.show');
Route::get('/kbli/create', [KBLIController::class, 'create'])->name('admin.kbli.create');
Route::post('/kbli/store', [KBLIController::class, 'store'])->name('admin.kbli.store');
Route::get('/kbli/edit/{id}', [KBLIController::class, 'edit'])->name('admin.kbli.edit');
Route::put('/kbli/{id}', [KBLIController::class, 'update'])->name('admin.kbli.update');
Route::delete('/kbli/hapus/{id}', [KBLIController::class, 'destroy'])->name('admin.kbli.destroy');


// Route untuk kategori KBLI
Route::post('kbli-categories/store', [KBLIController::class, 'storeCategory'])->name('admin.kbli.category.store');
Route::get('kbli-categories/{category}/edit', [KBLIController::class, 'editCategory'])->name('admin.kbli.category.edit');
Route::put('kbli-categories/{category}', [KBLIController::class, 'updateCategory'])->name('admin.kbli.category.update');
Route::delete('kbli-categories/{category}', [KBLIController::class, 'destroyCategory'])->name('admin.kbli.category.destroy');

// Route untuk impor data
Route::get('kblis-by-category', [KBLIController::class, 'getKblisByCategory'])->name('admin.kblis.by.category');
Route::post('import-kbli', [KBLIController::class, 'importKbli'])->name('admin.kbli.import');
Route::post('import-kbli-category', [KBLIController::class, 'importKbliCategory'])->name('admin.kbli.category.import');
