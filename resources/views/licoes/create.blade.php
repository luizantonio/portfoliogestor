@extends('layouts.app')
	<head>
    <!-- <<link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->


    <link rel="shortcut icon" type="image/png" href="http://portifoliogestor.com/public/images/portfolio-logo4.png" sizes="16x16">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Luiz -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <style type="text/css">
            body {
                background-color: lightgray;
                widith: 100%;
                higth:100%;
            }
            
        hr {
            margin-top: 35px;
            margin-bottom: 35px;
            border: 0;
            border-top: 1px solid #bfbebe;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        li {
            display: inline-block;
            float: left;
            margin-left: 20px;
            line-height: 35px;
            font-weight: 100;
        }
        a {
            text-decoration: none;
            cursor: pointer;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }
        li a {
            color: red; /*    white;  */
            margin-left: 3px;
        }
        li > i {
            color: black;  /*  color: white;  */
        }
        .column-wrap a {
            color: #5c34c2;
            font-weight: 600;
            font-size:16px;
            line-height:24px;
        }
        .column-wrap p {
            color: gray;  /*     #717171; */
            font-size:16px;
            line-height:24px;
            font-weight:300;
        }
        .container {
            margin-top: 100px;
        }
    
        .column-custom {
            border-radius: 5px;
            background-color: #eeecf9;
            padding: 35px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 13px;
            color: gray !important;
            margin-top: 25px;
            line-height: 1.4;
            margin-bottom: 45px;
        }
        .footer a {
            cursor: pointer;
            color: red !important; /*   color: #646464 !important; */
            font-size: 12px;
        }
        .copyright {
            color: yellow !important; /*  color: #646464 !important; */
            font-size: 12px;
        }
        .column-custom-wrap{
            padding-top: 10px 20px;
        }
        @media screen and (max-width: 768px) {
            
            .container {
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 650px) {
            
            .container {
                margin-top: 30px;

                margin-bottom: 45px;
                margin-height: 25px;
                margin-left: 25px;
            }
        }
</style>
</head>
	
@section('content')
<div class="container">

@if(Session::has('message_error_licao_create'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_licao_create') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif


    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default">

                <div class="panel-heading">         
                <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-0">                          
                        <a href ="{{ route('home') }}"> <button type="button" class="btn btn-success">
                            <i class="fa fa-chevron-left"> Voltar</i> 
                        </button></a> <center><b><h3>Cadastrar Li&ccedil;&otilde;es Aprendidas</h3></b></center>
                    </div>
                </div>
            </div>
                <div class="panel-body">
                    <center><b><span id="mensagemVancelar"></span></b>&nbsp;&nbsp;<span id="mensagemVoltar"></span></b></center>
                    <span class="glyphicon glyphicon-question-sign">
                        <b> Selecione o projeto para habilitar a adi&ccedil;&atilde;o de li&ccedil;&otilde;es de aprendizado!</b></span>

					<!-- Display Validation Errors -->
					@include('common.erros')

                    <form id="cadastrar" class="form-horizontal" method="POST" action="{{ route('licao.create') }}">
                        {{ csrf_field() }}
						{{ method_field('POST') }}
                        @if(!is_null($projetos) && count($projetos) > 0)
                            
                            <div class="form-group">
                                <div class="form-group navbar-form"> 
                                    <label for="projeto_id" class="control-label">Nome do Projeto:</label>
                                    <select class="form-control m-b" name="projeto_id" id="projeto_id" >
                                        <option value="" disabled="" selected=""> SELECIONE O PROJETO </option>
                                            @foreach($projetos as $projeto)
                                                @if(!is_null($licoesaprendidas))
                                                    
                                               @endif
                                                <option value="{{ $projeto->id }}" >{{$projeto->nome}}</option>
                                            @endforeach 
                                        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}" class="form-control">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"> <b>Cadastrar</b></i> 
                                    </button>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                    <button type="button" id="btn-cancelar" class="btn btn-warning">
                                        <i class="fa fa-minus"> <b>Cancelar</b></i> 
                                    </button>
                                </div>
                            </div>   
                        @else
                            <div class="alert-danger">
                                <span class="glyphicon glyphicon-alert"> 
                                <b> {{ utf8_encode('Não existem projetos aguardando para cadastro de lições aprendidas!') }}</b></span>
                            </div>
                            <div class="alert-info">
                                <span class="glyphicon glyphicon-question-sign">
                                <b> {{ utf8_encode('Apenas projetos com status ENCERRADO poderão ser habilitados para receber lições de aprendizado!') }}</b></span>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function () {
    $('#btn-cancelar').click(function () {
        $("#name").attr("disabled", true);
        $("#cadastrar :input").prop("disabled", true);
        var texto = "";
       //$( "#mensagemVancelar" ).val() = '';
        $( "#mensagemVancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
        $( "#mensagemVancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );
        $( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Voltar] para retornar!"); @endphp');
         $( "#mensagemVoltar" ).css( "color", "green" );
                                
     });
    /**--------------------------------------------------------------
         SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
    --------------------------------------------------------------***/
    $('.btn-primary').click(function (event) {
        event.preventDefault();
        var button = confirm("Quer cadastrar a LICAO? "); // return true or false 

        var selected_option = $('#projeto_id option:selected');

        $('#projeto_id option').each(function() {
            if(this.selected) {
                if($('#projeto_id').val() == null){
                    alert('Selecioe um Projeto!');
                }
            }
        });   

        if(button == true)
         {
             var form_id = $(this).closest('form').attr('id');   
             //alert('form_id- : ' + form_id);
             //$('#'+form_id).submit();
             if($('#projeto_id').val() != null){
                $('#'+form_id).submit();
             }
        }
     });/* FIM click*/
});                 
</script>
@endsection