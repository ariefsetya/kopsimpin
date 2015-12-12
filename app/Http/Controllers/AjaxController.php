<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class AjaxController extends Controller {

	public function get_anggota($nama)
	{
		$data = \App\Anggota::where('nama','like','%'.$nama.'%')->where('id_koperasi',Auth::user()->assigned_koperasi)->get();
		$kirim = array();
		foreach ($data as $key) {
			$kirim[] = array('id'=>$key['id'],'value'=>$key['nama'],'label'=>$key['no_anggota']." - ".$key['nama']);
		}
		echo json_encode($kirim);
	}
	public function get_simpanan($id)
	{
		$data = \App\Simpanan::find($id);
		echo $data->jumlah;
	}
	public function get_pinjaman($id)
	{
		$data = \App\Pinjaman::find($id);
		echo json_encode($data);
	}
	public function get_pinjaman_belum_lunas($id_anggota)
	{
		$data = \App\Transaksi::where('jenis_transaksi','Pinjaman')
					->where('id_anggota',$id_anggota)
					->where('status','Belum Lunas')->get();
		echo json_encode($data);
	}
	public function get_angsuran_belum_lunas($id_induk)
	{
		$data = \App\Transaksi::where('jenis_transaksi','Pengembalian Pinjaman')
					->where('id_induk',$id_induk)
					->where('status','Belum Lunas')
					->limit(15)->get();
		echo json_encode($data);
	}
	public function get_angsuran_all($id_induk)
	{
		$data = \App\Transaksi::where('jenis_transaksi','Pengembalian Pinjaman')
					->where('id_induk',$id_induk)->get();
		echo json_encode($data);
	}
	public function get_angsuran_data($id_transaksi)
	{
		$data = \App\Transaksi::find($id_transaksi);

		$days = (strtotime(date_format($data->created_at,"Y-m-d")) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);

		$data_induk = \App\Transaksi::find($data->id_induk)['jumlah_asli'];

		$json = array('bunga'=>$data->jumlah_bunga,
					'admin'=>$data->biaya_admin,
					'asuransi'=>$data->biaya_asuransi,
					'materai'=>$data->biaya_materai,
					'jumlah_asli'=>$data->jumlah_asli,
					'total_tabungan'=>$data->total_tabungan,
					'jumlah_total'=>$data->jumlah_total,
					'jatuh_tempo'=>date_format($data->created_at,"d M Y"),
					'terlambat'=>$days,
					'denda'=>number_format((($days<0)?$days*-1:0)*(0.05*$data_induk),2,".",""),
					'total_pembayaran'=>number_format($data->jumlah_asli+$data->total_tabungan+((($days<0)?$days*-1:0)*(0.05*$data_induk)),2,".","")
				);
		echo json_encode($json);
	}

}
