<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
* Classe responsável pela nome da fase do projeto
*
**/
class Fase extends Model
{
     // Fields then update by web requests, using label fillable
	#protected $fillable = ['nome',];

	/**
    * The users that belong to the role.
    */
    public function projetos()
    {
        return $this->belongsToMany(Projeto::class)->using(FaseDoProjeto::class);
    }
	public function projeto()
	{
		return $this->belongsToMany(Projeto::class, 'fase_projeto');
	}

	public function indicador()
	{
		return $this->belongsToMany(Indicador::class, 'fase_projeto');
	}

	public function isQualProjeto($id)
	{		
		$result = Fase::find($id)->projeto()->orderBy('id')->get(); 
		if($result != null && count($result) > 0){
			                         			  						 
			$pattern = '/' . 'CONCEPCAO' . '/';//Padrão a ser encontrado na string
			foreach ($result as $res) {	
			    $Name = utf8_encode($res->nome);
				return $res->nome;
				return (   preg_match( $pattern,  $Name)	)		? 1 : 0;			
				//return (utf8_encode($res->nome) == 'CONCEPCAO' ) ? 1 : 0;			                         			  						 
			}
		}
		else{
			return 0;
		}
	}
	public function isQualIndicador($id)
	{
		$result = Fase::find($id)->indicador()->orderBy('id')->get(); 
		if($result != null && count($result) > 0){
			$Name ='';                         			  						 
			$pattern = '/' . 'CONCEPCAO' . '/';//Padrão a ser encontrado na string
			foreach ($result as $res) {	
			    $Name = utf8_encode($res->nome);
				return $Name;
				return (   preg_match( $pattern,  $Name)	)		? 1 : 0;			                         			  						 
			}
			//return $Name;
		}
		else{
			return 0;
		}
	}
	public function isQualIndicadorArray($id)
	{
		$result = Fase::find($id)->indicador()->orderBy('id')->get();	
		if($result != null && count($result) > 0){
			$NameDoIndicador = null;
			$contador =  intval( count($result) );
			$inicioContagem = 1;
			foreach ($result as $res) {	
			    if($inicioContagem == 1){
					 $NameDoIndicador =  utf8_encode($res->nome).'; ';				
				}elseif($inicioContagem == $contador){
					 $NameDoIndicador =   $NameDoIndicador .utf8_encode($res->nome).'. ';				
				}else{
					 $NameDoIndicador = $NameDoIndicador . utf8_encode($res->nome) .'; ';
				}
			   
				$inicioContagem = $inicioContagem +1;
			}
			return $NameDoIndicador;
		}
		else{
			return 0;
		}
	}


	public function faseNAME(int $id)
	{

		$fases = Fase::find($id)->indicador()->orderBy('id')->get();
		$permissoes = array();
		if($fases != null && count($fases) > 0){
			if(count($fases) == 1){
				foreach ($fases as $role) {	
					$roleName = utf8_encode($role->nome);
					return utf8_encode($roleName);
					break;						                         			  						 
				}
			}else{
				$patternCONC = '/' . 'CONCEPCAO' . '/';//Padrão a ser encontrado na string
				$patternPLANEJ = '/' . 'PLANEJAMENTO' . '/';//Padrão a ser encontrado na string
				$patternELABOR = '/' . 'ELABORACAO' . '/';//Padrão a ser encontrado na string
				$patternCONSTR = '/' . 'CONSTRUCAO' . '/';//Padrão a ser encontrado na string
				$patternEXEC = '/' . 'EXECUCAO' . '/';//Padrão a ser encontrado na string
				$patternTRANS = '/' . 'TRANSICAO' . '/';//Padrão a ser encontrado na string
				$patternCONTROL = '/' . 'CONTROLE' . '/';//Padrão a ser encontrado na string
				$patternENCERR = '/' . 'ENCERRAMENTO' . '/';//Padrão a ser encontrado na string
				$Multipapel ='';
				foreach ($fases as $role) {	
					$roleName = utf8_encode($role->role_name);

					if (   preg_match( $patternCONC,  $roleName)	)   { $Multipapel = 'CONCEPCAO-';}	
					if (   preg_match( $patternPLANEJ,  $roleName)	)	{ $Multipapel = 'PLANEJAMENTO-';}	
					if (   preg_match( $patternCONSTR,  $roleName)	)	{ $Multipapel = 'CONSTRUCAO-';}	
					if (   preg_match( $patternEXEC,  $roleName)	)	{ $Multipapel = 'EXECUCAO-';}		
					if (   preg_match( $patternTRANS,  $roleName)	)	{ $Multipapel = 'TRANSICAO-';}
					if (   preg_match( $patternCONTROL,  $roleName)	)	{ $Multipapel = 'CONTROLE-';}	
					if (   preg_match( $patternENCERR,  $roleName)	)	{ $Multipapel = 'ENCERRAMENTO-';}	
																                         			  						 
				}
				return utf8_encode($Multipapel);
			}
		}
		else{
			return utf8_encode('Não Definido');
		}
	}
}
