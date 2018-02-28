<?php

/*
|---------------------------------------------------------
| Web Routes
|---------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
 
use Illuminate\Http\Response;
use Illuminate\Http\Request; 

// Route::get('/', function () {
//     return view('welcome');
// }); 

//Route::get('/admin/home','Admin\AdministradorController@home')->middleware('auth')->name('home'); 


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email', 'HomeController@email')->name('sendemail');



# atualizações 12/08/2017 13:00hs


//Route::get('/', function () { return view('/index'); })->middleware('auth.admin')->name('index'); # [ok] Home do Administrador
/*
Route::get('/', function () {
    return view('index');
})->name('index');
*/
#----------------------------------END----------------------------------
# created by Luiz 25-07-2017 
# PROJETOS
#-----------------------------------------------------------------------
Route::get('/','ProjetoController@index')->name('projetos.index');							# [ok] Formulário de novo Projeto
Route::get('/projetos/show','ProjetoController@show')->name('projetos.show');				# [ok] Exibir os Projetos
Route::get('/projetos/create','ProjetoController@cadastro')->name('projetos.cadastro');		# [ok] Formulário de novo Projeto
Route::get('/projeto','ProjetoController@create')->name('projetos.create');				# [ok] Ação (Botão) do Formulário para Cadastrar novo Projeto
Route::delete('/projeto/{projeto}','ProjetoController@destroy')->name('projetos.delete');				# [ok] Deletar um Projeto
Route::get('/update/{projeto}','ProjetoController@update')->name('projetos.update');		# [ok] formulário de Atualizar Um Projeto
Route::get('/atualizar','ProjetoController@atualizar')->name('projetos.atualizar');			# [ok] Ação (Botão) do Formulário para Atualizar novo Projeto
Route::post('/buscar','ProjetoController@buscarPorNome')->name('projetos.buscar');			# [ok] Formulário de Buscar um  Projeto
Route::post('/ordenar','ProjetoController@buscarOrdenarPor')->name('projetos.ordenarPor');	# [ok] Formulário de Ordenar um  Projeto
Route::put('/projetos/detalhes/{projeto_id}','ProjetoController@detalhes')->name('projetos.detalhes'); # [Ok] Exibe os detalhes do projeto
#  created by Luiz 2017-09-13
Route::put('/semanal','Semanal\SemanalController@update')->name('semanal.update');
Route::get('/semanal/show','Semanal\SemanalController@show')->name('semanal.show');
Route::delete('/semanal/{id}','Semanal\SemanalController@destroy')->name('semanal.delete');

#----------------------------------END----------------------------------
# created by Luiz 30-07-2017 
# ADMINISTRADOR
#-----------------------------------------------------------------------
//Route::get('/admin/home', function () { return view('/admin/home'); })->middleware('auth.admin'); # [ok] Home do Administrador

Route::group(['middleware' => ['auth', 'auth.admin']], function () {
	//Route::get('/admin/home','Admin\AdministradorController@home');
	Route::get('/admin','Admin\AdministradorController@index');						# [ok] Formulário de novo Usuário
	Route::get('/admin/show','Admin\AdministradorController@show');					# [ok] Exibir os Usuários
	Route::post('/admin/register','Admin\AdministradorController@create');			# [ok] Criar um Usuário
	Route::delete('/admin/{id}','Admin\AdministradorController@destroy');							# [ok] Deletar um Usuário
	Route::put('/admin/update/{id}','Admin\AdministradorController@update')->name('admin.update');		# [ok] Formulário de Atualizar Um Projeto
	Route::put('/admin/atualizar','Admin\AdministradorController@atualizar')->name('admin.atualizar');	# [ok] Ação (Botão) do Formulário para Atualizar novo Projeto
	Route::post('/admin/buscar','Admin\AdministradorController@buscarPorNome')->name('admin.buscar');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/admin/ordenar','Admin\AdministradorController@buscarOrdenarPor')->name('admin.ordenarPor'); # [ok] Formulário de Ordenar um  Projeto
	Route::post('/admin/buscarpermissao','Admin\AdministradorController@buscarPorNomePermissao')->name('admin.buscarPermissao');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/admin/ordenarpermissao','Admin\AdministradorController@buscarOrdenarPorPermissao')->name('admin.ordenarPorPermissao'); # [ok] Formulário de Ordenar um  Projeto
	Route::get('/admin/permissao','Admin\AdministradorController@permissaoRole')->name('admin.permissaoRole'); # [Ok] Formulário de Ordenar um  Projeto
	Route::put('/admin/change/','Admin\AdministradorController@mudarPermissao')->name('admin.changeRole');		# [ok] Formulário de Atualizar Um Projeto
	Route::put('/admin/role/{userid}/{adm}/{ger_proj}/{lider_escr_proj}/{lider_proj}/{membro_alta_dir}', 'Admin\AdministradorController@mudarPermissao'); # [ok] Atualiza o perfil (tipo) usuário
});

#----------------------------------END----------------------------------
# created by Luiz
# 28/08/2017 15:30:00 - Líder do Escritório de Projetos ou Gerente de Projetos
# ALTER PROJECT STATUS 
#-----------------------------------------------------------------------
Route::group(['middleware' => ['auth', 'auth.lep', 'auth.gp']], function () {
	Route::get('/status/status/','Status\StatusmodificadoController@show')->name('status.show');			# [ok] Exibir projetos para informar indicadores
	Route::put('/status/status/{projeto_id}','Status\StatusmodificadoController@justificarProjetoTexto')->name('status.status');			# [ok] Exibir projetos para informar indicadores
	Route::put('/status/justificar/{projeto_id}','Status\StatusmodificadoController@justificativaStore')->name('status.storejustificar');			# [ok] Exibir projetos para informar indicadores	
	Route::post('/status/buscarstatus','Status\StatusmodificadoController@buscarPorNome')->name('status.buscarStatus');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/status/ordenarstatus','Status\StatusmodificadoController@buscarOrdenar')->name('status.ordenarPorStatus'); # [ok] Formulário de Ordenar um  Projeto
});

#----------------------------------END-----------------------------------
# created by Luiz 10-08-2017  DD-MM-YYYY - 15-08-2017
# LIDER DO ESCRITÓRIO DE PROJETOS
# INDICADORES
#-----------------------------------------------------------------------
Route::group(['middleware' => ['auth', 'auth.lep']], function () {
	//Route::get('/indicadores/home','Indicador\IndicadorController@home')->name('indicador.home');
	Route::get('/indicadores/','Indicador\IndicadorController@index')->name('indicador.index');				# [ok] Formulário de novo Usuário
	Route::get('/indicador/cadastro','Indicador\IndicadorController@cadastro')->name('indicador.cadastro');	# [ok] Formulário de novo Usuário
	Route::post('/indicadores/create','Indicador\IndicadorController@create')->name('indicador.create');	# [ok] Criar um Usuário
	Route::get('/indicadores/show','Indicador\IndicadorController@show')->name('indicador.show');			# [ok] Exibir os Usuários	
	Route::delete('/indicador/{id}','Indicador\IndicadorController@destroy')->name('indicador.destroy');	# [ok] Deletar um Usuário
	Route::put('/indicador/update/{id}','Indicador\IndicadorController@update')->name('indicador.update');		# [ok] Formulário de Atualizar Um Projeto
	Route::put('/indicador/atualizar/{indicador_id}','Indicador\IndicadorController@atualizar')->name('indicador.atualizar');	# [ok] Ação (Botão) do Formulário para Atualizar novo Projeto
	Route::post('/indicadores/buscar','Indicador\IndicadorController@buscarPorNome')->name('indicador.buscar');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/indicadores/ordenar','Indicador\IndicadorController@buscarOrdenarPor')->name('indicador.ordenarPor'); # [ok] Formulário de Ordenar um  Projeto
	Route::post('/indicadores/json','Indicador\IndicadorController@indicadoresDaFase')->name('indicador.indicadoresDaFase'); # [ok] Formulário de Ordenar um  Projeto
	Route::get('/indicadores/fases','Indicador\IndicadorController@associarFaseAoProjeto')->name('indicador.fases'); # [Ok] Formulário de Ordenar um  Projeto	
	Route::put('/indicadores/associar/{projeto_id}','Indicador\IndicadorController@associarIndicadorAoProjeto')->name('indicador.associar'); # [Ok] Formulário de Ordenar um  Projeto
	Route::post('/indicador/store','Indicador\IndicadorController@associarFaseIndicadorStore')->name('indicador.storeIndicador');		# [ok] Formulário de Atualizar Um Projeto
	# 16/09/2017 13:00:00	- Líder do Escritório de Projetos
	Route::get('/indicadores/desassociar','Indicador\IndicadorController@desassociarIndicadorAoProjeto')->name('indicador.desassociar'); # [Ok] Formulário de Ordenar um  Projeto
	Route::put('/indicadore/desassociar/{projeto}','Indicador\IndicadorController@getIndicadorDoProjeto')->name('indicador.quaisindicadores'); # [Ok] Formulário de Ordenar um  Projeto
	Route::put('/indicadore/remover/{indicador}','Indicador\IndicadorController@removerIndicadorDoProjeto')->name('indicador.removerindicador'); # [Ok] Formulário de Ordenar um  Projeto		
	# 22/08/2017 16:55:00	- Gerente de Projeto
	Route::get('/indicadores/informar/','Indicador\IndicadorController@informar')->name('indicador.informar');			# [ok] Exibir projetos para informar indicadores
	Route::put('/indicadores/informar/{projeto_id}','Indicador\IndicadorController@informarIndicadorEdit')->name('indicador.edit');			# [ok] Exibir projetos para informar indicadores
	Route::put('/indicadores/valores/{projeto_id}','Indicador\IndicadorController@informarIndicadorStore')->name('indicador.storeInformar');			# [ok] Exibir projetos para informar indicadores	
	Route::post('/indicadores/buscarinfo','Indicador\IndicadorController@buscarPorNomeInformar')->name('indicador.buscarInformar');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/indicadores/ordenarinfo','Indicador\IndicadorController@buscarOrdenarPorInformar')->name('indicador.ordenarPorInformar'); # [ok] Formulário de Ordenar um  Projeto
	# 28/08/2017 15:30:00 - Líder do Escritório de Projetos
	Route::get('/analises/analisar/','Indicador\AnalisarIndicadorComtroller@analisarShow')->name('analisar.analisar');			# [ok] Exibir projetos para informar indicadores
	Route::put('/analises/analisar/{projeto_id}','Indicador\AnalisarIndicadorComtroller@analisarIndicadorTexto')->name('analisar.edit');			# [ok] Exibir projetos para informar indicadores
	Route::put('/analises/acompanhamento/{projeto_id}','Indicador\AnalisarIndicadorComtroller@acompanhamentoIndicadorStore')->name('analisar.storeInformar');			# [ok] Exibir projetos para informar indicadores	
	Route::post('/analises/buscaranalise','Indicador\AnalisarIndicadorComtroller@buscarPorNome')->name('analisar.buscarAnalisar');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/analises/ordenaranalise','Indicador\AnalisarIndicadorComtroller@buscarOrdenar')->name('analisar.ordenarPorAnalisar'); # [ok] Formulário de Ordenar um  Projeto

	/****************************************************************************
	Route::post('/indicadores/indicadores','Indicador\IndicadorController@indicadoresDaFase', function (Request $request) {
		$result = Fase::findOrFail($fase_id)->indicador()->orderBy('id')->get(); # ------ busca na tabela fase_projeto ----------> RETURN indicador nome
		 return redirect()->response()->json(array(view('indicadores/fases')->with('indicadores',$result), ));
		 return response(view('/indicadores/fases',array('indicadores' => $result)),200, ['Content-Type' => 'application/json']);
})->name('indicador.indicadoresDaFase');
	Route::post('/indicadores/indicadores','Indicador\IndicadorController@indicadoresDaFase', function (Request $request) {
		$result = Fase::findOrFail($fase_id)->indicador()->orderBy('id')->get(); # ------ busca na tabela fase_projeto ----------> RETURN indicador nome			
		 return redirect('/indicadores/fases')->response()->json(array(view('indicadores/fases')->with('indicadores',$result), 'indicadores' => $result));
		 return redirect('/indicadores/fases');
	})->name('indicador.indicadoresDaFase');	
	*********************************************************************************/
});
#-----------------------END---------------------------------------------
# created by Luiz
# 07/09/2017 15:30:00 - Membro da alta Direção
# RELATORIOS MANAGER 
#-----------------------------------------------------------------------
 
Route::group(['middleware' => ['auth', 'auth.mad']], function () {
	Route::get('/relatorio/projetos/','Relatorio\RelatorioComtroller@show')->name('relatorio.show'); # [ok] Exibir projetos para informar indicadores
	Route::put('/relatorio/relatorio/{projeto_id}','Relatorio\RelatorioComtroller@relatorioPorProjeto')->name('relatorio.status'); # [ok] Exibir projetos para informar indicadores
	Route::get('/relatorio/geral','Relatorio\RelatorioComtroller@geral')->name('relatorio.geral'); # [ok] Exibir projetos para informar indicadores	
	Route::post('/relatorio/buscar','Relatorio\RelatorioComtroller@buscarPorNome')->name('relatorio.buscarProjeto'); # [ok] Formulário de Buscar um  Projeto
	Route::post('/relatorio/ordenar','Relatorio\RelatorioComtroller@buscarOrdenar')->name('relatorio.ordenarProjeto'); # [ok] Formulário de Ordenar um  Projeto
});
#------------END--------------------------------------------------------
# created by Luiz 16-08-2017 
# LIDEDOPROJETO
#-----------------------------------------------------------------------
//Route::get('equipes/home', function () { return view('/equipes/home'); })->middleware('auth.lp'); # [ok] Home do Administrador

Route::group(['middleware' => ['auth.lp']], function () {
	//Route::get('/equipes/home','LiderProjeto\EquipeController@home')->name('equipe.home');
	Route::get('/equipes/','LiderProjeto\EquipeController@index')->name('equipe.index'); # [ok] Formulário
	Route::get('/equipe/cadastro','LiderProjeto\EquipeController@cadastro')->name('equipe.cadastro'); # [ok] Formulário
	Route::post('/equipes/buscarm','LiderProjeto\EquipeController@showBuscarPorNomeMembro')->name('equipe.showMembroBuscar');# [ok] Formulário de Buscar
	Route::post('/equipes/ordenarm','LiderProjeto\EquipeController@showBuscarMembroOrdenarPor')->name('equipe.showMembroOrdenarPor'); # [ok] 
	Route::post('/equipes/buscar','LiderProjeto\EquipeController@buscarPorNome')->name('equipe.buscar'); # [ok] Formulário de Buscar
	Route::post('/equipes/ordenar','LiderProjeto\EquipeController@buscarOrdenarPor')->name('equipe.ordenarPor'); # [ok] 
	Route::get('/equipes/equipes','LiderProjeto\EquipeController@associarEquipeAoProjeto')->name('equipe.fases'); # [Ok] 
	Route::put('/equipes/detalhes/{projeto_id}','LiderProjeto\EquipeController@detalhes')->name('equipe.detalhes'); # [Ok] exibe os detalhes da equipe
	Route::post('/equipes/create','LiderProjeto\EquipeController@create')->name('equipe.create');# [ok] Criar
	Route::post('/equipes/createid','LiderProjeto\EquipeController@createByIdMembro')->name('equipe.createId');	# [ok] Criar
	Route::put('/membro/projetos/{membro}','LiderProjeto\EquipeController@projetoAndMembroShow')->name('equipe.projetoAndMembroShow');			# [ok] Exibir projetos do membro
	Route::get('/equipes/show','LiderProjeto\EquipeController@show')->name('equipe.show');# [ok] Exibir
	Route::delete('/equipe/{id}','LiderProjeto\EquipeController@destroy')->name('equipe.destroy');	# [ok] Deletar o membro da equipe do projeto
	Route::put('/equipe/update/{id}','LiderProjeto\EquipeController@update')->name('equipe.update');# [ok] Formulário de Atualizar
	Route::put('/equipe/atualizar','LiderProjeto\EquipeController@atualizar')->name('equipe.atualizar');# [ok] Ação (Botão) do Formulário para Atualizar novo Projeto
	Route::delete('/destroy/{id}','LiderProjeto\EquipeController@destroyEquipe')->name('equipe.destroyEquipe');	# [ok] Deletar o Membro do sistema
	Route::put('/equipes/associar/{projeto_id}','LiderProjeto\EquipeController@associarMembroEquipeAoProjeto')->name('equipe.associar'); # [Ok] 	
});

#----------------------------------END----------------------------------
# created by Luiz 04-02-2018  DD-MM-YYYY 
# LIDER DO ESCRITÓRIO DE PROJETOS / LIDER DE PROJETOS / GERENTE DE PROJETOS
# LICOES APRENDIDAS REQUISITO ESTRA PESSOAL
#-----------------------------------------------------------------------
Route::group(['middleware' => ['auth']], function () {
	//Route::get('/licaoes/home','licao\licaoController@home')->name('licao.home');
	Route::get('/licoes/','Licoes\LicoesAprendidasController@index')->name('licao.index');#[ok]
	Route::get('/licao/cadastro','Licoes\LicoesAprendidasController@cadastro')->name('licao.cadastro');# Cad
	Route::post('/licoes/create','Licoes\LicoesAprendidasController@create')->name('licao.create');# Criar
	Route::put('/licoes/detalhes/{projeto_id}','Licoes\LicoesAprendidasController@detalhes')->name('licao.detalhes');#[Ok] Detalhes
	Route::get('/licoes/show','Licoes\LicoesAprendidasController@show')->name('licao.show');#Listar
	Route::delete('/licao/{projeto_id}','Licoes\LicoesAprendidasController@destroy')->name('licao.destroy');#Deletar
	Route::put('/licao/update/{projeto_id}','Licoes\LicoesAprendidasController@update')->name('licao.update'); #[ok] Atualizar
	Route::put('/licao/atualizar','Licoes\LicoesAprendidasController@atualizar')->name('licao.atualizar');	# [ok] Ação (Botão) do Formulário para Atualizar novo Projeto
	Route::post('/licoes/buscar','Licoes\LicoesAprendidasController@buscarPorNome')->name('licao.buscar');	# [ok] Formulário de Buscar um  Projeto
	Route::post('/licoes/ordenar','Licoes\LicoesAprendidasController@buscarOrdenarPor')->name('licao.ordenarPor'); # [ok] Formulário de Ordenar um  Projeto	
	
});
#----------------------------------END----------------------------------
# created by Luiz 20-08-2017 
# MEMBRO DA ALTA DIREÇÃO
#-----------------------------------------------------------------------

/*
'auth.admin' Middleware name para administrador
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});
*/
Route::get('auth/logout','Auth\AuthController@getLogout');

//Route::post('/auth','Auth\AuthController@create')->name('register');