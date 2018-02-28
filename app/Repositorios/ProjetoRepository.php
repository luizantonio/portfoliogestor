<?php

namespace App\Repositorios;

use App\User;

class ProjetoRepository
{
    
	protected $STATUS_ENCERRADO =6; # status do projeto encerrado

    /**
	* Get all of the projects for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function forUser(User $user)
	{
		return $user->projetos()
					->orderBy('nome', 'asc')
					->get();
	}

	/**
	* Get one projects for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function oneProject(User $user)
	{
		return $user->projetos()
					->where("id_user", $user->id)
					->orderBy('nome', 'asc')
					->get();
	}

	/**
	* Get one projects finished  by user
	*
	* @param User $user
	* @return Collection
	*/
	public function finishedProject(User $user)
	{
		return $user->projetos()
					->where("status_id", $this->STATUS_ENCERRADO)
					->orderBy('nome', 'asc')
					->get();
	}

	/**
	* Get one projects finished  by user
	*
	* @param User $user
	* @return Collection
	*/
	public function finishedProjectGerente(User $user)
	{
		return $user->projetos()
					->where("status_id", $this->STATUS_ENCERRADO)
					->where("gerente_responsavel",'=', $user->id)
					->orderBy('nome', 'asc')
					->get();
	}

	/**
	* Get one projects finished  by user
	*
	* @param User $user
	* @return Collection
	*/
	public function finishedProjectLider(User $user)
	{
		return $user->projetos()
					->where("status_id", $this->STATUS_ENCERRADO)
					->orderBy('nome', 'asc')
					->get();
	}
}
