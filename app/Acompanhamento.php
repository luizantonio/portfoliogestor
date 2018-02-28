<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanhamento extends Model
{
    /*	22/08/2017 or 2017-08-22 10:54:00
	*	Class responsável pelo informar indicadores.
	*	Utilizada pelo Gerente de Projeto
	*	relacionado com a class Projeto, User e com o relacionamento da fase com o projeto e indicadores
	*
	*/
    // Fields then update by web requests, using label fillable
	protected $fillable = ['user_id', 'valor_id', 'descricao', 'created_at', 'updated_at',];

	//constructor
	public function __construct()
	{
		
	}
	public function getFillable() {
	  return $this->fillable;
	}

	/**
    * The funcion that should have one user asssociated with many inform id
	*                  1 user tem * acomp ---->
	*             <---- 1 acomp pertence 1 user
	*	[user]-----------1------<>-------*----------[acomp]
    *
    * @return User
    */
	public function user()
	{
		return $this->belongsTo(User::class);	#[ok] 31/08/2017 10:50:00
	}
}
