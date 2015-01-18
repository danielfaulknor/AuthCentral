<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNamesToUser extends Migration {


	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{

			$table->dropColumn('username');
			$table->string('first_name')->after('id');
			$table->string('last_name')->after('first_name');
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('username', 32)->after('id');
			$table->dropColumn('first_name');
			$table->dropColumn('last_name');
		});
	}

}
