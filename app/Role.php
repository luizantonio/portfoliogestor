<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
	 /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->using(UserRole::class);
    }
	public function user()
	{
		return $this->belongsToMany(User::class, 'role_user');
	} 
}
