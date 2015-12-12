<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaksis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_koperasi');
			$table->integer('id_induk');
			$table->integer('id_anggota');
			$table->string('no_transaksi');
			$table->string('jenis_transaksi');
			$table->integer('id_jenis');
			$table->decimal('bunga',65);
			$table->decimal('admin',65);
			$table->decimal('asuransi',65);
			$table->decimal('tabungan',65);
			$table->decimal('jumlah_asli',65);
			$table->decimal('jumlah_bunga',65);
			$table->decimal('biaya_admin',65);
			$table->decimal('biaya_materai',65);
			$table->decimal('biaya_asuransi',65);
			$table->decimal('total_tabungan',65);
			$table->decimal('tabungan_per_bulan',65);
			$table->decimal('total_peminjaman',65);
			$table->decimal('angsuran',65);
			$table->decimal('jumlah_total',65);
			$table->decimal('total_denda',65);
			$table->integer('denda');
			$table->integer('info_ke');
			$table->integer('bulan');
			$table->integer('tahun');
			$table->string('status');
			$table->text('keterangan');
			$table->integer('created_by');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transaksis');
	}

}
