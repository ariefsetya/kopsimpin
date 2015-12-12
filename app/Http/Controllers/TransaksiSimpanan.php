<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class TransaksiSimpanan extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$data['data'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('jenis_transaksi','Simpanan')->paginate(20);
		return view('transaksi.simpanan.all')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['simpanan'] = \App\Simpanan::where('id_koperasi',Auth::user()->assigned_koperasi)->get();
		$data['bulan'] = \App\Bulan::all();
		return view('transaksi.simpanan.baru')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$cek = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
				->where('id_jenis',Input::get('id_jenis'))
				->where('bulan',Input::get('bulan'))
				->where('tahun',Input::get('tahun'))
				->where('id_anggota',Input::get('id_anggota'))
				->where('jenis_transaksi','Simpanan')->get();

		if(sizeof($cek)==0){

			$info_ke = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)
				->where('id_jenis',Input::get('id_jenis'))
				->where('id_anggota',Input::get('id_anggota'))
				->where('jenis_transaksi','Simpanan')->get();

			$info_ke = sizeof($info_ke);


			$data = \App\Transaksi::orderBy('id','desc')->first()['id'];
			$new = new \App\Transaksi;
			$new->no_transaksi = 'KSP-'.date("ymd").($data+1)."-S";
			$new->id_anggota = Input::get('id_anggota');
			$new->keterangan = Input::get('keterangan');
			$new->jenis_transaksi = 'Simpanan';
			$new->status = 'Lunas';
			$new->id_jenis = Input::get('id_jenis');
			$new->jumlah_asli = Input::get('jumlah');
			$new->jumlah_bunga = 0;
			$new->bunga = 0;
			$new->info_ke = $info_ke+1;
			$new->bulan = Input::get('bulan');
			$new->tahun = Input::get('tahun');
			$new->jumlah_total = Input::get('jumlah');
			$new->id_koperasi = Auth::user()->assigned_koperasi;
			$new->created_by = Auth::user()->id;
			$new->save();

			$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($data+1)."-B";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'simpanan';
			$finan->info = "Pembayaran ".(\App\Simpanan::find(Input::get('id_jenis'))['nama'])." ".(\App\Anggota::find(Input::get('id_anggota'))['nama'])." Rp. ".(Input::get('jumlah'))." ".date("d/m/Y H:i:s");
			$finan->id_transaksi = $new->id;
			$finan->masuk = Input::get('jumlah');
			$finan->keluar = 0;
			$finan->save();

			return redirect(url('transaksi/simpanan'));
		}else{
			return redirect(url('transaksi/simpanan/baru'))->withPesan('sudah_ada');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = \App\Simpanan::find($id);
		return view('transaksi.simpanan.edit')->withData($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$new = \App\Simpanan::find($id);
		$new->nama = Input::get('nama');
		$new->jumlah = Input::get('jumlah');
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->save();

		return redirect(url('transaksi/simpanan'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Transaksi::find($id)->delete();
		\App\Keuangan::where('tabel','transaksis')->where('id_transaksi',$id)->delete();
		return redirect(url('transaksi/simpanan'));
	}

}
