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

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->email,
//     ];
// });

$factory->define(App\Game::class, function (Faker\Generator $faker) {
    return [
        'id_team1' => rand(1, 12),
        'id_team2' => rand(1, 12),
        'score_team1' => rand(1, 10),
        'score_team2' => rand(1, 10),
        'game_date' => "".rand(1, 30)."062018",
        'watched' => rand(500, 10000),
    ];
});
