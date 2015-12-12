<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anggotas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_koperasi');
			$table->string('no_anggota');
			$table->string('nama');
			$table->string('email');
			$table->string('no_telp');
			$table->string('no_hp');
			$table->string('no_ktp');
			$table->string('gender');
			$table->string('foto');
			$table->string('scan_ktp');
			$table->string('alamat');
			$table->string('rtrw');
			$table->string('kel');
			$table->string('kec');
			$table->string('kabkota');
			$table->string('prov');
			$table->string('negara');
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
		Schema::drop('anggotas');
	}

}
