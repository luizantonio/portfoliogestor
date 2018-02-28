<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicadores extends Model
{

/* Properties of indicators
* the indicator these associated the one member of time (liader of the project office.) 
* o indicador será associado a um projeto 
* o indicador está associado a fase	 
* o indicador terá um nome 		
* o indicador terá um valor esperado Mínimo 
* o indicador terá um valor esperado Máximo 
*/


    // Fields then update by web requests, using label fillable
	protected $fillable = [ 'projeto_id', 'fase_id', 'indicador_id', 'valor_minimo', 'valor_maximmo',];
	
	//
	public function role()
	{
		return $this->belongsToMany(Indicador::class, 'indicadores');
	}

	// Indicar que um indicador pertence a um projeto
	public function projeto()
	{
		return $this->belongsToMany(Projeto::class, 'projetos');
	}
	// Indicar que um indicador pertence a um fase
	public function fase()
	{
		return $this->belongsToMany(Fase::class, 'fases');
	}

	public function fase_projeto()
	{
		return $this->belongsToMany(Fase_Projeto::class, 'id', 'indicador_id');
	}
}
