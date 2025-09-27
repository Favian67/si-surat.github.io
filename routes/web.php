<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\PerihalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Surat Masuk
    Route::resource('surat-masuk', SuratMasukController::class)->names([
        'index' => 'surat-masuk.index',
        'create' => 'surat-masuk.create',
        'store' => 'surat-masuk.store',
        'edit' => 'surat-masuk.edit',
        'update' => 'surat-masuk.update',
        'destroy' => 'surat-masuk.destroy',
    ]);
    Route::patch('surat-masuk/{id}/approve', [SuratMasukController::class, 'approve'])->name('surat-masuk.approve');
    Route::patch('surat-masuk/{id}/reject', [SuratMasukController::class, 'reject'])->name('surat-masuk.reject');

    // Surat Keluar
    Route::resource('surat-keluar', SuratKeluarController::class)->names([
        'index' => 'surat-keluar.index',
        'create' => 'surat-keluar.create',
        'store' => 'surat-keluar.store',
        'edit' => 'surat-keluar.edit',
        'update' => 'surat-keluar.update',
        'destroy' => 'surat-keluar.destroy',
    ]);
    
    // Perihal
    Route::resource('perihal', PerihalController::class)->names([
        'index' => 'perihal.index',
        'create' => 'perihal.create',
        'store' => 'perihal.store',
        'edit' => 'perihal.edit',
        'update' => 'perihal.update',
        'destroy' => 'perihal.destroy',
    ]);

    // Users
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/masuk', [LaporanController::class, 'exportMasuk'])->name('laporan.masuk');
    Route::get('laporan/keluar', [LaporanController::class, 'exportKeluar'])->name('laporan.keluar');

    // Validasi
    Route::patch('/admin/surat-keluar/{id}/approve', [SuratKeluarController::class, 'approve'])
        ->name('admin.surat-keluar.approve');
    Route::patch('/admin/surat-keluar/{id}/reject', [SuratKeluarController::class, 'reject'])
        ->name('admin.surat-keluar.reject');
});


/*
|--------------------------------------------------------------------------
| SEKOLAH (SD & SMP)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:sekolah_sd,sekolah_smp'])->prefix('sekolah')->name('sekolah.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'sekolah'])->name('dashboard');

    Route::resource('surat-masuk', SuratMasukController::class)->names([
        'index' => 'surat-masuk.index',
        'create' => 'surat-masuk.create',
        'store' => 'surat-masuk.store',
        'edit' => 'surat-masuk.edit',
        'update' => 'surat-masuk.update',
        'destroy' => 'surat-masuk.destroy',
    ]);

    Route::resource('surat-keluar', SuratKeluarController::class)->names([
        'index' => 'surat-keluar.index',
        'create' => 'surat-keluar.create',
        'store' => 'surat-keluar.store',
        'edit' => 'surat-keluar.edit',
        'update' => 'surat-keluar.update',
        'destroy' => 'surat-keluar.destroy',
    ]);

    Route::get('laporan', [LaporanController::class, 'sekolahIndex'])->name('laporan.index');
    Route::get('laporan/masuk', [LaporanController::class, 'exportMasuk'])->name('laporan.masuk');
    Route::get('laporan/keluar', [LaporanController::class, 'exportKeluar'])->name('laporan.keluar');
    Route::get('laporan/cetak', [LaporanController::class, 'sekolahCetak'])->name('laporan.cetak');
});


/*
|--------------------------------------------------------------------------
| GURU SD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru_sd'])->prefix('guru-sd')->name('guru_sd.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'guruSD'])->name('dashboard');

    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);

    Route::get('laporan', [LaporanController::class, 'guruIndex'])->name('laporan.index');
    Route::get('laporan/masuk', [LaporanController::class, 'exportMasuk'])->name('laporan.masuk');
    Route::get('laporan/keluar', [LaporanController::class, 'exportKeluar'])->name('laporan.keluar');
    Route::get('laporan/cetak', [LaporanController::class, 'guruCetak'])->name('laporan.cetak');
});


/*
|--------------------------------------------------------------------------
| GURU SMP
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru_smp'])->prefix('guru-smp')->name('guru_smp.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'guruSMP'])->name('dashboard');

    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);

    Route::get('laporan', [LaporanController::class, 'guruIndex'])->name('laporan.index');
    Route::get('laporan/masuk', [LaporanController::class, 'exportMasuk'])->name('laporan.masuk');
    Route::get('laporan/keluar', [LaporanController::class, 'exportKeluar'])->name('laporan.keluar');
    Route::get('laporan/cetak', [LaporanController::class, 'guruCetak'])->name('laporan.cetak');
});


/*
|--------------------------------------------------------------------------
| KORWIL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':korwil'])->prefix('korwil')->name('korwil.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'korwil'])->name('dashboard');

    // Surat Masuk
    Route::resource('surat-masuk', SuratMasukController::class)->names([
        'index' => 'surat-masuk.index',
        'create' => 'surat-masuk.create',
        'store' => 'surat-masuk.store',
        'edit' => 'surat-masuk.edit',
        'update' => 'surat-masuk.update',
        'destroy' => 'surat-masuk.destroy',
    ]);
    
    // Surat Keluar
    Route::resource('surat-keluar', SuratKeluarController::class)->names([
        'index' => 'surat-keluar.index',
        'create' => 'surat-keluar.create',
        'store' => 'surat-keluar.store',
        'edit' => 'surat-keluar.edit',
        'update' => 'surat-keluar.update',
        'destroy' => 'surat-keluar.destroy',
    ]);
    Route::patch('surat-keluar/{id}/approve', [SuratKeluarController::class, 'approve'])->name('surat-keluar.approve');
    Route::patch('surat-keluar/{id}/reject', [SuratKeluarController::class, 'reject'])->name('surat-keluar.reject');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'korwilIndex'])->name('laporan.index');
    Route::get('laporan/masuk', [LaporanController::class, 'exportMasuk'])->name('laporan.masuk');
    Route::get('laporan/keluar', [LaporanController::class, 'exportKeluar'])->name('laporan.keluar');
    Route::get('laporan/cetak', [LaporanController::class, 'korwilCetak'])->name('laporan.cetak');

    // validasi
    // Validasi
    Route::patch('/admin/surat-keluar/{id}/approve', [SuratKeluarController::class, 'approve'])
        ->name('admin.surat-keluar.approve');
    Route::patch('/admin/surat-keluar/{id}/reject', [SuratKeluarController::class, 'reject'])
        ->name('admin.surat-keluar.reject');
});
