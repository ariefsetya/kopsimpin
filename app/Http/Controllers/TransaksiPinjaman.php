<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Validator;	
use PDF;

class TransaksiPinjaman extends Controller {

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
		$data['data'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('jenis_transaksi','Pinjaman')->paginate(20);
		return view('transaksi.pinjaman.all')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['pinjaman'] = \App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->get();
		$data['bulan'] = \App\Bulan::all();
		return view('transaksi.pinjaman.baru')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$v = Validator::make(Input::all(), [
	        'nama' => 'required|min:1',
	        'jumlah'=>'required|numeric|min:1',
	        'jangka_waktu'=>'required|numeric|min:1',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Transaksi::orderBy('id','desc')->first()['id'];
		$new = new \App\Transaksi;
		$new->no_transaksi = 'KSP-'.date("ymd").($data+1)."-P";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->created_by = Auth::user()->id;
		$new->id_anggota = Input::get('id_anggota');
		$new->jenis_transaksi = 'Pinjaman';
		$new->id_jenis = Input::get('id_jenis');
		$new->bunga = Input::get('persen_bunga_keseluruhan');
		$new->jumlah_bunga = Input::get('bunga_keseluruhan');
		$new->admin = Input::get('persen_biaya_admin');
		$new->biaya_admin = Input::get('biaya_admin');
		$new->biaya_materai = Input::get('biaya_materai');
		$new->asuransi = Input::get('persen_biaya_asuransi');
		$new->biaya_asuransi = Input::get('biaya_asuransi');
		$new->tabungan = Input::get('persen_tabungan');
		$new->total_tabungan = Input::get('tabungan');
		$new->tabungan_per_bulan = Input::get('tabungan');
		$new->jumlah_asli = Input::get('jumlah');
		$new->jumlah_total = Input::get('jumlah_total');
		$new->status = 'Belum Lunas';
		$new->keterangan = Input::get('keterangan');
		$new->total_peminjaman = Input::get('total_peminjaman');
		$new->info_ke = Input::get('jangka_waktu');
		$new->angsuran = Input::get('angsuran_total');
		$new->save();

		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$finan = new \App\Keuangan;
		$finan->no_nota = 'KSP-'.date("ymd").($data+1)."-KP";
		$finan->id_koperasi = Auth::user()->assigned_koperasi;
		$finan->id_anggota = Input::get('id_anggota');
		$finan->tabel = 'transaksis';
		$finan->jenis = 'pinjaman';
		$finan->info = "Pinjaman ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$finan->id_transaksi = $new->id;
		$finan->masuk = 0;
		$finan->keluar = Input::get('jumlah');
		$finan->save();

		if(Input::get('biaya_admin')>0){
			$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($data+1)."-KA";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'biaya_admin';
			$finan->info = "Biaya Admin Pinjaman ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('biaya_admin'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $new->id;
			$finan->masuk = Input::get('biaya_admin');
			$finan->keluar = 0;
			$finan->save();
		}

		if(Input::get('biaya_asuransi')>0){
			$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($data+1)."-KL";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'biaya_asuransi';
			$finan->info = "Biaya Asuransi Pinjaman ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('biaya_asuransi'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $new->id;
			$finan->masuk = Input::get('biaya_asuransi');
			$finan->keluar = 0;
			$finan->save();
		}

		if(Input::get('biaya_materai')>0){
			$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($data+1)."-KM";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'biaya_materai';
			$finan->info = "Biaya Materai Pinjaman ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('biaya_materai'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $new->id;
			$finan->masuk = Input::get('biaya_materai');
			$finan->keluar = 0;
			$finan->save();
		}

		if(Input::get('tabungan')>0){
			$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($data+1)."-KT";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'tabungan';
			$finan->info = "Tabungan Pinjaman ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('tabungan'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $new->id;
			$finan->masuk = Input::get('tabungan');
			$finan->keluar = 0;
			$finan->save();
		}

		for ($i=1; $i <= Input::get('jangka_waktu'); $i++) { 
			$baru = new \App\Transaksi;
			$baru->id_koperasi = Auth::user()->assigned_koperasi;
			$baru->id_induk = $new->id;
			$baru->created_by = Auth::user()->id;
			$baru->id_anggota = Input::get('id_anggota');
			$baru->jenis_transaksi = 'Pengembalian Pinjaman';
			$baru->id_jenis = 0;
			$baru->bunga = Input::get('persen_bunga');
			$baru->tabungan = Input::get('persen_tabungan');
			$baru->jumlah_asli = Input::get('angsuran');
			$baru->jumlah_bunga = Input::get('bunga');
			$baru->total_tabungan = Input::get('tabungan');
			$baru->jumlah_total = Input::get('angsuran_total');
			$baru->status = 'Belum Lunas';
			$baru->keterangan = '';
			$baru->biaya_admin = 0;
			$baru->biaya_asuransi = 0;
			$baru->total_peminjaman = 0;
			$baru->info_ke = $i;
			$baru->angsuran = 0;
			$baru->created_at = date("Y-m-".date_format(date_create(Input::get('tanggal_jatuh_tempo')),'d')." H:i:s",strtotime("+".$i." month"));
			$baru->save();
		}

		return redirect(url('transaksi/pinjaman'));
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
		$data = \App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);
		return view('transaksi.pinjaman.edit')->withData($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$new = \App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);
		$new->nama = Input::get('nama');
		$new->jumlah = Input::get('jumlah');
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->save();

		return redirect(url('transaksi/pinjaman'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id)->delete();
		\App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_induk',$id)->delete();
		\App\Keuangan::where('id_koperasi',Auth::user()->assigned_koperasi)->where('tabel','transaksis')->where('id_transaksi',$id)->delete();
		return redirect(url('transaksi/pinjaman'));
	}

	public function pembayaran()
	{
		return view('transaksi.pembayaran');
	}
	public function datapembayaran()
	{
		return view('transaksi.datapembayaran');
	}

	public function simpanpembayaran()
	{
		$v = Validator::make(Input::all(), [
	        'nama' => 'required|min:1',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Transaksi::where('id',Input::get('id_angsuran'))->first();
		$data->no_transaksi = 'KSP-'.date("ymd").($data->id_induk.$data->info_ke)."-PA";
		$data->status = 'Lunas';
		$data->denda = Input::get('jumlah_denda');
		$data->total_denda = Input::get('total_denda');
		$data->keterangan = Input::get('keterangan');
		$data->save();

		if(Input::get('jumlah_angsuran')>0){
			$old_num = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($old_num+1)."-PS";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'angsuran';
			$finan->info = "Pembayaran Pinjaman ke-".$data->info_ke." ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('jumlah_angsuran'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $data->id;
			$finan->masuk = Input::get('jumlah_angsuran');
			$finan->keluar = 0;
			$finan->save();
		}
		if(Input::get('jumlah_tabungan')>0){
			$old_num = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($old_num+1)."-PST";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'tabungan';
			$finan->info = "Pembayaran Tabungan Pinjaman ke-".$data->info_ke." ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('jumlah_tabungan'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $data->id;
			$finan->masuk = Input::get('jumlah_tabungan');
			$finan->keluar = 0;
			$finan->save();
		}
		if(Input::get('total_denda')>0){
			$old_num = \App\Keuangan::orderBy('id','desc')->first()['id'];
			$finan = new \App\Keuangan;
			$finan->no_nota = 'KSP-'.date("ymd").($old_num+1)."-PSD";
			$finan->id_koperasi = Auth::user()->assigned_koperasi;
			$finan->id_anggota = Input::get('id_anggota');
			$finan->tabel = 'transaksis';
			$finan->jenis = 'denda';
			$finan->info = "Pembayaran Denda Pinjaman ke-".$data->info_ke." ".(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find(Input::get('id_anggota'))['nama'])." Rp. ".(number_format(Input::get('total_denda'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
			$finan->id_transaksi = $data->id;
			$finan->masuk = Input::get('total_denda');
			$finan->keluar = 0;
			$finan->save();
		}

		$cou = \App\Transaksi::where('status','Lunas')->where('id_induk',$data->id_induk)->get();
		$induk = \App\Transaksi::where('id',$data->id_induk)->first();
		if($induk->info_ke==sizeof($cou)){
			$induk->status = 'Lunas';
			$induk->save();
		}


		return redirect(url('transaksi/pembayaran/selesai/'.$data->no_transaksi));
	}
	public function printbukti($id_trx)
	{
		$data['koperasi'] = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$data['transaksi'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('no_transaksi',$id_trx)->first(); 
		$data['anggota'] = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($data['transaksi']->id_anggota); 
		$data['induk'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id',$data['transaksi']->id_induk)->first();
		$data['keuangan'] = \App\Keuangan::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_transaksi',$data['transaksi']->id)->get();
		$jumlah = 0;
		foreach ($data['keuangan'] as $key) {
			$jumlah += $key->masuk;
		}
		$data['total'] = $jumlah;

		$pdf = PDF::loadView('transaksi.printpembayaran', $data);
//	$pdf loadView('transaksi.printpembayaran',$data);
	$pdf->setPaper(array(0,0,612,312));
	return $pdf->stream();
		//return view('transaksi.printpembayaran')->with($data);
	}	
	public function selesaipembayaran($id_trx)
	{
		$data['koperasi'] = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$data['transaksi'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('no_transaksi',$id_trx)->first(); 
		$data['anggota'] = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($data['transaksi']->id_anggota); 
		$data['induk'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id',$data['transaksi']->id_induk)->first();
		$data['keuangan'] = \App\Keuangan::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_transaksi',$data['transaksi']->id)->get();
		$jumlah = 0;
		foreach ($data['keuangan'] as $key) {
			$jumlah += $key->masuk;
		}
		$data['total'] = $jumlah;
		return view('transaksi.selesaipembayaran')->with($data);
	}
	public function cetakbuktimanual()
	{
		return view('transaksi.manual.pilihtransaksi');
	}
	public function cetakbuktimanualpost(){
		//print_r(Input::all());
		$arrIDKeu = implode(",", Input::get('id'));
		$id_anggota = Input::get('id_anggota');
		$id_induk = Input::get('id_induk');
		$id_angsuran = Input::get('id_angsuran');
		return redirect(url('transaksi/pembayaran/cetak_manual/'.$id_induk."/".$id_angsuran."/".$id_anggota."/".$arrIDKeu));
	}
	public function printbuktimanual($id_induk,$id_transaksi,$id_anggota,$arrIDKeu)
	{
		$data['keuangan'] = \App\Keuangan::where('id_koperasi',Auth::user()->assigned_koperasi)->whereIn('id',explode(",", $arrIDKeu))->get();
		$data['koperasi'] = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$jumlah = 0;
		foreach ($data['keuangan'] as $key) {
			$jumlah += $key->masuk;
		}
		$data['total'] = $jumlah;
		$data['transaksi'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id',$id_transaksi)->first(); 
		$data['anggota'] = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($data['transaksi']->id_anggota); 
		$data['induk'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id',$id_induk)->first();
		$data['url_next'] = url('transaksi/pembayaran/cetak_manual/live/'.$id_induk."/".$id_transaksi."/".$id_anggota."/".$arrIDKeu);


		return view('transaksi.selesaipembayaranmanual')->with($data);
	}
	public function livebuktimanual($id_induk,$id_transaksi,$id_anggota,$arrIDKeu)
	{
		$data['keuangan'] = \App\Keuangan::where('id_koperasi',Auth::user()->assigned_koperasi)->whereIn('id',explode(",", $arrIDKeu))->get();
		$data['koperasi'] = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$jumlah = 0;
		foreach ($data['keuangan'] as $key) {
			$jumlah += $key->masuk;
		}
		$data['total'] = $jumlah;
		$data['transaksi'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id',$id_transaksi)->first(); 
		$data['anggota'] = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($data['transaksi']->id_anggota); 
		$data['induk'] = \App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id',$id_induk)->first();
	
	// $pdf = \App::make('dompdf.wrapper');
	//$pdf->loadView('transaksi.printpembayaran',$data);
	$pdf = PDF::loadView('transaksi.printpembayaran', $data);
	$pdf->setPaper(array(0,0,612,379));
	return $pdf->stream('download.pdf');

		//return view('transaksi.printpembayaran')->with($data);
	}
}
