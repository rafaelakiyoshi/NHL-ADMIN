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
        $teams = array(
            [
                'name' => 'Carolina Hurricanes', 
                'logo' => 'https://goo.gl/qBrkyG', 
                'division' => 'Metropolitan',
                'wins' => 5,
                'loses' => 2,
            ],
            [
                'name' => 'Winnipeg Jets', 
                'logo' => 'https://goo.gl/bXzdoM', 
                'division' => 'Central',
                'wins' => 6,
                'loses' => 1,
            ],
            [
                'name' => 'Boston Bruins', 
                'logo' => 'https://goo.gl/1nX3NX', 
                'division' => 'Atlantic',
                'wins' => 4,
                'loses' => 3,
            ],
            [
                'name' => 'Anaheim Ducks', 
                'logo' => 'https://goo.gl/qV1TfC', 
                'division' => 'Pacific',
                'wins' => 3,
                'loses' => 4,
            ],
        );

        $games = array(
            [
                'id_team1' => 1, 
                'id_team2' => 2, 
                'score_team1' => 2,
                'score_team2' => 5,
                'game_date' => '06022017',
                'watched' => 2000,
            ],
            [
                'id_team1' => 2, 
                'id_team2' => 3, 
                'score_team1' => 4,
                'score_team2' => 5,
                'game_date' => '08022017',
                'watched' => 3500,
            ],
            [
                'id_team1' => 3, 
                'id_team2' => 4, 
                'score_team1' => 1,
                'score_team2' => 5,
                'game_date' => '06032017',
                'watched' => 2000,
            ],
            [
                'id_team1' => 4, 
                'id_team2' => 1, 
                'score_team1' => 8,
                'score_team2' => 5,
                'game_date' => '09022017',
                'watched' => 4000,
            ],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($teams as $team) {
            Team::create($team);
        }

        foreach ($games as $game) {
            Game::create($game);
        }
        Model::reguard();
    }
}
