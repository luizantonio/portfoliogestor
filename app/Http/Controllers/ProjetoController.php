<?php

namespace App\Http\Controllers;

use DateTime;
use App\User;
use App\Projeto;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositorios\ProjetoRepository;
use Validator;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use App\Exceptions\Handler;
use Gate; 
use Auth;
#
# Class used to controller make projects in sistems
# by Luiz Silva 2017-07-25 
#
class ProjetoController extends Controller
{
    # variável que instancia a classe ProjetoRepository
	protected $projetosRepository;
	protected $ERROR_DATA_INCONSISTENTE = 'Data inconsistente. Verifique o correto preenchimento dos campos: ano!';
	protected $ERROR_PROJETO_DESCRICAO_EXISTENTE =  'Projeto com esta decricao existe!'; 
	protected $ERROR_PROJETO_NOME_EXISTENTE  = 'Projeto com este nome existe!';
	protected $ERROR_PROJETO_NOME_TAMANHO_MINIMO = 'Falha no cadastro do projeto. O nome deve possuir 6 caracteres no minimo!'; 
	protected $ERROR_PROJETO_GERENTE_NAO_SELECIONADO = 'Falha no cadastro do projeto. Verifique se o campo Gerente foi selecionado!';
	protected $SUCESSO_PROJETO_CADASTRADO_CORRETAMENTE =  'Cadastro do projeto realizado com sucesso!'; 
	protected $ERROR_PROJETO_TEM_INDICADORES = 'Existem indicadores associados ao projeto!'; 	
	protected $SUCESSO_PROJETO_REMOVIDO = 'Projeto removido com sucesso!'; 
	protected $ERROR_ORCAMENTO_INVALIDO = 'Valor do orcamento invalido!';
	protected $SUCESSO_PROJETO_ATUALIZAR = 'Atualizacao do projeto realizada com sucesso!';

    /*
	* constructor
	*/
	public function __construct(ProjetoRepository $projetos) 
	{
		$this->middleware('auth');
		$this->projetosRepository = $projetos;
	}

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' and 'Gerente de Projetos' home view.
	*
	* @param Request
	* @return view
	*/
	public function index(Request $request)
	{
		# the project to week checked are make in ProjetoController, HomeController class and index method
	
		$FaseEncerrada = 8;
		$statusEncerrado = 6;
		$statusCancelada = 3;
		$ClassificacaoAltoRisco = 1;
		
		$projetos = Projeto::select('projetos.*')
			->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id') 	
			->where('fase_projeto.fase_id', '<>', $FaseEncerrada)	
			->where('projetos.status_id', '<>', $statusCancelada)
			->where('projetos.status_id', '<>', $statusEncerrado)
			->where('projetos.classificacao_id', '=', $ClassificacaoAltoRisco)		    
            ->distinct()->get();

		if(is_null($projetos) || count($projetos) == 0){
		
			$projetos = null;
		}
		
		return view('home', ['projetos' => $projetos,]);
	}
	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to listas gerentes in  create projects.
	* used in view and exists in user model
	* @param Request
	* @return view
	*/
	public function cadastro(Request $request)
	{
		# vem de ProjetoRepository
	    //$projetos = $this->projetosRepository->forUser($request->user());
		# gera erro se tiver a classe de role_user no select
		$collectionGerentes = User::select('users.*' )
            ->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)
            ->get();
		if( is_null($collectionGerentes) && count($collectionGerentes) == 0){
			$collectionGerentes = null;
		}
		//return view('projetos.create', ['projetos' => $projetos, 'collectionGerentes' => $collectionGerentes,]);
	    return view('projetos.create', [ 'collectionGerentes' => $collectionGerentes,]);
	}
	public function validaDigito($digito)
	{	
		 $result = 1;
		 $valor = ctype_digit( $digito) ? true : false;
		 if( $valor == false || $valor == 0 ){ $result = 0;}
		 $valor =  is_numeric( $digito) ? true : false;
		 if( $valor == false || $valor == 0 ){ $result = 0;}
		 if( ((int) $digito) > PHP_INT_MAX || ((int) $digito) <= 0 ){ $result = 0;}
		 return $result;
	}
	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to create projects.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function create(Request $request, Projeto $projeto)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para criar projetos
		* através da política (regra) de autorização
		*-----------------------------------------------------------
		*/
		try{
			
			$this->authorize('create', $projeto );
				
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
		
				$error = array( 'error' => 'Lider de Escritorio de Projetos!', 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch

		if ( !is_null($request-> nomeProjeto) && strlen($request-> nomeProjeto) < 6 ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_PROJETO_NOME_TAMANHO_MINIMO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
		$resultadoProjeto = Projeto::select('projetos.*' )->where('projetos.nome', '=', $request->nomeProjeto);

		if ( $resultadoProjeto->exists() ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_PROJETO_NOME_EXISTENTE ); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}

		if ( is_null($request-> gerenteResponsavel)  ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_PROJETO_GERENTE_NAO_SELECIONADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
		if ( !is_null($request-> gerenteResponsavel) && $request-> gerenteResponsavel == '' ){
			$request->session()->flash('message_error_projeto_create',  $this->ERROR_PROJETO_GERENTE_NAO_SELECIONADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
		if ( !is_null($request-> gerenteResponsavel) && strlen($request-> gerenteResponsavel) == 0 ){
			$request->session()->flash('message_error_projeto_create',  $this->ERROR_PROJETO_GERENTE_NAO_SELECIONADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
		if ( !is_null($request-> nomeProjeto) && $request-> nomeProjeto == '' ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_PROJETO_NOME_TAMANHO_MINIMO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
		
		$resultadoProjetoAux = Projeto::select('projetos.*' )->where('projetos.descricao', '=',  $request->descricao);

		if ( $resultadoProjetoAux->exists() ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_PROJETO_DESCRICAO_EXISTENTE); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
				
		if( $this->validaDigito($request->orcamentoTotal) == 0){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_ORCAMENTO_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);
		}
		if( $this->validaDigito($request->orcamentoTotal) == 1){
			if( ( (int) $request->orcamentoTotal ) < 0){
				$request->session()->flash('message_error_projeto_create', $this->ERROR_ORCAMENTO_INVALIDO); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->cadastro($request);
			}
			if( ( (int) $request->orcamentoTotal ) > PHP_INT_MAX ){
				$request->session()->flash('message_error_projeto_create', $this->ERROR_ORCAMENTO_INVALIDO); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->cadastro($request);
			}
		}
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		if(is_null($request->dataInicioAno) || is_null($request->previsaoDeTerminoAno) || is_null($request->dataRealDeTerminoAno) ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_DATA_INCONSISTENTE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);		
		}	
		if(!is_numeric($request->dataInicioAno) || !is_numeric($request->previsaoDeTerminoAno) || !is_numeric($request->dataRealDeTerminoAno) ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_DATA_INCONSISTENTE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);		
		}
		if(strlen($request->dataInicioAno) < 4 || strlen($request->previsaoDeTerminoAno) < 4 || strlen($request->dataRealDeTerminoAno) < 4 ){
			$request->session()->flash('message_error_projeto_create', $this->ERROR_DATA_INCONSISTENTE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->cadastro($request);		
		}
		if(is_numeric($request->dataInicioAno) && is_numeric($request->previsaoDeTerminoAno) && is_numeric($request->dataRealDeTerminoAno) ){
			if( (int)  $request->dataInicioAno > (int) $request->previsaoDeTerminoAno ){
				$request->session()->flash('message_error_projeto_create', $this->ERROR_DATA_INCONSISTENTE); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->cadastro($request);
			}
			if( (int)  $request->previsaoDeTerminoAno >  (int) $request->dataRealDeTerminoAno ){
				$request->session()->flash('message_error_projeto_create', $this->ERROR_DATA_INCONSISTENTE); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->cadastro($request);
			}	
		}
		$dataInicio = $request->dataInicioAno . $request->dataInicioMes . $request->dataInicioDia ;
		$dataInicioAux = date('Y-m-d', strtotime($dataInicio));
		$dataPrevisaoDeTermino = $request-> previsaoDeTerminoAno . $request->previsaoDeTerminoMes .$request-> previsaoDeTerminoDia ;
		$dataPrevisaoDeTerminoAux = date('Y-m-d', strtotime($dataPrevisaoDeTermino));
		$dataRealDeTermino = $request-> dataRealDeTerminoAno . $request->dataRealDeTerminoMes . $request->dataRealDeTerminoDia ;
		$dataRealDeTerminoAux = date('Y-m-d', strtotime($dataRealDeTermino));
		$request-> dataInicioAno = $dataInicioAux;
		$request-> previsaoDeTerminoAno = $dataPrevisaoDeTerminoAux ;
		$request-> dataRealDeTerminoAno= $dataRealDeTerminoAux;

		# vetor de mensagens personalizadas
		$messages = array(
			'required' => 'O campo :attribute é obrigatório!',
		);
		# ($input, $rules, $messages);
		
		if(is_numeric($request->gerenteResponsavel)){
			$this->validate($request, [
				'nomeProjeto' => 'required|string|min:6|max:255',
				#'dataInicioAno' => 'required|date',
				#'gerenteResponsavel' => 'required|string|min:3|max:255',
				#'previsaoDeTerminoAno' => 'required|date',
				#'dataRealDeTerminoAno' => 'required|date',
				#'orcamentoTotal' => 'required|numeric|min:1|max:10',
				'descricao' => 'required|string|min:6|max:255',
				'statusId' => 'required|numeric|max:10',
				'classificacaoId' => 'required|numeric|max:10',
			],
			$messages
			);
			
		}else{
			$this->validate($request, [
				'nomeProjeto' => 'required|string|min:6|max:255',
				#'dataInicioAno' => 'required|date',
				'gerenteResponsavel' => 'required|string|min:3|max:255',
				#'previsaoDeTerminoAno' => 'required|date',
				#'dataRealDeTerminoAno' => 'required|date',
				#'orcamentoTotal' => 'required|numeric|min:1|max:10',
				'descricao' => 'required|string|min:6|max:255',
				'statusId' => 'required|numeric|max:10',
				'classificacaoId' => 'required|numeric|max:10',
			],
			$messages
			);
		}

		$request->user()
		->projetos()
		->create([
			'user_id' => $request->user(),
			'nome' => $request->nomeProjeto,
			'data_de_inicio' => $dataInicioAux,
			'gerente_responsavel' => $request->gerenteResponsavel,
			'previsao_de_termino' => $dataPrevisaoDeTerminoAux,
			'data_real_de_termino' => $dataRealDeTerminoAux,
			'orcamento_total' => $request->orcamentoTotal,
			'descricao' => $request->descricao,
			'status_id' => $request->statusId,
			'classificacao_id' => $request->classificacaoId,
			
		]);

		$request->session()->flash('message_succes_projeto_show', $this->SUCESSO_PROJETO_CADASTRADO_CORRETAMENTE); 
		$request->session()->flash('alert-class', 'alert-success');

		return redirect('/projetos/show');
	}

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to lists projects.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function show(Request $request)
	{
		// Método de recuperação de projetos do user do ProjetoRepository
	    $projetos = $this->projetosRepository->forUser($request->user());
		// view
		return view('projetos.show', ['projetos' => $projetos,]);
	}
	/**
	* Detalhes de um projeto
	* @param REquest
	* @return Array Project
	*/
	public function detalhes(Request $request)
	{
		$projeto = Projeto::findOrFail($request->projeto_id); # Sem o ->get() só recupera um. Se utilizar o  ->get() traz todos
		if($projeto != null){			                         			  						 			
			return view('projetos/detalhes', ['projeto' => $projeto,]);
		}
		$projeto = array();
		return view('projetos/detalhes', ['projeto' => $projeto,]);
	}
	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to remove projects.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function destroy(Request $request, Projeto $projeto)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para criar projetos
		* através da política (regra) de autorização
		*-----------------------------------------------------------
		*/
	
		try{
			$this->authorize('destroy', $projeto);
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
				//$error = array( 'error' => $request->user()->perfil_id , 'code' => $code);
				$error = array( 'error' => $exception->getMessage(), 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch

		if($projeto->isQualIndicador( $projeto->id)){
			$request->session()->flash('message_succes_projeto_show', $this->ERROR_PROJETO_TEM_INDICADORES ); 			
			$request->session()->flash('alert-class', 'alert-danger');
			$request->session()->flash('alert-class', 'alert-danger'); 
		    return redirect('/projetos/show');
		
		}else{		
			$request->session()->flash('message_succes_projeto_show', $this->SUCESSO_PROJETO_REMOVIDO ); 	
			$request->session()->flash('alert-class', 'alert-success'); 
			$projeto->delete();
			return redirect('/projetos/show');
		}
		return redirect('/projetos/show');
	}

	/**
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to lists projects.
	*
	* @param User, Projeto
	* @return boolean
	*
	*/
	public function update(Request $request, Projeto $projeto)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para editar projetos
		* através da política (regra) de autorização
		*-----------------------------------------------------------
		*/
	
		try{
			$this->authorize('update', $projeto);
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
				//$error = array( 'error' => $request->user()->perfil_id , 'code' => $code);
				$error = array( 'error' => $exception->getMessage(), 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch

		if(!is_null($request->projeto)){
			$projetos = Projeto::findOrFail($request->projeto->id);
		}else{
			if(!is_null($projeto)){
				$projetos = Projeto::findOrFail($projeto->id);
			}
		}

		$collectionGerentes = User::select('users.*' )
            ->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)
            ->get();
		if( is_null($collectionGerentes) && count($collectionGerentes) == 0){
			$collectionGerentes = null;
		}

		return view('projetos.update', ['projetos' => $projetos, 'collectionGerentes' => $collectionGerentes,]);	
	}
	/**------------------------------------------------------------------
	*
    * Access  by user 'Lider Do Escritorio De Projetos' to lists projects.
	*
	* @param User, Projeto
	* @return boolean
	*--------------------------------------------------------------------
	*/
	public function atualizar(Request $request, Projeto $projeto)
	{		 
		if ( !is_null($request->nomeProjeto) && strlen($request->nomeProjeto) < 6 ){
			$request->session()->flash('message_error_projeto_update', $this->ERROR_PROJETO_NOME_TAMANHO_MINIMO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->show($request);			
		}
		$getProjeto = Projeto::find($request->projeto_id);

		if ( Projeto::select('projetos.*' )->where('projetos.nome', '=', $request->nomeProjeto)->exists() ){
			$resultadoProjeto = Projeto::select('projetos.*' )->where('projetos.nome', '=', $request->nomeProjeto)->first();
			if ($resultadoProjeto->id != $getProjeto->id){
				$request->session()->flash('message_error_projeto_update', $this->ERROR_PROJETO_NOME_EXISTENTE ); 		
				return $this->update($request ,$getProjeto);
			}
		}

		$resultadoProjeto = Projeto::select('projetos.*' )->where('projetos.nome', '=', $request->nomeProjeto);

		if ( is_null($request-> gerenteResponsavel)  ){
			$request->session()->flash('message_error_projeto_update', $this->ERROR_PROJETO_GERENTE_NAO_SELECIONADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);
		}
		if ( !is_null($request-> gerenteResponsavel) && $request-> gerenteResponsavel == '' ){
			$request->session()->flash('message_error_projeto_update',  $this->ERROR_PROJETO_GERENTE_NAO_SELECIONADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);
		}
		if ( !is_null($request-> gerenteResponsavel) && strlen($request-> gerenteResponsavel) == 0 ){
			$request->session()->flash('message_error_projeto_update',  $this->ERROR_PROJETO_GERENTE_NAO_SELECIONADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);
		}
		if ( !is_null($request-> nomeProjeto) && $request-> nomeProjeto == '' ){
			$request->session()->flash('message_error_projeto_update', $this->ERROR_PROJETO_NOME_TAMANHO_MINIMO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);
		}
		# configura adata e hora
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');
		# vetor de mensagens personalizadas
		$messages = array(
			'required' => 'O campo :attribute é obrigatório PARA ATUALIZAR!',
		);
		if(is_null($request->dataInicioAno) || is_null($request->previsaoDeTerminoAno) || is_null($request->dataRealDeTerminoAno) ){
			$request->session()->flash('message_error_projeto_update', $this->ERROR_DATA_INCONSISTENTE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);		
		}	
		if(!is_numeric($request->dataInicioAno) || !is_numeric($request->previsaoDeTerminoAno) || !is_numeric($request->dataRealDeTerminoAno) ){
			$request->session()->flash('message_error_projeto_update', $this->ERROR_DATA_INCONSISTENTE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);		
		}
		if(strlen($request->dataInicioAno) < 4 || strlen($request->previsaoDeTerminoAno) < 4 || strlen($request->dataRealDeTerminoAno) < 4 ){
			$request->session()->flash('message_error_projeto_update', $this->ERROR_DATA_INCONSISTENTE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->update($request,$projeto);		
		}
		if(is_numeric($request->dataInicioAno) && is_numeric($request->previsaoDeTerminoAno) && is_numeric($request->dataRealDeTerminoAno) ){
			if( (int)  $request->dataInicioAno > (int) $request->previsaoDeTerminoAno ){
				$request->session()->flash('message_error_projeto_update', $this->ERROR_DATA_INCONSISTENTE); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->update($request,$projeto);
			}
			if( (int)  $request->previsaoDeTerminoAno >  (int) $request->dataRealDeTerminoAno ){
				$request->session()->flash('message_error_projeto_update', $this->ERROR_DATA_INCONSISTENTE); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return $this->update($request,$projeto);
			}	
		}
		$dataInicio = $request->dataInicioAno . $request->dataInicioMes . $request->dataInicioDia ;
		$dataInicioAux = date('Y-m-d', strtotime($dataInicio));
		$dataPrevisaoDeTermino = $request-> previsaoDeTerminoAno . $request->previsaoDeTerminoMes .$request-> previsaoDeTerminoDia ;
		$dataPrevisaoDeTerminoAux = date('Y-m-d', strtotime($dataPrevisaoDeTermino));		
		$dataRealDeTermino = $request-> dataRealDeTerminoAno . $request->dataRealDeTerminoMes . $request->dataRealDeTerminoDia ;
		$dataRealDeTerminoAux = date('Y-m-d', strtotime($dataRealDeTermino));
		$request-> dataInicioAno = $dataInicioAux;
		$request-> previsaoDeTerminoAno = $dataPrevisaoDeTerminoAux ;
		$request-> dataRealDeTerminoAno= $dataRealDeTerminoAux;

		# vetor de mensagens personalizadas
		$messages = array(
			'required' => 'O campo :attribute é obrigatório!',
		);
		# ($input, $rules, $messages);
		try{
		if(is_numeric($request->gerenteResponsavel)){
			 $this->validate($request, [
				'nomeProjeto' => 'required|string|min:6|max:255',
				#'dataInicioAno' => 'required|date',
				#'gerenteResponsavel' => 'required|string|min:3|max:255',
				#'previsaoDeTerminoAno' => 'required|date',
				#'dataRealDeTerminoAno' => 'required|date',
				'orcamentoTotal' => 'required|string|min:1|max:20',
				'descricao' => 'required|string|min:6|max:255',
				'statusId' => 'required|numeric|max:10',
				'classificacaoId' => 'required|numeric|max:10',
			],
			$messages
			);
		}else{
			 $this->validate($request, [
				'nomeProjeto' => 'required|string|min:6|max:255',
				#'dataInicioAno' => 'required|date',
				'gerenteResponsavel' => 'required|string|min:3|max:255',
				#'previsaoDeTerminoAno' => 'required|date',
				#'dataRealDeTerminoAno' => 'required|date',
				'orcamentoTotal' => 'required|string|min:1|max:20',
				'descricao' => 'required|string|min:6|max:255',
				'statusId' => 'required|numeric|max:10',
				'classificacaoId' => 'required|numeric|max:10',
			],
			$messages
			);
		}
		}catch(MethodNotAllowedHttpException $e){
			return redirect('projetos.update');	
		
		}
		$request->user()
		->projetos()
		->where('id', $request->projeto_id)
		->update([
			'user_id' => $request->user()->id,
			'nome' => $request->nomeProjeto,
			'data_de_inicio' => $dataInicioAux,
			'gerente_responsavel' => $request->gerenteResponsavel,
			'previsao_de_termino' => $dataPrevisaoDeTerminoAux,
			'data_real_de_termino' => $dataRealDeTerminoAux,
			'orcamento_total' => $request->orcamentoTotal,
			'descricao' => $request->descricao,
			'status_id' => $request->statusId,
			'classificacao_id' => $request->classificacaoId,
			
		]);
		$request->session()->flash('message_succes_projeto_show', $this->SUCESSO_PROJETO_ATUALIZAR); 
		$request->session()->flash('alert-class', 'alert-success');
		return redirect('/projetos/show');

	}

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
		try{
		    $projetos =  $request->user()->projetos()->where('nome', 'like', '%'. $request->nomeProjetoBusca .'%')->orderBy('nome');
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		#return redirect('/projetos/show');
		return view('projetos.show', ['projetos' => $projetos,]);
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
		$ordenarPor = $request->nomeProjetoBusca;
	
		$projetos [] = array();
		try{
			
			if($ordenarPor === 'NOMEDOPROJETO'){
				$ordenarPor = 'nome';
				 $projetos =  $request
				->user()
				->projetos()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'DATAINICIAL'){
				$ordenarPor = 'data_de_inicio';
				$startDate = date('Y-m-d',strtotime('1500-01-01 00:00:00') );		
				$endDate = date('Y-m-d H:m:i');			
			    $projetos =  $request
				->user()
				->projetos()
				->select('data_de_inicio')
				->orderBy($ordenarPor, 'asc');		
			}
			elseif($ordenarPor === 'NOMEDOGERENTE'){
				$ordenarPor = 'gerente_responsavel';
				$projetos =  $request
				->user()
				->projetos()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'DATAPROVAVELDETERMINO'){
				$ordenarPor = 'previsao_de_termino';
				$date = date_create('1500-01-01');
				$startDate = $date;
				$endDate = date('Y-m-d');			
			    $projetos =  $request
				->user()
				->projetos()				
				->orderBy('previsao_de_termino', 'asc');
			}
			elseif($ordenarPor === 'DATADETERMINO'){
				$ordenarPor = 'data_real_de_termino';
				$date = date_create('1500-01-01');
				$startDate = $date;
				$dateNow = new DateTime();
				$endDate = $dateNow;			
			    $projetos =  $request
				->user()
				->projetos()
				->orderBy('data_real_de_termino', 'asc');			
			}
			elseif($ordenarPor === 'VALORDOPROJETO'){
				$ordenarPor = 'orcamento_total';
				$projetos =  $request
				->user()
				->projetos()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'DETALHESDOPROJETO'){
				$ordenarPor = 'descricao';
				$projetos =  $request
				->user()
				->projetos()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'STATUSDAFASE'){
				$ordenarPor = 'status_id';
				$projetos =  $request
				->user()
				->projetos()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'TIPODERISCO'){
				$ordenarPor = 'classificacao_id';
				$projetos =  $request
				->user()
				->projetos()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		#return redirect('/projetos/show');
		return view('projetos.show', ['projetos' => $projetos,]);
	}
}