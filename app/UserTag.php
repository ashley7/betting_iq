<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GameCode;

class UserTag extends Model
{

	public static function gamecode($tag)
	{
		return GameCode::where('tag',$tag)->get();
	}

	public function users()
	{
		return $this->belongsTo('App\User','user_id');
	}
    
}
