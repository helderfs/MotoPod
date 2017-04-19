<?php
//      Formulário
// =================================================== //

// campos
$data   	= date("d/m/Y - H:i");
$nome   	= $_POST['nome'];
$email  	= $_POST['email'];
$assunto	= $_POST['assunto'];
$info		= $_POST['info'];

//      Email que chega até você
// =================================================== //
if (trim($assunto) == "")
	$assunto = "Contato Site";

$para		= "contato@motopod.com.br";
$header		= "
<b>Nome:</b>    $nome<br>
<b>Email:</b>   $email<br>
<br><br>
<b>MENSAGEM:</b><br>
$info
<br><br>

==============================================<br>
		$data <br>
==============================================<br>
";

// Função HTML :)
$headers .= "MIME-Version: 1.0\r\n";
//$headers .= "Content-type: text/html;charset=iso-8859-1\r\n";
$headers .= "Content-type: text/html;charset=utf-8\r\n";
$headers .= "From: $nome <$email>\r\n";

//      Resposta que vai ao Cliente/Visitante
// =================================================== //
$resp_assunto	= "contato :: motopod";
$header2		= "
Olá <b>$nome</b>,
<br><br>
Obrigado por visitar o MotoPod.<br>
Recebemos seu e-mail e brevemente entraremos em contato.
<br><br><br>

Atenciosamente,<br>
<b>motopod</b><br>
";

// Função HTML
$headers2 .= "MIME-Version: 1.0\r\n";
//$headers2 .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers2 .= "Content-type: text/html; charset=utf-8\r\n";
$headers2 .= "From: contato motopod <contato@motopod.com.br>\r\n";

// Envia para você
mail($para, $assunto, $header, $headers);
// Envia para quem preencheu o form
mail($email, $resp_assunto, $header2,$headers2);

echo "<script>window.location='/contato'</script>";

//echo "OPAOPAOPAOPAOPA<br>". $para ." --- ". $assunto ." --- ". $header ." --- ". $headers;
?>