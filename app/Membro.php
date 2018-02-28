<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Projeto;

class Membro extends Model
{
	/*
	*	Class responsável pelo nome do membro da equipe do projeto
	*	relacionado com a class Projeto, User
	*
	*/
    // Fields then update by web requests, using label fillable
	protected $fillable = ['user_id','nome',];

	//protected $nome ='';
	//constructor
	public function __construct()
	{
		
	}
	/**
    * The funcion that should have one user asssociated with your ID
    *
    * @return User
    */
	public function user()
	{
		return $this->belongsTo(User::class);	#[ok] 18/08/2017 10:50:00
	}
	/**
    * The funcion that should have many projects asssociated with your ID
    *
    * @return User
    */
	public function projeto()
	{
		return $this->belongsToMany(Projeto::class, 'equipes');	#[ok] 18/08/2017 11:10:00
	}


	public function isMembro($id){
		$id = (int) $id;

		$membros = Membro::select('membro_id')
            ->join('equipes', 'membros.id', '=', 'equipes.membro_id')
            ->distinct()->get();

		# este também funciona
		#
		# $membros = Projeto::find(3)->membros()->orderBy('id')->get();
		#
		if($membros != null && count($membros) > 0){			                         			  						 
			foreach ($membros as $res) {	
				if( $res->membro_id == $id ){ return 1;}  						 
			}
			return 0;
		}
	}
	public function getMembro($id){
		$id = (int) $id;
		$membros = Membro::find($id);
		if($membros != null ){			                         			  						 
			return $membros;
		}
		return null;
	}
}
