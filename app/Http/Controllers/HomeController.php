<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NewUserWelcome;
use Auth;
use App\Projeto;
use App\licoesaprendidas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->middleware('auth');		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # ---------------------------------------------------------------------
	    # the project to week checked are make in ProjetoController class index
		# ---------------------------------------------------------------------
		$FaseEncerrada = 8;
		$statusEncerrado = 6;
		$statusCancelada = 3;
		$ClassificacaoAltoRisco = 1;
		$projetos = Projeto::select('projetos.*' )
		    ->join('fase_projeto', 'projetos.id', '=', 'fase_projeto.projeto_id')       
			->where('fase_projeto.fase_id', '<>', $FaseEncerrada)	
			->where('projetos.status_id', '<>', $statusCancelada)
			->where('projetos.status_id', '<>', $statusEncerrado)
			->where('projetos.classificacao_id', '=', $ClassificacaoAltoRisco)
            ->distinct()->get();

		// $licoesaprendidas = licoesaprendidas::select('licoesaprendidas.*')
  //           ->where('licoesaprendidas.projeto_id', '>', 0)->get();
  //    	if(is_null($licoesaprendidas) || count($licoesaprendidas) == 0){
  //    		$licoesaprendidas = null;
  //    	}
		return view('home', ['projetos' => $projetos,]);//'licoesaprendidas' => $licoesaprendidas]);
    }
	public function email()
    {
        return redirect('/home');
    }
	public function contato() {
		return view('pages.contato');
	}
	public function postContato() {
		$rules = array( 'nome' => 'required', 'email' => 'required|email', 'texto' => 'required' );
		$validation = Validator::make(Input::all(), $rules);
		$data = array();
		 $data['nome'] = Input::get("nome");
		 $data['email'] = Input::get("email");
		 $data['texto'] = Input::get("texto");
		if($validation->passes()) {
			 Mail::send('emails.contato', $data, function($message) {
				 $message->from(Input::get('email'), Input::get('nome'));
				 $message->to('contato@portifoliogestor.com') ->subject('Contato Bill Jr.');
			 });
			return Redirect::to('contato') ->with('message', 'Mensagem enviada com sucesso!');
		 }
		return Redirect::to('contato') 
		 ->withInput() 
		 ->withErrors($validation) 
		 ->with('message', 'Erro! Preencha todos os campos corretamente.');
	}
}
