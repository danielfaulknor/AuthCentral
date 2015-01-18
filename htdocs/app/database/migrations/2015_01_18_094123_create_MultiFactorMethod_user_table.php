<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMultiFactorMethodUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('MultiFactorMethod_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('MultiFactorMethod_id')->unsigned()->index();
			$table->foreign('MultiFactorMethod_id')->references('id')->on('MultiFactorMethods')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('order');
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
		Schema::drop('MultiFactorMethod_user');
	}

}
