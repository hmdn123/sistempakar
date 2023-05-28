<?php

use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\RulesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/temukan-penyakit', [HomeController::class, 'temukanPenyakit'])->name('temukanPenyakit');

Route::get('/temukan-penyakit-bawang', function () {
    return view('hasil');
});

Route::get('/setelan-pengguna', function () {
    return view('admin.setelan');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard', ['title' => 'Dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/indikator', IndikatorController::class);
    Route::resource('/penyakit', PenyakitController::class);
    Route::resource('/input-rules', RulesController::class);
    Route::resource('/data-pengguna', DataPenggunaController::class);

    // Export Indiktor
    Route::get('/export-indikator-excel', function () {
        return view('export.indikator.indikator_excel');
    });
    Route::get('/export-indikator-pdf', [PdfController::class, 'exportIndikator'])->name('export.indikator.pdf');

    // Export penyakit
    Route::get('/export-penyakit-excel', function () {
        return view('export.penyakit.penyakit_excel');
    });
    Route::get('/export-penyakit-pdf', [PdfController::class, 'exportPenyakit'])->name('export.penyakit.pdf');

    // Export data pengguna
    Route::get('/export-pengguna-excel', function () {
        return view('export.pengguna.pengguna_excel');
    });
    Route::get('/export-pengguna-pdf', [PdfController::class, 'exportPengguna'])->name('export.pengguna.pdf');
});

require __DIR__ . '/auth.php';
