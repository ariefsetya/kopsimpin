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
		$kop->nama = "Koperasi Online";
		$kop->alamat = "Jalan Condet Raya No. 9A";
		$kop->email = "emailanenih@gmail.com";
		$kop->no_telp = "083870002220";
		$kop->no_fax = "083870002220";
		$kop->denda = "0.05";
		$kop->logo = ("Logo-Koperasi.gif");
		$kop->catatan = ("Simpan baik baik dan setiap kali berhubungan dengan Koperasi Online");
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

		if(sizeof(\App\Menu::all())==0){
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Dashboard";
		$menu->url = "/";
		$menu->icon = "fa-dashboard";
		$menu->save();
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Anggota";
		$menu->url = "";
		$menu->icon = "fa-user";
		$menu->save();
			$id_last = $menu->id;
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Tambah Anggota";
			$menu->url = "anggota/baru";
			$menu->icon = "fa-user-plus";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Data Anggota";
			$menu->url = "anggota";
			$menu->icon = "fa-list";
			$menu->save();
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Transaksi";
		$menu->url = "";
		$menu->icon = "fa-map-signs";
		$menu->save();
			$id_last = $menu->id;
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Simpanan";
			$menu->url = "";
			$menu->icon = "fa-folder-open";
			$menu->save();
				$id_last2 = $menu->id;	
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Tambah Simpanan";
				$menu->url = "transaksi/simpanan/baru";
				$menu->icon = "fa-plus";
				$menu->save();
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Data Simpanan";
				$menu->url = "transaksi/simpanan";
				$menu->icon = "fa-list";
				$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Pinjaman";
			$menu->url = "";
			$menu->icon = "fa-money";
			$menu->save();
				$id_last2 = $menu->id;
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Buat Pinjaman";
				$menu->url = "transaksi/pinjaman/baru";
				$menu->icon = "fa-plus";
				$menu->save();
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Data Pinjaman";
				$menu->url = "transaksi/pinjaman";
				$menu->icon = "fa-list"; 
				$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Angsuran";
			$menu->url = "";
			$menu->icon = "fa-pencil-square-o";
			$menu->save();
				$id_last2 = $menu->id;
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Pembayaran";
				$menu->url = "transaksi/pembayaran/baru";
				$menu->icon = "fa-plus";
				$menu->save();
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Data Pembayaran";
				$menu->url = "transaksi/pembayaran/all";
				$menu->icon = "fa-list";
				$menu->save();
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Keuangan";
		$menu->url = "";
		$menu->icon = "fa-money";
		$menu->save();
			$id_last = $menu->id;
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Koreksi";
			$menu->url = "";
			$menu->icon = "fa-pencil";
			$menu->save();
				$id_last2 = $menu->id;
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Koperasi";
				$menu->url = "";
				$menu->icon = "fa-institution";
				$menu->save();
					$id_last3 = $menu->id;
					$menu = new \App\Menu;
					$menu->id_induk = $id_last3;
					$menu->nama = "Pemasukan Koperasi";
					$menu->url = "keuangan/pemasukan/koreksi";
					$menu->icon = "fa-sign-in";
					$menu->save();
					$menu = new \App\Menu;
					$menu->id_induk = $id_last3;
					$menu->nama = "Pengeluaran Koperasi";
					$menu->url = "keuangan/pengeluaran/koreksi";
					$menu->icon = "fa-sign-out";
					$menu->save();
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Anggota";
				$menu->url = "";
				$menu->icon = "fa-user";
				$menu->save();
					$id_last3 = $menu->id;
					$menu = new \App\Menu;
					$menu->id_induk = $id_last3;
					$menu->nama = "Pemasukan Anggota";
					$menu->url = "keuangan/pemasukan/anggota";
					$menu->icon = "fa-sign-in";
					$menu->save();
					$menu = new \App\Menu;
					$menu->id_induk = $id_last3;
					$menu->nama = "Pengeluaran Anggota";
					$menu->url = "keuangan/pengeluaran/anggota";
					$menu->icon = "fa-sign-out";
					$menu->save();
				$menu = new \App\Menu;
				$menu->id_induk = $id_last2;
				$menu->nama = "Tabungan";
				$menu->url = "";
				$menu->icon = "fa-credit-card";
				$menu->save();
					$id_last3 = $menu->id;
					$menu = new \App\Menu;
					$menu->id_induk = $id_last3;
					$menu->nama = "Pemasukan Tabungan";
					$menu->url = "keuangan/pemasukan/tabungan";
					$menu->icon = "fa-sign-in";
					$menu->save();
					$menu = new \App\Menu;
					$menu->id_induk = $id_last3;
					$menu->nama = "Pengeluaran Tabungan";
					$menu->url = "keuangan/pengeluaran/tabungan";
					$menu->icon = "fa-sign-out";
					$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Rekap Keuangan";
			$menu->url = "keuangan/rekap";
			$menu->icon = "fa-server";
			$menu->save();
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Laporan";
		$menu->url = "";
		$menu->icon = "fa-copy";
		$menu->save();
			$id_last = $menu->id;
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Simpanan";
			$menu->url = "laporan/simpanan";
			$menu->icon = "fa-folder-open";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Pinjaman";
			$menu->url = "laporan/pinjaman";
			$menu->icon = "fa-money";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Saldo Koperasi";
			$menu->url = "laporan/saldo";
			$menu->icon = "fa-tachometer";
			$menu->save();
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Preferensi";
		$menu->url = "";
		$menu->icon = "fa-cubes";
		$menu->save();
			$id_last = $menu->id;
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Simpanan";
			$menu->url = "preferensi/simpanan";
			$menu->icon = "fa-folder-open";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Pinjaman";
			$menu->url = "preferensi/pinjaman";
			$menu->icon = "fa-money";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Denda";
			$menu->url = "preferensi/denda";
			$menu->icon = "fa-calendar-times-o";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Catatan Transaksi";
			$menu->url = "preferensi/catatan";
			$menu->icon = "fa-pencil";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Badan Hukum";
			$menu->url = "preferensi/badan_hukum";
			$menu->icon = "fa-institution";
			$menu->save();
		$menu = new \App\Menu;
		$menu->id_induk = 0;
		$menu->nama = "Pengaturan";
		$menu->url = "";
		$menu->icon = "fa-cogs";
		$menu->save();
			$id_last = $menu->id;
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Koperasi";
			$menu->url = "pengaturan/koperasi";
			$menu->icon = "fa-institution";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Pengurus";
			$menu->url = "pengaturan/pengurus";
			$menu->icon = "fa-group";
			$menu->save();
			$menu = new \App\Menu;
			$menu->id_induk = $id_last;
			$menu->nama = "Bantuan";
			$menu->url = "bantuan";
			$menu->icon = "fa-life-ring";
			$menu->save();
			//dst


		}

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
		$ang->no_anggota = "KSP-00001-A";
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


		$menu = \App\Menu::all();
		foreach ($menu as $key) {
			$priv = new \App\Privileges;
			$priv->id_koperasi = $kop->id;
			$priv->id_menu = $key['id'];
			$priv->id_users = $user->id;
			$priv->save();
		}


		return User::find($user->id);
	}

}
