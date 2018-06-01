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
 * This router group is about the whole admin about teams data
 * All methods needed about teams (Create, Update, Delete and Visualize)
 */
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('teams',  ['uses' => 'TeamController@showAllTeams']);
  
    $router->get('teams/{id}', ['uses' => 'TeamController@showOneAuthor']);
  
    $router->post('teams', ['uses' => 'TeamController@create']);
  
    $router->delete('teams/{id}', ['uses' => 'TeamController@delete']);
  
    $router->put('teams/{id}', ['uses' => 'TeamController@update']);

  });
