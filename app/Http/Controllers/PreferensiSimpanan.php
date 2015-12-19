<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Validator;

class PreferensiSimpanan extends Controller {

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
		$data = \App\Simpanan::where('id_koperasi',Auth::user()->assigned_koperasi)->paginate(20);
		return view('preferensi.simpanan.all')->withData($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('preferensi.simpanan.baru');
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
	        'jumlah'=>'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$new = new \App\Simpanan;
		$new->nama = Input::get('nama');
		$new->jumlah = Input::get('jumlah');
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->created_by = Auth::user()->id;
		$new->save();

		return redirect(url('preferensi/simpanan'));
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
		$data = \App\Simpanan::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);
		return view('preferensi.simpanan.edit')->withData($data);
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
	        'jumlah'=>'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$new = \App\Simpanan::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id);
		$new->nama = Input::get('nama');
		$new->jumlah = Input::get('jumlah');
		$new->id_koperasi = Auth::user()->assigned_koperasi;
		$new->save();

		return redirect(url('preferensi/simpanan'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\Simpanan::where('id_koperasi',Auth::user()->assigned_koperasi)->find($id)->delete();
		return redirect(url('preferensi/simpanan'));
	}

}
