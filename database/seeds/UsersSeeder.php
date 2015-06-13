<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersSeeder extends Seeder {

	/**
	 * Add test users to the database
	 *
	 * @return void
	 */
	public function run()
	{

        //Create an admin user so we can login
        $admin = App\User::firstOrCreate(['name' => 'Chris Morris']);
        $admin->email       = 'chris@ahoy.co.uk';
        $admin->password    = bcrypt('password');
        $admin->client_id   = App\Client::all()->random(1)->id;

        if (!$admin->roles->contains(1))
            $admin->roles()->attach(1);

        $admin->save();

        //Generate some random users
        factory('App\User', 10)->create()->each(function($u) {
            $u->attachRole( App\Role::all()->random(1)->id );

            $u->save();
        });

	}

}
