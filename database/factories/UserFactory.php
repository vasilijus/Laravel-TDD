<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Concert;
use Carbon\Carbon;

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Concert::class, function (Faker $faker) {
    return [
        
        'title' => 'Example Band',
        'subtitle' => 'with The Fake Band',
        'date' => Carbon::parse('+2 weeks'),
        'ticket_price' => 20000,
        'venue' => 'THe Example Theatre',
        'venue_address' => '123 Oxford Road',
        'city' => 'Oxford',
        'state' => 'UK',
        'zip' => '9876',
        'additional_information' => 'for tickets call Us',
    ];
});