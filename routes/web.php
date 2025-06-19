<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [App\Http\Controllers\Pages\LoginController::class, 'index']);
Route::get('/profil-user', [App\Http\Controllers\Pages\ProfilUserController::class, 'index']);
Route::get('/ubah-password', [App\Http\Controllers\Pages\UbahPasswordController::class, 'index']);
Route::get('/riwayat', [App\Http\Controllers\Pages\RiwayatController::class, 'index']);
Route::get('/form-peminjaman', [App\Http\Controllers\Pages\FormPeminjamanController::class, 'index']);
Route::get('/detail-ruangan', [App\Http\Controllers\Pages\DetailRuanganController::class, 'index']);
Route::get('/ruangan', [App\Http\Controllers\Pages\RuanganController::class, 'index']);
Route::get('/admin-dashboard', [App\Http\Controllers\Pages\AdminDashboardController::class, 'index']);
Route::get('/daftar', [App\Http\Controllers\Pages\DaftarController::class, 'index']);
Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});
Route::get('/approval', [App\Http\Controllers\Pages\ApprovalController::class, 'index']);
Route::get('/profil-admin', [App\Http\Controllers\Pages\ProfilAdminController::class, 'index']);
Route::get('/ubah-password-admin', [App\Http\Controllers\Pages\ProfilAdminController::class, 'ubahPassword']);
Route::post('/login', [App\Http\Controllers\Pages\LoginController::class, 'login']);
Route::post('/daftar', [App\Http\Controllers\Pages\DaftarController::class, 'daftar']);
Route::post('/form-peminjaman', [App\Http\Controllers\Pages\FormPeminjamanController::class, 'store']);
Route::post('/ubah-password', [App\Http\Controllers\Pages\UbahPasswordController::class, 'update']);
Route::post('/approval', [App\Http\Controllers\Pages\ApprovalController::class, 'update']);
Route::post('/ubah-password-admin', [App\Http\Controllers\Pages\ProfilAdminController::class, 'update']);
Route::get('/ruangan-admin', [App\Http\Controllers\Pages\RuanganAdminController::class, 'index']);
Route::get('/ruangan-admin/create', [App\Http\Controllers\Pages\RuanganAdminController::class, 'create']);
Route::post('/ruangan-admin', [App\Http\Controllers\Pages\RuanganAdminController::class, 'store']);
Route::get('/ruangan-admin/{id}/edit', [App\Http\Controllers\Pages\RuanganAdminController::class, 'edit']);
Route::post('/ruangan-admin/{id}/update', [App\Http\Controllers\Pages\RuanganAdminController::class, 'update']);
Route::post('/ruangan-admin/{id}/delete', [App\Http\Controllers\Pages\RuanganAdminController::class, 'destroy']);
Route::get('/user-admin', [App\Http\Controllers\Pages\UserAdminController::class, 'index']);
Route::get('/user-admin/create', [App\Http\Controllers\Pages\UserAdminController::class, 'create']);
Route::post('/user-admin', [App\Http\Controllers\Pages\UserAdminController::class, 'store']);
Route::get('/user-admin/{id}/edit', [App\Http\Controllers\Pages\UserAdminController::class, 'edit']);
Route::post('/user-admin/{id}/update', [App\Http\Controllers\Pages\UserAdminController::class, 'update']);
Route::post('/user-admin/{id}/delete', [App\Http\Controllers\Pages\UserAdminController::class, 'destroy']);
Route::get('/form-peminjaman/booked-times', [App\Http\Controllers\Pages\FormPeminjamanController::class, 'getBookedTimes']);
Route::post('/profil-user/update', [App\Http\Controllers\Pages\ProfilUserController::class, 'update']);
