<?php

namespace App\Http\Controllers\Indicador;

use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Fase;
use App\Valor;
use App\Projeto;
use App\Indicador;
use App\FaseProjeto;
use App\Acompanhamento;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositorios\IndicadorRepository;
use App\Http\Controllers\Fase\FaseController;


class AnalisarIndicadorComtroller extends Controller
{
    protected $indicadoresRepo;
	protected $faseController;


    //constructor
	public function __construct(IndicadorRepository $indicadoresRepo, FaseController $faseController) 
	{
		$this->middleware('auth.lep');
		$this->indicadoresRepo = $indicadoresRepo;
		$this->faseController = $faseController;

	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects to access indicators.
	*
	* @param Request
	* @return view
	*/
	public function analisarShow(Request $request)
	{
		$indicadores = Indicador::all();
		$projetos = Projeto::all();
		$fases = Fase::all();
		
		return view('analises.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function analisarIndicadorTexto(Request $request)
	{	
		#-correto não mexer	24/08/2017
		$projeto =  Projeto::findOrFail($request->projeto_id);
		$fases = Fase::all(); 
		return view('analises.analisar', ['projeto' => $projeto,'fases' => $fases,]);
	}

	/**
	*
    * validar digito
	*
	* @param int
	* @return boolean
	*/
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
    * Access  by user Administrador' to change attributes role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function acompanhamentoIndicadorStore(Request $request)
	{
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		$indicadores = Indicador::all();
		$projeto =  Projeto::findOrFail($request->projeto); # Sem o ->get() só recupera um. Se utilizar o  ->get() traz todos
		$fases = Fase::all();

		# not necessary verify if numbres is string, by this this numbers is string and is necessary convert to int numbers

		$resultadoValor = Valor::select('valors.*' )->where('valors.id', '=', $request->valor);

		if ( !$resultadoValor->exists() ){
			$request->session()->flash('message_error_informar', 'Indicador sem valores informados: inexiste!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('analises.analisar', ['projeto' => $projeto, 'indicadores' => $indicadores,  'fases' => $fases,]);
		}
		if ( is_null( $request->Acompanhamento) ){
			$request->session()->flash('message_error_informar', 'Texto do Acompanhamento invalido: Utilize um texto valido!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('analises.analisar', ['projeto' => $projeto, 'indicadores' => $indicadores, 'fases' => $fases,]);
		}
		if ( strlen( $request->Acompanhamento) > 255 ){
			$request->session()->flash('message_error_informar', 'Texto do Acompanhamento invalido: Tamanho acima do permitido!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('analises.analisar', ['projeto' => $projeto,   'indicadores' => $indicadores,  'fases' => $fases,]);
		}
		if ( strlen( $request->Acompanhamento) < 15 ){
			$request->session()->flash('message_error_informar', 'Texto do Acompanhamento invalido: Tamanho inferior ao esperado 15 - quinze - caracteres!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('analises.analisar', ['projeto' => $projeto,  'indicadores' => $indicadores, 'fases' => $fases,]);
		}
		if ( is_null($request->user) ){
			$request->session()->flash('message_error_informar', 'Usuario nao informado!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('analises.analisar', ['projeto' => $projeto,  'indicadores' => $indicadores, 'fases' => $fases,]);
		}
		if( $this->validaDigito($request->valor) == 0 || $this->validaDigito($request->fase) == 0  ||
			 $this->validaDigito($request->faseProjeto) == 0  ){
			$request->session()->flash('message_error_informar', 
					'Dados invalidos: Sem possibilidade de cadastrar o acompanhamento!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('analises.analisar', ['projeto' => $projeto,  'indicadores' => $indicadores, 'fases' => $fases,]);
		}

		$acomp = new Acompanhamento();		

		if($acomp->where('acompanhamentos.valor_id', $request->valor)->exists()){					
				$acompanhamento = new Acompanhamento();
				$result = Acompanhamento::where('valor_id', $request->valor)								
								 ->update(['descricao' => $request->Acompanhamento ,						 
								 'updated_at' => date('Y-m-d H:i:s') ]);
				$request->session()->flash('message_success_informar',  'Texto do Acompanhamento foi atualizado com sucesso!' ); 
				$request->session()->flash('alert-class', 'alert-success'); 
		}else{			
				$acompanhamento = new Acompanhamento();
				$acompanhamento	->user_id = $request->user()->id;
				$acompanhamento	->valor_id = $request->valor;
				$acompanhamento	->descricao = $request->Acompanhamento;
				$acompanhamento	->created_at = date('Y-m-d H:i:s');
				$acompanhamento	->updated_at = date('Y-m-d H:i:s');
				$result = $acompanhamento->save();													 
				$request->session()->flash('message_success_informar', 'Texto do Acompanhamento foi adicionado com sucesso!'); 
				$request->session()->flash('alert-class', 'alert-success'); 
				
		}
		
		return view('analises.analisar', ['projeto' => $projeto,  'indicadores' => $indicadores,  'fases' => $fases,]);
	}

	/** NÃO DEVE SER CHAMADO NO FaseController por causa do construtor
	*
    * Access  by user Lider do Escritório de Projetos to remove Acompanhamento of table
	*
	* @param Request
	* @return boolean 
	*/
	public function destroyAcompanhamento(Request $request, $valor)
	{
		$acomp = new Acompanhamento();		
		# verify if exists one acompanhamento with value
		if($acomp->where('acompanhamentos.valor_id', $valor)->exists()){					
				return Acompanhamento::where('valor_id', $valor)->delete();
				return 1;
		}
		return 0;
	}
	

	
	/**
	*
    * Access  by user 'LEP' to lists projects by name.
	*
	* @param User, Indicador
	* @return boolean
	*/
	public function buscarPorNome(Request $request)
	{		
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();;
		try{
		    $projetos =  Projeto::where('nome', 'like', '%' . $request->buscarAnalisar . '%')->orderBy('nome')->get();			
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('analises.projetos', ['projetos' => $projetos,   'indicadores' => $indicadores,   'fases' => $fases,]);
	}

	/**
	*
    * Access  by user 'LEP' to lists projects sort.
	*
	* @param Request, Indicador
	* @return boolean
	*/
	public function buscarOrdenar(Request $request)
	{
		$ordenarPor = $request->ordenarPorAnalisar;
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();;
	
		try{
			if($ordenarPor === 'NOMEDOPROJETO'){
				$ordenarPor = 'nome';
				$projetos =  Projeto::where('nome','<>',null)->orderBy($ordenarPor, 'asc')->get();
			}
			if($ordenarPor === 'NOMEDOGERENTE'){
				$ordenarPor = 'gerente_responsavel';
				$projetos =   Projeto::where('gerente_responsavel','<>',null)->orderBy($ordenarPor, 'asc')->get();
			}
			if($ordenarPor === 'DATAINICIAL'){
				$ordenarPor = 'data_de_inicio';
				$projetos =   Projeto::where('gerente_responsavel','<>',null)->orderBy($ordenarPor, 'asc')->get();
			}
			if($ordenarPor === 'DATAFINAL'){
				$ordenarPor = 'previsao_de_termino';
				$projetos =    Projeto::where('gerente_responsavel','<>',null)->orderBy($ordenarPor, 'asc')->get();
			}
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('analises.projetos', ['projetos' => $projetos,  'indicadores' => $indicadores, 'fases' => $fases,]);
	}
}

