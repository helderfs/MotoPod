<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" charset="utf-8"/>

	<link rel="stylesheet" href="css/demos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
		
	<script language="javascript" type="text/javascript">
	</script>
	
	</head>
<?php
include_once("../func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");
include_once("../../_func/phpmailer/class.phpmailer.php");

/*########################################################################################################################*/
/* 
DESENVOLVER NOVO GERADOR DE SENHA

??????????????????????????
function gera_pw(){
  	
  	$CaracteresAceitos = 'AaBbCcDdEeFfGgHhiJjLMmNnRrSstTuUvVxXzZ123456789';
  	$max = strlen($CaracteresAceitos)-1;
  	$password = null;
  	for($i=0; $i < 4; $i++) { 
  		$password .= $CaracteresAceitos{rand(0, $max)};
  	}
  	
	return $password;
}
*/

$USR_EMAIL = "";
$c_erros = "";
$at = "";

if (isset($_GET['at'])){
	$at = $_GET['at'];
}
if ($at == "s"){

	$erro_email = "";
	if (isset($_POST['USR_EMAIL'])){
		$USR_EMAIL = $_POST['USR_EMAIL'];
	
		if ($USR_EMAIL != ""){
			$qr = "SELECT USR_EMAIL FROM user WHERE USR_EMAIL = '$USR_EMAIL' ";
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);
			if ($total == 0) 
				$c_erros = " E-mail não cadastrado!";
		}
	}
	if ($USR_EMAIL == ""){
		$c_erros = $c_erros . " E-mail não informado!";
		$erro_email = "erro";
	}		
	
	if ($c_erros == ""){
		$qr = "
		SELECT user.USR_SENHA, user.USR_EMAIL, PES.PES_NOME
		  FROM user AS user
		  LEFT JOIN pessoa AS PES ON PES.PES_CPFCNPJ = user.USR_PES_CPFCNPJ
		 WHERE user.USR_EMAIL = '$USR_EMAIL' ";
		$sql = mysql_query($qr);
		$total = mysql_num_rows($sql);
		while($r = mysql_fetch_array($sql)){
			$email  = $USR_EMAIL;
			$nome   = $r['PES_NOME'];
			$psswrd = base64_decode($r['USR_SENHA']);

			$msg  = '
			<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
				<font color="black" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				</head>
			<body>
				<img src="http://www.emnomedejesus.com.br/images/logo.jpg" alt="Em Nome de Jesus" height="180px">
				<br><br><h3>Lembrete de Senha</h3><br>
				Sr(a) '. $nome .',<p>
				Seguem as informações para acesso à sua conta <font color="red"><b>Em Nome de Jesus</b></font>!<br><br>
				E-mail: <b>'. $email . '</b><br>
				Senha: <b> '. $psswrd . '</b><br><br><hr>
				Atendimento <font color="red"><b>Em Nome de Jesus</b></font><br>
				<font color="gray"><b>E-mail: </b></font>contato@emnomedejesus.com.br<br>
			</body>
			</html>';
			
			$enviou = enviaEmail($email, $subject, $msg);
		}
	}
}
?>

<?php if ($at == "s" && $c_erros == ""){ ?>
	<script language="JavaScript" type=" text/JavaScript">
		//alert("Sua senha foi enviada para seu e-mail.");
		//window.close();
	</script>
<?php } ?>

<form id="formLembraSenha" name="formLembraSenha" action="telaLembraSenha.php?at=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Lembrete de Senha</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<?php if ($c_erros != ""){ ?>
		<tr><td><?php echo msgErro($c_erros); ?></td></tr>
		<?php } ?>		
		
		<tr>
			<td align="center"></br>
			<table width="90px" border="0" cellspacing="4" cellpadding="0">
				<tr>
					<td align="left" class="td_cad" ><b><label for="" style="margin-right:5px;">Informe o <u>E-mail</u> para reenvio de senha</label></b></td>
				</tr>
				<tr>
					<td align="left"><input type="text" class="<?php if($erro_email != ""){echo "field_error";}else{echo "input";} ?>" size="40" maxlength="60" id="USR_EMAIL" name="USR_EMAIL" value="<?php if($USR_EMAIL != ""){ echo $USR_EMAIL; } ?>"></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<input type="submit" name="btEnvioSenha" value="Lembrar Senha" style="height:40px; width:110px;">
			</td>
		</tr>
	</table>
	
	<script language="javascript" type="text/javascript">document.formLembraSenha.USR_EMAIL.focus();</script>
</form>
</html>