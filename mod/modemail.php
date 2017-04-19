<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		
		<link href="css/_templatemo_style.css" rel="stylesheet" type="text/css" />
	</head>
	
<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

$at = "";
$tipo = "";
$loginemailtop = "";

$PES_CPFCNPJ = "";
$USR_EMAIL = "";
$USR_SENHA = "";
$NOVO_EMAIL = "";
$RENOVO_EMAIL = "";

if (isset($_SESSION['sesEmailLog'])) 		$loginemailtop = $_SESSION['sesEmailLog'];
if (isset($_SESSION['tipo'])) 	  	 	$tipo = $_SESSION['tipo'];
if (isset($_SESSION['ses_cpfcnpj']))  	$PES_CPFCNPJ = soNumero($_SESSION['ses_cpfcnpj']);

if (isset($_POST['at'])) 				$at = $_POST['at'];

if ($at == "s"){
	$c_erros = "";
	$acao = "modemail"; // Ao atr, acao como mesmo local, no caso, ModEmail
	
	/* ##################### ALTERACAO ##################### */
	if (isset($_POST['PES_CPFCNPJ'])) $PES_CPFCNPJ = $_POST['PES_CPFCNPJ'];

	$USR_EMAIL = $_SESSION['USR_EMAIL'];

	if (isset($_POST['USR_SENHA']))	$USR_SENHA = base64_encode($_POST['USR_SENHA']);
	if ($USR_SENHA == ""){
		$c_erros = $c_erros . ",Senha não informada.";
		$erro_senha = "erro";
	}
	if (isset($_POST['NOVO_EMAIL'])) $NOVO_EMAIL = $_POST['NOVO_EMAIL'];
	if (isset($_POST['RENOVO_EMAIL'])) $RENOVO_EMAIL = $_POST['RENOVO_EMAIL'];

	$sql_busca = "
	SELECT pessoa.*, user.*
	  FROM pessoa, user
	 WHERE pessoa.PES_CPFCNPJ = user.USR_PES_CPFCNPJ
	   AND user.USR_EMAIL 	= '$loginemailtop'
	   AND user.USR_ATIVO   = 'S'	   
	   AND user.USR_SENHA   = '$USR_SENHA' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca == 0){
		$c_erros = $c_erros . ",Endereço de e-mail e/ou senha inválidos. Tente novamente.";
	}elseif($fet_busca['USR_ATIVO'] == "N"){
		$c_erros = $c_erros . ",Usuário não ativado, verifique seu e-mail para ativa a conta.<br>";
	}
	
	// So valida a email e senha quando for pela tela de cadastro
	if (!validaEmail($NOVO_EMAIL)){
		$c_erros = $c_erros . ", Novo e-mail inválido. Tente novamente.<br>";
	}
	
	$erro_email01 = "";
	$erro_email02 = "";
	if ($NOVO_EMAIL != $RENOVO_EMAIL){
		$c_erros = $c_erros . ",O Novo Email difere da Confirmação do Novo Email.";
		$erro_email01 = "erro";
		$erro_email02 = "erro";
	}
	if ($NOVO_EMAIL == ""){
		$c_erros = $c_erros . ", Novo Email não informado.";
		$erro_email01 = "erro";
	}
	if ($RENOVO_EMAIL == ""){
		$c_erros = $c_erros . ", Confirmação Novo Email não informado.";
		$erro_email02 = "erro";
	}
	
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		// pessoa
		$sql_busca = "SELECT * FROM user WHERE USR_PES_CPFCNPJ = '$PES_CPFCNPJ'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca != 0){
			$sql_busca = "
			UPDATE user SET 
			USR_EMAIL = '$NOVO_EMAIL'
			WHERE USR_PES_CPFCNPJ = '$PES_CPFCNPJ' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
	}
	/* ##################### ALTERACAO ##################### */
}else{
	/* ##################### CONSULTA ##################### */
	$sql_busca = "
	SELECT pessoa.*, user.*
	  FROM pessoa    AS pessoa
	  LEFT JOIN user AS user ON user.USR_PES_CPFCNPJ = pessoa.PES_CPFCNPJ
	 WHERE pessoa.PES_CPFCNPJ = '$PES_CPFCNPJ' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$USR_EMAIL    = $fet_busca['USR_EMAIL'];
	$_SESSION['USR_EMAIL'] = $USR_EMAIL;
	$USR_SENHA	  = $fet_busca['USR_SENHA'];
}
?>

<?php 
if ($at == "s" && $c_erros == ""){
	echo msgAviso("Email Alterado com Sucesso!","");
	
	$_SESSION['sesEmailLog'] 	= $NOVO_EMAIL;
	$loginemailtop			= $NOVO_EMAIL;
	$_SESSION['USR_EMAIL'] 	= "";
	
	$NOVO_EMAIL = "";
	$RENOVO_EMAIL = "";
}
?>

<div id="titulo">Alteração de Email</div>

<form id="formModEmail" name="formModEmail" action="<?php echo $modulo; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at" 	value="s">
	<input type="hidden" name="PES_CPFCNPJ" value="<?php if($PES_CPFCNPJ != ""){ echo $PES_CPFCNPJ; } ?>">

	<table class="pessoa" border="0" cellspacing="4" cellpadding="0" style="color:black;" align="center">
		<tr>
			<td width="190px" class="td_cad" ><div align="right"><b><label for="" style="margin-right:5px;">E-mail</label></b></div></td>
			<td align="left"><input type="text" class="<?php if($erro_email != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="cad_email" name="USR_EMAIL" 
									value="<?php if($loginemailtop != ""){ echo $loginemailtop; } ?>" readOnly="true" disabled></td>
		</tr>
		<tr>
			<td class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;">Senha</label></b></div></td>
			<td align="left"><input type="password" maxlength="100" style="WIDTH:50%;" id="cad_senha" name="USR_SENHA" 
									class="<?php if($erro_senha != ""){echo "field_error";}else{echo "input";} ?>"></td>
		</tr>
		<tr>
			<td class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Novo E-mail</label></b></div></td>
			<td align="left"><input type="text" class="<?php if($erro_email01 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="recad_email" name="NOVO_EMAIL"
									value="<?php if($NOVO_EMAIL != ""){ echo $NOVO_EMAIL; } ?>"></td>
		</tr>
		<tr>
			<td class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Confirme Novo E-mail</label></b></div></td>
			<td align="left"><input type="text" class="<?php if($erro_email02 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="recad_email" name="RENOVO_EMAIL"
									value="<?php if($RENOVO_EMAIL != ""){ echo $RENOVO_EMAIL; } ?>"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"></br>
				<input class="btsubmit" type="submit" name="btAlteraEmail" value="Alterar Email">
			</td>
		</tr>
	</table>
	</br></br>
	
	<script type="text/javascript">document.formModEmail.USR_SENHA.focus();</script>
</form>
</html>