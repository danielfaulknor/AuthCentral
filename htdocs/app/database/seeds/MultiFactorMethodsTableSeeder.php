<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MultiFactorMethodsTableSeeder extends Seeder {

	public function run()
	{
		$method = array(
			'name' => 'authy',
			'friendly_name' => 'Authy'
		);

		DB::table('Multifactormethods')->insert($method);
	}

}
