<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Administrador;
use App\Indicador;
use App\Projeto;
use App\Fase;
use App\UserRole;
use App\Statusmodificado;
use App\Acompanhamento;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjetoController;
use \resources\views\relatorio\json\GeradorJson;
use Illuminate\Support\Facades\Mail;
use App\Relatorio;

class RelatorioComtroller extends Controller
{
    protected $user;
	//constructor
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = new User();
	}

	public function email(Request $request){	
		return redirect('/home');
	}

	public function json(Request $request){
		$GeradorJson = new GeradorJson();
		view('your-view')->with('leads', json_decode($leads, true));
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects to access indicators.
	*
	* @param Request
	* @return view
	*/
	public function show(Request $request)
	{		
		#-------Verify if user is Project 'Gerente'----------GP-----------------
		$isMembroAltaDir = $request->user()->isMembroAltaDir($request->user()->id);		
		if($isMembroAltaDir){ return $this->showProjetos($request);}
		#-----------------------------------------------------------------------
		$indicadores = Indicador::all();
		$projetos = Projeto::all();
		$fases = Fase::all();
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}
	public function showProjetos(Request $request){
		//$indicadores = Indicador::all();
		$projetos = Projeto::select('projetos.*' )
		    ->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
			->where('fase_projeto.fase_id', '<>',8)
			->where('projetos.status_id', '<>',3)
			->where('projetos.status_id', '<>',6)
            ->distinct()->get();
		//$fases = Fase::all();
		//$projetos = null;
		return view('relatorio.projetos', ['projetos' => $projetos, ]);
		#return view('relatorio.projetos', ['projetos' => $projetos, 'indicadores' => $indicadores, 'fases' => $fases,]);
	}

	/**
    * Access  by user 'LEP or GP' to modify projects status.
	*
	* @param Request
	*/
	public function create(Request $request)
	{
		
		return redirect('/relatorio/show');
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function relatorioPorProjeto(Request $request)  
	{	
		//$relatorio = new Relatorio (); 
		//$relatorioTXT = new MailRelatorio ($relatorio);
		//$relatorioTXT->build();
		#correto não mexer	24/08/2017
		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '=', $request->projeto_id)
            ->get();
        if(is_null($indicadores)){$indicadores=null;}
        # Sem o ->get() só recupera um. Se utilizar o  ->get() traz todos
		$projeto =  Projeto::findOrFail($request->projeto_id); 
		$fases = Fase::all();
		if(is_null($fases)){$fases=null;}
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $request->projeto_id)->get();
		$justificativa = array ();
		if(!is_null($result) && count($result) > 0){			                         			  						 			
			foreach($result as $ff){
				foreach($result as $ff){
					if(!is_null( $ff->justificativa_analise_aprovada ) && $ff->projeto_id == $request->projeto_id){
						$justificativa = array ('value' => $ff->justificativa_analise_aprovada);
					}
					break;
				}
			}
		}else{
			$justificativa = array ('value' => 'Sem Justificativa');
		}
		return view('relatorio.analisar', ['projeto' => $projeto,'indicadores' => $indicadores, 'fases' => $fases, 'justificativa' => $justificativa, ]);
	}
	
	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function geral(Request $request)
	{	
		#correto não mexer	24/08/2017
		//$indicadores = Indicador::all();if(is_null($indicadores)){$indicadores=null;}
		$projetos =  Projeto::select('projetos.*' )
		    ->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
			->where('fase_projeto.fase_id', '<>',8)
			->where('projetos.status_id', '<>',3)
			->where('projetos.status_id', '<>',6)
            ->distinct()->get();
        if(is_null($projetos)){$projetos=null;}
		$fases = Fase::all(); 
		if(is_null($fases)){$fases=null;}
		$indicadores=null;
		if(!is_null($projetos)){
			$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')->where('fase_projeto.projeto_id', '=', $request->projeto_id)
            ->get();
		}
		
        if(is_null($indicadores)){$indicadores=null;}
		return view('relatorio.geral', ['projetos' => $projetos ,'indicadores' => $indicadores, 'fases' => $fases, ]);
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
    * Access  by user Administrador' to change attributes role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function justificativaStore(Request $request)
	{
		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		$statusAprovado = 1;
		$statusCancelado = 3;
		$indicadores = Indicador::all();
		$projeto =  Projeto::findOrFail($request->projeto); # Sem o ->get() só recupera um. Se utilizar o  ->get() traz todos
		$fases = Fase::all();
		$request->session()->flash('message_error_justificar', 'Nao implementado!'); 
		$request->session()->flash('alert-class', 'alert-danger'); 
		return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		# not necessary verify if numbres is string, 
		# by this this numbers is string and is necessary convert to int numbers
		if ( ((int) $request->statusId) == $statusAprovado && is_null($request->aprovada) ){
			$request->session()->flash('message_error_justificar', 'A justificativa para o status ANALISE APROVADA deve ser informada!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( ((int) $request->statusId) == $statusCancelado && is_null($request->cancelada) ){
			$request->session()->flash('message_error_justificar', 'A justificativa para o status CANCELADO deve ser informada!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if( $this->validaDigito($request->statusId) == 0 || $this->validaDigito($request->projeto) == 0  ||
			$this->validaDigito($request->user) == 0  ){
			$request->session()->flash('message_error_justificar', 
					'Dados invalidos: Sem possibilidade de cadastrar o acompanhamento!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('relatorio.justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		$user = User::find($request->user);
		$statusModificado = new Statusmodificado();		
		# Verifica se é do tipo ANÁLISE APROVADA ou CANCELADO
		if ( ( (int) $request->statusId ) == $statusCancelado || ( (int) $request->statusId) == $statusAprovado ){
			# Verifica se EXISTE o projeto com o status foi modificado desse tipo
			if( $statusModificado->where('statusmodificados.projeto_id', $request->projeto_id)->exists() ){					
				# Verifica se é  do tipo ANÁLISE APROVADA
				if (  ( (int) $request->statusId) == $statusAprovado ){
					# Deve ser atualizado o status modificado do projeto
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'justificativa_analise_aprovada' =>$request->aprovada,'updated_at' => date('Y-m-d H:i:s')  ]);
				}
				# Verifica se é  do tipo CANCELADO
				if ( ( (int) $request->statusId ) == $statusCancelado  ){
					# Deve ser atualizado o status modificado do projeto
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'justificativa_cancelado' => $request->cancelada,'updated_at' => date('Y-m-d H:i:s') ]);
				}
				if($result){
					# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
					if($projeto->user_id == $request->user()->id ){
						
						$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]);
					# Verifica se quem está atualizando NÃO FOI QUEM CRIOU O PROJETO e atualiza
					}else{		
								
						$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);								
					}
					$request->session()->flash('message_succes_justificar',  'Status do projeto foi atualizado com sucesso!'); 
					$request->session()->flash('alert-class', 'alert-success'); 
				}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
				}
			#Em caso de NÃO EXISTE o projeto com o status foi modificado desse tipo
			}else{			
					$statusmodificado = new Statusmodificado();
					$statusmodificado	->user_id = $request->user()->id;
					$statusmodificado	->projeto_id = $request->projeto_id;	
					$statusmodificado	->status_id = $request->statusId;	
					$statusmodificado	->justificativa_analise_aprovada = null;	
					$statusmodificado	->justificativa_cancelado = null;	
					//$statusmodificado	->created_at; 
					//$statusmodificado	->updated_at = date(Y-m-d H:i:s)
					$result = $statusmodificado->save();
					if($result){
						# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						# Verifica se quem está atualizando NÃO FOI QUEM CRIOU O PROJETO e atualiza
						}else{			
							$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);	
						}									 
						$request->session()->flash('message_succes_justificar', 'Status do projeto foi inserido com sucesso!'); 
						$request->session()->flash('alert-class', 'alert-success');	
					}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
					}		
			}
		# Verifica se NÂO é do tipo ANÁLISE APROVADA ou CANCELADO
		}else{
			# Verifica se EXISTE O PROJETO com o status foi MODIFICADO desse tipo
			if( $statusModificado->where('statusmodificados.projeto_id', $request->projeto_id)->exists() ){	
					# Deve ATUALIZAR O STATUS modificado do projeto
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'updated_at' => date('Y-m-d H:i:s')  ]);
					if($result){
						# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]);
						# Verifica se quem está atualizando NÃO FOI QUEM CRIOU O PROJETO e atualiza
						}else{				
							$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);
						}
						$request->session()->flash('message_succes_justificar',  'Status do projeto foi atualizado com sucesso!'); 
						$request->session()->flash('alert-class', 'alert-success'); 
					}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
					}
			# Em caso de NÃO EXISTE o projeto com o status foi modificado desse tipo
			}else{
					# Deve ser CRIADO o status modificado do projeto
					$statusmodificado = new Statusmodificado();
					$statusmodificado	->user_id = $request->user()->id;
					$statusmodificado	->projeto_id = $request->projeto_id;	
					$statusmodificado	->status_id = $request->statusId;	
					$statusmodificado	->justificativa_analise_aprovada = null;	
					$statusmodificado	->justificativa_cancelado = null;	
					//$statusmodificado	->created_at;	 
					//$statusmodificado	->updated_at = date(Y-m-d H:i:s)
					$result = $statusmodificado->save();	
					if($result){						# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]);
						# Verifica se quem está atualizando NÃO FOI QUEM CRIOU O PROJETO e atualiza
						}else{				
							$result = Projeto::where('id', $request->projeto_id)->update(['status_id' => $request->statusId,]);
						}
						$request->session()->flash('message_succes_justificar',  'Status do projeto foi inserido com sucesso!'); 
						$request->session()->flash('alert-class', 'alert-success');
					}else{
						$request->session()->flash('message_error_justificar', 'Falhou a tentativa de atualizar!'); 
						$request->session()->flash('alert-class', 'alert-danger'); 
					} 			
			}	
		}
		$justificativa [] = $request->aprovada;
		return view('relatorio.justificar', ['projeto' => $projeto,  'indicadores' => $indicadores,  'fases' => $fases, 'justificativa' => $justificativa,]);
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
		//echo '======nomeProjetoBusca=======('. $request->buscarProjeto .')/............</br>';
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();
		try{
			
			$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('nome', 'like', '%' . $request->buscarProjeto . '%')
						->orderBy('nome')
						->distinct()
						->get();

	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
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
		//echo '======buscarOrdenarPor=======('. $request->ordenarProjeto .')/............</br>';
		$ordenarPor = $request->ordenarProjeto;
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();;
	
		try{
			if($ordenarPor === 'NOMEDOPROJETO'){
				$ordenarPor = 'nome';
				//$projetos =  Projeto::where('nome','<>',null)->orderBy($ordenarPor, 'asc')->get();
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('nome','<>',null)
						->orderBy('nome')
						->distinct()
						->get();									
			}
			if($ordenarPor == 'NOMEDOGERENTE'){
				$ordenarPor = 'gerente_responsavel';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('gerente_responsavel','<>',null)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();									
			}
			if($ordenarPor == 'DATAINICIAL'){
				$ordenarPor = 'data_de_inicio';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();									
			}
			if($ordenarPor == 'DATAFINAL'){
				$ordenarPor = 'previsao_de_termino';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();					
			}
			if($ordenarPor == 'STATUS'){
				$ordenarPor = 'status_id';
				$projetos = Projeto::select('projetos.*' )
						->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')     
						->where('fase_projeto.fase_id', '<>',8)
						->where('projetos.status_id', '<>',3)
						->where('projetos.status_id', '<>',6)
						->where('status_id','<>',null)
						->orderBy($ordenarPor, 'asc')
						->distinct()->get();		
			}
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('relatorio.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}
}#end class