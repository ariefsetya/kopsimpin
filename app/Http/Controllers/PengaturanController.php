<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

use Validator;	


class PengaturanController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function koperasi()
	{
		$data = \App\Koperasi::find(Auth::user()->assigned_koperasi);
		return view('pengaturan.koperasi')->withData($data);
	}

	public function save_koperasi()
	{
		$v = Validator::make(Input::all(), [
	        'nama' => 'required',
	        'alamat' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
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

		return redirect(url('pengaturan/koperasi'));
	}

	public function index()
	{
		$data = \App\User::where('assigned_koperasi',Auth::user()->assigned_koperasi)->paginate(20);
		return view('pengaturan.allpengurus')->withData($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pengaturan.pengurusbaru');
	}	

	public function bantuan()
	{
		return view('pengaturan.bantuan');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$v = Validator::make(Input::all(), [
	        'name' => 'required',
	        'email' => 'required|email|unique:users',
	        'password'=>'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		$new = new \App\User;
		$new->name = Input::get('name');
		$new->email = Input::get('email');
		$new->password = bcrypt(Input::get('password'));
		$new->primary = 0;
		$new->assigned_koperasi = Auth::user()->assigned_koperasi;
		$new->created_by = Auth::user()->id;
		$new->save();

		$priv_data = explode(",", Input::get('id_menu'));
		for($i=0;$i<sizeof($priv_data);$i++) {
			echo $priv_data[$i];

			if(is_numeric($priv_data[$i]) and $priv_data[$i]>0){

				$induk = \App\Menu::find($priv_data[$i])['id_induk'];
				$ada = \App\Privileges::where(array('id_koperasi'=>Auth::user()->assigned_koperasi,
												'id_users'=>$new->id,
												'id_menu'=>$priv_data[$i]))->first();
				$adainduk = \App\Privileges::where(array('id_koperasi'=>Auth::user()->assigned_koperasi,
												'id_users'=>$new->id,
												'id_menu'=>$induk))->first();
				if(empty($ada)){
					$new_priv = new \App\Privileges;
					$new_priv->id_koperasi = Auth::user()->assigned_koperasi;
					$new_priv->id_users = $new->id;
					$new_priv->id_menu = $priv_data[$i];
					$new_priv->open = 1;
					$new_priv->save();
				}

				if(empty($adainduk) and $induk > 0){
					$new_priv = new \App\Privileges;
					$new_priv->id_koperasi = Auth::user()->assigned_koperasi;
					$new_priv->id_users = $new->id;
					$new_priv->id_menu = $induk;
					$new_priv->open = 1;
					$new_priv->save();
				}

			}
		}
		return redirect(url('pengaturan/pengurus'));
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
		$data = \App\User::where('assigned_koperasi',Auth::user()->assigned_koperasi)->find($id);
		$priv = \App\Privileges::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_users', $id)->get();
		//print_r($priv);
		$dab = [];
		foreach ($priv as $key) {
			$dab[] = $key->id_menu;
		}
		$priv = implode(",", $dab);
		return view('pengaturan.pengurusedit')->with(array('data'=>$data, 'priv'=>$priv));
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
	        'name' => 'required',
	        'email' => 'required|email',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
		\App\Privileges::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_users',$id)->delete();
		$new = \App\User::where('assigned_koperasi',Auth::user()->assigned_koperasi)->find($id);
		$new->name = Input::get('name');
		$new->email = Input::get('email');
		if(bcrypt(Input::get('password'))!=$new->password and trim(Input::get("password"))!=""){
			$new->password = bcrypt(Input::get('password'));
		}
		$new->assigned_koperasi = Auth::user()->assigned_koperasi;
		$new->created_by = Auth::user()->id;
		$new->save();

		$priv_data = explode(",", Input::get('id_menu'));
		for($i=0;$i<sizeof($priv_data);$i++) {
			echo $priv_data[$i];

			if(is_numeric($priv_data[$i]) and $priv_data[$i]>0){

				$induk = \App\Menu::find($priv_data[$i])['id_induk'];
				$ada = \App\Privileges::where(array('id_koperasi'=>Auth::user()->assigned_koperasi,
												'id_users'=>$new->id,
												'id_menu'=>$priv_data[$i]))->first();
				$adainduk = \App\Privileges::where(array('id_koperasi'=>Auth::user()->assigned_koperasi,
												'id_users'=>$new->id,
												'id_menu'=>$induk))->first();
				if(empty($ada)){
					$new_priv = new \App\Privileges;
					$new_priv->id_koperasi = Auth::user()->assigned_koperasi;
					$new_priv->id_users = $new->id;
					$new_priv->id_menu = $priv_data[$i];
					$new_priv->open = 1;
					$new_priv->save();
				}

				if(empty($adainduk) and $induk > 0){
					$new_priv = new \App\Privileges;
					$new_priv->id_koperasi = Auth::user()->assigned_koperasi;
					$new_priv->id_users = $new->id;
					$new_priv->id_menu = $induk;
					$new_priv->open = 1;
					$new_priv->save();
				}

			}
		}

		return redirect(url('pengaturan/pengurus'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\App\User::where('assigned_koperasi',Auth::user()->assigned_koperasi)->find($id)->delete();
		\App\Privileges::where('id_koperasi',Auth::user()->assigned_koperasi)->where('id_users',$id)->delete();
		return redirect(url('pengaturan/pengurus'));
	}

}
