<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class AnggotaController extends Controller {

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
		$data = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->paginate(20);
		return view('anggota.all')->withData($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('anggota.baru');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//$data = \App\Anggota::orderBy('id','desc')->first()['id'];
		$new = new \App\Anggota;
		//$new->no_anggota = 'KSP-'.date("ymd").($data+1)."-A";	
		$new->no_anggota = Input::get('no_anggota');
		$new->nama = Input::get('nama');	
		$new->id_koperasi = Auth::user()->assigned_koperasi;	
		$new->email = Input::get('email');	
		$new->gender = Input::get('gender');	
		$new->no_telp = Input::get('no_telp');	
		$new->no_hp = Input::get('no_hp');	
		$new->no_ktp = Input::get('no_ktp');	
		$new->alamat = Input::get('alamat');	
		$new->rtrw = Input::get('rtrw');	
		$new->kel = Input::get('kel');	
		$new->kec = Input::get('kec');	
		$new->kabkota = Input::get('kabkota');	
		$new->prov = Input::get('prov');	
		$new->kodepos = Input::get('kodepos');	
		$new->negara = Input::get('negara');	
		$new->created_by = Auth::user()->id;	
		if(Input::hasFile('foto')){
			$foto = date("YmdHis")
			.uniqid()
			."."
			.Input::file('foto')->getClientOriginalExtension();

			Input::file('foto')->move(storage_path("images"),$foto);
			$new->foto = $foto;
		}
		if(Input::hasFile('scan_ktp')){
			$scan_ktp = date("YmdHis")
			.uniqid()
			."."
			.Input::file('scan_ktp')->getClientOriginalExtension();

			Input::file('scan_ktp')->move(storage_path("images"),$scan_ktp);
			$new->scan_ktp = $scan_ktp;
		}
		$new->save();

		return redirect(url('anggota'));
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
		$data = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);
		return view('anggota.edit')->withData($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$new = \App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);	
		$new->nama = Input::get('nama');	
		$new->id_koperasi = Auth::user()->assigned_koperasi;	
		$new->email = Input::get('email');	
		$new->gender = Input::get('gender');	
		$new->no_telp = Input::get('no_telp');	
		$new->no_hp = Input::get('no_hp');	
		$new->no_ktp = Input::get('no_ktp');	
		$new->alamat = Input::get('alamat');	
		$new->rtrw = Input::get('rtrw');	
		$new->kel = Input::get('kel');	
		$new->kec = Input::get('kec');	
		$new->kabkota = Input::get('kabkota');	
		$new->prov = Input::get('prov');	
		$new->kodepos = Input::get('kodepos');	
		$new->negara = Input::get('negara');	
		$new->created_by = Auth::user()->id;	
		if(Input::hasFile('foto')){
			$foto = date("YmdHis")
			.uniqid()
			."."
			.Input::file('foto')->getClientOriginalExtension();

			Input::file('foto')->move(storage_path("images"),$foto);
			$new->foto = $foto;
		}
		if(Input::hasFile('scan_ktp')){
			$scan_ktp = date("YmdHis")
			.uniqid()
			."."
			.Input::file('scan_ktp')->getClientOriginalExtension();

			Input::file('scan_ktp')->move(storage_path("images"),$scan_ktp);
			$new->scan_ktp = $scan_ktp;
		}
		$new->save();

		return redirect(url('anggota'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id)->delete();
		return redirect(url('anggota'));
	}

}
