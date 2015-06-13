<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TicketsSeeder extends Seeder {

    /**
     * Add test tickets to the database
     *
     * @return void
     */
    public function run()
    {
        $ticket_id  = null;
        $user_id    = null;
        $admin_id   = null;

        //Generate some random tickets
        factory('App\Ticket', 50)->create()->each(function($t) {

            global $ticket_id, $user_id, $admin_id;

            //Set the ticket id
            $ticket_id  = $t->id;

            //Get a user for making the ticket
            $user_id    = App\User::where('client_id', '=', $t->client_id)->get()->random(1)->id;

            //Get an admin to respond to the ticket
            $admin_id   = App\User::whereHas('roles', function($q){
                $q->whereIn('id', [0, 1]);
            })->get()->random(1)->id;


            //Generate random comments for the ticket
            factory('App\TicketComment', rand(2, 10))->create()->each(function($c) {

                global $ticket_id, $user_id, $admin_id;

                $c->ticket_id   = $ticket_id;
                $c->user_id     = (rand(0, 1) == 0 ? $admin_id : $user_id );

                $c->save();
            });


        });
    }

}
