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
        
        $path = realpath(__DIR__ . '/../../database/seeds/TeamsSeed.json');
        $teams = json_decode(file_get_contents($path), true);

        $games = factory(App\Game::class, 100)->create();
        // $games = array(
        //     [
        //         'id_team1' => 1, 
        //         'id_team2' => 2, 
        //         'score_team1' => 2,
        //         'score_team2' => 5,
        //         'game_date' => '06022017',
        //         'watched' => 2000,
        //     ],
        //     [
        //         'id_team1' => 2, 
        //         'id_team2' => 3, 
        //         'score_team1' => 4,
        //         'score_team2' => 5,
        //         'game_date' => '08022017',
        //         'watched' => 3500,
        //     ],
        //     [
        //         'id_team1' => 3, 
        //         'id_team2' => 4, 
        //         'score_team1' => 1,
        //         'score_team2' => 5,
        //         'game_date' => '06032017',
        //         'watched' => 2000,
        //     ],
        //     [
        //         'id_team1' => 4, 
        //         'id_team2' => 1, 
        //         'score_team1' => 8,
        //         'score_team2' => 5,
        //         'game_date' => '09022017',
        //         'watched' => 4000,
        //     ],
        // );

        // Loop through each user above and create the record for them in the database
        foreach ($teams as $team) {
            Team::create($team);
        }
        Model::reguard();
    }
}
