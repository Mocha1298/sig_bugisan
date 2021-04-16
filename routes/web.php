<?php

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

// ROUTE BACKEND
Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/be/dashboard','Backend@dashboard');


    // Halaman Master Jenis_Kerusakan
    Route::get('/be/jenis_kerusakan','Backend@jenis_kerusakan');
    Route::post('/be/jenis_kerusakan/tambah','Backend@tambah_jenis');
    Route::post('/be/jenis_kerusakan/{Id_Jenis}','Backend@post_edit_jenis');
    Route::get('/be/jenis_kerusakan/hapus/{Id_Jenis}','Backend@delete_jenis');

    // Halaman Data Kerusakan
    Route::get('/be/kerusakan','Backend@kerusakan');//Get Halaman Dash
    // Halaman Tambah Data
    Route::get('/be/kerusakan/tambah','Backend@tambah');//Get Halaman Tambah Data
    Route::post('/be/kerusakan/proses_tambah','Backend@proses_tambah_data');//Post Tambah Data
    // Halaman Detail Data
    Route::get('/be/kerusakan/{Id_Kerusakan}','Backend@detail_kerusakan');//Get Halaman Detail
    Route::get('/datapeta1','Backend@datapeta1');//Get data detail peta
    Route::post('/be/komentar/balas','Backend@balas');
    // Aksi Halaman Detail
    Route::get('/be/detail/all/{Id_Kerusakan}','Backend@ubah_all_data');//Get Ubah Semua
    Route::post('/be/kerusakan/proses_ubah','Backend@proses_ubah_all_data');//Post Ubah Semua
    Route::post('/be/kerusakan/proses_status','Backend@proses_ubah_status');//Get Ubah Status
    Route::get('/be/detail/delete/{Id_Kerusakan}','Backend@hapus_data');//Delete Data


    // Halaman Admin
    Route::get('/be/admin','Backend@admin');//Get Halaman admin
    route::get('/be/admin/tambah','Backend@tambah_admin');//Get halaman tambah admin
    Route::post('/be/admin/proses_tambah','Backend@proses_tambah_admin');//Post tambah admin
    Route::get('/be/admin/edit/{id}','Backend@ubah_admin');
    Route::post('/be/admin/proses_ubah','Backend@proses_ubah_admin');//Post ubah admin


    // Halaman Peta
    Route::get('/be/peta','Backend@peta');//Get halaman peta
    Route::get('/datapeta','Backend@datapeta');//Get data peta
    Route::post('/be/peta/filter','Backend@filter');//Get data peta
    Route::get('/peta/tambah/{Garis_Bujur}/{Garis_Lintang}','Backend@tambah_peta');//masuk form tambah data
    Route::post('/be/peta/post','Backend@post_peta');//post input data peta
    Route::get('/jos','Backend@jos');

    //
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// ROUTE FRONTEND
Route::get('/','Frontend@index');
Route::get('/fe/peta','Frontend@peta');
Route::get('/fe/datapeta','Frontend@datapeta');
Route::get('/fe/datapeta1','Frontend@datapeta1');
Route::get('/fe/profile','Frontend@profile');
Route::get('/fe/kontak','Frontend@kontak');
Route::get('/fe/data','Frontend@data');
Route::get('/fe/kerusakan/{Id_Kerusakan}','Frontend@detail');
Route::post('/komentar','Frontend@komentar');
Route::post('/balas','Frontend@balas');