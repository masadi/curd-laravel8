<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Data_jurusan;
use App\Http\Livewire\Data_kelas;
use App\Http\Livewire\Data_mapel;
use App\Http\Livewire\Data_pembelajaran;
use App\Http\Livewire\Data_guru;
use App\Http\Livewire\Data_siswa;
use App\Http\Livewire\Data_absen;
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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('jurusan', Data_jurusan::class)->name('jurusan');
    Route::get('kelas', Data_kelas::class)->name('kelas');
    Route::get('mapel', Data_mapel::class)->name('mapel');
    Route::get('pembelajaran', Data_pembelajaran::class)->name('pembelajaran');
    Route::get('guru', Data_guru::class)->name('guru');
    Route::get('siswa', Data_siswa::class)->name('siswa');
    Route::get('absen', Data_absen::class)->name('absen');
});
