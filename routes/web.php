<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/dashboard','dashboard.admin')->name('home');

Route::get('login',[AuthController::class,'formLogin'])->name('login');
Route::post('login',[AuthController::class,'login']);

Route::prefix('admin')->group(function () {
    Route::get('login',[AuthAdminController::class, 'formLogin'])->name('admin.login');
    Route::post('login',[AuthAdminController::class, 'login']);
});

Route::middleware('auth')->group(function (){
    Route::view('/','dashboard.pegawai')->name('dashboard');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update']);

    Route::get('peminjaman',[PeminjamanController::class,'index'])
    ->name('peminjaman.index');

    Route::get('peminjaman/create',[PeminjamanController::class,'create'])
    ->name('peminjaman.create');

    Route::post('peminjaman/create',[PeminjamanController::class,'store']);

    Route::get('peminjaman/add/{inventari}',
    [PeminjamanController::class,'add'])
    ->name('peminjaman.add');

    Route::get('peminjaman/update/{inventari}',
    [PeminjamanController::class,'update'])
    ->name('peminjaman.update');

    Route::get('peminjaman/delete/{inventari}',
    [PeminjamanController::class,'delete'])
    ->name('peminjaman.delete');

    Route::get('peminjaman/empty',[PeminjamanController::class,'empty'])
    ->name('peminjaman.empty');

    Route::get('peminjaman/{peminjaman}/info',[PeminjamanController::class,'info'])
    ->name('peminjaman.info');

    Route::get('peminjaman/{peminjaman}/card',[PeminjamanController::class,'card'])
    ->name('peminjaman.card');

    Route::get('/',[DashboardController::class,'pegawai'])
    ->name('dashboard');

});

