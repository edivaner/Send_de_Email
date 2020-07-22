<?php

	//print_r($_POST);
	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer/PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php";
	require "./bibliotecas/PHPMailer/SMTP.php";

	use  PHPMailer\PHPMailer\PHPMailer;
	use  PHPMailer\PHPMailer\Exception;


	class Mensagem{
		private $para = null;
		private $assunto= null;
		private $mensagem = null;


		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function mensagemValida(){
			if(empty($this->para) || empty($this->assunto) || empty($this->mensagem) ){
				return false;
			}
			return true;
		}

	}


	$mensagem =new mensagem();
	$mensagem->__set('para', $_POST['para']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);

	//print_r($mensagem);

	if(!$mensagem->mensagemValida()){
		echo 'Mensagem não é validada';
		die();
	}

	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                                         // Enable verbose debug output
	    $mail->isSMTP();                                             // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                                     // Enable SMTP authentication
	    $mail->Username = '***********';       //Seu E-mail            // SMTP username
	    $mail->Password = '****';              //Sua Senha               // SMTP password
	    $mail->SMTPSecure = 'tls';                                   // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                           // TCP port to connect to

	    //Recipients
	    $mail->setFrom('*********', '******'); //Remetente (email e nome)
	    $mail->addAddress('*********', '*****');     // Quem vai receber (email e nome)
            
            // Name is optional
	    //$mail->addReplyTo('edivanerfernandes18@gmail.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = ''; //assunto
	    $mail->Body    = ''; //Conteudo com html
	    $mail->AltBody = ''; //conteudo sem html

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo 'Não Foi Possível enviar este e-mail! Por favor tente novamente mais tarde.';
	    echo '<br>'.'Detalhes do erro: ' . $mail->ErrorInfo;
	}

?>