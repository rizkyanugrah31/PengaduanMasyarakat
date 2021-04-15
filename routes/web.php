<?php

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

//Rute Otentikasi
Auth::routes();

//Rute Home
Route::get('/home', 'HomeController@index')->name('home');

//Rute fitur pengaduan
Route::get('/listpengaduan', 'PetugasController@listpengaduan')->name('petugas.pengaduan');
Route::delete('/deletePengaduan/{id}','PengaduanController@destroy')->name('petugas.pengaduan');

Route::get('/riwayat','PengaduanController@index')->name('pengaduan.history');
Route::get('/form','PengaduanController@create')->name('pengaduan.form');
Route::get('/usertanggapan','PengaduanController@tanggapan')->name('pengaduan.tanggapan');
Route::post('/buatPengaduan','PengaduanController@store')->name('pengaduan.form');

//Rute fitur Manage Users
Route::get('/listusers', 'AdminController@index')->name('admin.userlist');
Route::get('/addusers', 'AdminController@create')->name('admin.addusers');
Route::post('/buatUsers', 'AdminController@store')->name('admin.addusers');

//Rute fitur Tanggapan
Route::get('/listtanggapan', 'TanggapanController@index')->name('petugas.listtanggapan');
Route::get('/tanggapan/{id}', 'TanggapanController@edit')->name('petugas.formtanggapan');
Route::put('/buatTanggapan/{id}', 'TanggapanController@update')->name('petugas.formtanggapan');
Route::put('/tolakTanggapan/{id}', 'TanggapanController@dismiss')->name('petugas.formtanggapan');
Route::delete('/deleteTanggapan/{id}','TanggapanController@destroy')->name('petugas.formtanggapan');

//Rute Generate Laporan
Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/export_tanggapan', 'AdminController@export_tanggapan')->name('admin.dashboard');
Route::get('/export_pengaduan', 'AdminController@export_pengaduan')->name('admin.dashboard');

//Rute Profile
Route::get('/profile/{id}', 'HomeController@showProfile')->name('profile');
Route::put('/storeProfile/{id}', 'HomeController@storeProfile')->name('profile');
Route::get('/showChangePasswordForm/{id}','HomeController@showChangePasswordForm')->name('auth.changePassword');
Route::put('/changePassword/{id}','HomeController@changePassword')->name('auth.changePassword');


