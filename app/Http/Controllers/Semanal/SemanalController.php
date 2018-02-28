<?php

namespace App\Http\Controllers\Semanal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use App\User;
use App\Projeto;
use App\Semanal;
use App\Http\Controllers\ProjetoController;
use Auth;
use App\Repositorios\ProjetoRepository;

class SemanalController extends Controller
{
    protected $projetoController;
	protected $MAX_LENGTH_ACOMPANHAMENTO = 1000;
	protected $TEXT_SUCESSO_CREATE_OR_UPDATE = 'Acompanahamento atualizado com sucesso!'; 
	protected $TEXT_ERROR_PROJETO_INEXISTENTE = 'Projeto inexistente para acompanhamento!';	
	protected $TEXT_ERROR_ACOMPANAHMENTO_NULL_OR_VAZIO = 'Falha no cadastro do acompanahamento do projeto. Verifique o correto preenchimento dos campo: Acompanahamento!'; 
	protected $TEXT_ERROR_ACOMPANAHMENTO_EXCESSSO_DE_CARACTERES = 'Falha no cadastro do acompanahamento do projeto. O texto ultapassou o limite de caracterres permitidos!';
	protected $TEXT_ERROR_ACOMPANAHMENTO_NAO_MODIFICADO = 'Acompanhamento inalterado!';
	protected $TEXT_SUCESSO_DELETE = 'Acompanhamento Semanal removido com sucesso!';
	protected $TEXT_ERROR_DELETE = 'Falha ao remover o Acompanhamento Semanal!';
	//constructor
	public function __construct(ProjetoController $projetoController)
	{
		$this->projetoController = $projetoController;
	}

	/**
	*
    *  update "Acompanhamento Semanal".
	*
	* @param User
	* @return boolean
	*/
	public function update(Request $request)
	{		
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');
		$projeto = null;
		# get project by id
		$projeto = Projeto::find($request->projeto) ; 
		# verify if exists project
		if( is_null($projeto) ){						
			$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_PROJETO_INEXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger');
			return $this->projetoController->index($request);
		}
		# verify if not exists project
		if( !$projeto->exists()){						
			$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_PROJETO_INEXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger');
			return $this->projetoController->index($request);
		}
		# verify if text is null or empty
		if ( is_null($request->Acompanhamento) || $request->Acompanhamento == '' ){
			$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_ACOMPANAHMENTO_NULL_OR_VAZIO ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->projetoController->index($request);
		}
		# verifica se é nulo ou se o comprimento do texto é zero
		if ( is_null($request->Acompanhamento) || strlen($request->Acompanhamento) == 0 ){
			$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_ACOMPANAHMENTO_NULL_OR_VAZIO ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->projetoController->index($request);
		}
		# verifica se é nulo ou se o comprimento do texto é zero
		if ( is_null($request->Acompanhamento) || strlen(trim($request->Acompanhamento)) == 0 ){
			$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_ACOMPANAHMENTO_NULL_OR_VAZIO ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->projetoController->index($request);
		}
		# verifica se é nulo ou se o comprimento do texto é maior que o limite
		if ( is_null($request->Acompanhamento) || strlen($request->Acompanhamento) > $this->MAX_LENGTH_ACOMPANHAMENTO ){
			$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_ACOMPANAHMENTO_EXCESSSO_DE_CARACTERES); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->projetoController->index($request);
		}		
		# Verifica se existe um acompanahemnto para o projeto e se o texto foi alterado		
		if(Semanal::select('semanals.*' )->where('semanals.projeto_id', '=', $request->projeto) ){	
			$semanalDescricao  = Semanal::select('semanals.*' )->where('semanals.descricao', '=', $request->Acompanhamento);				
			if($semanalDescricao->exists()){					
				$request->session()->flash('message_error_acompanahamento', $this->TEXT_ERROR_ACOMPANAHMENTO_NAO_MODIFICADO); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->projetoController->index($request);
			}
		}
		# get in DBase
		$semanal = Semanal::where('semanals.projeto_id', '=',  $request->projeto)->first();	
		# verify if exists 
		if(!is_null($semanal) && $semanal->exists()){					
			$projeto->semanal()
			->update([
				'projeto_id' => $request->projeto,		
				'descricao' => $request->Acompanhamento,
				'status' =>0,
				'updated_at' => date('Y-m-d H:i:s'),  	# H:m:i	 - original ?			
			]);
						
			$request->session()->flash('message_success_acompanahamento',  $this->TEXT_SUCESSO_CREATE_OR_UPDATE ); 
			$request->session()->flash('alert-class', 'alert-success');			
		}	
		# verify if not exists / null
		if(is_null($semanal)){							
			$projeto->semanal()
			->create([
				'projeto_id' => $request->projeto,		
				'descricao' => $request->Acompanhamento,
				'status' =>0,
				'created_at' => date('Y-m-d H:i:s'),  	# H:m:i	
				'updated_at' => date('Y-m-d H:i:s'), 	# H:m:i			
			]);
		
			$request->session()->flash('message_success_acompanahamento',  $this->TEXT_SUCESSO_CREATE_OR_UPDATE ); 
			$request->session()->flash('alert-class', 'alert-success');
		}
		return $this->projetoController->index($request);
	}#end update

	/**
	*
    *  delete "Acompanhamento Semanal".
	*
	* @param User
	* @return boolean
	*/
	public function destroy(Request $request)
	{		
		
		$projeto = null;
		# get project by id
		$projeto = Projeto::find($request->projeto) ; 
		# verify if exists project
		if( is_null($projeto) ){						
			$request->session()->flash('message_error_remover_acomp', 
					$this->TEXT_ERROR_DELETE); 
			$request->session()->flash('alert-class', 'alert-danger');
			return $this->show($request);
		}
		# get in DBase
		$semanal = Semanal::where('semanals.projeto_id', '=',  $request->projeto)->first();	
		# verify if exists 
		if(!is_null($semanal) && $semanal->exists()){					
			# delete o acompanhamento
			$resultado = $projeto->semanal()->delete();
			//$resultado =true;
			//$resultado =false;
			if($resultado){
				$request->session()->flash('message_success_remover_acomp',  
					$this->TEXT_SUCESSO_DELETE ); 
				$request->session()->flash('alert-class', 'alert-success');
			}else{
				$request->session()->flash('message_error_remover_acomp', 
					$this->TEXT_ERROR_DELETE); 
				$request->session()->flash('alert-class', 'alert-danger');
			}
		}	
		# verify if not exists / null
		if(is_null($semanal)){							
			$request->session()->flash('message_error_acompanahamento', 
				$this->TEXT_ERROR_DELETE); 
			$request->session()->flash('alert-class', 'alert-danger');
		}
		return $this->show($request);
	}#end update

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to create or update "Acompanhamento Semanal".
	*
	* @param User
	* @return boolean
	*/
	public function show(Request $request)
	{
		# get in DB
		$projetos = Projeto::select('projetos.*' )->join('semanals', 'semanals.projeto_id', '=', 'projetos.id')->where('projetos.user_id' ,'=', $request->user()->id )->get();
		// if(!is_null($projetos) && count($projetos) > 0){
		// 	foreach($projetos as $elementKey => $element) {
		// 	    if( $element['user_id'] ==  $request->user()->id ){
		// 	    	//var_dump( $element['id'] );
		// 	    	//var_dump($licoesElement['projeto_id']);
		// 	    	//unset($projetos[$elementKey]);
		// 	    }
		// 	}
		// }# if

		# verify if exists 
		//if(is_null($projetos)){	$projetos = null; }
		return view('semanal.remover', ['projetos' => $projetos,]);
		
	}#end show
}#end class