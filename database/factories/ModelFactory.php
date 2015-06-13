<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => null,
        'client_id' => App\Client::all()->random(1)->id
    ];
});

$factory->define(App\Client::class, function ($faker) {
    return [
        'name' => $faker->company,
        'notes' => $faker->text,
    ];
});

$factory->define(App\Ticket::class, function ($faker) {
    return [
        'client_id' => App\Client::has('users')->get()->random(1)->id,
        'status' => $faker->numberBetween(0, 3),
        'title' => $faker->text(50)
    ];
});

$factory->define(App\TicketComment::class, function ($faker) {
    return [
        'content' => $faker->paragraph( rand(4, 25) )
    ];
});
