<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameCode extends Model
{
    protected $fillable = ['game_code','game_type','game_odd','usertag_id'];
}
