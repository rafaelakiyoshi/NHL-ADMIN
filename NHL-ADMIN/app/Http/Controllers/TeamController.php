<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
  /**
   * It should return all teams existing in database
   * return: Json with all Teams as objects
   */
  public function showAllTeams()
  {
    return response()->json(Team::all());
  }

  /**
  * It should return only one team
  * params: team ID
  * return: Json with all Teams as objects
  */
  public function showOneTeam($id)
  {
    return response()->json(Team::find($id));
  }

  /**
  * It should create a team
  * params: name, logo, division, wins and loses
  * return: The date of creation
  */
  public function create(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'logo' => 'required',
      'division' => 'required',
      'wins' => 'required',
      'loses' => 'required',
    ]);
    $team = Team::create($request->all());

    return response()->json($team, 201);
  }

  /**
  * It should update the data of one team
  * params: team ID, name, logo, division, wins and loses
  * return: The date of update
  */
  public function update($id, Request $request)
  {
    $team = Team::findOrFail($id);
    $team->update($request->all());

    return response()->json($team, 200);
  }

  /**
  * It should DELETE a team
  * params: team ID
  * return: Delete Message
  */
  public function delete($id)
  { 
    Team::findOrFail($id)->delete();
    return response('Team was Successfully Deleted!', 200);
  }
}