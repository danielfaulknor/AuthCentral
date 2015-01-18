<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCamelCaseMultifactormethods extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('MultiFactorMethods', 'multifactormethods');
		Schema::rename('MultiFactorMethod_user', 'multifactormethod_user');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('multifactormethods','MultiFactorMethods');
		Schema::rename('multifactormethod_user', 'MultiFactorMethod_user');
	}

}
