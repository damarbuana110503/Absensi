<?php

use App\Http\Controllers\MainController;
use App\Http\Livewire\Kategori\MainIndex;
use App\Http\Livewire\MasterData\AgamaMainIndex;
use App\Http\Livewire\MasterData\JurusanMainIndex;
use App\Http\Livewire\MasterData\KelasMainIndex;
use App\Http\Livewire\MasterData\MahasiswaMainIndex;
use App\Http\Livewire\MasterData\MatkulMainIndex;
use App\Http\Livewire\MasterData\ProdiMainIndex;
use App\Http\Livewire\MasterData\ThnAjaranMainIndex;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('backend')->name('backend.')->group(function () {
        Route::get('/', [MainController::class, 'main'])->name('main');

        Route::get('/agama', AgamaMainIndex::class)->name('agama');
        Route::get('/jurusan', JurusanMainIndex::class)->name('jurusan');
        Route::get('/matkul', MatkulMainIndex::class)->name('matkul');
        Route::get('/kelas', KelasMainIndex::class)->name('kelas');
        Route::get('thnajaran', ThnAjaranMainIndex::class)->name('thnajaran');
        Route::get('/mahasiswa', MahasiswaMainIndex::class)->name('mahasiswa');
    });
});

