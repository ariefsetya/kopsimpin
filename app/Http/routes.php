<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('anggota', 'AnggotaController@index');
Route::get('anggota/baru', 'AnggotaController@create');
Route::post('anggota/baru', 'AnggotaController@store');
Route::get('anggota/edit/{id}', 'AnggotaController@edit');
Route::post('anggota/edit/{id}', 'AnggotaController@update');
Route::get('anggota/destroy/{id}', 'AnggotaController@destroy');

Route::get('preferensi/simpanan', 'PreferensiSimpanan@index');
Route::get('preferensi/simpanan/baru', 'PreferensiSimpanan@create');
Route::post('preferensi/simpanan/baru', 'PreferensiSimpanan@store');
Route::get('preferensi/simpanan/edit/{id}', 'PreferensiSimpanan@edit');
Route::post('preferensi/simpanan/edit/{id}', 'PreferensiSimpanan@update');
Route::get('preferensi/simpanan/destroy/{id}', 'PreferensiSimpanan@destroy');

Route::get('preferensi/pinjaman', 'PreferensiPinjaman@index');
Route::get('preferensi/pinjaman/baru', 'PreferensiPinjaman@create');
Route::post('preferensi/pinjaman/baru', 'PreferensiPinjaman@store');
Route::get('preferensi/pinjaman/edit/{id}', 'PreferensiPinjaman@edit');
Route::post('preferensi/pinjaman/edit/{id}', 'PreferensiPinjaman@update');
Route::get('preferensi/pinjaman/destroy/{id}', 'PreferensiPinjaman@destroy');

Route::get('preferensi/denda', 'PreferensiPinjaman@denda');
Route::post('preferensi/denda', 'PreferensiPinjaman@simpandenda');
Route::get('preferensi/catatan', 'PreferensiPinjaman@catatan');
Route::post('preferensi/catatan', 'PreferensiPinjaman@simpancatatan');

Route::get('transaksi/simpanan', 'TransaksiSimpanan@index');
Route::get('transaksi/simpanan/baru', 'TransaksiSimpanan@create');
Route::post('transaksi/simpanan/baru', 'TransaksiSimpanan@store');
Route::get('transaksi/simpanan/destroy/{id}', 'TransaksiSimpanan@destroy');

Route::get('transaksi/pinjaman', 'TransaksiPinjaman@index');
Route::get('transaksi/pinjaman/baru', 'TransaksiPinjaman@create');
Route::post('transaksi/pinjaman/baru', 'TransaksiPinjaman@store');
Route::get('transaksi/pinjaman/destroy/{id}', 'TransaksiPinjaman@destroy');

Route::get('transaksi/pembayaran/baru', 'TransaksiPinjaman@pembayaran');
Route::post('transaksi/pembayaran/baru', 'TransaksiPinjaman@simpanpembayaran');
Route::get('transaksi/pembayaran/print/{no_trx}', 'TransaksiPinjaman@printbukti');
Route::get('transaksi/pembayaran/selesai/{no_trx}', 'TransaksiPinjaman@selesaipembayaran');
Route::get('transaksi/pembayaran/all', 'TransaksiPinjaman@datapembayaran');

Route::get('pengaturan/koperasi', 'PengaturanController@koperasi');
Route::post('pengaturan/koperasi', 'PengaturanController@save_koperasi');
Route::get('pengaturan/pengurus', 'PengaturanController@index');
Route::get('pengaturan/pengurus/baru', 'PengaturanController@create');
Route::post('pengaturan/pengurus/baru', 'PengaturanController@store');
Route::get('pengaturan/pengurus/edit/{id}', 'PengaturanController@edit');
Route::post('pengaturan/pengurus/edit/{id}', 'PengaturanController@update');
Route::get('pengaturan/pengurus/destroy/{id}', 'PengaturanController@destroy');


Route::get('keuangan/pemasukan/koreksi','KeuanganController@koreksipemasukan');
Route::post('keuangan/pemasukan/koreksi','KeuanganController@simpanpemasukan');
Route::get('keuangan/pengeluaran/koreksi','KeuanganController@koreksipengeluaran');
Route::post('keuangan/pengeluaran/koreksi','KeuanganController@simpanpengeluaran');
Route::get('keuangan/pemasukan/anggota','KeuanganController@koreksipemasukananggota');
Route::post('keuangan/pemasukan/anggota','KeuanganController@simpanpemasukananggota');
Route::get('keuangan/pengeluaran/anggota','KeuanganController@koreksipengeluarananggota');
Route::post('keuangan/pengeluaran/anggota','KeuanganController@simpanpengeluarananggota');
Route::get('keuangan/pemasukan/tabungan','KeuanganController@koreksipemasukantabungan');
Route::post('keuangan/pemasukan/tabungan','KeuanganController@simpanpemasukantabungan');
Route::get('keuangan/pengeluaran/tabungan','KeuanganController@koreksipengeluarantabungan');
Route::post('keuangan/pengeluaran/tabungan','KeuanganController@simpanpengeluarantabungan');
Route::get('keuangan/rekap','KeuanganController@rekap');
Route::get('keuangan/rekap/export','KeuanganController@rekapexport');
Route::get('keuangan/rekap/clear',function ()
{
	session(array('tgl0'=>""));
	session(array('tgl1'=>""));
	session(array('id_anggota'=>""));
	session(array('nama'=>""));
	return redirect(url('keuangan/rekap'));
});
Route::post('keuangan/rekap','KeuanganController@rekap');

Route::get('bantuan','PengaturanController@bantuan');

Route::get('laporan/simpanan','LaporanController@laporansimpanan');
Route::get('laporan/pinjaman','LaporanController@laporanpinjaman');
Route::get('laporan/pinjaman/export/{bulan}/{tahun}','LaporanController@laporanpinjamanexport');
Route::get('laporan/simpanan/export/{bulan}/{tahun}','LaporanController@laporansimpananexport');
Route::post('laporan/simpanan','LaporanController@laporansimpanan');
Route::post('laporan/pinjaman','LaporanController@laporanpinjaman');
Route::get('laporan/saldo','LaporanController@saldo');

Route::get('ajax/get_anggota/{nama}', 'AjaxController@get_anggota');
Route::get('ajax/get_simpanan/{id_jenis}', 'AjaxController@get_simpanan');
Route::get('ajax/get_pinjaman/{id_jenis}', 'AjaxController@get_pinjaman');
Route::get('ajax/get_pinjaman/belum_lunas/{id_anggota}', 'AjaxController@get_pinjaman_belum_lunas');
Route::get('ajax/get_angsuran/belum_lunas/{id_anggota}', 'AjaxController@get_angsuran_belum_lunas');
Route::get('ajax/get_angsuran/all/{id_anggota}', 'AjaxController@get_angsuran_all');
Route::get('ajax/get_angsuran/data/{id_transaksi}', 'AjaxController@get_angsuran_data');

Route::get('/images/{filename}', function ($filename)
{
	$path = storage_path() . '/images/' . $filename;
	$file = File::get($path);
	$type = File::mimeType($path);
	$response = Response::make($file);
	$response->header("Content-Type", $type);
	return $response;
});

// Route::get('bcrypt/{pass}',function ($pass)
// {
// 	echo bcrypt($pass);
// });
