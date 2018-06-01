<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * This class is a model of a NHL Team.
 */
class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id_team1', 'id_team2', 'score_team1', 'score_team2', 'game_date', 'watched'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}