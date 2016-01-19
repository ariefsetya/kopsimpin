<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Validator;	

class PreferensiPinjaman extends Controller {

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
		$data = \App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->paginate(20);
		return view('preferensi.pinjaman.all')->withData($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('preferensi.pinjaman.baru');
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
	        'jumlah'=>'required|numeric',
	        'jangka_waktu'=>'required|numeric',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$new = new \App\Pinjaman;
		$new->nama = Input::get('nama');
		$new->jangka_waktu = Input::get('jangka_waktu');
		$new->bunga = Input::get('bunga');
		$new->jumlah = Input::get('jumlah');
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->created_by = Auth::user()->id;
		$new->save();

		return redirect(url('preferensi/pinjaman'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function denda()
	{
		return view('preferensi.denda');
	}
	public function simpandenda()
	{
		$denda = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$denda->denda = Input::get('denda');
		$denda->save();

		return redirect(url('preferensi/denda'))->withPesan('tersimpan');
	}	
	public function badan_hukum()
	{
		return view('preferensi.badan_hukum');
	}
	public function simpanbadan_hukum()
	{
		$denda = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$denda->badan_hukum = Input::get('badan_hukum');
		$denda->save();

		return redirect(url('preferensi/badan_hukum'))->withPesan('tersimpan');
	}

	public function catatan()
	{
		return view('preferensi.catatan');
	}
	public function simpancatatan()
	{
		$v = Validator::make(Input::all(), [
	        'catatan' => 'required|min:1',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$catatan = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		$catatan->catatan = Input::get('catatan');
		$catatan->save();

		return redirect(url('preferensi/catatan'))->withPesan('tersimpan');
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
		return view('preferensi.pinjaman.edit')->withData($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$v = Validator::make(Input::all(), [
	        'nama' => 'required|min:1',
	        'jumlah'=>'required|numeric',
	        'jangka_waktu'=>'required|numeric',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$new = \App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);
		$new->nama = Input::get('nama');
		$new->jangka_waktu = Input::get('jangka_waktu');
		$new->bunga = Input::get('bunga');
		$new->jumlah = Input::get('jumlah');
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->save();

		return redirect(url('preferensi/pinjaman'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Pinjaman::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id)->delete();
		return redirect(url('preferensi/pinjaman'));
	}

}
