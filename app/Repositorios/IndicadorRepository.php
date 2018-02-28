<?php

namespace App\Repositorios;

use App\User;
use App\Indicador;

class IndicadorRepository
{
    /*
	* Get all of the indicadores for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function forUser(User $user)
	{
		return $user->indicadores()
					->orderBy('nome', 'asc')
					->get();
	}

	/*
	* Get one indicadores for a given user
	*
	* @param User $user
	* @return Collection
	*/
	public function oneIndicador(User $user, Indicador $indicador)
	{
		return $user->indicadores()
					->where("id", $indicador->id)
					->orderBy('nome', 'asc')
					->get();
	}
}
