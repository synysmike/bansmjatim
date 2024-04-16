<?php

use App\Models\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpaController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AbsenDhController;
use App\Http\Controllers\GalleryController;
// use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\RakordaController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AssetsFormController;
use App\Http\Controllers\ConfigFormController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DaftarhadirController;
use App\Http\Controllers\DetilSekolahController;
use App\Http\Controllers\JudulAbsenController;
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



Route::get('/visitasi',function(){
return redirect("http://202.51.106.30/visitasi/");
});
Route::get('/asesor',function(){
return redirect("http://202.51.106.30/asesor/");
});



Route::get('/', [HomeController::class, 'index']);
Route::resource('/asesor', AsesorController::class);
Route::resource('/dh_absen', AbsenDhController::class);
Route::resource('/sekretariat', NamaSekretariatController::class);
Route::resource('/judul_absen', JudulAbsenController::class);
Route::get('/total', [VerifikasiController::class, 'total']);
Route::get('/status', [DetilsekolahController::class, 'status']);
Route::post('/perbaikan', [DetilsekolahController::class, 'perbaikan']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/loginbansm', [AuthController::class, 'login'])->name('login');
// Route::resource('/login', AuthController::class);
Route::post('/logout', [AuthController::class, 'logout']);

// public access
Route::get('/tbl-dh', [DaftarhadirController::class, 'tbl_dh']);
Route::get('/cetak-dh', [DaftarhadirController::class, 'cetak']);
Route::get('/list-dh', [DaftarhadirController::class, 'view']);
Route::get('/configtable', [DaftarhadirController::class, 'config']);
Route::get('/kesanggupan', [DaftarhadirController::class, 'kesediaan']);
Route::post('/kesanggupan', [DaftarhadirController::class, 'postkesediaan']);
Route::get('/sesi1', [DaftarhadirController::class, 'sesi1']);
Route::post('/sesi1', [DaftarhadirController::class, 'postsesi1']);
Route::post('/settable', [DaftarhadirController::class, 'set_config']);

// dynamic URL get from config_table
Route::get('form/{link}', [DaftarhadirController::class,'index']);
Route::post('form/{link}', [DaftarhadirController::class,'store']);
Route::post('/form/{link}/{id}', [DaftarhadirController::class,'show']);

Route::get('link/{red}', [UrlController::class,'redirect']);
Route::get('link/{link}', [UrlController::class,'show']);
Route::get('link/', [UrlController::class,'index']);
Route::post('link/', [UrlController::class,'store']);

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


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);
});

Route::middleware(['auth', 'role:kpa'])->group(function () {
    Route::resource('verifikasi', VerifikasiController::class);
    Route::get('/admin', [SekolahController::class, 'admin']);
});

Route::middleware(['auth', 'role:sekolah'])->group(function () {
    Route::resource('/detilsekolah', DetilSekolahController::class);
});

Route::middleware(['auth', 'role:kpa|admin'])->group(function () {
    Route::resource('sekolah', SekolahController::class);
    // Route::resource('gallery', GalleryController::class);
    Route::get('/bmps', [SekolahController::class, 'bmps']);
    Route::post('/bmps', [SekolahController::class, 'bmps']);
    
});
