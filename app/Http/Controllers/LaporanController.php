<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Excel;

class LaporanController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function laporansimpanan()
	{
		$data = array();
		$data['kirimanbulan'] = date("m");
		$data['kirimantahun'] = date("Y");
		if(Input::get('bulan')!="" and Input::get('tahun')!=""){
			$data['data'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
								->where('created_at','like',Input::get('tahun')."-%".Input::get('bulan')."-%")
								->where('jenis_transaksi','Simpanan')
								->get();
		$data['kirimanbulan'] = Input::get('bulan');
		$data['kirimantahun'] = Input::get('tahun');
		}else{
			$data['data'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
								->where('created_at','like',date('Y')."-%".date('m')."-%")
								->where('jenis_transaksi','Simpanan')
								->get();
		}
		$data['bulan'] = \App\Bulan::all();
		return view('laporan.simpanan')->with($data);
	}
	public function laporanpinjaman()
	{
		$data = array();
		$data['kirimanbulan'] = date("m");
		$data['kirimantahun'] = date("Y");
		if(Input::get('bulan')!="" and Input::get('tahun')!=""){
			$data['data'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
								->where('created_at','like',Input::get('tahun')."-%".Input::get('bulan')."-%")
								->where('jenis_transaksi','Pinjaman')
								->get();
			$data['kirimanbulan'] = Input::get('bulan');
			$data['kirimantahun'] = Input::get('tahun');
		}else{
			$data['data'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
								->where('created_at','like',date('Y')."-%".date('m')."-%")
								->where('jenis_transaksi','Pinjaman')
								->get();
		}
		$data['bulan'] = \App\Bulan::all();

		return view('laporan.pinjaman')->with($data);
	}
	public function laporanpinjamanexport($bulan,$tahun)
	{
		$data = array();
		$data = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
							->where('created_at','like',$tahun."-%".$bulan."-%")
							->where('jenis_transaksi','Pinjaman')
							->get();
		$export = array();
		foreach ($data as $key) {
			$export[] = array('Nama'=>\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($key->id_anggota)['nama'],
							'Jenis'=>\App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->find($key->id_jenis)['nama'],
							'Angsuran'=>(int)$key->angsuran,
							'Total'=>(int)$key->jumlah_total,
							'Status'=>$key->status,
							'Jatuh Tempo'=>"Tanggal ".date_format(date_create($key->created_at),"d")." setiap bulan",
							'Jangka Waktu'=>$key->info_ke." bulan");
		}
		
		Excel::create('Laporan Pinjaman', function($excel) use($export) {

		    $excel->sheet('Laporan Pinjaman', function($sheet) use($export) {

		        $sheet->fromArray($export);

		    });

		})->download('xls');
	}
	public function laporansimpananexport($bulan,$tahun)
	{
		$data = array();
		$data = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
							->where('created_at','like',$tahun."-%".$bulan."-%")
							->where('jenis_transaksi','Simpanan')
							->get();
		$export = array();
		foreach ($data as $key) {
			$export[] = array('Tanggal'=>date_format(date_create($key->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($key->created_at),"m"))->first()['nama'])." ".date_format(date_create($key->created_at),"Y"),
							'Nama'=>\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($key->id_anggota)['nama'],
							'Jenis'=>\App\Simpanan::where('id_koperasi',Auth::user()->assigned_koperasi)->find($key->id_jenis)['nama'],
							'Jumlah'=>(int)$key->jumlah_total);
		}
		
		Excel::create('Laporan Simpanan', function($excel) use($export) {

		    $excel->sheet('Laporan Simpanan', function($sheet) use($export) {

		        $sheet->fromArray($export);

		    });

		})->download('xls');
	}
	public function saldo()
	{
		$data = array();
		$data['saldo'] = \App\Keuangan::selectRaw('(sum(masuk)-sum(keluar)) as jumlah')->where('id_koperasi',Auth::user()->assigned_koperasi)->first();
		$data['saldo_bulan_lalu'] = \App\Keuangan::selectRaw('(sum(masuk)-sum(keluar)) as jumlah')->where('created_at','like',date("Y-m-",strtotime("-1 month"))."%")->where('id_koperasi',Auth::user()->assigned_koperasi)->first();
		$data['saldo_tahun_lalu'] = \App\Keuangan::selectRaw('(sum(masuk)-sum(keluar)) as jumlah')->where('created_at','like',date("Y-",strtotime("-1 year"))."%")->where('id_koperasi',Auth::user()->assigned_koperasi)->first();
		return view('laporan.saldo')->with($data);
	}

}
