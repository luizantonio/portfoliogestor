<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membro;
use App\User;
use App\Licoesaprendidas;
use App\Fase_Projeto;

class Projeto extends Model
{
    // Fields then update by web requests, using label fillable
	protected $fillable = ['user_id', 'nome', 'data_de_inicio', 'gerente_responsavel', 'previsao_de_termino',
	 'data_real_de_termino', 'orcamento_total', 'descricao', 'status_id', 'classificacao_id',];
	
	// Indicar que um projeto pertence a um usuário
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	// Indicar que um acompanhamento semanal pertence a um projeto
	public function semanal()
	{
		return $this->hasOne(Semanal::class);
	}
	
	/**
    * The funcion that should have many fases asssociated with your ID
    *
    * @return fase do projeto collection
    */
	public function fases()
	{
		return $this->belongsToMany(Fase::class, 'fase_projeto');
	}

	/**
    * The funcion that should have many indicadores asssociated with your ID
    *
    * @return indicador collection
    */
	public function indicador()
	{
		return $this->belongsToMany(Indicador::class);
	}

	/**
    * The funcion that should have many projects asssociated with your ID
    *
    * @return Projeto
    */
	public function indicadores()
	{
		return $this->belongsToMany(Indicador::class, 'fase_projeto');
	}

	/**
    * The funcion that should have many asssociated with your ID
    *
    * @return fase do projeto
    */
	public function faseprojeto()
	{
		return $this->belongsToMany(FaseProjeto::class, 'fase_projeto');
	}

	/**
    * The funcion that should have many Members asssociated with your ID
    *
    * @return Membro
    */
	public function membros()
	{
		return $this->belongsToMany(Membro::class, 'equipes');	#[ok] 18/08/2017 11:03:00
	}

	/**	
	* 22/08/2017 or 2017-08-22 10:54:00
    * The funcion that should have many informarIndicadores asssociated with your ID
    *
    * @return Informar_Indicador
    */
	public function valores()
	{
		return $this->hasMany(Valor::class, 'valors');
	}

	/**
    * The funcion that should have many licoes asssociated with your ID
    *
    * @return Projeto
    */
	public function licoesaprendidas()
	{
		return $this->belongsToMany(licoesaprendidas::class);
	}
	/**
	* Verifica se tem lição
	* @return bool
	*
	*/ 
	public function temLicaoAprendidasDoProjeto($id){
		$licoesaprendidas = Licoesaprendidas::select('licoesaprendidas.*')
            ->where('licoesaprendidas.projeto_id', '=', $id)->get();
		if($licoesaprendidas != null && count($licoesaprendidas) > 0){
			return 1;
		}
		return 0;
	}
	/**
    * The funcion used to get one fase name
    *
    * @return string
    */
	public function projetoNome($idProjeto)
	{
		//$result = Projeto::find($idProjeto)->get();	
		//if($result != null && count($result) > 0){
				//var_dump($result->nome);
				//return $result->nome;
		//}
	    //return null;		
	}
	/**
    * The funcion used to get Status do Projeto decricao
    *
    * @return string
    */
	public function getStatusDoProjeto($id)
	{
		$result = StausDoProjeto::select('statusdoprojeto.*')->where('statusdoprojeto.id', '=', $id)->get();
		if($result != null && count($result) > 0){
			foreach ($result as $res) {	
				return $res->status_do_projeto;		 
			}
		}
		return null;
	}
	/**
    * The funcion used to verify if one project is asscociated with fase and have indicador
    *
    * @return bool
    */
	public function associadoAindicadorEmFase($id)
	{
		$result = Projeto::find($id)->fases()->orderBy('id')->get();			
		return ($result != null && count($result) > 0) ? 1 : 0;						 
		return 0;
	}
	/**
    * The funcion used to get fases 
    *
    * @return array
    */
	public function fasesDoProjeto($id)
	{
		$result = Projeto::find($id)->fases()->orderBy('id')->get();	
		$resultAuxiliar = array();
		return ($result != null && count($result) > 0) ? $result : $resultAuxiliar;	
	}
	/**
    * The funcion used to get last fase id
	* informar.blade.php and fases.blade.php
    *
    * @return array
    */
	public function idUltimaFaseDoProjeto($id)
	{
		# --- verifica se é o id da fase para só mostrar a atual fase 
		$result = Projeto::find($id)->fases()->orderBy('id')->get();
		$id  = null;	
		if($result != null && count($result) > 0){			 
			foreach ($result as $res) {	
			    $id = $res->id;	 
			}
		}
	    return $id;		
	}
	/**
    * The funcion used to get one fase name
    *
    * @return string
    */
	public function faseDoProjetoFaseNome($idProjeto,$faseId)
	{
		$result = Projeto::find($idProjeto)->fases()->orderBy('id')->get();	
		if($result != null && count($result) > 0){			                         			  						 
			foreach ($result as $res) {	
				if( $faseId === $res->id ){ return $res->nome; }
			}
		}
	    return null;		
	}
	/**
    * The funcion used to get indicador name
    *
    * @return string
    */
	public function isQualIndicador($id)
	{
		$result = Projeto::find($id)->fases()->orderBy('id')->get();			
		if($result != null && count($result) > 0){			                         			  						 
			#$pattern = '/' . 'CONCEPCAO' . '/';//Padrão a ser encontrado na string
			foreach ($result as $res) {	
			    $Name = utf8_encode($res->nome);
				return $res->nome;
				#return (   preg_match( $pattern,  $Name)	)		? 1 : 0;			
				#return (utf8_encode($res->nome) == 'CONCEPCAO' ) ? 1 : 0;		 
			}
		}
		return 0;
	}
	/*
	* Retorna Os indicadores de todos os indicadores do projeto 24/08/2017
	*
	*/
	public function indicadoresDoProjeto($id){
		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '=', $id)
            ->get('fase_projeto.id as faseid' );
		$resultAuxiliar = array();
		return ($indicadores != null && count($indicadores) > 0) ? $indicadores : $resultAuxiliar;
	}
	/**
    * The funcion used to get Membro name
    *
    * @return array
    */
	public function isQualMembro($id)
	{
		$result = Projeto::find($id)->membros()->orderBy('id')->get();
		if($result != null && count($result) > 0){			                         			  						 
			foreach ($result as $res) {	
			    $Name = utf8_encode($res->nome);
				return $res->nome;
			}
		}
		return 0;
	}
	/**
    * The funcion used to verify if has one Membro
    *
    * @return boolean
    */
	public function hasMembros($id){
		$result = Projeto::find($id)->membros()->orderBy('id')->get();	
		if($result != null && count($result) > 0){
			return 1;
		}
		return 0;
	}
	/**
    * The funcion used to get Membros
    *
    * @return array
    */
	public function getMembrosVetor($id){
		$result = Projeto::find($id)->membros()->orderBy('nome')->where('projeto_id', '=', $id)->get(); 	
		if($result != null && count($result) > 0){
			return $result;
		}
	}
	/**
    * The funcion used to verify if Project has this Membro name
    *
    * @return boolean
    */
	public function isMembro($projeto_id, $membro){
		$projeto = Projeto::find($projeto_id)->get();	
		if($projeto != null && count($projeto) > 0){
			return Projeto::find($projeto_id)->membros()->where('nome', '=', $membro)->exists();
		}
		return 0;
	}
	/**
    * The funcion used to get all Membro
    *
    * @return array
    */
	public function allMembros(){
		$membros = new Membro();
		$array = $membros->orderBy('nome', 'asc')->get();
		if($array != null && count($array) > 0){
			return $array;
		}
		$membros = array();
		return $membros;
	}	
	/**	
    * The funcion that should have one Statusmodificado asssociated with your ID
    *
    * @return array
    */
	public function statusProjeto()
	{
		return $this->belongsTo(Statusmodificado::class, 'statusmodificados');
	}
	/**
    * The funcion verify if have justify
    *
    * @return bool
    */
	public function temJustificativa($id){
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $id)->get();
		if($result != null && count($result) > 0){	
			foreach($result as $ff){	                         			  						 			
				if(!is_null( $ff->justificativa_analise_aprovada ) || !is_null( $ff->justificativa_cancelado ) ){
					return 1;
				}
			}
		}
		return 0;
	}
	/**
    * The funcion verify if haven't justify
    *
    * @return array
    */
	public function notHaveJustificativa($id){
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $id)->get();
		if($result != null && count($result) > 0){	
			foreach($result as $ff){	                         			  						 			
				if(is_null( $ff->justificativa_analise_aprovada ) || is_null( $ff->justificativa_cancelado ) ){
						return 1;
				}
			}
		}
		return 0;
	}
	/**
    * The funcion get canceled justify
    *
    * @return array
    */
	public function getJustificativaCancelado($id){
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $id)->get();
		if($result != null && count($result) > 0){
			foreach($result as $ff){
				if(!is_null( $ff->justificativa_cancelado ) && $ff->projeto_id == $id ){
					return( $ff->justificativa_cancelado);
				}
			}
		}
		return null;
	}
	/**
    * The funcion get ok justify
    *
    * @return array
    */
	public function getJustificativaAprovada($id){
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $id)->get();
		if($result != null && count($result) > 0){
			foreach($result as $ff){
				if(!is_null( $ff->justificativa_analise_aprovada ) && $ff->projeto_id == $id ){
					return( $ff->justificativa_analise_aprovada);
				}
			}
		}
		return null;
	}
	/**
    * The funcion get user justify
    *
    * @return array
    */
	public function getUserJustificativa($id){
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $id)->get();
		$userid;
		if($result != null && count($result) > 0){
			foreach($result as $ff){
				if($ff->projeto_id == $id ){
					$userid = $ff->user_id;
					break;				
				}
			}
			$user = User::find($userid);
			if($user != null){	
				return $user->name;
			}
		}
		return null;
	}
	/**
    * The funcion get date justify
    *
    * @return array
    */
	public function getDateJustificativa($id){
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $id)->get();
		if($result != null && count($result) > 0){
			foreach($result as $wanted){
				if($wanted->projeto_id == $id ){
					return $wanted->updated_at;				
				}
			}
		}
		return null;
	}
	/**
    * The funcion get office name (nome do gerente)
    *
    * @return string
    */
	public function getUserGerenteName($projetoid){
		$result = Projeto::find($projetoid);
		if($result != null && count($result) > 0){
				if($result->id == $projetoid ){
					$user = User::find($result->gerente_responsavel);
					if($user != null){ return  $user->name;}				
				}
		}
		return null;
	}

	/**
    * The funcion used to get acompanhamento by ID project
    *
    * @return array
    */
	public function getAcompanhamentoDoProjetoBiId($id)
	{
		$result = Projeto::find($id)->semanal()->orderBy('id')->get();	
		$resultAuxiliar = array();
		return ($result != null && count($result) > 0) ? $result : $resultAuxiliar;	
	}

	/**
	* Usado para retornar a descrição do acompanhamento semanal
	* @return string
	*/
	public function getSemanal($id)
	{
		$result = Projeto::find($id)->semanal()->where('projeto_id', '=', $id)->get();	
		
		if($result != null && count($result) > 0){
			foreach($result as $acompanhamento){
				if(!is_null( $acompanhamento->descricao ) && $acompanhamento->projeto_id == $id ){
					return( $acompanhamento->descricao);
				}
			}
		}
		return null;
	}
	/**
	* Usado para retornar a data da atualização do acompanhamento semanal
	* @return string (date)
	*/
	public function getUpdateSemanal($id)
	{
		$result = Projeto::find($id)->semanal()->where('projeto_id', '=', $id)->get();		
		if($result != null && count($result) > 0){
			foreach($result as $acompanhamento){
				if(!is_null( $acompanhamento->updated_at ) && $acompanhamento->projeto_id == $id ){
					return($acompanhamento->updated_at);
				}
			}
		}
		return null;
	}
}