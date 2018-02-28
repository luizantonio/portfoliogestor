<?php

namespace App\Http\Controllers\Indicador;

use Gate;
use App\Fase;
use DateTime;
use App\User;
use Validator;
use App\Indicador;
use App\Projeto;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositorios\IndicadorRepository;
use App\FaseProjeto;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use App\Exceptions\Handler;
use App\Http\Controllers\Fase\FaseController;
use App\Http\Controllers\Informar\InformarIndicadorController;
use Illuminate\Support\Facades\DB;

class IndicadorController extends Controller
{
    protected $indicadoresRepository;
	protected $indicadors;
	protected $faseController;
	protected $informarIndicador;

	protected $ERROR_INDICADOR_REMOVER = 'Existem projetos associados ao indicador!'; 	
	protected $ERROR_INDICADOR_NOME_NUM = 'Nome do indicador deve ser apenas caracteres!'; 
	protected $ERROR_INDICADOR_LIMITE = 'Nome do indicador deve ter menos de 100 caracteres!'; 
	protected $ERROR_INDICADOR_NOME = 'Nome do indicador deve ter mais de 6 caracteres com sucesso!'; 
	protected $ERROR_INDICADOR_NOME_EXISTE = 'O indicador existe!';
	protected $ERROR_VALOR_MAXIMO_MINIMO_INVALIDO = 'Valor maximo invalido! E Valor minimo invalido!';
	protected $ERROR_VALOR_MINIMO_INVALIDO = 'Valor minimo invalido!';
	protected $ERROR_VALOR_MAXIMO_INVALIDO = 'Valor maximo invalido!'; 
	protected $ERROR_VALOR_MAXIMO_INVALIDO_MAIOR_ZERO ='Valor Maximo e Valor Minimo devem ser maiores que 0 (zero)!';
	protected $ERROR_VALOR_MINIMO_MAIOR_ZERO = 'Valor Minimo deve ser maior que 0 (zero)!';
	protected $ERROR_VALOR_MAXIMO_MAIOR_ZERO = 'Valor Maximo deve ser maior que 0 (zero)!'; 
	protected $ERROR_VALOR_MAXIMO_MAIOR_MINIMO = 'Valor Minimo deve ser Menor que o Valor Maximo!'; 
	protected $ERROR_VALOR_USE_NUMEROS = 'Valor maximo e Valor minimo invalidos! Use numeros validos'; 
	protected $ERROR_VALOR_MAXIMO_USE_NUMERO = 'Valor maximo invalido! Use numero validos'; 
	protected $ERROR_INDICADOR_FALHA_ASSOCIAR = 'Falha ao tentar associar o indicador!'; 	
	protected $SUCESSO_INDICADOR_DESASSOCIAR = 'Indicador desassociado com sucesso!'; 
	protected $SUCESSO_INDICADOR_REMOVIDO = 'Indicador removido com sucesso!'; 
	protected $SUCESSO_INDICADOR_CADASTRADO_CORRETAMENTE = 'Indicador cadasrado com sucesso!';
	protected $SUCESSO_INDICADOR_UPDATE_CORRETAMENTE = 'Indicador atualizado com sucesso!';

    //constructor
	public function __construct(IndicadorRepository $indicadores, FaseController $faseController, InformarIndicadorController $informarIndicador) 
	{
		$this->middleware('auth.lep');
		$this->indicadoresRepository = $indicadores;
		$this->faseController = $faseController;
		$this->informarIndicador = $informarIndicador;

	}

	/**
	*
    * Access  by user 'LEP' to create projects.
	*
	* @param Request
	* @return view
	*/
	public function index(Request $request)
	{
		return view('indicadores.index');
		
	}
	public function home(Request $request)
	{
		return view('indicadores.home');	
	}
	public function cadastro(Request $request)
	{

		return view('indicadores.create');	
	}
	/**
	*
    * Access  by user 'LEP' to create projects.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function create(Request $request, Indicador $indicador)
	{

		if ( !is_null($request->name) && strlen($request->name) < 6 ){
			$request->session()->flash('message_error_indicador_create', $this->ERROR_INDICADOR_NOME); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			//return view('indicadores/create');
		}
		if ( !is_null($request->name) && strlen($request->name) > 100 ){
			$request->session()->flash('message_error_indicador_create', $this->ERROR_INDICADOR_LIMITE); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			//return view('indicadores/crete');
		}
		if(is_numeric($request->name) ){
			$request->session()->flash('message_error_indicador_create', $this->ERROR_INDICADOR_NOME_NUM); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			//return view('indicadores/crete');	
		}
		try{
		# vetor de mensagens personalizadas
		$messages = array(
			'required' => 'O campo :attribute é obrigatório!',
			'min' => 'O campo :attribute deve apresentar 6 caracteres no mínimo!',
			'string' => 'O campo :attribute deve ser um texto!',
		);
		//($input, $rules, $messages);

		$erro = $this->validate($request, [
				'name' => 'required|string|min:6|max:100',
			],
			$messages
		);
		
		}catch ( PDOException $e){
			$e->message();
		}
		try{
		    # config(['app.timezone' => 'UTC']);
		    # DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		    date_default_timezone_set('America/Sao_Paulo');
			$request->user()
			->indicadores()
			->create([
				'user_id' => $request->user(),
				'nome' => $request->name,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 			
			]);

			$request->session()->flash('message_succes_indicador_show', $this->SUCESSO_INDICADOR_CADASTRADO_CORRETAMENTE); 
			$request->session()->flash('alert-class', 'alert-success');


		}catch ( PDOException $e){
			$e->message();
		}
		
		return redirect('/indicadores/show');
		
	}
	/**
	*
    * Access  by user 'LEP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function show(Request $request)
	{
		#----------------------------LEP e GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);	
		if($isGerenteDeProjeto ){ return $this->informarIndicador->InformarIndicadoresShow($request);}
		#-------------------------------------------------------------------------------
		// Método de recuperação de Indicadors do user do IndicadorRepository
	    $indicadores = $this->indicadoresRepository->forUser($request->user());
		return view('indicadores.show', ['indicadores' => $indicadores,]);
	}

	public function informar(Request $request)
	{
		#----------------------------LEP e GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		$isLiderEscritProjetos = $request->user()->isLiderEscritProjetos($request->user()->id);
		if($isGerenteDeProjeto || $isLiderEscritProjetos){ return $this->informarIndicador->InformarIndicadoresShow($request);}
		#-------------------------------------------------------------------------------
	    $indicadores = $this->indicadoresRepository->forUser($request->user());
		return view('indicadores.home', ['indicadores' => $indicadores,]);
	}
	public function informarIndicadorEdit(Request $request)
	{
		#----------------------------LEP e GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		$isLiderEscritProjetos = $request->user()->isLiderEscritProjetos($request->user()->id);
		if($isGerenteDeProjeto || $isLiderEscritProjetos){ return $this->informarIndicador->informarIndicadorEdit($request);}
		#-------------------------------------------------------------------------------
	    $indicadores = $this->indicadoresRepository->forUser($request->user());
		return view('indicadores.home', ['indicadores' => $indicadores,]);
	}
	public function informarIndicadorStore(Request $request)
	{
		#----------------------------LEP e GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		$isLiderEscritProjetos = $request->user()->isLiderEscritProjetos($request->user()->id);
		if($isGerenteDeProjeto || $isLiderEscritProjetos){ return $this->informarIndicador->store($request);}
		#-------------------------------------------------------------------------------
	    $indicadores = $this->indicadoresRepository->forUser($request->user());
		return view('indicadores.home', ['indicadores' => $indicadores,]);
	}
	/**
	*
    * Access  by user 'LEP' to remove projects.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function destroy(Request $request, Indicador $indicador)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para criar indicadors
		* através da política (regra) de autorização
		*-----------------------------------------------------------
		*/
	
		try{
			//$this->authorize('destroy', $indicador);
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
		
		$id = (int)  $request->id;

		$existeIndicador = Indicador::select('indicadors.id' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.indicador_id', '=', $id) ->first();

		if(!is_null($existeIndicador )){			
				$request->session()->flash('message_error_indicador_show', $this->ERROR_INDICADOR_REMOVER); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return redirect('indicadores/show');
		}else{
		
			$result = Indicador::where('id', '=', $request->id)->delete();
			var_dump($result);
			$request->session()->flash('message_succes_indicador_show', $this->SUCESSO_INDICADOR_REMOVIDO); 
			$request->session()->flash('alert-class', 'alert-success');
			return redirect('indicadores/show');
		}

		return redirect('indicadores/show');
	}

	/**------------------------------------------------------------------
	*
    * Access  by user 'Lider Do Escritorio De indicadores' to lists projects.
	*
	* @param User, Indicador
	* @return boolean
	*--------------------------------------------------------------------
	*/
	public function update(Request $request, Indicador $indicador)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para editar indicadors
		* através da política (regra) de autorização
		*-----------------------------------------------------------
		*/
	
		try{
			//$this->authorize('update', $indicador);
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
		
		try{
			$indicadores = Indicador::findOrFail($request->id);
		}catch ( PDOException $e){
			$e->message();
		}
	    $indicadores = $this->indicadoresRepository->oneIndicador($request->user(), $indicadores);
		//var_dump($indicadores->id);	   
		return view('indicadores/update', ['indicadores' => $indicadores]);

	}
	/**------------------------------------------------------------------
	*
    * Access  by user 'LEP' to lists projects.
	*
	* @param User, Indicador
	* @return boolean
	*--------------------------------------------------------------------
	*/
	public function atualizar(Request $request, Indicador $indicador)
	{		 
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		if ( !is_null($request->name) && strlen($request->name) < 6 ){
			$request->session()->flash('message_error_indicador_update', $this->ERROR_INDICADOR_NOME); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			 try{
			 	$indicadores = Indicador::findOrFail($request->indicador_id);
			 }catch ( PDOException $e){
			 	$e->message();
			}
			     $indicadores = $this->indicadoresRepository->oneIndicador($request->user(), $indicadores);
 
			return view('indicadores/update', ['indicadores' => $indicadores]);	
		}
		if ( !is_null($request->name) && strlen($request->name) > 100 ){
			$request->session()->flash('message_error_indicador_update', $this->ERROR_INDICADOR_LIMITE);
			$request->session()->flash('alert-class', 'alert-danger'); 
			 try{
			 	$indicadores = Indicador::findOrFail($request->indicador_id);
			 }catch ( PDOException $e){
			 	$e->message();
			}
			     $indicadores = $this->indicadoresRepository->oneIndicador($request->user(), $indicadores);
 
			return view('indicadores/update', ['indicadores' => $indicadores]);	
		}
		if(is_numeric($request->name) ){
			$request->session()->flash('message_error_indicador_update', $this->ERROR_INDICADOR_NOME_NUM); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			 try{
			 	$indicadores = Indicador::findOrFail($request->indicador_id);
			 }catch ( PDOException $e){
			 	$e->message();
			}
			     $indicadores = $this->indicadoresRepository->oneIndicador($request->user(), $indicadores);
 
			return view('indicadores/update', ['indicadores' => $indicadores]);	
		}

		if(DB::table('indicadors')->where('nome', 'like', '%'. $request->name .'%')->orderBy('nome')->exists()){
			$request->session()->flash('message_error_indicador_update', $this->ERROR_INDICADOR_NOME_EXISTE); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			 try{
			 	$indicadores = Indicador::findOrFail($request->indicador_id);
			 }catch ( PDOException $e){
			 	$e->message();
			}
			     $indicadores = $this->indicadoresRepository->oneIndicador($request->user(), $indicadores);
 
			return view('indicadores/update', ['indicadores' => $indicadores]);	

		}
		// try{
		// # vetor de mensagens personalizadas
		// $messages = array(
		// 	'required' => 'O campo :attribute é obrigatório!',
		// 	'min' => 'O campo :attribute deve apresentar 6 caracteres no mínimo!',
		// 	'string' => 'O campo :attribute deve ser um texto!',
		// );
		// //($input, $rules, $messages);

		// $erro = $this->validate($request, [
		// 		'name' => 'required|string|min:6|max:100',
		// 	],
		// 	$messages
		// );
		
		// }catch ( PDOException $e){
		// 	//$e->message();
		// 	return redirect('/indicadores/show');
		// }
		try{
			$request->user()
			->indicadores()
			->where('id', $request->indicador_id)
			->update([
				'nome' => $request->name,
				'updated_at' => date('Y-m-d H:i:s'), 
				
			]);

			$request->session()->flash('message_succes_indicador_show', $this->SUCESSO_INDICADOR_UPDATE_CORRETAMENTE); 
			$request->session()->flash('alert-class', 'alert-success');
		}catch ( PDOException $e){
			$e->message();
		}
		return redirect('/indicadores/show');

	}

	/**
	*
    * Access  by user 'LEP' to lists projects by name.
	*
	* @param Request
	* @return view
	*/
	public function buscarPorNomeInformar(Request $request)
	{
		#----------------------------LEP e GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		$isLiderEscritProjetos = $request->user()->isLiderEscritProjetos($request->user()->id);
		if($isGerenteDeProjeto || $isLiderEscritProjetos){ return $this->informarIndicador->buscarPorNome($request);}
		#-------------------------------------------------------------------------------
	    $indicadores = $this->indicadoresRepository->forUser($request->user());
		return view('indicadores.home', ['indicadores' => $indicadores,]);
	}

	/**
	*
    * Access  by user 'LEP' to lists projects by name.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function buscarPorNome(Request $request, Indicador $indicador)
	{

		#echo '===buscarPorNome=('. $request->nomeIndicadorBusca .')/............</br>';
		
		//var_dump($request->user()->id );

		$indicadores [] = array();
		try{
			
		    $indicadores =  $request->user()->indicadores()->where('nome', 'like', '%' . $request->nomeIndicadorBusca . '%')->orderBy('nome')->get();
			
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		//return redirect('/indicadores/show');

		return view('indicadores.show', [
			'indicadores' => $indicadores,
		]);
	}
	/**
	*
    * Access  by user 'LEP' to lists projects sort.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function buscarOrdenarPorInformar(Request $request)
	{
		#----------------------------LEP e GP-------------------------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);
		$isLiderEscritProjetos = $request->user()->isLiderEscritProjetos($request->user()->id);
		if($isGerenteDeProjeto || $isLiderEscritProjetos){ return $this->informarIndicador->buscarOrdenarPor($request);}
		#-------------------------------------------------------------------------------
	    $indicadores = $this->indicadoresRepository->forUser($request->user());
		return view('indicadores.home', ['indicadores' => $indicadores,]);
	}
	/**
	*
    * Access  by user 'LEP' to lists projects by name.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function buscarOrdenarPor(Request $request, Indicador $indicador)
	{
		$ordenarPor = $request->ordenarIndicadorPor;
	
		$indicadores [] = array();
		try{
			if($ordenarPor === 'NOMEDOINDICADOR'){
				$ordenarPor = 'nome';
				 $indicadores =  $request
				->user()
				->indicadores()
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		//return redirect('/indicadores/show');

		return view('indicadores.show', [
			'indicadores' => $indicadores,
		]);
	}

	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	* used by fases.blade.php
	* @param Request, User
	* @return boolean
	*/
	public function associarFaseAoProjeto(Request $request, User $user)
	{
		return $this->faseController->associarFasesAoProjeto($request, $user);
	}
	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	* used by associar.blade.php
	* @param Request, User
	* @return boolean
	*/
	public function associarIndicadorAoProjeto(Request $request)
	{
	
		//echo "projeto_id<:>".$request->projeto_id;	
		//echo "projeto_id<:>".$request->projeto_id;	
		return $this->faseController->associarIndicadorAoProjeto($request, $request->projeto_id);
	}

	/*
    * Access  by user Administrador' to change attributes role to user.
	* used by desassociar.blade.php
	* @param Request, User
	* @return boolean
	*/
	public function desassociarIndicadorAoProjeto(Request $request)
	{

		$projetos = array();	
		$projetos = Projeto::all();
		
		#return view('indicadores/desassociar', ['projetos' => $projetos, 'fases' => $fases,]);
		return view('indicadores/desassociar', ['projetos' => $projetos,]);
	}

	public function removerIndicadorDoProjeto(Request $request)
	{
		
		$result =  $this->faseController->destroy($request, $request->projeto_id);
		
		return $this->faseController->getIndicadorDoProjeto($request,  $request->projeto);
	}
	
	/*
    * Desassociate indicator of project
	* used by dassociar.blade.php
	* @param Request, User
	* @return boolean
	*/
	public function getIndicadorDoProjeto(Request $request)
	{
		return $this->faseController->getIndicadorDoProjeto($request, $request->projeto);
	}

	# Utilizado para carregar os nome s dos indicadores da fase de busca
	public function indicadoresDaFase(Request $request)
	{
		$this->faseController->indicadoresDaFase( $request->fasedoProjeto);
		return redirect('indicadores/fases');
	}


	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	* used by associar.blade.php form
	* @param Request, User
	* @return boolean
	*/
	public function associarFaseIndicadorStore(Request $request, User $user)
	{
		if( $request->valormaximo === null || $request->valorminimo === null ||  $request->valormaximo === '' || $request->valorminimo === ''){
			if( $request->valorminimo =='' && $request->valormaximo == '' ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_MINIMO_INVALIDO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
			}
			elseif( $request->valorminimo =='' ){			
				$request->session()->flash('message',  $this->ERROR_VALOR_MINIMO_INVALIDO); 
			    $request->session()->flash('alert-class', 'alert-danger');
				return $this->associarIndicadorAoProjeto( $request);

			}elseif( $request->valormaximo == ''){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_INVALIDO); 
			    $request->session()->flash('alert-class', 'alert-danger');
				return $this->associarIndicadorAoProjeto( $request);
			}
		}
		elseif(is_numeric ($request->valormaximo) && is_numeric ($request->valorminimo)){
			if( ( (int) $request->valorminimo < 0) && ((int) $request->valormaximo < 0) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_INVALIDO_MAIOR_ZERO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
			}
			elseif( ( (int) $request->valorminimo < 0) ){			
				$request->session()->flash('message',  $this->ERROR_VALOR_MINIMO_MAIOR_ZERO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);

			}elseif( ( (int) $request->valormaximo < 0) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_MAIOR_ZERO); 
			    $request->session()->flash('alert-class', 'alert-danger');
				return $this->associarFaseAoProjeto($request, $user);
			}
			if( ( (int) $request->valorminimo ) > ((int) $request->valormaximo ) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_MAIOR_MINIMO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
			}
		}
		elseif( is_string( $request->valormaximo) && is_string( $request->valorminimo) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_USE_NUMEROS); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
		}
		elseif( is_string( $request->valormaximo) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_USE_NUMERO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
		}
		elseif( is_string( $request->valorminimo) ){
				$request->session()->flash('message', 'Valor  minimo invalido! Use numero validos'); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
		}
		elseif(is_numeric ($request->valormaximo) && is_numeric ($request->valorminimo)){
			if( ( (int) $request->valorminimo < 0) && ((int) $request->valormaximo < 0) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_INVALIDO_MAIOR_ZERO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);
			}
			elseif( ( (int) $request->valorminimo < 0) ){			
				$request->session()->flash('message',  $this->ERROR_VALOR_MINIMO_MAIOR_ZERO); 
			    $request->session()->flash('alert-class', 'alert-danger');				
				return $this->associarIndicadorAoProjeto( $request);

			}elseif( ( (int) $request->valormaximo < 0) ){
				$request->session()->flash('message',  $this->ERROR_VALOR_MAXIMO_MAIOR_ZERO); 
			    $request->session()->flash('alert-class', 'alert-danger');
				return $this->associarIndicadorAoProjeto( $request);
			}
		}
		

		$result  = $this->faseController->store( $request);
		//var_dump($result);  //se deu certo retorna null
		if($result === true){
			$request->session()->flash('message_success_associar',  $this->SUCESSO_INDICADOR_DESASSOCIAR); 
			$request->session()->flash('alert-class', 'alert-success'); 
		}elseif ($result === false) {
			$request->session()->flash('message_error_associar',  $this->ERROR_INDICADOR_FALHA_ASSOCIAR); 
			$request->session()->flash('alert-class', 'alert-danger');
		}
		// view
		return $this->associarFaseAoProjeto($request, $user);
	}
}