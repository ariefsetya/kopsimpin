<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$kop = new \App\Koperasi;
		$kop->nama = "BaseCamp Software";
		$kop->alamat = "Jalan Condet Raya No. 9A";
		$kop->email = "emailanenih@gmail.com";
		$kop->no_telp = "083870002220";
		$kop->no_fax = "083870002220";
		$kop->denda = "0.05";
		$kop->logo = ("Logo-Koperasi.gif");
		$kop->catatan = ("Simpan baik baik dan setiap kali berhubungan dengan BaseCamp Software");
		$kop->rtrw = "04/04";
		$kop->kel = "Balekambang";
		$kop->kec = "Kramat Jati";
		$kop->kabkota = "Jakarta Timur";
		$kop->prov = "DKI Jakarta";
		$kop->kodepos = "13530";
		$kop->negara = "Indonesia";
		$kop->created_by = 0;
		$kop->save();		

		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'assigned_koperasi'=>$kop->id,
			'primary'=>1,
			'created_by'=>0,
		]);

		$kop->created_by = $user->id;
		$kop->save();		

		if(sizeof(\App\Bulan::all())!=12){
			$bul = new \App\Bulan;
			$bul->bulan = 1;
			$bul->nama = "Januari";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 2;
			$bul->nama = "Februari";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 3;
			$bul->nama = "Maret";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 4;
			$bul->nama = "April";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 5;
			$bul->nama = "Mei";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 6;
			$bul->nama = "Juni";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 7;
			$bul->nama = "Juli";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 8;
			$bul->nama = "Agustus";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 9;
			$bul->nama = "September";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 10;
			$bul->nama = "Oktober";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 11;
			$bul->nama = "November";
			$bul->save();
			$bul = new \App\Bulan;
			$bul->bulan = 12;
			$bul->nama = "Desember";
			$bul->save();
		}

		$sim = new \App\Simpanan;
		$sim->id_koperasi = $kop->id;
		$sim->no_transaksi = "KSP-{tanggal}-SP";
		$sim->nama = "Simpanan Pokok";
		$sim->jumlah = 1000000;
		$sim->created_by = $user->id;
		$sim->save();
		$sim = new \App\Simpanan;
		$sim->id_koperasi = $kop->id;
		$sim->no_transaksi = "KSP-{tanggal}{urutan}-SW";
		$sim->nama = "Simpanan Wajib";
		$sim->jumlah = 500000;
		$sim->created_by = $user->id;
		$sim->save();
		$sim = new \App\Simpanan;
		$sim->id_koperasi = $kop->id;
		$sim->no_transaksi = "KSP-{tanggal}{urutan}-SK";
		$sim->nama = "Simpanan Sukarela";
		$sim->jumlah = 0;
		$sim->created_by = $user->id;
		$sim->save();
		$pin = new \App\Pinjaman;
		$pin->id_koperasi = $kop->id;
		$pin->no_transaksi = "KSP-{tanggal}{urutan}-PM";
		$pin->nama = "Pinjaman Manual";
		$pin->jumlah = 0;
		$pin->jangka_waktu = 12;
		$pin->bunga = 5;
		$pin->created_by = $user->id;
		$pin->save();
		$pin = new \App\Pinjaman;
		$pin->id_koperasi = $kop->id;
		$pin->no_transaksi = "KSP-{tanggal}{urutan}-KB";
		$pin->nama = "Kasbon";
		$pin->jumlah = 0;
		$pin->jangka_waktu = 1;
		$pin->bunga = 5;
		$pin->created_by = $user->id;
		$pin->save();
		$ang = new \App\Anggota;
		$ang->id_koperasi = $kop->id;
		$ang->no_anggota = "A00001/2015";
		$ang->nama = "Arief Setya";
		$ang->email = "ariefsetya@live.com";
		$ang->no_telp = "083870002220";
		$ang->no_hp = "083870002220";
		$ang->no_ktp = "3175043103961004";
		$ang->gender = "L";
		$ang->alamat = "Jalan Condet Raya No. 9A";
		$ang->rtrw = "04/04";
		$ang->kel = "Balekambang";
		$ang->kec = "Kramat Jati";
		$ang->scan_ktp = ("Logo-Koperasi.gif");
		$ang->foto = ("Logo-Koperasi.gif");
		$ang->kabkota = "Jakarta Timur";
		$ang->prov = "DKI Jakarta";
		$ang->kodepos = "13530";
		$ang->negara = "Indonesia";
		$ang->created_by = $user->id;
		$ang->save();


		return User::find($user->id);
	}

}
