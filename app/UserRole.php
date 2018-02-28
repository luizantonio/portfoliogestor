<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Model
{
    //
	public function role()
	{
		return $this->belongsToMany(Role::class, 'role_user');
	}

	
}
