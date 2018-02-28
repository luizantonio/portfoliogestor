<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<html lang=" app()->getLocale() "> -->
<html lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Sistema de Gerenciamento de Portfólio de Projetos (Portfólio Gestor) - é um sistema de cadastro de projetos onde usuários podem realizar atividades inerentes ao seu perfil.">
    <meta name="author" content="Luiz Antôniô Silva">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">  

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/png" href="http://portifoliogestor.com/public/images/portfolio-logo9.png" sizes="16x16">
    <!-- 15/09/2016 menu toggle fluid and colappse -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet"> -->
    <!-- 15/09/2016 menu toggle fluid and colappse -->
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Luiz -->
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">


 <script>

$(document).ready(function(){

          $( "body" ).click(function( event ) {
         
             
            //if(event.target.nodeName === 'BUTTON' ){
            if( $(event.target).attr('class') ==='navbar-toggle' ||  $(event.target).attr('class') ==='navbar-toggle collapsed'){


                    $( "div #myNavbar").toggle();
                   
                // //console.log(event.target.nodeName);
                // // console.log(event.target.id);

                //   if( $(event.target).attr('class') ==='navbar-toggle'){ 
                //  //if( $(event.target).attr('class') === 'navbar-toggle' ) {
                    
                //        // $('#mae div:first-child').remove().insertAfter($("#mae div:last"));
                    
                //    // console.log('fechou..BUTTON..');
                //    // console.log(event.target.nodeName);
                //    // console.log(event.target.id);
                //     $( "#btnnav" ).attr('class', null) ;
                //     $( "#btnnav" ).attr('class', 'navbar-toggle collapsed') ;                   
                //     $( "#btnnav" ).attr("aria-expanded","false");
                //     //$( "#myNavbar" ).replaceWith('<div class="collapse navbar-collapse" id="myNavbar" aria-expanded="false" style="height: 0.916667px;">');
                //     $( "#myNavbar" ).attr('class', null) ;                    
                //     $( "#myNavbar" ).attr( 'class', 'navbar-collapse collapse') ;                    
                //     $( "#myNavbar" ).attr( "aria-expanded", null );
                //     $( "#myNavbar" ).attr( "aria-expanded","false");
                //     //$( "#myNavbar" ).removeAttr( "style" );
                //     //$( "#myNavbar" ).attr("style", 'height: 0.916667px;' );
                //     //console.log($( "#myNavbar" ).attr('class'));
                    
                //     $( "div #myNavbar" ).toggleClass(function() {
                //       if ( $( "div #myNavbar" ) ) {
                //         return "navbar-collapse collapse";
                //       } else {
                //         return "navbar-collapse collapse";
                //       }
                //     });
                //     $( "div #myNavbar").toggle(function () {
                //        $( "div #myNavbar").removeClass("in");
                //     });

                //     $( "div #myNavbar").toggle();
                      
                    
                //     return ;
                    
                // }
                //  if( $(event.target).attr('class') === 'navbar-toggle collapsed' ) {
                //     //console.log('Abriu..BUTTON..');
                //    // console.log(event.target.nodeName);
                //    // console.log(event.target.id);
                //     $( "#btnnav" ).attr('class', null) ;
                //     $( "#btnnav" ).attr('class', 'navbar-toggle') ;
                //     $( "#btnnav" ).attr("aria-expanded", null) ;
                //     $( "#btnnav" ).attr("aria-expanded","true");
                //     $( "#myNavbar" ).removeClass('in') ;
                //     $( "#myNavbar" ).attr("aria-expanded", null) ;
                //     $( "#myNavbar" ).attr("aria-expanded","true");
                //     //$( "#myNavbar" ).attr("style",  null) ;
                //     //$( "#myNavbar" ).attr("style", '' );
                //     $( "#myNavbar" ).attr("style", 'height: 0.916667px;' );
                //     //console.log($( "#myNavbar" ).attr('class'));
                //      $( "#btnnav" ).mouseup(function() {
                //         $( "#myNavbar" ).attr( "style",'height: 0.916667px;' );
                //       })
                //       .mousedown(function() {
                //          $( "#myNavbar" ).attr( "style",'' );
                //       });
                //     return ;
                // }
            }
            
       

            function handler( event ) {
              var target = $( event.target );
              if ( target.is( "li" ) ) {
                target.children().toggle();
                
              }
            }

          });
});
 </script>


    <style type="text/css">
            body {
                background-color: lightgray;
                widith: 100%;
                higth:100%;
            }
            /*.dropdown-submenu {
                position: relative;
            }
            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px 6px;
                border-radius: 0 6px 6px 6px;
            }
            .dropdown-submenu:hover>.dropdown-menu { 
                background-color: lightgreen;
                display: block;
            }
            .dropdown-submenu>a:after {
                display: block;
                content: " ";
                i: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #cccccc;
                margin-top: 5px;
                margin-right: -10px;
            }
            .dropdown-submenu:hover>a:after {
                border-left-color: #ffffff;
            }
            .dropdown-submenu.pull-left {
                float: none;
            }
            .dropdown-submenu.pull-left>.dropdown-menu {
                left: -100%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
            }
         
        
        h1 {
            font-size: 30px;
            font-weight: 600!important;
            color: #333;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
        }
        h3 {
            font-size: 22px;
            font-weight: 600;
            line-height: 28px;
        }*/
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
            float: right;
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
            color: white;
            margin-left: 3px;
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
        

/*
        .navbar {
            position: relative;
            min-height: 45px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .navbar-brand {
            float: left;
            height: auto;
            padding: 10px 10px;
            font-size: 18px;
            line-height: 20px;
        }
        .navbar-nav>li>a {
            padding-top: 11px;
            padding-bottom: 11px;
            font-size: 13px;
            padding-left: 5px;
            padding-right: 5px;
        }
        .navbar-nav>li>a:hover {
            text-decoration: none;
            color: #cdc3ea!important;
        }
        .navbar-nav>li>a i {
            margin-right: 5px;
        }
        .nav-bar img {
            position: relative;
            top: 3px;
        }

        .navbar a {
            color: white !important;
        }
        .navbar {
            border-radius: 0px !important;
        }
        .navbar-inverse {
            background-color: #434343;
            border: none;
        } 






        .element {
            height: 0.966667px;
        }
        .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
            border-color: #101010;
        }
        .container-fluid > .navbar-collapse, .container-fluid > .navbar-header, .container > .navbar-collapse, .container > .navbar-header {
            margin-right: -15px;
            margin-left: -15px;
        }
        .navbar-collapse {
            padding-right: 15px;
            padding-left: 15px;
            overflow-x: visible;
            -webkit-overflow-scrolling: touch;
            border-top: 1px solid transparent;
                border-top-color: transparent;
            -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
        }
        .collapse {
            display: none;
        }
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;

        }
        .element {
            height: 57.9667px;
        }
        .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
            border-color: #101010;
        }
        .container-fluid > .navbar-collapse, .container-fluid > .navbar-header, .container > .navbar-collapse, .container > .navbar-header {
            margin-right: -15px;
            margin-left: -15px;
        }
        .navbar-collapse.in {
            overflow-y: auto;
        }
        .collapse.in {
            display: block;
        }
        .navbar-collapse {
            padding-right: 15px;
            padding-left: 15px;
            overflow-x: visible;
            -webkit-overflow-scrolling: touch;
            border-top: 1px solid transparent;
                border-top-color: transparent;
            -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
        }
        .collapse {
            display: none;
        }
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

*/

        .congratz {
            margin: 0 auto;
            text-align: center;
        }
        .message::before {
            content: " ";
           /* background: url(https://...);*/
            width: 141px;
            height: 175px;
            position: absolute;
            left: -150px;
            top: 0;
        }
        .message {
            width: 50%;
            margin: 0 auto;
            height: auto;
            padding: 40px;
            background-color: #eeecf9;
            margin-bottom: 100px;
            border-radius: 5px;
            position:relative;
        }
        .message p {
            font-weight: 300;
            font-size: 16px;
            line-height: 24px;
        }
        #pathName {
            margin: 20px 10px;
            color: grey;
            font-weight: 300;
            font-size:18px;
            font-style: italic;
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
            color: #646464 !important;
            font-size: 12px;
        }
        .copyright {
            color: #646464 !important;
            font-size: 12px;
        }
        
        .column-custom-wrap{
            padding-top: 10px 20px;
        }
        @media screen and (max-width: 768px) {
            .message {
                width: 50%;
                padding: 35px;
            }
            .container {
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 650px) {
            .message {
                width: 100%;
                padding: 35px;
            }
            .message::before {
                width: 100px;
                height: 123px;
                position: relative;
                left: auto;
                top: 0;
                float: left;
                margin-right: 15px;
                background-size: 100px;
            }
             .container {
                margin-top: 30px;

                margin-bottom: 45px;
                margin-height: 25px;
                margin-left: 25px;
                
            }
/*
            .navbar {
                position: relative;
                min-height: 45px;
                margin-bottom: 20px;
                border: 1px solid transparent;
            }
            .navbar-brand {
                float: left;
                height: auto;
                padding: 10px 10px;
                font-size: 18px;
                line-height: 20px;
            }
            .navbar-nav>li>a {
                padding-top: 11px;
                padding-bottom: 11px;
                font-size: 13px;
                padding-left: 5px;
                padding-right: 5px;
            }
            .navbar-nav>li>a:hover {
                text-decoration: none;
                color: #cdc3ea!important;
            }
            .navbar-nav>li>a i {
                margin-right: 5px;
            }
            .nav-bar img {
                position: relative;
                top: 3px;
            }

            .navbar a {
                color: white !important;
            }
            .navbar {
                border-radius: 0px !important;
            }
            .navbar-inverse {
                background-color: #434343;
                border: none;
            } 

         
          .element {
                height: 0.966667px;
            }
            .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
                border-color: #101010;
            }
            .container-fluid > .navbar-collapse, .container-fluid > .navbar-header, .container > .navbar-collapse, .container > .navbar-header {
                margin-right: -15px;
                margin-left: -15px;
            }
            .navbar-collapse {
                padding-right: 15px;
                padding-left: 15px;
                overflow-x: visible;
                -webkit-overflow-scrolling: touch;
                border-top: 1px solid transparent;
                    border-top-color: transparent;
                -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
                box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
            }
            .collapse {
                display: none;
            }
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;

            }
            .element {
                height: 57.9667px;
            }
            .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
                border-color: #101010;
            }
            .container-fluid > .navbar-collapse, .container-fluid > .navbar-header, .container > .navbar-collapse, .container > .navbar-header {
                margin-right: -15px;
                margin-left: -15px;
            }
            .navbar-collapse.in {
                overflow-y: auto;
            }
            .collapse.in {
                display: block;
            }
            .navbar-collapse {
                padding-right: 15px;
                padding-left: 15px;
                overflow-x: visible;
                -webkit-overflow-scrolling: touch;
                border-top: 1px solid transparent;
                    border-top-color: transparent;
                -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
                box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
            }
            .collapse {
                display: none;
            }
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
*/



        }
    }
</style>
    
</head>
<body>
    <div id="app">
    
        <nav class="navbar navbar-inverse">
                 <div class="navbar-header">
      
                    <!-- Collapsed Hamburger -->
                  <!-- <button  type="button"  id="#btnnav"class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse"    aria-expanded="false" aria-controls="navbar" style="height: 0.966667px;"> -->
                   <!--  <button  type="button"  id="#btnnav" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse"    aria-expanded="false" aria-controls="navbar" style="background-color: white;"> -->

                   <button type="button" id="#btnnav" class="navbar-toggle collapsed" data-toggle="collapse" aria-expanded="false"  data-target="#myNavbar"> 
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    <!-- Branding Image -->   
                    <a class="navbar-brand" href="http://portifoliogestor.com/"><img src="http://portifoliogestor.com/public/images/portfolio-logo9.png" height="30" width="30"></a>                 
                    <a class="navbar-brand" href="javascript:void(0)"> {{ config('app.name', 'Laravel') }}</a> 
                </div>

                <div class="collapse navbar-collapse" id="myNavbar" aria-expanded="false" style="height: 0.916667px;">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                <!-- ************ Membro da alta direção ************ -->
                @if (Auth::guest())
                    
                @elseif (Auth::user()->isMembroAltaDir(Auth::user()->id) )
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">             
        
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-close" > Relat&oacute;rios dos Projetos</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">                              
                                <li class="menu-item dropdown">
                                   <a href="{{ route('relatorio.show')  }}"><span class="glyphicon glyphicon-stats"> Relat&oacute;rio de Indicadores Por Projeto</span></a>
                                </li>                                                           
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                   <a href="{{ route('relatorio.geral')  }}"><span class="glyphicon glyphicon-stats"> Relat&oacute;rio de Indicadores de Todos os Projetos</span></a>
                                </li>                                                           
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('relatorio.show') }}"><span class="glyphicon glyphicon-list"> Listar</span></a>
                                </li>                                                               
                            </ul>
                        </li>                   
                        
                        <li class="menu-item dropdown">
                            <li><a target="_blank" href="http://192.168.0.104/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li>
                        
                        </li>                    
                        
                    </ul>
                @endif
                <!-- fim Membro da alta direção -->

                <!--lider do escritorio de projetos -->
                @if (Auth::guest())
                    
                @elseif (Auth::user()->isLiderEscritProjetos(Auth::user()->id) )
                        

                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-close" > Projetos</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">                              
                                <li class="menu-item dropdown">
                                    <a href="{{ route('status.show')  }}"><span class="glyphicon glyphicon-check"> Alterar Status do Projeto</span></a>
                                </li>                               
                                <li class="divider"></li>     
                                <li class="menu-item dropdown">
                                    <a href="{{ route('projetos.cadastro')  }}"><span class="glyphicon glyphicon-plus"> Cadastrar Projeto</span></a>
                                </li>                                
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('projetos/show') }}"><span class="glyphicon glyphicon-list"> Listar Projeto</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('projetos/show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Projeto</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('projetos/show')}}"><span class="glyphicon glyphicon-trash"> Excluir Projeto</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil glyphicon-stats"> Indicador</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">                              
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.fases')  }}"><span class="glyphicon glyphicon-log-in"> Associar Indicador ao Projeto</span></a>                        
                                </li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.desassociar')  }}"><span class="glyphicon glyphicon-log-out"> Desassociar Indicador do Projeto</span></a>                          
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('analisar.analisar') }}"><span class="glyphicon glyphicon-stats"> Analisar Valores dos indicador</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.cadastro')  }}"><span class="glyphicon glyphicon-plus"> Cadastrar Indicador</span></a>                                    
                                </li>                               
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.show') }}"><span class="glyphicon glyphicon-list"> Listar Indicadores</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Indicador</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.show') }}"><span class="glyphicon glyphicon-trash"> Excluir Indicador</span></a>
                                </li>
                            </ul>
                        </li> 
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil" > Li&ccedil;&atilde;o</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.cadastro') }}"><span class="glyphicon glyphicon-plus"> Cadastrar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-list"> Listar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-trash"> Excluir Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil" > Semanal</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ route('semanal.show') }}"><span class="glyphicon glyphicon-list"> Listar Acompanhamento Semanal</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('semanal.show') }}"><span class="glyphicon glyphicon-trash"> Excluir Acompanhamento Semanal</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a target="_blank" href="http://portifoliogestor.com/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li>                
                    </ul>               
                   
                @endif
                <!-- fim lider do escritorio de projetos -->

                <!-- líder de projetos -->
                @if (Auth::guest())
                    
                @elseif (Auth::user()->isLiderProjetos(Auth::user()->id) )
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user">&nbsp;Equipe</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.fases') }}"><span class="glyphicon glyphicon-plus"> Cadastrar Equipe</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.show') }}"><span class="glyphicon glyphicon-list"> Listar Membro</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Membro</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.show') }}"><span class="glyphicon glyphicon-trash"> Excluir Membro</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil"> Li&ccedil;&atilde;o</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-list"> Listar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                                 <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                            </ul>
                        </li> 
                        <li><a target="_blank" href="http://portifoliogestor.com/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li>
                  </ul>
                @endif
                <!-- fim líder de projetos -->
                        
                <!-- gerente de projetos -->
                @if (Auth::guest())
                    
                @elseif (Auth::user()->isGerenteProjetos(Auth::user()->id) )                        
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">             
        
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-close" > Projetos</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">                              
                                <li class="menu-item dropdown">
                                   <a href="{{ route('status.show')  }}"><span class="glyphicon glyphicon-check"> Alterar Status do Projeto</span></a>
                                </li>                                                       
                            </ul>
                        </li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats" > Indicador</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.informar')  }}"><span class="glyphicon glyphicon-check"> Informar Valores do Indicador</span></a>                                          
                                </li>                                                           
                            </ul>                       
                        </li> 
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil"> Li&ccedil;&atilde;o</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-list"> Listar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                                 <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('licao.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Li&ccedil;&atilde;o Aprendida do Projeto</span></a>
                                </li>
                            </ul>
                        </li> 
                        <!-- <li><a target="_blank" href="http://192.168.0.104/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li> -->
                        <li><a target="_blank" href="http://portifoliogestor.com/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li>
                    </ul>
                @endif
                <!-- fim gerente de projetos -->


                <!--admin -->
                @if (Auth::guest())

                @elseif (Auth::user()->isAdmin(Auth::user()->id) )
                        
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="divider"><hr style="color:red;"/></li>  
                        <li class="menu-item dropdown">             
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"> Usuarios</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                               @if (Auth::check())
                                <li class="menu-item dropdown">
                                    <a href="{{ url('/admin') }}"><span class="glyphicon glyphicon-plus"> Cadastrar Usuario</span></a>                                    
                                </li>
                                @endif
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/show') }}"><span class="glyphicon glyphicon-list"> Listar</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/show') }}"><span class="glyphicon glyphicon-trash"> Excluir</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="divider"><hr style="color:red;"/></li>  
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-check"> @php echo utf8_encode('Permissão');@endphp</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/permissao')  }}"><span class="glyphicon glyphicon-check"> @php echo utf8_encode('Gerenciar Permissão de Acesso as Telas');@endphp</span></a>                                         
                                </li>
                            </ul>
                        </li>       
                        <li class="divider"><hr style="color:red;"/></li>
                        <li><a target="_blank" href="http://portifoliogestor.com/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li>
                    </ul>

                @endif
               <!-- fim admin -->






                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a target="_blank" href="http://portifoliogestor.com/squirrelmail/src/login.php"><span class="glyphicon glyphicon-envelope" > E-Mail</span></a></li>
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in" > Login</span></a></li>                            
                            <!--<li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <!-- <li><a href="javascript:void(0)">@php echo '<b style="color:white">'.Auth::user()->roleNAME(Auth::user()->id).'</b>' @endphp</a></li> -->
                            <li class="dropdown active">                                
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">                                 
                                    <span class="glyphicon glyphicon-user">&nbsp;{{ Auth::user()->name }}</span> <span class="caret"></span>    
                                            
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-log-out"></span> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif



                        @if (Auth::guest())
                        

                        @elseif (  (Auth::user()->isNotRole( Auth::user()->id) ) )
                            <ul class="nav navbar-nav navbar-brand navbar-right">
                                <li><a href="javascript:void(0)"><span class="active panel panel-danger" ><b style="color=red;">@php echo utf8_encode('Você não tem permissão de acesso as telas da aplicação!');@endphp</b>&nbsp;&nbsp;&nbsp;</span></a></li>
                                <li class="menu-item dropdown">     
                            </ul>

                            @php                        
                                    return Redirect::intended('/home');                     
                                    return view('home');                                        
                            @endphp 
                        @endif


    <!--                 </ul>
                </div>
            </div>
    </nav> -->
                        </li>
                    </ul>
                </ul>
            </div>
        </nav>
    </div>
    

    <div id="log"></div>
     @yield('content')
     <p></p>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

