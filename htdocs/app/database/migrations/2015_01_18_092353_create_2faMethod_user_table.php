<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create2faMethodUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('2faMethod_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('2faMethod_id')->unsigned()->index();
			$table->foreign('2faMethod_id')->references('id')->on('2faMethods')->onDelete('cascade');
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
		Schema::drop('2faMethod_user');
	}

}
