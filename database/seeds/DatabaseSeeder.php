<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->command->info('---------------------------');
        $this->command->info('Generating Global data');
        $this->command->info('---------------------------');

		$this->call('RolesSeeder');

        $this->command->info('');

		if (App::environment() !== 'production') {
            $this->command->info('---------------------------');
            $this->command->info('Generating Test data');
            $this->command->info('---------------------------');

            $this->call('ClientsSeeder');
            $this->call('UsersSeeder');
            $this->call('TicketsSeeder');

		} else {
            $this->command->info('---------------------------');
            $this->command->info('Generating Production data');
            $this->command->info('---------------------------');

		}
	}

}
