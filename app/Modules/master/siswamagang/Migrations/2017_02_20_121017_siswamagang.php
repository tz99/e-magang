<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Siswamagang Migration
* @var Siswamagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Siswamagang extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ms_siswa_magang', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('no_induk', 15);
			$table->string('nm_siswa', 100);
			$table->string('asal_sekolah', 100);
			$table->string('jenjang_pddk', 50);
			$table->string('alamat', 150);
			$table->string('no_telp', 12);
			$table->string('email', 100);
			$table->string('tgl_mulai', 50);
			$table->string('tgl_selesai', 50);
			$table->string('nm_magang', 50);
			$table->string('nm_supervisior', 100);
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
		Schema::drop('ms_siswa_magang');
	}

}
