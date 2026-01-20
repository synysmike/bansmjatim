<?php

use App\Models\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpaController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AsesorController;
// use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\AbsenDhController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RakordaController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\FormController;
// use App\Http\Controllers\RecordBioController;
// use App\Http\Controllers\AssetsFormController;
// use App\Http\Controllers\ConfigFormController;
use App\Http\Controllers\JudulAbsenController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DaftarhadirController;
// use App\Http\Controllers\MSoslokFormController;
use App\Http\Controllers\DetilSekolahController;
use App\Http\Controllers\NamaSekretariatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('tes', function(){
//     return view('admin.modal');
// });
// Route::get('sekolah', [SekolahController::class, 'index']);
// Route::get('sekolah/{id}', [SekolahController::class, 'show']);



Route::get('/visitasi', function () {
    return redirect("http://202.51.106.30/visitasi/");
});
Route::get('/asesor', function () {
    return redirect("http://202.51.106.30/asesor/");
});



Route::resource('/berita', BeritaController::class);
Route::resource('/galeri', GalleryController::class);
Route::resource('/info', InfoController::class);



// Route::resource('/bio', RecordBioController::class);
// Route::resource('/form-field', MSoslokFormController::class);

Route::get('/', [HomeController::class, 'index']);
Route::resource('/asesor', AsesorController::class);
Route::resource('/presensi', AbsenDhController::class);
Route::resource('/sekretariat', NamaSekretariatController::class);
Route::resource('/judul_absen', JudulAbsenController::class);
Route::get('/report_dh/{link}', [AbsenDhController::class, 'view']);
Route::get('/total', [VerifikasiController::class, 'total']);
Route::get('/status', [DetilsekolahController::class, 'status']);
Route::post('/perbaikan', [DetilsekolahController::class, 'perbaikan']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/loginbansm', [AuthController::class, 'login'])->name('login');
// Route::resource('/login', AuthController::class);
Route::post('/logout', [AuthController::class, 'logout']);

// public access
Route::post('/list-form', [DaftarhadirController::class, 'listForm']);
// Route::get('/tbl-dh', [DaftarhadirController::class, 'tbl_dh']);
Route::get('/cetak-dh/{link}', [DaftarhadirController::class, 'cetak']);
Route::get('/export-dh/{link}', [DaftarhadirController::class, 'dh_export']);
Route::get('/list-dh/{link}', [DaftarhadirController::class, 'view']);
Route::get('/selectlist/{id}', [DaftarhadirController::class, 'selectlist']);
Route::get('/kesanggupan', [DaftarhadirController::class, 'kesediaan']);
Route::post('/kesanggupan', [DaftarhadirController::class, 'postkesediaan']);
Route::get('/sesi1', [DaftarhadirController::class, 'sesi1']);
Route::post('/sesi1', [DaftarhadirController::class, 'postsesi1']);

// Route::delete('/del_config/{id}', [DaftarhadirController::class, 'del_config']);
// Route::get('/show_config/{id}', [DaftarhadirController::class, 'show_config']);
// Route::post('/settable', [DaftarhadirController::class, 'set_config']);
// Route::get('/configtable', [DaftarhadirController::class, 'config']);
// access of config
Route::resource('/config', ConfigController::class);

// dynamic URL get from config_table
Route::get('form/{link}', [DaftarhadirController::class, 'index']);
Route::get('print', [DaftarhadirController::class, 'print_form']);
Route::post('form/{link}', [DaftarhadirController::class, 'store']);
// Route::post('/form/{link}/{id}', [DaftarhadirController::class,'show']);

Route::get('link/{red}', [UrlController::class, 'redirect']);
Route::get('link/{link}', [UrlController::class, 'show']);
Route::get('link/', [UrlController::class, 'index']);
Route::post('link/', [UrlController::class, 'store']);

Route::get('list-form/', [FormController::class, 'index']);
Route::get('list-form/list/', [FormController::class, 'get_form']);

// Route::resource('/link', UrlController::class);
// Route::resource('/kinerja', KinerjaController::class);

Route::resource('/bukutamu', BukuTamuController::class);
Route::resource('/rakorda', RakordaController::class);
Route::resource('kpa', KpaController::class);
Route::get('/registrasi-kpa', [KpaController::class, 'index']);
Route::resource('/absen', AbsenController::class);
// Route::resource('/configform', ConfigFormController::class);
// Route::resource('/assetform', AssetsFormController::class);
// Route::get('/assetlists{list}', [ConfigFormController::class, 'assetlists']);

Route::get('/ordal_berita', [BeritaController::class, 'ordal_berita']);
Route::post('/ordal_berita', [BeritaController::class, 'store']);
Route::post('/kategori', [BeritaController::class, 'store_kat']);
Route::get('/kategori', [BeritaController::class, 'get_kat']);
Route::get('/get-kat', [BeritaController::class, 'get_katlist']);
Route::get('/kategori/{id}/edit', [BeritaController::class, 'edit_kat']);
Route::delete('/kategori/{id}', [BeritaController::class, 'destroy_kat']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('admin/home', App\Http\Controllers\Admin\AdminHomeController::class)->names('admin.home');
    
    // Super Admin Dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\SuperAdminController::class, 'index'])->name('admin.dashboard');
    
    // Berita Management (Admin access)
    Route::get('/admin/berita', [BeritaController::class, 'ordal_berita'])->name('admin.berita.index');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
    Route::get('/admin/berita/kategori', [BeritaController::class, 'get_kat'])->name('admin.berita.kategori');
    Route::post('/admin/berita/kategori', [BeritaController::class, 'store_kat'])->name('admin.berita.kategori.store');
    Route::get('/admin/berita/kategori/list', [BeritaController::class, 'get_katlist'])->name('admin.berita.kategori.list');
    Route::get('/admin/berita/kategori/{id}/edit', [BeritaController::class, 'edit_kat'])->name('admin.berita.kategori.edit');
    Route::delete('/admin/berita/kategori/{id}', [BeritaController::class, 'destroy_kat'])->name('admin.berita.kategori.destroy');
    
    // Staff/Sekretariat Management (Admin access)
    Route::get('/admin/staff', [NamaSekretariatController::class, 'index'])->name('admin.staff.index');
    Route::get('/admin/staff/create', [NamaSekretariatController::class, 'create'])->name('admin.staff.create');
    Route::post('/admin/staff', [NamaSekretariatController::class, 'store'])->name('admin.staff.store');
    Route::get('/admin/staff/{id}/edit', [NamaSekretariatController::class, 'edit'])->name('admin.staff.edit');
    Route::put('/admin/staff/{id}', [NamaSekretariatController::class, 'update'])->name('admin.staff.update');
    Route::delete('/admin/staff/{id}', [NamaSekretariatController::class, 'destroy'])->name('admin.staff.destroy');
    
    // Config Management (Admin access)
    Route::get('/admin/config', [ConfigController::class, 'index'])->name('admin.config.index');
    Route::post('/admin/config', [ConfigController::class, 'store'])->name('admin.config.store');
    Route::get('/admin/config/{id}', [ConfigController::class, 'show'])->name('admin.config.show');
    Route::delete('/admin/config/{id}', [ConfigController::class, 'destroy'])->name('admin.config.destroy');
});

Route::middleware(['auth', 'role:kpa|admin'])->group(function () {
    Route::resource('verifikasi', VerifikasiController::class);
    Route::get('/admin', [SekolahController::class, 'admin']);
});

Route::middleware(['auth', 'role:sekolah|admin'])->group(function () {
    Route::resource('/detilsekolah', DetilSekolahController::class);
});

Route::middleware(['auth', 'role:kpa|admin'])->group(function () {
    Route::resource('sekolah', SekolahController::class);
    // Route::resource('gallery', GalleryController::class);
    Route::get('/bmps', [SekolahController::class, 'bmps']);
    Route::post('/bmps', [SekolahController::class, 'bmps']);
});
