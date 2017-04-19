<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	
<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");
include_once("../_func/phpmailer/class.phpmailer.php");

$btEnviaEmail = "";
if (isset($_POST['btEnviaEmail']))	$btEnviaEmail = $_POST['btEnviaEmail'];

if ($btEnviaEmail != ""){
	$c_erros = "";
	
	/* ##################### ALTERACAO ##################### */
	$USR_EMAIL = "";
	if (isset($_POST['USR_EMAIL']))
		$USR_EMAIL = $_POST['USR_EMAIL'];

	// So valida a email e senha quando for pela tela de cadastro
	if (!validaEmail($USR_EMAIL))
		$c_erros = " E-mail informado é inválido!";
	else 
		$c_erros = "";

	$sql_busca = "SELECT * FROM user WHERE USR_EMAIL = '$USR_EMAIL' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	//$num_busca=0 "Sem Registro" | $num_busca=1 "Com Registro"
	if ($num_busca == 1) 
		$c_erros = " E-mail já cadastrado!";
	
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		$sql_busca = "INSERT INTO  user (USR_EMAIL, USR_RECEBE_EMAILS) VALUES ('$USR_EMAIL', 'S')";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	}
	/* ##################### ALTERACAO ##################### */
}else{
	$USR_EMAIL = "";
}

if ($btEnviaEmail != "" && $c_erros == "")
	echo msgAviso("Email Cadastrado!","");

?>

<div id="titulo">Notícias por e-mail</div>

<form id="formModEmail" name="formModEmail" action="juntese" method="post" accept-charset="utf-8">
	
	<center>
	<table width="100%" border="0" cellspacing="4" cellpadding="0" style="color:black;">
		<tr>
			<td>
				<table border="0" cellspacing="4" cellpadding="0" align="center">
					<tr>
						<td class="td_cad" ><div align="right"><b><label for="" style="margin-right:5px;">E-mail</label></b></div></td>
						<td align="left"><input type="text" class="<?php if($erro_email != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="cad_email" name="USR_EMAIL" 
												value="<?php if($USR_EMAIL != ""){ echo $USR_EMAIL; } ?>"></td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"></br>
				<input class="btsubmit" type="submit" name="btEnviaEmail" value="Enviar E-mail">
			</td>
		</tr>
	</table>
	<center>
	
	</br></br>
	</br></br>
	
	<script type="text/javascript">document.formModEmail.USR_EMAIL.focus();</script>
</form>
</html>