<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


/**
 * This router group is about the whole admin about TEAMS data
 * All methods needed about TEAMS (Create, Update, Delete and Visualize)
 */
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('teams',  ['uses' => 'TeamController@showAllTeams']);
  
    $router->get('teams/{id}', ['uses' => 'TeamController@showOneTeam']);
  
    $router->post('teams', ['uses' => 'TeamController@create']);
  
    $router->delete('teams/{id}', ['uses' => 'TeamController@delete']);
  
    $router->put('teams/{id}', ['uses' => 'TeamController@update']);

  });

/**
 * This router group is about the whole admin about GAMES data
 * All methods needed about GAMES (Create, Update, Delete and Visualize)
 */
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('games',  ['uses' => 'GameController@showAllGames']);
  
    $router->get('games/{id}', ['uses' => 'GameController@showOneGame']);
  
    $router->post('games', ['uses' => 'GameController@create']);
  
    $router->delete('games/{id}', ['uses' => 'GameController@delete']);
  
    $router->put('games/{id}', ['uses' => 'GameController@update']);

  });
