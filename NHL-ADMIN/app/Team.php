<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * This class is a model of a NHL Team.
 */
class Team extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'division', 'wins', 'loses'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}