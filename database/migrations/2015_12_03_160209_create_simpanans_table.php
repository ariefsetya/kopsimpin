<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimpanansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('simpanans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_koperasi');
			$table->string('no_transaksi');
			$table->string('nama');
			$table->decimal('jumlah',65);
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
		Schema::drop('simpanans');
	}

}
