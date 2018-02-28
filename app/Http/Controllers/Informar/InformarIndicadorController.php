<?php

namespace App\Http\Controllers\Informar;

use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Fase;
use App\Valor;
use App\Projeto;
use App\Indicador;
use App\FaseProjeto;
use App\Relatorio;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositorios\IndicadorRepository;
use App\Http\Controllers\Fase\FaseController;
use App\Http\Controllers\Relatorio\RelatorioComtroller;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class InformarIndicadorController extends Controller
{
    protected $indicadoresRepo;
	protected $faseController;
	protected $email;
	protected $ERROR_VALOR_MAXIMO_INVALIDO = 'Valor inalido: Utilize algarismos entre 0 - 9!'; 
	protected $ERROR_VALOR_MAXIMO_INVALIDO__ULTRAPASSOU_LIMITE = 'Valor invalido: Superior ao limite esperado!'; 
	protected $ERROR_VALOR_MAXIMO_INVALIDO__ABAIXO_DO_LIMITE = 'Valore invalido: valor informado deve ser maior que -0-zero !'; 
			                          
    //constructor
	public function __construct(IndicadorRepository $indicadoresRepo, FaseController $faseController) 
	{
		$this->middleware('auth.lep');
		$this->indicadoresRepo = $indicadoresRepo;
		$this->faseController = $faseController;
		//$this->middleware("auth", ["only"=>["create","edit"]]);
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects to access indicators.
	*
	* @param Request
	* @return view
	*/
	public function InformarIndicadoresShow(Request $request)
	{
		$projetoID = DB::table('projetos')->select('id')->where('gerente_responsavel',  $request->user()->id)->get();
		$ids = array();
		$ids2 = array();
		$projetos = null;
		if(!is_null($projetoID)){
			foreach ($projetoID as $key => $value) {
				$ids [] = (intval($value->id));
			}
		}
		if(!is_null($projetoID)){
			$temIndicador = DB::table('fase_projeto')->select('projeto_id')->whereNotIn('id', $ids )->get();
			foreach ($ids as $key => $value) {
				foreach ($temIndicador as $key2 => $value2) {
					
					if( $value === (intval($value2->projeto_id)) ){
						$ids2 [] = (intval($value2->projeto_id));
					}
				}
			}
			if(count($ids2 )>0){
				$projetos = Projeto::whereIn('id', $ids2 )->get();
			}
		}
		return view('indicadores.projetos', ['projetos' => $projetos,]);                           
	}

	/**
	*
    * Access  by user 'LEP and GP' to lists projects.
	*
	* @param Request
	* @return view
	*/
	public function informarIndicadorEdit(Request $request)
	{	
		$indicadores = Indicador::select('indicadors.*', 'fase_projeto.*' )
            ->join('fase_projeto', 'indicadors.id', '=', 'fase_projeto.indicador_id')
            ->where('fase_projeto.projeto_id', '=', $request->projeto_id)
            ->get();

		$projeto =  Projeto::findOrFail($request->projeto_id); 
		$fases = Fase::all();
		return view('indicadores.informar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
	}
	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function store(Request $request)
	{
		 # config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');
		$indicadores = Indicador::all();
		$projeto =  Projeto::findOrFail($request->projeto_id);
		$fases = Fase::all();

		# ñot necessary verify if numbres is string, by this this numbers is string and is necessary convert to int numbers

		if ( is_null( $request->valormaximo) ){
			$request->session()->flash('message_error_informar', $this->ERROR_VALOR_MAXIMO_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('indicadores.informar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if ( !is_numeric( $request->valormaximo) ){
			$request->session()->flash('message_error_informar', $this->ERROR_VALOR_MAXIMO_INVALIDO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('indicadores.informar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if($request->valormaximo > PHP_INT_MAX){
			$request->session()->flash('message_error_informar', $this->ERROR_VALOR_MAXIMO_INVALIDO__ULTRAPASSOU_LIMITE); 
			$request->session()->flash('alert-class', 'alert-danger');
			return view('indicadores.informar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}
		if( $request->valormaximo < 0 ){
			$request->session()->flash('message_error_informar', $this->ERROR_VALOR_MAXIMO_INVALIDO__ABAIXO_DO_LIMITE); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return view('indicadores.informar', ['projeto' => $projeto,
		                                'indicadores' => $indicadores,
		                                'fases' => $fases,]);
		}


	

		$user = User::find($request->user_id);


		if($user->valores()->where('valors.fase_projeto_id', $request->indicadorProjeto)->exists()){					
				$valor = new Valor();
				$result = Valor::where('fase_projeto_id', $request->indicadorProjeto)
								 ->update([								
								 'valor_maximo' => $request->valormaximo, 
								 'updated_at' => date('Y-m-d H:i:s') ]);
				$request->session()->flash('message_success_informar',  'Valores do indicador foram atualizados com sucesso!' ); 
				$request->session()->flash('alert-class', 'alert-success'); 
		}else{	// salvar o valor informado		
				$valor = new Valor();
				$valor	->user_id = $request->user()->id;
				$valor	->fase_projeto_id = $request->indicadorProjeto;				
				$valor	->valor_minimo = null;				
				$valor	->valor_maximo = $request->valormaximo;
				$valor	->created_at = date('Y-m-d H:i:s');
				$valor	->updated_at = date('Y-m-d H:i:s');
				$result = $valor->save();													 
				$request->session()->flash('message_success_informar', 'Valores do Indicador foram adicionados com sucesso!'); 
				$request->session()->flash('alert-class', 'alert-success');
		}
		//Recupera dados dos indicadores
		$arrayDeIndicadoresToEmail = $this->verificarNivelDoValorInformadoParaIndicador($request);

		// Enviar email
		if(!is_null($arrayDeIndicadoresToEmail)){
			$this->sendEmail($request, $arrayDeIndicadoresToEmail);
		}
		// retornar a tela 
		return view('indicadores.informar', ['projeto' => $projeto, 'indicadores' => $indicadores,
											 'fases' => $fases,])->with('message', 'Atividade realizada com sucesso!');
	}
	/**
	* Verifica se os valor informado do Indicador está dentro do limite esperado.
	* Caso três ou mais valores não estejam dentro do limite esperado:
	* - será enviado um emial aos menbros da alta direção.
	* [Requisito funcional] - O sistema deve emitir um e-mail aos membros da alta direção
	* quando três ou mais indicadores de uma fase do projeto estiverem fora do limite esperado
	*
	* metodo verifica quantidade de indicadores que estão fora do limite esperado:
	**/
	public function verificarNivelDoValorInformadoParaIndicador(Request $request){
        $projeto = Projeto::find($request->projeto_id);
		if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) ){ 
			if($projeto->isQualIndicador( $projeto->id)){			  
				if(!is_null($projeto->idUltimaFaseDoProjeto($projeto->id)) && $projeto->idUltimaFaseDoProjeto($projeto->id) > 0 ){ 
					$texto = array();
					$contadorIndicador = 0;
					$contadorValor = 0;
					$indicadores = $projeto->indicadoresDoProjeto( $projeto->id); 
					foreach($indicadores as $indic){ 
						if($projeto->isQualIndicador( $projeto->id)){ 								
							$valoresInformados = $indic->valoresInformados($indic->id, $projeto->id);
							if(!is_null($valoresInformados)){ 
								foreach($valoresInformados as $valoresInf){ 
								   if($projeto->idUltimaFaseDoProjeto($projeto->id) == $indic->fase_id){
										if( $indic->id == $valoresInf->fase_projeto_id ){
											$texto ['Projeto'] = ' - '. $projeto->nome;
											$texto ['FASE'] = ' - '. $indic->nomeFase($indic->fase_id);
											if ($valoresInf->valor_maximo < $indic->valor_minimo){
												$contadorValor = $contadorValor + 1;
												$texto [$indic->nome] = ' ABAIXO - '. $valoresInf->valor_maximo;
											}
											if ($valoresInf->valor_maximo > $indic->valor_maximo){
												$contadorValor = $contadorValor + 1;
												$texto [$indic->nome] = ' ACIMA - '. $valoresInf->valor_maximo;
											}
											if ($valoresInf->valor_maximo >= $indic->valor_minimo
												&& $valoresInf->valor_maximo <= $indic->valor_maximo){
											}
										}	
									}
								}
							}
						}
					}
					// se existir mais de dois indicadores na última fase com valores fora do limite
					// esperado retorna os indicadores
					if( $contadorValor > 2){
						return $texto;
					}					
					$contadorValor = 0;
					return null;
				}// ultima fase
			}
		}
	}


	/** NÃO DEVE SER CHAMADO NO FaseController poor causa do construtor
	*
    * Access  by user Lider do Escritório de Projetos to remove valor of table
	*
	* @param Request
	* @return boolean 
	*/
	public function destroyValor(Request $request)
	{
		$resultadoValor = Valor::where('valors.fase_projeto_id', '=', $request->fase)->first();
		# verify if exists value in table
		if ( !$resultadoValor->exists() ){
			return Valor::where('valor_id', $request->valor)->delete();
			return 1;
		}
		return 0;
	}

	/** 
	* Hith Administration - Alta direção 
    * Request user´s mail to send statistics of level indicators inconsistence level
	* Recupera os emails dos usuários da alta direção no caso de indicador fora de nível
	* @param Request
	* @return array 
	*/
	public function allUsersMails()
	{
		// $items = DB::table('items')->whereIn('id', [1, 2, 3])->get();
		# verify if exists value in table
		$resultadoMails = User::select('users.*', 'email' )
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '=', 5 )
            ->get();
        $eMails = array();
		if ( !is_null($resultadoMails) ){
			foreach ($resultadoMails as $usermail) {	
			    $eMails [] = $usermail->email;
			}
			return $eMails;
		}
		return null;
	}


	/**
	* Função responsável por envia email aos membros da ata direção em caso de 
	* indicadores fora do nível esperado
	*/
	public function sendEmail(Request $request,  $IndicadorForaDoNivel )
    {
        # config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');
		$data = 'Um email de Mail';
		if(is_null($IndicadorForaDoNivel)){ return; }
        $emailAltadirecao = $this->allUsersMails();
        if(is_null($emailAltadirecao)){ return; }
		//$Relatorio = new Relatorio();
		$data = 'Um email de Mail';
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		$from = 'nao-responda@portifoliogestor.com';
		$to = 'administrador@portifoliogestor.com';
		$subject = 'Indicadore fora do nível esperado';
		$message = 'Em: '.date('d/m/Y H:i:s') . "\r\n";
		$message .= 'Atencao: Relatorio de Indicadores fora do nivel esperado'. "\r\n";
		foreach ($IndicadorForaDoNivel as $key => $value) {
			$message .= $key . ' ' . $value . "\r\n";
		}
		$message .=  ' ' . "\r\n";
		$message .= 'Remetente: Sistema Portifolio Gestor.';
		$headers = 'MIME-Version: 1.0' . "\r\n" .
				   'Content-type: text/plain; charset=iso-8859-1' . "\r\n" .
		 		   'From: '.$from. "\r\n" .
		 		   'Cc: ';
		 		   foreach ($emailAltadirecao as $CcMail) {
		 		   		$headers .= ', '. $CcMail ;
		 		   }
		 		   $headers .= "\r\n".
				   'Reply-To: administrador@portifoliogestor.com' . "\r\n" .
				   'Subject:'.$subject. "\r\n" .
				   'X-Mailer: PHP/' . phpversion();
       mail($to, $subject, $message, $headers);
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
		    $projetos =  Projeto::where('nome', 'like', '%' . $request->nomeProjetoBusca . '%')->orderBy('nome')->get();
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('indicadores.fases', ['projetos' => $projetos, 'indicadores' => $indicadores, 'fases' => $fases,]);
	}

	/**
	*
    * Access  by user 'Gerente de Projetos' to lists projects sort.
	*
	* @param Request, Indicador
	* @return boolean
	*/
	public function buscarOrdenarPor(Request $request)
	{
		$ordenarPor = $request->nomeProjetoOrdenar;
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
		return view('indicadores.fases', ['projetos' => $projetos,'indicadores' => $indicadores, 'fases' => $fases,]);
	}
}