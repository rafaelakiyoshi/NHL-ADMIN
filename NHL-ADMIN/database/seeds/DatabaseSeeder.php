<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Team;

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

        // Loop through each user above and create the record for them in the database
        foreach ($teams as $team) {
            Team::create($team);
        }
        Model::reguard();
    }
}
