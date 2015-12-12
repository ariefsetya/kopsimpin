<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;


class PengaturanController extends Controller {

	public function koperasi()
	{
		$data = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		return view('pengaturan.koperasi')->withData($data);
	}

	public function save_koperasi()
	{
		$new = \App\Koperasi::find(Auth::user()->assigned_koperasi);	
		$new->nama = Input::get('nama');		
		$new->email = Input::get('email');		
		$new->no_telp = Input::get('no_telp');	
		$new->no_fax = Input::get('no_fax');	
		$new->alamat = Input::get('alamat');	
		$new->rtrw = Input::get('rtrw');	
		$new->kel = Input::get('kel');	
		$new->kec = Input::get('kec');	
		$new->kabkota = Input::get('kabkota');	
		$new->prov = Input::get('prov');	
		$new->kodepos = Input::get('kodepos');	
		$new->negara = Input::get('negara');	
		if(Input::hasFile('logo')){
			$logo = date("YmdHis")
			.uniqid()
			."."
			.Input::file('logo')->getClientOriginalExtension();

			Input::file('logo')->move(storage_path("images"),$logo);
			$new->logo = $logo;
		}
		$new->save();

		return redirect(url('anggota'));
	}

}
