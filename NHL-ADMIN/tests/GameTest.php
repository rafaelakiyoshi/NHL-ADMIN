<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Game;

class GameTest extends TestCase
{
    use DatabaseTransactions;

    // A test to verify if /api/games endpoint is returning all Games available.
    public function testGetAllGames()
    {
        $this->get('/api/games');

        $this->assertEquals(Game::all(), $this->response->getContent()
        );
    }

    // A test to verify if /api/games/{id} endpoint is returning this specific Game.    
    public function testGetOneGame()
    {
        $this->get('/api/games/10');

        $this->assertEquals(Game::find(10), $this->response->getContent()
        );
    }

    // A test to verify if POST /api/games endpoint is creating a Game. 
    public function testCreateOneGame()
    {
        $game = factory('App\Game')->make();      
        $this->post('/api/games', [
          'id_team1' => $game->id_team1, 
          'id_team2'=> $game->id_team2,
          'score_team1'=> $game->score_team1,
          'score_team2'=> $game->score_team2,
          'game_date'=> $game->game_date,
          'watched' => $game->watched,
        ]) ->seeJson([
          'id_team1' => $game->id_team1, 
          'id_team2'=> $game->id_team2,
          'score_team1'=> $game->score_team1,
          'score_team2'=> $game->score_team2,
          'game_date'=> $game->game_date,
          'watched' => $game->watched,
        ]);
    }

    // A test to verify if PUT /api/Games endpoint is Updating a Game.
    public function testUpdateOneGame()
    {
        $game2 = factory('App\Game')->make();      
        $this->put('/api/games/1', [
          'id_team1' => $game2->id_team1, 
          'id_team2'=> $game2->id_team2,
          'score_team1'=> $game2->score_team1,
          'score_team2'=> $game2->score_team2,
          'game_date'=> $game2->game_date,
          'watched' => $game2->watched,
        ]) ->seeJson([
          'id_team1' => $game2->id_team1, 
          'id_team2'=> $game2->id_team2,
          'score_team1'=> $game2->score_team1,
          'score_team2'=> $game2->score_team2,
          'game_date'=> $game2->game_date,
          'watched' => $game2->watched,
        ]);
    }

    // A test to verify if DELETE /api/Games endpoint is DELETING a Game.
    public function testDeleteOneGame()
    {
      $response = $this->call('DELETE', '/api/games/1');
      $this->assertEquals(200, $response->status());
    }
}
