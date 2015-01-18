<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add2faMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('2faMethods', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');
			$table->string('friendly_name');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('2faMethods', function(Blueprint $table)
		{
			Schema::drop('2faMethods');
		});
	}

}
