<?php

namespace App\Repositorios;

use App\User;
use App\Projeto;

class FaseDoProjetoRepository
{
    /*
	* Get all of the projects for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function forUser(Projeto $projeto)
	{
		//return $projeto->projetos()
					->orderBy('nome', 'asc')
					->get();
	}

	/*
	* Get one projects for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function oneProject(User $user)
	{
		//return $user->projetos()
					->where("id_user", $user->id)
					->orderBy('nome', 'asc')
					->get();
	}
}
