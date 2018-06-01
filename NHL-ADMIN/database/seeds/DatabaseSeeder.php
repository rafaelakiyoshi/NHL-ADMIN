<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Team;
use App\Game;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('teams')->delete();
        DB::table('games')->delete();
        

        // Read a JSON file to get real teams information
        $path = realpath(__DIR__ . '/../../database/seeds/TeamsSeed.json');
        $teams = json_decode(file_get_contents($path), true);


        // Create 100 fake games results with model factory
        $games = factory(App\Game::class, 100)->create();

        // Loop through each user above and create the record for them in the database
        foreach ($teams as $team) {
            Team::create($team);
        }
        Model::reguard();
    }
}
