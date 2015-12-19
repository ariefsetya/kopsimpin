<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Excel;
use Validator;


class KeuanganController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */	
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function koreksipemasukan()
	{
		return view('keuangan.pemasukan.koreksi');
	}
	public function simpanpemasukan()
	{
		$v = Validator::make(Input::all(), [
	        'jumlah' => 'required|numeric',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$new = new \App\Keuangan;
		$new->no_nota = 'KSP-'.date("ymd").($data+1)."-KP";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->info = Input::get('keterangan')." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$new->jenis = 'manual';
		$new->masuk = Input::get('jumlah');
		$new->save();

		return redirect('keuangan/pemasukan/koreksi')->withData($new->no_nota);
	}	
	public function koreksipengeluaran()
	{
		return view('keuangan.pengeluaran.koreksi');
	}
	public function simpanpengeluaran()
	{
		$v = Validator::make(Input::all(), [
	        'jumlah' => 'required|numeric',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$new = new \App\Keuangan;
		$new->no_nota = 'KSP-'.date("ymd").($data+1)."-KL";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->info = Input::get('keterangan')." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$new->jenis = 'manual';
		$new->keluar = Input::get('jumlah');
		$new->save();

		return redirect('keuangan/pengeluaran/koreksi')->withData($new->no_nota);
	}
	public function koreksipemasukananggota()
	{
		return view('keuangan.pemasukan.anggota');
	}
	public function simpanpemasukananggota()
	{
		$v = Validator::make(Input::all(), [
	        'jumlah' => 'required|numeric',
	        'nama' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$new = new \App\Keuangan;
		$new->no_nota = 'KSP-'.date("ymd").($data+1)."-KPA";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->id_anggota = Input::get('id_anggota');
		$new->info = Input::get('keterangan')." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$new->jenis = 'manual';
		$new->masuk = Input::get('jumlah');
		$new->save();

		return redirect('keuangan/pemasukan/anggota')->withData($new->no_nota);
	}	
	public function koreksipengeluarananggota()
	{
		return view('keuangan.pengeluaran.anggota');
	}
	public function simpanpengeluarananggota()
	{
		$v = Validator::make(Input::all(), [
	        'jumlah' => 'required|numeric',
	        'nama' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$new = new \App\Keuangan;
		$new->no_nota = 'KSP-'.date("ymd").($data+1)."-KLA";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->id_anggota = Input::get('id_anggota');
		$new->info = Input::get('keterangan')." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$new->jenis = 'manual';
		$new->keluar = Input::get('jumlah');
		$new->save();

		return redirect('keuangan/pengeluaran/anggota')->withData($new->no_nota);
	}
	public function koreksipemasukantabungan()
	{
		return view('keuangan.pemasukan.tabungan');
	}
	public function simpanpemasukantabungan()
	{

		$v = Validator::make(Input::all(), [
	        'jumlah' => 'required|numeric',
	        'nama' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$new = new \App\Keuangan;
		$new->no_nota = 'KSP-'.date("ymd").($data+1)."-KPT";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->id_anggota = Input::get('id_anggota');
		$new->info = Input::get('keterangan')." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$new->jenis = 'tabungan';
		$new->masuk = Input::get('jumlah');
		$new->save();

		return redirect('keuangan/pemasukan/tabungan')->withData($new->no_nota);
	}	
	public function koreksipengeluarantabungan()
	{
		return view('keuangan.pengeluaran.tabungan');
	}
	public function simpanpengeluarantabungan()
	{

		$v = Validator::make(Input::all(), [
	        'jumlah' => 'required|numeric',
	        'nama' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$data = \App\Keuangan::orderBy('id','desc')->first()['id'];
		$new = new \App\Keuangan;
		$new->no_nota = 'KSP-'.date("ymd").($data+1)."-KLT";
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->id_anggota = Input::get('id_anggota');
		$new->info = Input::get('keterangan')." Rp. ".(number_format(Input::get('jumlah'),2,",","."))." (".date("d/m/Y H:i:s").") ".Auth::user()->name;
		$new->jenis = 'tabungan';
		$new->keluar = Input::get('jumlah');
		$new->save();

		return redirect('keuangan/pengeluaran/tabungan')->withData($new->no_nota);
	}

	public function rekap()
	{
		$data = array();
		$saldo = array();
		$tgl[0] = "";
		$tgl[1] = "";
		$id_anggota = "";
		if(Input::get('tanggal')!=""){
			$tgl = explode(" - ", Input::get('tanggal'));
			$tgl[0] = date_format(date_create($tgl[0]),"Y-m-d");
			$tgl[1] = date_format(date_create($tgl[1]),"Y-m-d");
			session(array('tgl0' => $tgl[0]));
			session(array('tgl1' => $tgl[1]));
		}
		if(Input::get('id_anggota')!=""){
			$id_anggota = Input::get('id_anggota');
			session(array('id_anggota' => $id_anggota));
			session(array('nama'=>Input::get('nama')));
		}
			//cek saldo
			$tgl[0] = session('tgl0');
			$tgl[1] = session('tgl1');
			$id_anggota = session('id_anggota');


		$data = \App\Keuangan::whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d") between "'.($tgl[0]).'" and "'.($tgl[1]).'"')->where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_anggota','like','%'.$id_anggota.'%')->paginate(50);
		//echo ($data[0]);
		$last_id = 0;
		if(sizeof($data)>0){
			$last_id = $data[0]->id;
		}
		$saldo = \App\Keuangan::selectRaw('sum(masuk) as debit')->selectRaw('sum(keluar) as kredit')->whereRaw('id < '.$last_id)->where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_anggota','like','%'.$id_anggota.'%')->first();
		return view('keuangan.rekap')->with(array('data'=>$data,'saldo'=>$saldo));
	}
	public function rekapexport()
	{
		//$data = \App\Keuangan::selectRaw('created_at as "Waktu",no_nota as "No. Nota", jenis as "Jenis",info as "Keterangan",masuk as "Pemasukan",keluar as "Pengeluaran"')->get();
		$tgl[0] = session('tgl0');
		$tgl[1] = session('tgl1');
		$id_anggota = session('id_anggota');


		$lama = \App\Keuangan::selectRaw('created_at as "Waktu",
											no_nota as "No. Nota", 
											jenis as "Jenis",
											info as "Keterangan",
											masuk as "Pemasukan",
											keluar as "Pengeluaran"')->whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d") between "'.($tgl[0]).'" and "'.($tgl[1]).'"')->where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_anggota','like','%'.$id_anggota.'%')->get();

		$data = array();
		foreach ($lama as $key) {
			$data[] = array('Waktu'=>$key['Waktu'],
							'No. Nota'=>$key['No. Nota'],
							'Jenis'=>$key['Jenis'],
							'Keterangan'=>$key['Keterangan'],
							'Pemasukan'=>(int)$key['Pemasukan'],
							'Pengeluaran'=>(int)$key['Pengeluaran']);
		}
		
		Excel::create('Laporan Keuangan', function($excel) use($data) {

		    $excel->sheet('Laporan Keuangan', function($sheet) use($data) {

		        $sheet->fromArray($data);

		    });

		})->download('xls');
	}
}
