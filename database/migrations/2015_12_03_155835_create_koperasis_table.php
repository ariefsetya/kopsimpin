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
		Schema::drop('koperasis');
	}

}
