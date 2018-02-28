<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    /*	22/08/2017 or 2017-08-22 10:54:00
	*	Class responsável pelo informar indicadores.
	*	Utilizada pelo Gerente de Projeto
	*	relacionado com a class Projeto, User e com o
	*   relacionamento da fase com o projeto e indicadores
	*
	*/
    // Fields then update by web requests, using label fillable
    // valor_minimo not usede in db table
	protected $fillable = ['user_id', 'fase_projeto_id', 'valor_minimo', 'valor_maximo', 'created_at', 'updated_at',];

	//constructor
	public function __construct()
	{
		
	}
	public function getFillable() {
	  return $this->fillable;
	}
	/**
    * The funcion that should have one user asssociated with many inform id
    *
	*	[iform_indic]---1--<>---*---[user]
	*	[user]---1--<>---*---[iform_indic]
    *
    * @return User
    */
	public function user()
	{
		return $this->belongsTo(User::class);	#[ok] 18/08/2017 10:50:00
	}
	/**
    * The funcion that should have one fase_project asssociated with your ID 
	*
	*	[iform_indic]---1--<>---1---[fase_projeto]
    *
    * @return User
    */
	public function faseprojeto()
	{
		return $this->belongsTo(Projeto::class, 'fase_projeto');	#[ok] 18/08/2017 11:10:00
	}


	
	/**
    * The funcion that should have one user asssociated with many inform id
	*                  1 valor assoc 1 acomp ---->
	*             <---- 1 acomp assoc 1 valor
	*	[valo]-----------1------<>-------1----------[acomp]
    *
    * @return User
    */
	public function acompanhamento()
	{
		return $this->belongsTo(Acompanhamento::class);	#[ok] 31/08/2017 10:50:00
	}


	
}