<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Tugas Migration
* @var Tugas
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Tugas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mg_tugas', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nm_siswa', 100);
			$table->string('nm_project', 100);
			$table->string('tugas', 100);
			$table->string('deskripsi', 100);
			$table->string('tgl_deadline', 10);
			$table->string('status', 100);
			$table->string('tgl_selesai', 10);
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
		Schema::drop('mg_tugas');
	}

}
