<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeuangansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keuangans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_koperasi');
			$table->string('no_nota');
			$table->string('tabel');
			$table->integer('id_transaksi');
			$table->integer('id_anggota');
			$table->string('jenis');
			$table->string('info');
			$table->decimal('masuk',65);
			$table->decimal('keluar',65);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('keuangans');
	}

}
