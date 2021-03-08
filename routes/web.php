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

Route::get('login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login');
// Route::get('/register', 'LoginController@register');
// Route::post('/register', 'LoginController@store');
Route::get('/logout', 'LoginController@logout');

// Route::any('{catchall}', 'PagesController@notfound')->where('catchall', '.*');
   Route::fallback(function () {
       return view('errors.404');
   });

Route::group(['middleware' => 'auth'], function() {
	
	//Supplier
	Route::get('/', 'PagesController@index');

	//Riwayat Peminjam Barang
	Route::get('/history-peminjam-barang', 'BarangController@RiwayatPeminjam');

	//Pinjam Barang
	Route::get('/pinjam-barang', 'BarangController@indexPinjam');
	Route::post('/pinjam-barang', 'BarangController@storePinjam');
	Route::get('/stok-barang/{kode_barang}', 'StokBarangController@index');


	//Ganti Password
	Route::get('/change-password', 'UserController@changePass');
	Route::post('/change-password', 'UserController@updatePass');

	
	//Kembalikan Barang (User)
	Route::get('/kembalikan-barang', 'BarangController@indexKembalikan');
	Route::post('/kembalikan-barang/{id}', 'BarangController@KembalikanBarang');


	Route::post('/tester', 'PagesController@Tester');

	Route::group(['middleware' => ['admin']], function(){

		//Barang Keluar
		Route::get('/barang-keluar', 'BarangKeluarController@index');
		Route::get('/tambah-barang-keluar', 'BarangKeluarController@create');
		Route::post('/barang-keluar', 'BarangKeluarController@store');
		Route::delete('/barang-keluar/{id}', 'BarangKeluarController@destroy');


	//Supplier
		Route::get('/supplier', 'SupplierController@index');
		Route::get('/add-supplier', 'SupplierController@create');
		Route::post('/supplier', 'SupplierController@store');
		Route::get('/supplier/edit/{id}', 'SupplierController@edit');
		Route::put('/supplier/{id}', 'SupplierController@update');
		Route::delete('/supplier/{id}', 'SupplierController@destroy');

	//Account
		Route::get('/account', 'UserController@index');
		Route::get('/add-account', 'UserController@create');
		Route::post('/account', 'UserController@store');
		Route::get('/account/edit/{id}', 'UserController@edit');
		Route::put('/account/{id}', 'UserController@update');
		Route::delete('/account/{id}', 'UserController@destroy');

 	//Barang
		Route::get('/barang', 'BarangController@index');
		Route::get('/tambah-barang', 'BarangController@create');
		Route::post('/barang', 'BarangController@store');
		Route::get('/barang/edit/{id}', 'BarangController@edit');
		Route::put('/barang/{id}', 'BarangController@update');
		Route::delete('/barang/{id}', 'BarangController@destroy');

	//Barang Masuk
		Route::get('/barang-masuk', 'BarangController@indexMasuk');
		Route::get('/add-barang-masuk', 'BarangController@createMasuk');
		Route::post('/barang-masuk', 'BarangController@storeMasuk');
		Route::get('/barang-masuk/edit/{id}', 'BarangController@editMasuk');
		Route::put('/barang-masuk/{id}', 'BarangController@updateMasuk');
		Route::delete('/barang-masuk/{id}', 'BarangController@destroyMasuk');

	//Persetujuan Pengembalian
		Route::get('/persetujuan-pengembalian', 'BarangController@indexPersetujuanPengembalian');
		Route::post('/persetujuan-pengembalian/{id}', 'BarangController@BarangKembali');

	//Persetujuan Peminjam
		Route::get('/persetujuan-peminjam', 'BarangController@indexPersetujuanPeminjam');

	//Peminjam Barang
		Route::get('/peminjam-barang', 'BarangController@indexPeminjam');
		Route::post('/peminjam-barang/{id}', 'BarangController@BarangKembali');
		Route::post('/setujui-pinjam/{id}', 'BarangController@SetujuiPeminjam');
		Route::post('/tolak-peminjam/{id}', 'BarangController@TolakPeminjam');

	//Laporan
		Route::get('/peminjam-barang/export_excel', 'BarangController@export_excel');

	//PDF
		Route::post('/pdf-riwayat', 'PdfController@pdf_riwayat');

	//Count Data
		Route::get('/count-data', 'AjaxController@hitung_peminjam');
		Route::get('/count-data-kembali', 'AjaxController@hitung_pengembalian');
		Route::get('/count-data-total', 'AjaxController@hitung_total');
		// Route::get('/count-data', function(){
		// 	return DB::table('pinjam_barangs')->where('status', 1)->count();
		// });

	});



});

//penambahan fitur
// https://www.tutsmake.com/laravel-dynamic-dependent-dropdown-using-ajax/
// minjem barang ga bisa lebih dari jumlah stok
// tambahan tabel kategori sama jenis barang
// print pdf barang masuk/keluar, laporan tiap bulan/tahun
// kode barang berdasarkan jenis/kategori barang