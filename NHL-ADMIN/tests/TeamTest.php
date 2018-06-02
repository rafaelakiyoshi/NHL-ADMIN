<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Team;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    // A test to verify if /api/teams endpoint is returning all teams available.
    public function testGetAllTeams()
    {
        $this->get('/api/teams');

        $this->assertEquals(Team::all(), $this->response->getContent()
        );
    }

    // A test to verify if /api/teams/{id} endpoint is returning this specific team.    
    public function testGetOneTeam()
    {
        $this->get('/api/teams/10');

        $this->assertEquals(Team::find(10), $this->response->getContent()
        );
    }

    // A test to verify if POST /api/teams endpoint is creating a team. 
    public function testCreateOneTeam()
    {
        $this->post('/api/teams', 
          [
            'name' => 'Team 1',
            'logo' => 'Logo 1',
            'division' => 'Division 1',
            'wins' => 1,
            'loses' => 1,
          ]) ->seeJson([
            'name' => 'Team 1',
            'logo' => 'Logo 1',
            'division' => 'Division 1',
            'wins' => 1,
            'loses' => 1,
        ]);
    }

    // A test to verify if PUT /api/teams endpoint is Updating a team.
    public function testUpdateOneTeam()
    {
        $this->put('/api/teams/1',
           [
            'name' => 'Team 2',
            'logo' => 'Logo 2',
            'division' => 'Division 2',
            'wins' => 2,
            'loses' => 2,
          ]) ->seeJson([
            'name' => 'Team 2',
            'logo' => 'Logo 2',
            'division' => 'Division 2',
            'wins' => 2,
            'loses' => 2,
        ]);
    }

    // A test to verify if DELETE /api/teams endpoint is DELETING a team.
    public function testDeleteOneTeam()
    {
      $response = $this->call('DELETE', '/api/teams/1');
      $this->assertEquals(200, $response->status());
    }
}
