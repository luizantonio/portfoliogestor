<?php
//namespace App\Mail\app\Mail;
require_once('/usr/share/php/libphp-phpmailer/autoload.php');
require_once('/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php');
require_once('/usr/share/php/libphp-phpmailer/class.phpmailer.php');
require_once('/usr/share/php/libphp-phpmailer/class.smtp.php');
$servername = "localhost";
$username = "cancelados";
$password = "12345";
$banco = "portifoliogestor";
$Mails = array();
$projetosCollection = array();
# Create connection
$conn = false;
$conn = mysqli_connect($servername, $username, $password, $banco);
// Check connection
if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
}
ini_set('max_execution_time', 60);
# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
# CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dateSaoPaulo = date('d/m/Y H:i:s', time());
# Recupera os projetos cncelados
$date = date('Ym');        
$sql = 'select * from portifoliogestor.projetoscancelados WHERE portifoliogestor.projetoscancelados.data="'.$date.'"';
$projetosCancelados = $conn->query($sql);
$emailsAltaDirecao = $conn->query("select email from usermails");
#Close the connection with DB if is open
mysqli_close($conn);
$verificar = null;
if($projetosCancelados){
    if(!is_null($projetosCancelados) && sizeof($projetosCancelados) > 0){
         $verificar = $projetosCancelados;
    }
}
# variável para a colecao de emails
$eMails = array();
# variável para o retorno do arquivo
$Arquivo = null;        
# 1o tem projetos cancelado - verifica
if ( !is_null($verificar) ){
        if($emailsAltaDirecao){
            if ( !is_null($emailsAltaDirecao) ){
                foreach ($emailsAltaDirecao as $usermail) {   
                    //echo($usermail["email"]."\n\t") ;
                    $eMails [] = $usermail["email"];
                }
            }
        }
        # email not null
        if ( !is_null($eMails) ){
            if(is_null($verificar)){
                return null;
            }
            error_reporting(E_ALL);
            # RELATÓRIO FILE BEGINN
            $t = "";
            $t .= "\r\n". PHP_EOL;
            $stringCabecalho = "RELATORIO DOS PROJETOS CANCELADOS NO PERIODO";
            $t .= "\t\t".$stringCabecalho. PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "EMPRESA:\t". "PORTIFOLIOGESTOR". PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "DATA: ".date('d/m/Y H:i:s'). PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "-----------------------------------------------------------------". PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "PERIODO - ANO/MES: ". date('Ym'). PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            $t .= "=================================================================". PHP_EOL;
            $t .= "\r\n". PHP_EOL;
            foreach($verificar as $key => $projeto){
                $t .= "PROJETO:\t". $projeto['projeto']. PHP_EOL;
                $t .= "\r\n". PHP_EOL;
                $t .= "-----------------------------------------------------------------". PHP_EOL;
                $t .= "\r\n". PHP_EOL;
                $t .= "RESPONSAVEL:\t" .$projeto['responsavel']. PHP_EOL; 
                $t .= "\r\n". PHP_EOL; 
                $t .= "STATUS:     \t" .$projeto['status']. PHP_EOL; 
                $t .= "\r\n". PHP_EOL;
                $t .= "JUSTIFICATIVA:\t" .$projeto['justificativa']. PHP_EOL; 
                $t .= "\r\n". PHP_EOL;
                $t .= "ANO/MES:    \t" .$projeto['data']. PHP_EOL; 
                $t .= "\r\n". PHP_EOL;
                $t .= "". PHP_EOL;
                $t .= "\r\n". PHP_EOL;
                $t .= "-----------------------------------------------------------------". PHP_EOL;
                $t .= "\r\n". PHP_EOL;
            }#foreach
            #-----------------escreve no arquivo relatorio.txt-----------------------     
            $filename = '/var/www/html/public/storage/relatorio.txt';
            if (file_exists($filename)) {
                $oldfile = fopen("/var/www/html/public/storage/relatorio.txt", "w") or die("Falha ao abrir arquivo de relarorio!");
                fwrite($oldfile, $t);
                fclose($oldfile);
            }
             #-----------------cria e escreve no arquivo relatorio.txt----------------------- 
            $fileName = 'relatorio';
            $newFileName = '/var/www/html/public/storage/'.$fileName.".txt";
            if (file_put_contents($newFileName, $t) !== false) {
                echo "Arquivo criado com sucesso (" . basename($newFileName) . ") ";
            } else {
                echo "Nao pode criar o arquivo (" . basename($newFileName) . ") ";
            }
        }# email not null
        $date = date('m/Y');
        # tem projetos cancelados
        if ( !is_null($verificar) ){
            $filename = '/var/www/html/public/storage/relatorio.txt';
            if (file_exists($filename)) {
                $mail = new PHPMailer(true);
                $name = "Portifoliogestor";
                $email = "nao-responda@portifoliogestor.com";
                $message = "Relatorio de projetos cancelados no periodo:". $date. ". Arquivo do relatorio segue anexo. ";
                $mail->isMail();            // Set mailer to use SMTP or MAIL
                $mail->Host = 'localhost';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;     // Enable SMTP authentication
                $mail->Username = 'portifoliogestor@portifoliogestor.com'; // SMTP username
                $mail->Password = '123456';  // SMTP password
                $mail->SMTPSecure = 'tls';   // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;           // TCP port to connect to
                $mail->From = 'administrador@portifoliogestor.com';
                $mail->FromName = $name;           
                # $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Relatorio de Projetos Cancelados em: '.$date;
                $mail->Body = $message;
                $mail->Body .= "<br/><br/>Below are my contact details <br/> Name: ";
                $mail->Body .= $name;
                $mail->Body .= "<br/> My email address: ";
                $mail->Body .= $email;
                $mail->AltBody = 'You are using basic web browser ';
                $mail->MsgHTML("Relatorio de projetos cancelados no periodo:". $date);
                foreach ($eMails as $CcMail) {
                    $mail->AddAddress($CcMail);
                }
                $filename = '/var/www/html/public/storage/relatorio.txt'; // File to attachments
                if (file_exists($filename)) {
                    $mail->AddAttachment('/var/www/html/public/storage/relatorio.txt', $name = 'relatorio.txt',
                        $encoding = 'base64', $type = 'txt'); // Add attachments
                }
                if(!$mail->send()) {
                    echo 'A mensagem não foi enviada.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'A mensagem foi enviada';
                }
            }
        }# 2o tem projetos cancelados
        else{
                $mail = new PHPMailer(true);
                $name = "Portifoliogestor";
                $email = "nao-responda@portifoliogestor.com";
                $message = "Relatorio de projetos cancelados no periodo!". $date;
                $mail->isMail();            // Set mailer to use SMTP
                $mail->Host = 'localhost';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;     // Enable SMTP authentication
                $mail->Username = 'portifoliogestor@portifoliogestor.com'; // SMTP username
                $mail->Password = '123456'; // SMTP password
                $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;          // TCP port to connect to
                $mail->From = 'nao-responda@portifoliogestor.com';
                $mail->FromName = $name;          
                //$mail->isHTML(true);      // Set email format to HTML
                $mail->Subject = "Relatorio de projetos cancelados no periodo: ". $date;
                $mail->Body = $message;
                $mail->Body .= "<br/><br/>Caso deseje entrar en contato.<br/> Name: ";
                $mail->Body .= $name;
                $mail->Body .= "<br/> Meu endereco de email: ";
                $mail->Body .= $email;
                $mail->AltBody = 'Voce esta usando um basico web browser ';
                $mail->MsgHTML('Nao foram encontrados projetos cancelados neste periodo! Sem anexo.');
                foreach ($eMails as $CcMail) {
                    $mail->AddAddress($CcMail);
                }
                if(!$mail->send()) {
                    echo 'A mensagem não foi enviada.';
                    echo "\n\t";
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo "\n\t";
                    echo 'A mensagem foi enviada';
                }
            }#else
}# 1o tem projetos cancelado - verifica
?>