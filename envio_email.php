<?php
	include_once("../_func/phpmailer/class.phpmailer.php");

	$psswrd = "senha671236";
	$nome   = "Helder";
	$email  = "helderfsantos@gmail.com";

	$mensagem = htmlspecialchars($mensagem); // Isso aqui é pra Desabilitar Tag's HTML (Muito Util)
	
	//$headers  = "Content-Type: text/html; charset=iso-8859-1\n";
	$headers  = "Content-Type: text/html; charset=UTF-8;";

	//$fonte = "<font color=\"black\" size=\"-1\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
	
	$destinatario = " $email "; // Aqui pega e email do usuario e envia uma resposta
	
	$msg2  = '
				<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
					<font color="black" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
					</head>
				<body>
				<img src="http://www.motopod.com/logo_tmb.png" alt="motopod">
				<br><br><h3>Lembrete de Senha</h3><br>
				Sr(a) ';
	$msg2  .= $nome;
	$msg2  .= ',<p>
				Seguem as informações para acesso à sua conta na <font color="red"><b>motopod</b></font>!<br><br>
				E-mail: <b>';
	$msg2  .= $email;
	$msg2  .= '</b><br>Senha: <b> ';
	$msg2  .= $psswrd;
	$msg2  .= ' </b><br><br><hr>
				Atendimento <font color="red"><b>motopod</b></font><br>
				<font color="gray"><b>E-mail: </b></font>contato@motopod.com<br>
				</body>
				</html>';

	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP(); // Define que a mensagem será SMTP
	$mail->Host = 'mail.zoomoutdoors.com.br'; //'localhost';
	$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
	$mail->Port = 587; //Indica a porta de conexão para a saída de e-mails
	$mail->Username = 'contato@zoomoutdoors.com.br'; // Usuário do servidor SMTP
	$mail->Password = 'contato22'; // Senha do servidor SMTP

	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "contato@motopod.com"; // Seu e-mail
	//$mail->From = $mail->Username;
	$mail->FromName = "motopod";
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($destinatario);
	//$mail->AddAddress('helderfsantos@gmail.com', 'Helder');
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject = "Lembrete de Senha - motopod"; // Assunto da mensagem
	$mail->Body = $msg2;
	//$mail->AltBody = 'Este é o corpo da mensagem de teste, em Texto Plano! \r\n <img src="http://blog.thiagobelem.net/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> ';

	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");&nbsp; // Insere um anexo

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

?>