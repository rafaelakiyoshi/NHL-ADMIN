<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
  /**
   * It should return all Games existing in database
   * return: Json with all Games as objects
   */
  public function showAllGames()
  {
    return response()->json(Game::all());
  }

  /**
  * It should return only one Game
  * params: Game ID
  * return: Json with all Games as objects
  */
  public function showOneGame($id)
  {
    return response()->json(Game::find($id));
  }

  /**
  * It should create a Game
  * params: id_team1, id_team2, score_team1, score_team2, game_date, watched
  * return: The date of creation
  */
  public function create(Request $request)
  {
    $this->validate($request, [
      'id_team1' => 'required',
      'id_team2' => 'required',
      'score_team1' => 'required',
      'score_team2' => 'required',
      'game_date' => 'required',
      'watched' => 'required',
    ]);
    $game = Game::create($request->all());

    return response()->json($game, 201);
  }

  /**
  * It should update the data of one Game
  * params: Game ID, name, logo, division, wins and loses
  * return: The date of update
  */
  public function update($id, Request $request)
  {
    $game = Game::findOrFail($id);
    $game->update($request->all());

    return response()->json($game, 200);
  }

  /**
  * It should DELETE a Game
  * params: Game ID
  * return: Delete Message
  */
  public function delete($id)
  { 
    Game::findOrFail($id)->delete();
    return response('Game was Successfully Deleted!', 200);
  }
}