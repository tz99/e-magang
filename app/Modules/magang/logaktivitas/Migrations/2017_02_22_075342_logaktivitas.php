<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Logaktivitas Migration
* @var Logaktivitas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Logaktivitas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mg_log_aktivitas', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('siswa', 100);
			$table->dateTime('tanggal');
			$table->string('aktivitas', 255);
			$table->integer('verifikasi');
			$table->string('verifikator', 100);
			$table->dateTime('waktu_verifikasi');
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
		Schema::drop('mg_log_aktivitas');
	}

}
