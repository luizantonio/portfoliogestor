<?php

namespace App\Http\Controllers\Fase;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use App\Indicador;
use App\Projeto;
use App\Fase;
use App\Valor;
use App\Acompanhamento;
use App\FaseProjeto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class FaseController extends Controller
{
	protected $ERROR_INDICADOR_FALHA_ASSOCIAR = 'Falha ao tentar associar o indicador!'; 	
	protected $ERROR_INDICADOR_IMOSSIBILITADO = 'Indicador impossibilitado de ser desassociado!'; 
	protected $ERROR_INDICADOR_FALHA_DESASSOCIAR = 'Falha ao tentar desassociar o indicador!'; 
	protected $ERROR_INDICADOR_FALHA_FASE = 'Valor da Fase do Projeto não Selecionadoa!';
	protected $SUCESSO_INDICADOR_ASSOCIADO =   'Indicador associado com sucesso!';
	protected $SUCESSO_INDICADOR_DESASSOCIAR = 'Indicador desassociado com sucesso!'; 


	# Contrutor
	public function __construct()
	{
		$this->middleware('auth.lep');
	}
	/**
	* Função usada para exibir os projetos para associar o indicador
	* @param Request, User
	* @return view
	*/
	public function associarFasesAoProjeto(Request $request, User $user)
	{	
	    $indicadores = array();
		$fases = array();
		$projetos = array();	
		$projetos = Projeto::all(); 
		$fases = Fase::all(); 
		// view		
		return view('indicadores/fases', ['projetos' => $projetos, 'fases' => $fases,]);
		
	}

	/**
    * Access  by user LEP' to associar show form with indicador, project, and fase.
	*
	* @param Request, User
	* @return view
	*/
	public function associarIndicadorAoProjeto(Request $request,  $projeto_id)
	{
		// Método de recuperação de projetos do user do ProjetoRepository
	    $indicadores = array();		
		$projetos = array();	
		$projeto = Projeto::findOrFail( $projeto_id );
		$fases = Fase::all(); 
		$indicadoresall = Indicador::all();
		if($projeto != null ){
			$projetos [] = $projeto;
		}
		// view
		return view('indicadores/associar', ['projetos' => $projetos, 'fases' => $fases, 'indicadoresall' => $indicadoresall,]);
	}
	/**
	* Get indicador of projetct associated
	* @param Request, User
	* @return view
	*/
	public function getIndicadorDoProjeto(Request $request,  $projeto_id)
	{
		$indicadores = array();
		$fases = array();
		$projetos = array();	
		$projeto = Projeto::findOrFail( $projeto_id );
		$fases = Fase::all();
		$indicadoresall = Indicador::all();
		if($projeto != null ){
			$projetos [] = $projeto;
		}
		return view('indicadores/remover', ['projetos' => $projetos, 'fases' => $fases,'indicadoresall' => $indicadoresall,]);
	}
	/**
	* Remove indicador do projeto
	* @param Request, User
	* @return view
	*/
	public function destroy(Request $request, $faseDoProjeto)
	{
		# verify if user has authorize to make this operation
		if(!$request->user()->isLiderEscritProjetos($request->user()->id)){	
			$code = [403];
			// vetor com a exception e  codigo para serem exibidos na view
			$error = array( 'error' => 'Você não tem privilégio suficiente para excluir usuário!', 'code' => $code);								
			return view('/common.403', $error, $code);
		}//if
		$projeto = Projeto::find($request->projeto) ;
	    if(!DB::table('fase_projeto')->where('id', intval($request->faseprojeto))->exists()){
			$request->session()->flash('message_error_desassociar',  $this->ERROR_INDICADOR_IMOSSIBILITADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return $this->getIndicadorDoProjeto($request, $request->projeto);
		}else{
			$temValorInformado = Valor::where('fase_projeto_id', $request->faseprojeto)->first();
			$acomp = new Acompanhamento();	
			$result = null;	
			if(!is_null($temValorInformado)){
				# verify if exists one acompanhamento with value
				if($acomp->where('acompanhamentos.valor_id', $temValorInformado->id)->exists()){
					$acompanhamento = Acompanhamento::where('valor_id', $temValorInformado->id)->delete();
				}
				if($temValorInformado->where('fase_projeto_id', $request->faseprojeto)->exists()){	
					#  luiz 09/02/2018
					$resultadoDoRemoverValor =  Valor::where('fase_projeto_id',  $request->faseprojeto)->delete();
				}
			}		 
        	$id_fase_projeto = intval($request->faseprojeto);
        	$deletedRows = DB::table('fase_projeto')->where('id', $id_fase_projeto)->delete();
			if(!is_null($deletedRows) ){
				$request->session()->flash('message_success_desassociar',  $this->SUCESSO_INDICADOR_DESASSOCIAR); 
				$request->session()->flash('alert-class', 'alert-success'); 
			}else{
				$request->session()->flash('message_error_desassociar',  $this->EERROR_INDICADOR_FALHA_DESASSOCIAR); 
				$request->session()->flash('alert-class', 'alert-danger'); 
			}
			return $this->getIndicadorDoProjeto($request, $request->projeto);
		}
		return $this->getIndicadorDoProjeto($request, $request->projeto);
	}

	public function indicadoresDaFase($fase_id)
	{
		return null;
	}
	/**
	*
    * Access  by user LEP GP' to stroe and atache indicador in project
	* Associa multiplos indicadores à fase do projeto
	* @param Request, User
	* @return boolean
	*/
	public function store(Request $request)
	{
		$projeto = Projeto::find($request->projeto_id);
		
		if(is_null($request->fasedoProjeto) ){
			$request->session()->flash('message_error_associar',  $this->ERROR_INDICADOR_FALHA_FASE); 
			$request->session()->flash('alert-class', 'alert-danger'); 			
			return (bool)false;
		}
	    if($projeto->fases()->where('indicador_id', $request->indicadorProjeto)->exists()){		
			$request->session()->flash('message_error_associar',  $this->ERROR_INDICADOR_FALHA_ASSOCIAR); 
			$request->session()->flash('alert-class', 'alert-danger');
			$request->session()->flash('message',  $this->ERROR_INDICADOR_FALHA_ASSOCIAR); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return (bool)false;

		}else{
		  //config(['app.timezone' => 'UTC']);
		  # DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		  date_default_timezone_set('America/Sao_Paulo');
		  $request->session()->flash('message_success_associar',  $this->SUCESSO_INDICADOR_ASSOCIADO); 
		  $request->session()->flash('alert-class', 'alert-success'); 
		  return $projeto->fases()->attach($request->fasedoProjeto, ['fase_id' => $request->fasedoProjeto, 'projeto_id' => $request->projeto_id, 'indicador_id' => $request->indicadorProjeto, 'valor_minimo' => $request->valorminimo, 'valor_maximo' => $request->valormaximo, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),]);
		  return true;
		}
	}

	/**
	*
    * Access  by user 'LEP GP' to lists.
	*
	* @param Request
	* @return boolean
	*/
	public function show(Request $request)
	{
		
	}
	/**
	*
    * Access  by user 'Admin' to lists users by name.
	*
	* @param Request, User
	* @return boolean
	*/
	public function buscarPorNome(Request $request, User $user)
	{
		
	}

	/**
	*
    * Access  by user 'Administrador' to lists projects by name.
	*
	* @param Request, User
	* @return array
	*/
	public function buscarOrdenarPor(Request $request, User $user)
	{
		# echo 'buscarOrdenarPor('. $request->ordenarUsuarioPor .')/...</br>';
		# echo '<time datetime="'.date('c').'">'.date('Y - m - d').'</time>';
		$ordenarPor = $request->ordenarUsuarioPor;
		$users [] = array();
		try{			
			if($ordenarPor === 'NOMEDOUSUARIO'){
				$ordenarPor = 'name';
				 $users =  $this
				    ->user
					->orderBy($ordenarPor, 'asc')
					->get();
			}
			elseif($ordenarPor === 'EMAILDOUSUARIO'){
				$ordenarPor = 'email';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'PERFILDOUSUARIO'){
				$ordenarPor = 'perfil_id';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('admin.show', ['users' => $users,]);
	}
	public function buscarTodasRoles()
	{
		$role = new Role();
		$roles [] = array();
		$roles =  $role->orderBy('role_name', 'asc')
					->get();
		return  $roles;
	}
}