<?php

namespace App\Http\Controllers\Licoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use App\User;
use App\Projeto;
use App\Licoesaprendidas;
use App\Http\Controllers\ProjetoController;
use Auth;
use App\Repositorios\ProjetoRepository;

class LicoesAprendidasController extends Controller
{
    # variável que instancia a classe ProjetoRepository
	protected $projetosRepository;
    protected $STATUS_ENCERRADO =6; # status do projeto encerrado
	protected $MAX_LENGTH_LICOES = 5000;
	protected $TEXT_SUCESSO_CREATE_OR_UPDATE = 'Operacao do aprendizado realizada com sucesso!'; 
	protected $TEXT_ERROR_PROJETO_INEXISTENTE = 'Projeto inexistente para LICOES!';	
	protected $TEXT_ERROR_LICAO_INEXISTENTE = 'Aprendizado inexistente!';	
	protected $TEXT_ERROR_LICAO_NULL_OR_VAZIO = 'Falha no cadastro do aprendizado do projeto. Verifique o correto preenchimento dos campo: aprendizado!'; 
	protected $TEXT_ERROR_LICAO_EXCESSSO_DE_CARACTERES = 'Falha no cadastro do aprendizado do projeto. O texto ultapassou o limite de caracterres permitidos!';
	protected $TEXT_ERROR_LICAO_NAO_MODIFICADO = 'Aprendizado inalterado!';
	protected $EXISTE_ERROR_LICAO = 'Aprendizado existe na base de dados!';
	protected $TEXT_SUCESSO_LICAO_REMOVIDO = 'Removido com sucesso!';
	protected $TEXT_ERROR_LICAO_REMOVIDO = 'Erro ao remover aprendizado!';
	protected $TEXT_ERROR_LICAO_BUSCAR = 'Projeto inexistente para busca!';	
	//constructor
	public function __construct(ProjetoRepository $projetos)
	{
		$this->projetosRepository = $projetos; # Instance ProjetoRepository to get projects
	}
	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to create or update "aprendizado licoesaprendida".
	*
	* @param User
	* @return boolean
	*/
	public function cadastro(Request $request)
	{	
		$projetos = Projeto::select('projetos.*' )->where('status_id', '=',  $this->STATUS_ENCERRADO)->get();
		if(is_null($projetos) || count($projetos) == 0){
			$projetos = null;
			$request->session()->flash('message_error_licao_show', $this->TEXT_ERROR_PROJETO_INEXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger');
		}
		/*foreach ($projetos as $key => $value) { echo $key ."=>" .$value->nome ." "; }*/
		$licoesaprendidas =LicoesAprendidas::all();
		if(is_null($licoesaprendidas) || count($licoesaprendidas) == 0){
			//$licoesaprendidas = null;
		}
		$contador = 0;
		if(!is_null($projetos)){
			foreach($projetos as $projeto){
	            if(!is_null($licoesaprendidas)){
	                foreach($licoesaprendidas as $licoes){	                	
	                    if($licoes->projeto_id == $projeto->id){
	                    	$contador = $contador +1;
	                    }
	                }
	            }
	        }
		}
		if($contador == sizeof($projetos)){
			$projetos = null; 
		}
		$contador = 0;
		# verify if projetct id equals licoes projetct id and remove of vetor projects
		# to send view project unless licoes
		if(!is_null($projetos) && !is_null($licoesaprendidas)){
			foreach($projetos as $elementKey => $element) {
			    	foreach($licoesaprendidas as $elementKeylicoes => $licoesElement){	
			    			if( $element['id'] == $licoesElement['projeto_id'] ){
			    				//var_dump( $element['id'] );
			    				//var_dump($licoesElement['projeto_id']);
			    				unset($projetos[$elementKey]);
					        }
			    	}
			}
		}# if
		# novo array para os projetos
		return view('licoes.create', ['projetos' => $projetos, 'licoesaprendidas' => $licoesaprendidas]);
	}#end cadastro
	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to create or update "aprendizado licoesaprendida".
	*
	* @param User
	* @return boolean
	*/
	public function create(Request $request)
	{		
		//echo $request->user . ' user <br>';echo $request->projeto_id . ' projeto <br>';
		
		$projetos = Projeto::select('projetos.*' )->where('status_id', '=',  $this->STATUS_ENCERRADO)->get();
		if(is_null($projetos) || count($projetos) == 0){
			$projetos = null;
		}
		$licoesaprendidas =LicoesAprendidas::all();
		if(is_null($licoesaprendidas) || count($licoesaprendidas) == 0){
			$licoesaprendidas = null;
		}
		$contador = 0;
		if(!is_null($projetos)){
			foreach($projetos as $projeto){
	            if(!is_null($licoesaprendidas)){
	                foreach($licoesaprendidas as $licoes){
	                    if($licoes->projeto_id == $projeto->id){
	                    	$contador = $contador +1;
	                    }
	                }
	            }
	        }
		}
		if($contador == sizeof($projetos)){
			$projetos = null; 
		}

		$contador = 0;

		$projeto = Projeto::find($request->projeto_id) ; 
		# verify if exists project
		if( is_null($projeto) ){						
			$request->session()->flash('message_error_licao_create', $this->TEXT_ERROR_PROJETO_INEXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger');
			return view('licoes.create', ['projetos' => $projetos, 'licoesaprendidas' => $licoesaprendidas]);
		}
		$licoesaprendida = LicoesAprendidas::where('licoesaprendidas.projeto_id', '=',  $request->projeto_id)->first();	
		# Verifica se existe 
		if(!is_null($licoesaprendida)){					
				$request->session()->flash('message_error_licao_create', $this->EXISTE_ERROR_LICAO); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return view('licoes.create', ['projetos' => $projetos, 'licoesaprendidas' => $licoesaprendidas]);
		}
		# get in DBase
		
		# verify if null 	
		if(is_null($licoesaprendida)){	
			$licoesaprendidaAux = new LicoesAprendidas();
			$licoesaprendidaAux->user_id = $request->user()->id;
			$licoesaprendidaAux->projeto_id = $request->projeto_id;		
			$licoesaprendidaAux->licao = $request->aprendizado;
			$licoesaprendidaAux->created_at = date('Y-m-d H:m:i');
			$licoesaprendidaAux->updated_at = date('Y-m-d H:m:i');			
			$result = $licoesaprendidaAux->save();
			$request->session()->flash('message_success_licao_create',  $this->TEXT_SUCESSO_CREATE_OR_UPDATE ); 
			$request->session()->flash('alert-class', 'alert-success');
		}
		//return view('licoes.create', ['projetos' => $projetos, 'licoesaprendidas' => $licoesaprendidas]);
		return view('licoes.show', ['projetos' => $projetos,]);	
	}#end create
	/**
	*
    * Show  project names to 'Licões Aprendidas no Projeto'
	*
	* @param User
	* @return boolean
	*/
	public function show(Request $request)
	{	
		#---is Gerente de Projeto--
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		if($isGerenteDeProjeto ){ 
			// Método de recuperação de projetos do user do ProjetoRepository
			$projetos = Projeto::where("status_id", '=', $this->STATUS_ENCERRADO)
					->where("gerente_responsavel",'=', $request->user()->id)
					->orderBy('nome', 'asc')
					->get();
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		
		#----is Líder Projetos--
		$isLiderProjetos = $request->user()->isLiderProjetos($request->user()->id);
		if($isLiderProjetos ){ 
			// Método de recuperação de projetos do user do ProjetoRepository
			$projetos = Projeto::where("status_id", '=', $this->STATUS_ENCERRADO)
					->orderBy('nome', 'asc')
					->get();
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		#-----------------------
		// Método de recuperação de projetos do user do ProjetoRepository
		$projetos = $this->projetosRepository->finishedProject($request->user());
		// view
		return view('licoes.show', ['projetos' => $projetos,]);	 
	}#end show

	/**
	* Detalhes de um projeto
	* @param REquest
	* @return Array Project
	*/
	public function detalhes(Request $request)
	{
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		$projeto = Projeto::findOrFail($request->projeto_id); # Sem o ->get() só recupera um. Se utilizar o  ->get() traz todos
		$licoesaprendida = LicoesAprendidas::where('licoesaprendidas.projeto_id', '=',  $request->projeto_id)->first();
		if(is_null($licoesaprendida) ){
			$request->session()->flash('message_error_licao_show', $this->TEXT_ERROR_LICAO_INEXISTENTE ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			#-----is GP--------------
			if($isGerenteDeProjeto ){ 
			// Método de recuperação de projetos
				$projetos = Projeto::select('projetos.*')
						->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
						->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
					    ->where("status_id", '=', $this->STATUS_ENCERRADO)
						->where("gerente_responsavel",'=', $request->user()->id)
						->orderBy('nome', 'asc')
						->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			#-----------------------
			else{
			#----is Líder Projetos--
				$isLiderProjetos = $request->user()->isLiderProjetos($request->user()->id);
				if($isLiderProjetos ){ 
					// Método de recuperação de projetos do user do ProjetoRepository
					$projetos = Projeto::select('projetos.*')
						->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
						->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
					    ->where("status_id", '=', $this->STATUS_ENCERRADO)
						->orderBy('nome', 'asc')
						->get();
					return view('licoes.show', ['projetos' => $projetos,]);	
				}
			#-----------------------
			}
			
			$projetos = $this->projetosRepository->finishedProject($request->user());
			// view
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		if($projeto != null){
			return view('licoes.detalhes', ['licoesaprendida' => $licoesaprendida , 'projeto' => $projeto,]);
		}
		$projeto = array();
		return view('licoes/detalhes', ['projeto' => $projeto,]);
	} # detalhes

	/**
	*
    * Redirect to Update page the 'Lições Aprendidas' plus increase text
	*
	* @param User
	* @return boolean
	*/
	public function update(Request $request)
	{	
		$licoesaprendida = LicoesAprendidas::where('licoesaprendidas.projeto_id', '=',  $request->projeto_id)->first();
		if(is_null($licoesaprendida) ){
			$request->session()->flash('message_error_licao_show', $this->TEXT_ERROR_LICAO_INEXISTENTE ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			#-------is GP------------
			$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
			if($isGerenteDeProjeto ){ 
				// Método de recuperação de projetos do user do ProjetoRepository
				$projetos = Projeto::select('projetos.*')
					->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
					->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
				    ->where("status_id", '=', $this->STATUS_ENCERRADO)
					->where("gerente_responsavel",'=', $request->user()->id)
					->orderBy('nome', 'asc')
					->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			#-----------------------
			#---is Líder Projetos---
			$isLiderProjetos = $request->user()->isLiderProjetos($request->user()->id);
			if($isLiderProjetos ){ 
				// Método de recuperação de projetos do user do ProjetoRepository
				$projetos = Projeto::select('projetos.*')
					->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
					->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
				    ->where("status_id", '=', $this->STATUS_ENCERRADO)
					->orderBy('nome', 'asc')
					->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			#-----------------------
			 $projetos = $this->projetosRepository->finishedProject($request->user());
			// view
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		return view('licoes.update', ['licoesaprendida' => $licoesaprendida ,'projeto_id' => $request->projeto_id,]);	
	}#end update

	/**
	*
    * Update the 'Lições Aprendidas' plus increase text
	*
	* @param User
	* @return boolean
	*/
	public function atualizar(Request $request)
	{		
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');
		#----------------------------is GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		#----------------------------is LP-------------------------------------------
		$isLiderProjetos = $request->user()->isLiderProjetos($request->user()->id);
		# instance of one get object Licoes DB
		$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
		# verify if not null
		if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
			$licoesaprendida = null;
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_LICAO_INEXISTENTE ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			#-----is GP--------------
			if($isGerenteDeProjeto ){ 
				// Método de recuperação de projetos do user do ProjetoRepository
				$projetos = Projeto::select('projetos.*')
					->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
					->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
				    ->where("status_id", '=', $this->STATUS_ENCERRADO)
					->where("gerente_responsavel",'=', $request->user()->id)
					->orderBy('nome', 'asc')
					->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			#-----------------------
			#------is Líder Projetos
			if($isLiderProjetos ){ 
				// Método de recuperação de projetos do user do ProjetoRepository
				$projetos = Projeto::select('projetos.*')
					->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
					->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
					->where("status_id", '=', $this->STATUS_ENCERRADO)
					->orderBy('nome', 'asc')
					->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			#-----------------------
			$projetos = $this->projetosRepository->finishedProject($request->user());
			// view
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		$projeto = null;
		# get project by id
		$projeto = Projeto::find($request->projeto_id) ; 
		# verify if exists project
		if( is_null($projeto) ){						
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_PROJETO_INEXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger');
			$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
			if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
				$licoesaprendida = null;
			}
			return view('licoes.update', ['licoesaprendida' => $licoesaprendida, 'projeto_id'=> $request->projeto_id]);
		}
		# verify if not exists project
		if( !$projeto->exists()){						
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_PROJETO_INEXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger');
			$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
			if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
				$licoesaprendida = null;
			}
			return view('licoes.update', ['licoesaprendida' => $licoesaprendida, 'projeto_id'=> $request->projeto_id]);
		}
		# verify if text is null or empty
		if ( is_null($request->aprendizado) || $request->aprendizado == '' ){
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_LICAO_NULL_OR_VAZIO );
			$request->session()->flash('alert-class', 'alert-danger'); 
			$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
			if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
				$licoesaprendida = null;
			}
			return view('licoes.update', ['licoesaprendida' => $licoesaprendida, 'projeto_id'=> $request->projeto_id]);
		}
		# verifica se é nulo ou se o comprimento do texto é zero
		if ( is_null($request->aprendizado) || strlen($request->aprendizado) == 0 ){
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_LICAO_NULL_OR_VAZIO );
			$request->session()->flash('alert-class', 'alert-danger'); 
			$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
			if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
				$licoesaprendida = null;
			}
			return view('licoes.update', ['licoesaprendida' => $licoesaprendida, 'projeto_id'=> $request->projeto_id]);
		}
		# verifica se é nulo ou se o comprimento do texto é zero
		if ( is_null($request->aprendizado) || strlen(trim($request->aprendizado)) == 0 ){
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_LICAO_NULL_OR_VAZIO );
			$request->session()->flash('alert-class', 'alert-danger'); 
			$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
			if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
				$licoesaprendida = null;
			}
			return view('licoes.update', ['licoesaprendida' => $licoesaprendida, 'projeto_id'=> $request->projeto_id]);
		}
		# verifica se é nulo ou se o comprimento do texto é maior que o limite
		if ( is_null($request->aprendizado) || strlen($request->aprendizado) > $this->MAX_LENGTH_LICOES ){
			$request->session()->flash('message_error_licao_update', $this->TEXT_ERROR_LICAO_EXCESSSO_DE_CARACTERES); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			$licoesaprendida =LicoesAprendidas::select('licoesaprendidas.*' )->where('projeto_id', '=',  $request->projeto_id)->first();
			if(is_null($licoesaprendida) || count($licoesaprendida) == 0){
				$licoesaprendida = null;
			}
			return view('licoes.update', ['licoesaprendida' => $licoesaprendida, 'projeto_id'=> $request->projeto_id]);
		}	
		$user_id = $request->user;
		# verify if not exists 
		if($licoesaprendida->exists()){	
			if(!$isGerenteDeProjeto ){ # Gerente de projeto
				$licoesaprendida->update([	
					'licao' => $request->aprendizado,
					'updated_at' => date('Y-m-d H:m:i'), 			
				]);
			}else{ # Lider do Escritorio OU lider de projeto
				$licoesaprendida->update([		
					'licao' => $request->aprendizado,
					'updated_at' => date('Y-m-d H:m:i'), 			
				]);
			}
			$request->session()->flash('message_succes_licao_show',  $this->TEXT_SUCESSO_CREATE_OR_UPDATE ); 
			$request->session()->flash('alert-class', 'alert-success');
		}
		#-------is GP-----------
		if($isGerenteDeProjeto ){ 
			// Método de recuperação de projetos 
			$projetos = Projeto::select('projetos.*')
					->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
					->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
				    ->where("status_id", '=', $this->STATUS_ENCERRADO)
					->where("gerente_responsavel",'=', $request->user()->id)
					->orderBy('nome', 'asc')
					->get();
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		#-----------------------
		#------is Líder Projetos
		if($isLiderProjetos ){ 
			// Método de recuperação de projetos do user do ProjetoRepository
			$projetos = Projeto::select('projetos.*')
					->join('licoesaprendidas', 'licoesaprendidas.projeto_id','=','projetos.id')
					->where('licoesaprendidas.projeto_id', '=', $request->projeto_id)
					->where("status_id", '=', $this->STATUS_ENCERRADO)
					->orderBy('nome', 'asc')
					->get();
			return view('licoes.show', ['projetos' => $projetos,]);	
		}
		#-----------------------
		$projetos = $this->projetosRepository->finishedProject($request->user());
		// view
		return view('licoes.show', ['projetos' => $projetos,]);	
	}#end update

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to create or update "aprendizado licoesaprendida".
	*
	* @param User
	* @return boolean
	*/
	public function destroy(Request $request)
	{	
		$projetos = Projeto::select('projetos.*' )->where('status_id', '=',  $this->STATUS_ENCERRADO)->get();
		if(is_null($projetos) || count($projetos) == 0){
			$projetos = null;
		}
		$licoesaprendidas = LicoesAprendidas::where('licoesaprendidas.projeto_id', '=', $request->projeto_id)->first();
		# verify if exists value in table
		if ( !is_null($licoesaprendidas) ){
			$result =  $licoesaprendidas->delete();
			if($result){
				$request->session()->flash('message_success_licao_show_removido',  $this->TEXT_SUCESSO_LICAO_REMOVIDO ); 
				$request->session()->flash('alert-class', 'alert-success');
			}else{
				$request->session()->flash('message_error_licao_show_removido',  $this->TEXT_ERROR_LICAO_REMOVIDO ); 
				$request->session()->flash('alert-class', 'alert-success');
			}
		}
		return view('licoes.show', ['projetos' => $projetos,]);	
	}#end destroy

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to lists projects by name.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function buscarPorNome(Request $request, Projeto $projeto)
	{
		$projetos [] = array();
		#----------------------------is GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		#----------------------------is LP-------------------------------------------
		try{
			#-------is GP-----------
			if($isGerenteDeProjeto ){ 
				// Método de recuperação de projetos 
				$projetos = Projeto::where("status_id", '=', $this->STATUS_ENCERRADO)
						->where("gerente_responsavel",'=', $request->user()->id)
						->where('nome', 'like', '%'. $request->nomeProjetoBusca .'%')
						->orderBy('nome', 'asc')
						->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}else{
				$projetos = Projeto::where('status_id', '=', $this->STATUS_ENCERRADO)
							->where('nome', 'like', '%'. $request->nomeProjetoBusca .'%')->get();				
			}
		}catch(PDOException $e){
			$request->session()->flash('message_error_licao_show_buscar', $e); 
			$request->session()->flash('alert-class', 'alert-danger');
		}
		#return redirect('/licao/show');
		return view('licoes.show', ['projetos' => $projetos,]);	
	}

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to lists projects by name.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function buscarOrdenarPor(Request $request, Projeto $projeto)
	{
		$ordenarPor = $request->ordenarLicaoPor;
		#----------------------------is GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		#----------------------------is LP-------------------------------------------
		$isLiderProjetos = $request->user()->isLiderProjetos($request->user()->id);
		#----------------------------is LEP-------------------------------------------
		$isLiderEscritProjetos = $request->user()->isLiderEscritProjetos($request->user()->id);
		$projetos [] = array();
		try{
			#-------is GP-----------
			if($isGerenteDeProjeto ){ 
				// Método de recuperação de projetos 
				$projetos = Projeto::where("status_id", '=', $this->STATUS_ENCERRADO)
						->where("gerente_responsavel",'=', $request->user()->id)
						->orderBy('nome', 'asc')
						->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			#-----------------------
			#------is Líder Projetos
			if($isLiderProjetos ){ 
				// Método de recuperação de projetos do user do ProjetoRepository
				$projetos = Projeto::where("status_id", '=', $this->STATUS_ENCERRADO)
						->orderBy('nome', 'asc')
						->get();
				return view('licoes.show', ['projetos' => $projetos,]);	
			}
			if($isLiderEscritProjetos ){ 
				  $projetos = $this->projetosRepository->finishedProject($request->user());
			}
			
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		#return redirect('/projetos/show');
		return view('licoes.show', ['projetos' => $projetos,]);	
	}
}