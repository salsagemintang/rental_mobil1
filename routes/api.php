<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'petugascontroller@register');
Route::post('login', 'petugascontroller@login');
Route::get('user', 'petugascontroller@getAuthenticatedUser')->middleware('jwt.verify');

//penyewa
Route::post('/simpan_penyewa','penyewacontroller@store')->middleware('jwt.verify');
Route::put('/ubah_penyewa/{id}','penyewacontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_penyewa/{id}','penyewacontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_penyewa','penyewacontroller@tampil_penyewa')->middleware('jwt.verify');

//mobil
Route::post('/simpan_mobil','mobilcontroller@store')->middleware('jwt.verify');
Route::put('/ubah_mobil/{id}','mobilcontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_mobil/{id}','mobilcontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_mobil','mobilcontroller@tampil_mobil')->middleware('jwt.verify');

//jenis_mobil
Route::post('/simpan_jenis','jeniscontroller@store')->middleware('jwt.verify');
Route::put('/ubah_jenis/{id}','jeniscontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_jenis/{id}','jeniscontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_jenis','jeniscontroller@tampil_jenis')->middleware('jwt.verify');