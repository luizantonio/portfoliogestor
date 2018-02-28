<?php

namespace App\Policies;

use App\User;
use App\Projeto;
use Illuminate\Http\Request;

use Illuminate\Auth\Access\HandlesAuthorization;
use Symfony\Component\HttpKernel\Exception;


class ProjetoPolicy
{
    use HandlesAuthorization;

	protected $administrador = 1;
	protected $gerenteDeProjetos = 2;
	protected $membroDaAltaDirecao = 3;
	protected $liderDoEscritorioDeProjetos = 4;
	protected $liderDeProjetos = 5;


    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	/**
     * Verify if user 'Lider Do Escritorio De Projetos' have access restrict to create projects.
	 *
     * @param User, Projeto
     * @return boolean
     */
	public function create(User $user, Projeto $projeto)
	{	
		return ($user->isLiderEscritProjetos($user->id) );
	}

	/**
     * Verify if user have access restrict to remove projects.
     * 
     * @return boolean
     */
	public function destroy(User $user, Projeto $projeto)
	{		
		return ($user->isLiderEscritProjetos($user->id) );
	}

	/**
     * Verify if user 'Lider Do Escritorio De Projetos' have access restrict to create projects.
	 *
     * @param User, Projeto
     * @return boolean
     */
	public function update(User $user, Projeto $projeto)
	{	
		//echo '<script>alert("'.$user->isLiderEscritProjetos($user->id).'");</script>';

		return ($user->isLiderEscritProjetos($user->id) );

	}
}