<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ClientsSeeder extends Seeder {

    /**
     * Add test clients to the database
     *
     * @return void
     */
    public function run()
    {
        //Generate some random clients
        factory('App\Client', 5)->create();

    }

}
