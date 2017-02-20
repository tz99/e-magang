<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Supervisor Migration
* @var Supervisor
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Supervisor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ms_supervisor', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nm_supervisor', 100);
			$table->string('jabatan', 100);
			$table->string('telepon', 20);
			$table->string('email', 100);
			$table->string('foto', 100);
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
		Schema::drop('ms_supervisor');
	}

}
