<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

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
