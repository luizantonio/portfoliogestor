<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
   
   protected $relatorio = array('Uma menssagem'); 
   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'email:send {user*}';
	//protected $signature = 'command:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';
	protected $description = 'Isto eh um teste';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		
        ini_set('max_execution_time', 60);
        # Recupera os projetos cncelados
        $verificar = self::verificarProjetosCanceladosNoPeriodo();
        # variável para a colecao de emails
        $UsersMails = null;
        # variável para o retorno do arquivo
        $Arquivo = null;        
        if ( !is_null($verificar) ){
            # realiza a recuperação dos emails
            $UsersMails = allUsersMails();
            if ( !is_null($UsersMails) ){
                # realiza a operação de gerar o arquivo
                $Arquivo = self::gerarArquivo($verificar);
            }
        }
        # se arquivo retornou diferente de null enviar email
        if ( !is_null($Arquivo) ){
            $OUTRO = self::sendEmail($verificar);   
            //return 
            

            // Inclui o arquivo class.phpmailer.php localizado na pasta class
            require_once('/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php');
            require_once('/usr/share/php/libphp-phpmailer/class.phpmailer.php');
            require_once('/usr/share/php/libphp-phpmailer/class.smtp.php');
            $mail = new PHPMailer(true);
            $name = "Luiz";
            //$phone = $_POST['phone'];
            $email = "contato@portifoliogestor.com";
            //$file = $_FILES['attachment']['tmp_name'];
            $message = "To view the message, please use an HTML compatible email viewer!";
            $mail->isMail();                                      // Set mailer to use SMTP
            $mail->Host = 'localhost';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'administrador@portifoliogestor.com';                 // SMTP username
            $mail->Password = '*****';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->From = 'administrador@portifoliogestor.com';
            $mail->FromName = $name;
            //$mail->addAddress('joe@example.net', 'Joe User');  // Add a recipient
            $mail->addAddress('contato@portifoliogestor.com');  // Name is optional            
            $mail->isHTML(true);                                // Set email format to HTML
            $mail->Subject = 'Relatório de Projetos Cancelados';
            $mail->Body = $message;
            $mail->Body .= "<br/><br/>Below are my contact details <br/> Name: ";
            $mail->Body .= $name;
            $mail->Body .= "<br/>My Phone number: ";
            //$mail->Body .= $phone;
            $mail->Body .= "<br/> My email address: ";
            $mail->Body .= $email;
            $mail->AltBody = 'You are using basic web browser ';
            $mail->MsgHTML("Relatório de Projetos Cancelado");
            foreach ($UsersMails as $CcMail) {
                $mail->AddAddress($CcMail);
            }
           /* $filename = '/var/www/html/public/storage/relatorio.txt';
            $mail->AddAttachment('/var/www/html/public/storage/400.txt', $name = 'relatorio.txt',
            $encoding = 'base64', $type = 'application/txt');        // Add attachments
            if (file_exists($filename)) {
                $mail->AddAttachment('/var/www/html/public/storage/400.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'application/txt');

                $mail->AddAttachment('/var/www/html/public/storage/400.txt', $name = 'relatorio.txt',
                    $encoding = 'base64', $type = 'txt');
            }*/
            if(!$mail->send()) {
                echo 'A mensagem não foi enviada.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'A mensagem foi enviada';
                //header('Location: thankyou.html');
            }
        }



        /*
        $result1  = Mail::send('email.relarorio', ['relatorio' => $this->relatorio,], function($message)
        {
			echo "\n\tresult1 ";
            $message->to('portifoliogestor@portifoliogestor.com', 'Portifolio Gestor')->subject('SendEmails');
        });
		echo "\n\tfora ";
		$result2  =  Mail::send('relatorio.mail.relarorio', ['relatorio' => $this->relatorio,], function($message)
        {
			echo "\n\tresult2 ";
            $message->to('contato@portifoliogestor.com', 'Portifolio Gestor')->subject('SendEmails');
        });

		$tets = Mail::raw('Message text', function($message) {
			echo "\n\ttets";
			//$message->from('no-reply@portifolio.gestor.com.br', 'Portifolio Gestor');
			$message->to('biacal@portifoliogestor.com')->cc('portifoliogestor@portifoliogestor.com' );
		});
	
		$resutadoc  = Mail::raw('relatorio.mail.relarorio',  function($message)
		{
			echo "\n\tresutadoc";
			//$message->from('no-reply@portifolio.gestor.com.br', 'Portifolio Gestor');
			$message->to('biacal@portifoliogestor.com', 'Luiz')->subject('This is my subject');
		});
	
		//return 
		$result3  =  Mail::send('relatorio.mail.relarorio', ['relatorio' => $this->relatorio,], function($message)
        {
			echo "\n\ttrês";
            //$message->from('no-reply@portifolio.gestor.com.br', 'Portifolio Gestor');
		    $message->to('biacal@portifoliogestor.com', 'Portifolio Gestor')->subject('SendEmails');			
			$message->cc('biacal@portifoliogestor.com', 'biacal' );
			//$message->cc('dfb6b9fe68-78b989@inbox.mailtrap.io', 'Luiz' );			        
			$message->attach(public_path('/storage/400.txt'));
        });
        */
		echo "\n\t";

        $this->info('Test has fired.');
    }
    /** 
    * Hith Administration - Alta direção 
    * Request user´s mail to send statistics of level indicators inconsistence level
    * Recupera os emails dos usuários da alta direção no caso de indicador fora de nível
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
            echo 'Message has been eMails';
            return $eMails;
        }
        return null;
    } 

    /**
    * Verifica se existem projetos cancelados.
    *
    * @return array
    **/
    public function verificarProjetosCanceladosNoPeriodo(){
        $date = date('Ym');
        $ProjetosCancelados = ProjetosCancelados::select('projetoscancelados.*' )
            ->where('projetoscancelados.data', '=', $date)
            ->get();

       if(!is_null($ProjetosCancelados)){
            echo 'Message has been ProjetosCancelados';
            return $ProjetosCancelados;
       }
       return null;
      
    }
    /**
    * Gera um arquivo txt para ser enviado ao menbro da alta direção
    * @param Request
    * @return array
    **/
    public function gerarArquivo($ProjetosCancelados){
        if(is_null($ProjetosCancelados)){
            return null;
        }
        $t = "";
        $t .= "--------------------".date('d/m/Y H:i:s')."----------------------". PHP_EOL;
        $t .= "\t\tRELATÓRIO DOS PROJETOS CANCELADOS NO PERÍODO". PHP_EOL;
        foreach($ProjetosCancelados as $projeto){
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "PROJETO:\t". utf8_decode($projeto->projeto). PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "RESPONSÁVEL:\t" .$projeto->responsavel. PHP_EOL; 
            $t .= "STATUS:     \t" .$projeto->status. PHP_EOL; 
            $t .= "JUSTIFICATIVA:\t" .$projeto->justificativa. PHP_EOL; 
            $t .= "ANO/MES:    \t" .$projeto->data. PHP_EOL; 
            $t .= "". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
        }#foreach
        #-----------------cria e escreve no arquivo 400.txt-----------------------      
         \Illuminate\Support\Facades\Storage::disk('public')->put('400.txt', $t);
        #-------------------------------------------------------------------------
       echo 'Message has been ProjetosCancelados';
       return $ProjetosCancelados;
    }
}
