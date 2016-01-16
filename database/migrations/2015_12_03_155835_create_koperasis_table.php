<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKoperasisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('koperasis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nama');
			$table->string('email');
			$table->string('no_telp');
			$table->string('no_fax');
			$table->string('logo');
			$table->string('catatan');
			$table->string('alamat');
			$table->string('rtrw');
			$table->string('kel');
			$table->string('kec');
			$table->string('kabkota');
			$table->string('prov');
			$table->string('kodepos');
			$table->string('negara');
			$table->string('file_bantuan');
			$table->decimal('denda',65);
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
		Schema::drop('koperasis');
	}

}
