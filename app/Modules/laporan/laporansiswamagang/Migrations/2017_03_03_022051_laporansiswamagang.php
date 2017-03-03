<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Laporansiswamagang Migration
* @var Laporansiswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Laporansiswamagang extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lap_laporan_siswa_magang', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nm_siswa', 12);
			$table->string('no_induk', 12);
			$table->string('asal_sekolah', 12);
			$table->string('jenjang_pddk', 12);
			$table->string('nm_magang', 12);
			$table->string('tgl_mulai', 12);
			$table->string('tgl_selesai', 12);
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
		Schema::drop('lap_laporan_siswa_magang');
	}

}
