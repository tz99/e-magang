<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Requestizin Migration
* @var Requestizin
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Requestizin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mg_request_izin', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('tgl_awal_izin', 1);
			$table->string('tgl_akhir_izin', 1);
			$table->string('jenis_izin', 1);
			$table->string('surat_izin', 1);
			$table->string('keterangan_izin', 255);
			$table->string('verifikasi_izin', 255);
			$table->string('verifikator_izin', 100);
			$table->string('waktu_verifikasi_izin', 1);
			$table->bigInteger('user_id');
			$table->bigInteger('role_id');

			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
		public function down()
	{
		Schema::drop('mg_request_izin');
	}

}
