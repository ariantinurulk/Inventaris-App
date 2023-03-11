<?php

use App\Http\Controllers\AuthAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PeminjamanAdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;


Route::view('/','dashboard.admin')->name('admin.dashboard');
Route::post('/logout',[AuthAdminController::class,'logout'])->name('admin.logout');
Route::get('profile', [ProfileAdminController::class, 'profile'])->name('admin.profile');
Route::post('profile', [ProfileAdminController::class, 'update']);

Route::middleware('can:admin')->group(function (){
    Route::resource('petugas',PetugasController::class);
    Route::resource('pegawai',PegawaiController::class);
    Route::resource('jenis',JenisController::class);
    Route::resource('ruang',RuangController::class);
    Route::resource('inventaris',InventarisController::class);
    Route::get('/laporan',[LaporanController::class,'index'])
    ->name('laporan.index');
    Route::get('/laporan/inventaris',[LaporanController::class,'inventaris'])
    ->name('laporan.inventaris');
});

Route::get('/peminjaman',[PeminjamanAdminController::class,'index'])
->name('admin.peminjaman.index');

Route::get('peminjaman/pegawai/{pegawai}',[PeminjamanAdminController::class,'create'])
->name('admin.peminjaman.create');

Route::post('peminjaman/pegawai/{pegawai}',[PeminjamanAdminController::class,'store']);

Route::get('peminjaman/pegawai/{pegawai}/add/{inventari}',
[PeminjamanAdminController::class,'add'])
->name('admin.peminjaman.add');

Route::get('peminjaman/pegawai/{pegawai}/update/{inventari}',
[PeminjamanAdminController::class,'update'])
->name('admin.peminjaman.update');

Route::get('peminjaman/pegawai/{pegawai}/delete/{inventari}',
[PeminjamanAdminController::class,'delete'])
->name('admin.peminjaman.delete');

Route::get('peminjaman/pegawai/{pegawai}/empty/',[PeminjamanAdminController::class,'empty'])
->name('admin.peminjaman.empty');

Route::get('/peminjaman/{peminjaman}/info',[PeminjamanAdminController::class,'info'])
->name('admin.peminjaman.info');

Route::get('/peminjaman/{peminjaman}/card',[PeminjamanAdminController::class,'card'])
->name('admin.peminjaman.card');

Route::get('/peminjaman/{peminjaman}/status/{status}',[PeminjamanAdminController::class,'status'])
->name('admin.peminjaman.status');

Route::get('/',[DashboardController::class,'petugas'])
->name('admin.dashboard');