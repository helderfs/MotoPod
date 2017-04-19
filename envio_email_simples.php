<?php
// Incluindo arquivo com a classe Mail
require_once('Mail.php'); 

// Configurar quem envia, quem recebe, assunto e a mensagem do email.
$de         = "CONTATO motopod<contato@motopod.com>";
$para       = "Helder<helderfsantos@gmail.com>";
$assunto    = "Lembrete de Senha - motopod";

$nome	    = "João come pão";
$email		= "helderfsantos@gmail.com";
$psswrd     = "santo45858@#";

//$fonte = "<font color=\"black\" size=\"-1\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
//$mensagem  = "$fonte";
$mensagem = "
Lembrete de Senha
Sr(a) $nome
sua Senha é  $psswrd 

Seu Login será sempre seu email '$email'

Atenciosamente - motopod
contato@motopod.com";
//$mensagem = htmlspecialchars($mensagem); // Isso aqui é pra Desabilitar Tag's HTML (Muito Util)


// Configurar os dados de conexão ao servidor SMTP
$servidor 	= "mail.zoomoutdoors.com.br"; // Coloque aqui seu servidor de SMTP
$login		= "contato@zoomoutdoors.com.br"; // Coloque aqui o email de login de sua conta
$senha	 	= "contato22"; // Coloque aqui a senha do email
  
########## NÂO ALTERAR ############################
// Cabeçalho do email
$headers = array (
    'From'     => $de,
    'Reply-to' => $de,
    'To'       => $para,
    'Subject'  => $assunto
);

// Conexão ao servidor
$smtp = Mail::factory('smtp',
    array (
      'host'     => $servidor,
      'port'     => 25,
      'auth'     => true,
      'username' => $login,
      'password' => $senha
    )
);
 
// Efetuando o envio autenticado
$mail = $smtp->send($para, $headers, $mensagem);
###################################################
 
// Verificando se houve erro
if (PEAR::isError($mail)) {
    echo("Error:" . $mail->getMessage());
} else {
    echo("Email enviado com sucesso!!");
}
?>