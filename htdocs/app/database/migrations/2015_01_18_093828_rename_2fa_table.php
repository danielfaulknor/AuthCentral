<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rename2faTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('2faMethods', 'MultiFactorMethods');
		Schema::drop('2faMethod_user');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('MultiFactorMethods', '2faMethods');
		Schema::rename('MultiFactorMethod_user', '2faMethod_user');
	}

}
