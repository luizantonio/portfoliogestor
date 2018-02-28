<?php

namespace App\Repositorios;

use App\User;

class EquipeRepository
{
    /*
	* Get all of the projects for a given user
	*
	* @return Collection
	*/
	public function allUser()
	{
		$user = new User();
		return $user->orderBy('name', 'asc')
					->get();		
	}

	/*
	* Get one projects for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function oneUser(User $user)
	{
		$user = new User();
		return $user->where("id_user", $user->id)
					->orderBy('nome', 'asc')
					->get();
	}
}
