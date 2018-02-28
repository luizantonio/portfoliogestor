<?php

namespace App\Http\Controllers\Status;

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

class StatusmodificadoController extends Controller
{
    protected $projetoController;

    //constructor
	public function __construct(ProjetoController $projetoController)
	{
		$this->projetoController = $projetoController;
		$this->middleware('auth.lep');
		$this->middleware('auth.gp');
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
		#-------Verify if user is Project 'Gerente'----------GP----------------------------
		$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
		if($isGerenteDeProjeto){ return $this->showGerente($request);}
		#----------------------------------------------------------------------------------
		$indicadores = Indicador::all();
		$projetos = Projeto::all();
		$fases = Fase::all();
		
		return view('status.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}
	public function showGerente(Request $request){
		$indicadores = Indicador::all();
		$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->get();
		$fases = Fase::all();
		return view('status.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}

	/**
    * Access  by user 'LEP or GP' to modify projects status.
	*
	* @param Request
	*/
	public function create(Request $request)
	{
		// vetor de mensagens personalizadas
		/*$messages = array(
			'required' => 'O campo :attribute é obrigatório!',
			'min' => 'O campo :attribute deve apresentar 6 caracteres no mínimo!',
			'string' => 'O campo :attribute deve ser um texto!',
		);*/
		//($input, $rules, $messages);
		/*$this->validate($request, [
			'name' => 'required|string|min:6|max:100',
			
		],
        $messages
		);
		*/
		try{
		    # config(['app.timezone' => 'UTC']);
		    # config(['app.timezone' => 'America/Sao_Paulo']);
		    # DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
			date_default_timezone_set('America/Sao_Paulo');
			#  'user_id', 'projeto_id', 'status_id', 'justificativa_analise_aprovada',
			#  'justificativa_cancelado', 'created_at', 'updated_at',

			$request->user()
			->statusProjeto()
			->create([
				'user_id' => $request->user(),
				'projeto_id' => $request->projeto_id,
				'status_id' => $request->status_id,
				'justificativa_analise_aprovada' => $request->justificativa_analise_aprovada,
				'justificativa_cancelado' => $request->justificativa_cancelado,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 			
			]);


			// Statusmodificado::create([
			// 	create([
			// 	'user_id' => $request->user(),
			// 	'projeto_id' => $request->projeto_id,
			// 	'status_id' => $request->status_id,
			// 	'justificativa_analise_aprovada' => $request->justificativa_analise_aprovada,
			// 	'justificativa_cancelado' => $request->justificativa_cancelado,
			// 	'created_at' => date('Y-m-d H:i:s'),
			// 	'updated_at' => date('Y-m-d H:i:s'), 			



		}catch ( PDOException $e){
			$e->message();
		}
		return redirect('/status/show');
	}
	
	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function justificarProjetoTexto(Request $request)
	{	
		#---------------------------------------------------------------------------
		#			correto não mexer	24/08/2017
		##--------------------------------------------------------------------------

		$projeto =  Projeto::findOrFail($request->projeto_id); 
		
		$fases = Fase::all();
		$result = Statusmodificado::select('statusmodificados.*' )->where('projeto_id', '=', $request->projeto_id)->get();
		$justificativa = array ();
		if(!is_null($result) && count($result) > 0 && !is_null($projeto)){			                         			  						 			
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
		
		
		return view('status.justificar', ['projeto' => $projeto, 'justificativa' => $justificativa, ]);
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
		# not necessary verify if numbres is string, by this this numbers is string and is necessary convert to int numbers
		if ( ((int) $request->statusId) == $statusAprovado && is_null($request->aprovada) ){
			$request->session()->flash('message_error_justificar', 'A justificativa para o status ANALISE APROVADA deve ser informada!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('status/justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( ((int) $request->statusId) == $statusCancelado && is_null($request->cancelada) ){
			$request->session()->flash('message_error_justificar', 'A justificativa para o status CANCELADO deve ser informada!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('status/justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}

		if( $this->validaDigito($request->statusId) == 0 || $this->validaDigito($request->projeto) == 0  || $this->validaDigito($request->user) == 0  ){
			$request->session()->flash('message_error_justificar', 
					'Dados invalidos: Sem possibilidade de cadastrar o acompanhamento!'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('status/justificar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}

		$user = User::find($request->user);
		
		$statusModificado = new Statusmodificado();		
		#------------------------------------------------------------------------
		# Verifica se é do tipo ANÁLISE APROVADA ou CANCELADO
		if ( ( (int) $request->statusId ) == $statusCancelado || ( (int) $request->statusId) == $statusAprovado ){
			#--------------------------------------------------------------------
			# Verifica se EXISTE o projeto com o status foi modificado desse tipo
			if( $statusModificado->where('statusmodificados.projeto_id', $request->projeto_id)->exists() ){					
				#--------------------------------------------------------------------
				# Verifica se é  do tipo ANÁLISE APROVADA
				if (  ( (int) $request->statusId) == $statusAprovado ){
					# Deve ser atualizado o status modificado do projeto
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'justificativa_analise_aprovada' =>$request->aprovada,'updated_at' => date('Y-m-d H:i:s')  ]);
				}
				#--------------------------------------------------------------------
				# Verifica se é  do tipo CANCELADO
				if ( ( (int) $request->statusId ) == $statusCancelado  ){
					# Deve ser atualizado o status modificado do projeto								
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'justificativa_cancelado' => $request->cancelada,'updated_at' => date('Y-m-d H:i:s') ]);
				}
				if($result){
					#----------------------------------------------------------------
					# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
					if($projeto->user_id == $request->user()->id ){
						var_dump('---------------------------------329--------------------------');
						$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
					#----------------------------------------------------------------
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
				
			#------------------------------------------------------------------------
			# Em caso de NÃO EXISTE o projeto com o status foi modificado desse tipo
			#------------------------------------------------------------------------
			}else{			
					$statusmodificado = new Statusmodificado();
					$statusmodificado	->user_id = $request->user()->id;						
					$statusmodificado	->projeto_id = $request->projeto_id;	
					$statusmodificado	->status_id = $request->statusId;	
					if(is_null($request->aprovada)){$statusmodificado->justificativa_analise_aprovada= null;
					}else{ $statusmodificado->justificativa_analise_aprovada = $request->aprovada;}	
					if(is_null($request->cancelada)){ $statusmodificado->justificativa_cancelado= null;
					}else{ $statusmodificado->justificativa_cancelado = $request->cancelada;}
					# $statusmodificado	->created_at;
					# $statusmodificado	->updated_at = date(Y-m-d H:i:s)
					$result = $statusmodificado->save();	
					if($result){
						#----------------------------------------------------------------
						# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						#----------------------------------------------------------------
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
		#------------------------------------------------------------------------
		# Verifica se NÂO é do tipo ANÁLISE APROVADA ou CANCELADO
		}else{
			#--------------------------------------------------------------------
			# Verifica se EXISTE O PROJETO com o status foi MODIFICADO desse tipo
			if( $statusModificado->where('statusmodificados.projeto_id', $request->projeto_id)->exists() ){	
					#----------------------------------------------------------------
					# Deve ATUALIZAR O STATUS modificado do projeto								
					$result = Statusmodificado::where('projeto_id', $request->projeto_id)->update(['user_id' => $request->user()->id,'status_id' => $request->statusId ,'updated_at' => date('Y-m-d H:i:s')  ]);
					if($result){						
						#----------------------------------------------------------------
						# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						#----------------------------------------------------------------
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
					
			#-------------------------------------------------------------------
			# Em caso de NÃO EXISTE o projeto com o status foi modificado desse tipo
			}else{    # var_dump($request->user()->id);	
				#----------------------------------------------------------------
					# Deve ser CRIADO o status modificado do projeto						
					# $result = Statusmodificado::where('projeto_id', $request->projeto_id)->create(['user_id' => $request->user()->id, 'projeto_id' => $request->projeto_id, 'status_id' => $request->statusId ,'updated_at' => date('Y-m-d H:i:s')  ]); 
					$statusmodificado = new Statusmodificado();
					$statusmodificado	->user_id = $request->user()->id;						
					$statusmodificado	->projeto_id = $request->projeto_id;	
					$statusmodificado	->status_id = $request->statusId;	
					$statusmodificado	->justificativa_analise_aprovada = null;	
					$statusmodificado	->justificativa_cancelado = null;	
					# $statusmodificado	->created_at;	 
					# $statusmodificado	->updated_at = date(Y-m-d H:i:s)
					$result = $statusmodificado->save();	
					if($result){
						#----------------------------------------------------------------
						# Verifica se quem está atualizando FOI QUEM CRIOU O PROJETO e atualiza
						if($projeto->user_id == $request->user()->id ){
							$request->user()->projetos()->where('id', $request->projeto_id)->update(['status_id' => $request->statusId,'updated_at' => date('Y-m-d H:i:s') ]); 
						#----------------------------------------------------------------
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
				
		return $this->show($request);
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
		# echo '======nomeProjetoBusca=======('. $request->buscarStatus .')/............</br>';
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();;
		try{
			#-------Verify if user is Project 'Gerente'----------GP----------------------------
			$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
			if($isGerenteDeProjeto){ 
				$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->where('nome', 'like', '%' . $request->buscarStatus . '%')->orderBy('nome')->get();			
			#----------------------------------------------------------------------------------
			}else{
				$projetos =  Projeto::where('nome', 'like', '%' . $request->buscarStatus . '%')->orderBy('nome')->get();	
			}	
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('status.projetos', ['projetos' => $projetos,
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
		
		$ordenarPor = $request->ordenarPorStatus;
		$projetos[] = array();
		$indicadores [] = array();
		$indicadores = Indicador::all();
		$fases = Fase::all();;
		try{
			if($ordenarPor === 'NOMEDOPROJETO'){
				$ordenarPor = 'nome';
				#-------Verify if user is Project 'Gerente'----------GP----------------------------
				$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
				if($isGerenteDeProjeto){ 
					$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->orderBy($ordenarPor, 'asc')->get();
				#----------------------------------------------------------------------------------
				}else{
					$projetos =  Projeto::where('nome','<>',null)->orderBy($ordenarPor, 'asc')->get();					
				}
			}
			if($ordenarPor == 'NOMEDOGERENTE'){
				$ordenarPor = 'gerente_responsavel';
				#-------Verify if user is Project 'Gerente'----------GP----------------------------
				$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
				if($isGerenteDeProjeto){ 
					$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->orderBy($ordenarPor, 'asc')->get();
				#----------------------------------------------------------------------------------
				}else{
					$projetos =   Projeto::where('gerente_responsavel','<>',null)->orderBy($ordenarPor, 'asc')->get();				
				}				
			}
			if($ordenarPor == 'DATAINICIAL'){
				$ordenarPor = 'data_de_inicio';
				#-------Verify if user is Project 'Gerente'----------GP----------------------------
				$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
				if($isGerenteDeProjeto){ 
					$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->orderBy($ordenarPor, 'asc')->get();
				#----------------------------------------------------------------------------------
				}else{
					$projetos =   Projeto::where('gerente_responsavel','<>',null)->orderBy($ordenarPor, 'asc')->get();				
				}				
			}
			if($ordenarPor == 'DATAFINAL'){
				$ordenarPor = 'previsao_de_termino';
				#-------Verify if user is Project 'Gerente'----------GP----------------------------
				$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
				if($isGerenteDeProjeto){ 
					$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->orderBy($ordenarPor, 'asc')->get();
				#----------------------------------------------------------------------------------
				}else{
					$projetos =   Projeto::where('gerente_responsavel','<>',null)->orderBy($ordenarPor, 'asc')->get();				
				}
			}
			if($ordenarPor == 'STATUS'){
				$ordenarPor = 'status_id';
				#-------Verify if user is Project 'Gerente'----------GP----------------------------
				$isGerenteDeProjeto = $request->user()->isGerenteProjetos($request->user()->id);		
				if($isGerenteDeProjeto){ 
					$projetos = Projeto::where('gerente_responsavel','=', $request->user()->id)->orderBy($ordenarPor, 'asc')->get();
				#----------------------------------------------------------------------------------
				}else{
					$projetos =    Projeto::where('status_id','<>',null)->orderBy($ordenarPor, 'asc')->get();		
				}
			}
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('status.projetos', ['projetos' => $projetos,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}	
}