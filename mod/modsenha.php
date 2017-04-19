<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		
		<link href="css/_templatemo_style.css" rel="stylesheet" type="text/css" />
	</head>
	
<?php
include_once("../_func/phpmailer/class.phpmailer.php");
include_once("../_func/func_db.php");
include_once("func/config.php");

$loginemailtop = "";
if (isset($_SESSION['sesEmailLog'])) $loginemailtop = $_SESSION['sesEmailLog'];

$at = "";
if (isset($_POST['at'])) $at = $_POST['at'];

if ($at == "s"){
	$c_erros = "";
	$acao = "modsenha"; // Ao atr, acao como mesmo local, no caso, ModSenha
	
	/* ##################### ALTERACAO ##################### */
	$PES_CPFCNPJ = "";
	if (isset($_POST['PES_CPFCNPJ'])) $PES_CPFCNPJ = $_POST['PES_CPFCNPJ'];

	$USR_EMAIL = "";
	if (isset($_POST['USR_EMAIL']))	$USR_EMAIL = $_POST['USR_EMAIL'];

	$USR_SENHA = "";
	if (isset($_POST['USR_SENHA']))	$USR_SENHA = base64_encode($_POST['USR_SENHA']);
	if ($USR_SENHA == ""){
		$c_erros = $c_erros . ",Senha Antiga não informada.";
		$erro_senha = "erro";
	}

	$sql_busca = "
	SELECT pessoa.*, user.*
	  FROM pessoa, user
	 WHERE pessoa.PES_CPFCNPJ = user.USR_PES_CPFCNPJ
	   AND user.USR_EMAIL = '$loginemailtop' 
	   AND user.USR_ATIVO = 'S'
	   AND user.USR_SENHA = '$USR_SENHA' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca == 0){
		$c_erros = $c_erros . ",Senha Antiga inválida. Tente novamente.";
	}elseif($fet_busca['USR_ATIVO'] == "N"){
		$c_erros = $c_erros . ",Usuário não ativado, verifique seu e-mail para ativa a conta.<br>";
	}

	// user
	$NOVA_SENHA = "";
	if (isset($_POST['NOVA_SENHA'])) $NOVA_SENHA = base64_encode($_POST['NOVA_SENHA']);
	$RENOVA_SENHA = "";
	if (isset($_POST['RENOVA_SENHA'])) $RENOVA_SENHA = base64_encode($_POST['RENOVA_SENHA']);

	if (!validaSenha($NOVA_SENHA)) 
		$c_erros = $c_erros . ", Nova senha inválida. Tente novamente.<br>";

	$erro_senha01 = "";
	$erro_senha02 = "";
	if ($NOVA_SENHA != $RENOVA_SENHA){
		$c_erros = $c_erros . ",A Nova Senha difere da Confirmação da Nova Senha.";
		$erro_senha01 = "erro";
		$erro_senha02 = "erro";
	}
	if ($NOVA_SENHA == ""){
		$c_erros = $c_erros . ", Nova Senha não informada.";
		$erro_senha01 = "erro";
	}
	if ($RENOVA_SENHA == ""){
		$c_erros = $c_erros . ", Confirmação Nova Senha não informada.";
		$erro_senha02 = "erro";
	}

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		// user
		$sql_busca = "SELECT * FROM user WHERE USR_PES_CPFCNPJ = '$PES_CPFCNPJ'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		//$num_busca=0 "Sem Registro" | $num_busca=1 "Com Registro"
		if ($num_busca != 0){
			$sql_busca = "UPDATE user SET " .
						 "USR_SENHA = '$NOVA_SENHA' " .
						 "WHERE USR_PES_CPFCNPJ = '$PES_CPFCNPJ'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
	}
	/* ##################### ALTERACAO ##################### */
}else{
	/* ##################### CONSULTA ##################### */
	$email = "";
	if (isset($_SESSION['sesEmailLog'])){
		$email = $_SESSION['sesEmailLog'];
	}
	$PES_CPFCNPJ = "";
	if (isset($_SESSION['ses_cpfcnpj'])) $PES_CPFCNPJ = soNumero($_SESSION['ses_cpfcnpj']);

	$sql_busca = "
	SELECT pessoa.*, user.*
	  FROM pessoa 	 AS pessoa
	  LEFT JOIN user AS user ON user.USR_PES_CPFCNPJ = pessoa.PES_CPFCNPJ
	 WHERE pessoa.PES_CPFCNPJ = '$PES_CPFCNPJ' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$USR_EMAIL        	   = $fet_busca['USR_EMAIL'];
	$_SESSION['USR_EMAIL'] = $USR_EMAIL;
	$REUSR_EMAIL		   = "";

	$USR_SENHA	  = $fet_busca['USR_SENHA'];
	$NOVO_EMAIL   = "";
	$RENOVO_EMAIL = "";
}
?>

<?php 
if ($at == "s" && $c_erros == ""){
	echo msgAviso("Senha Alterada com Sucesso!","");
}
?>

<div id="titulo">Alteração de Senha</div>

<form id="formModSenha" name="formModSenha" action="<?php echo $modulo; ?>" method="post" accept-charset="utf-8">
	<input type="hidden" name="at" 	value="s">
	<input type="hidden" name="PES_CPFCNPJ" value="<?php if($PES_CPFCNPJ != ""){ echo $PES_CPFCNPJ; } ?>">

	<table class="pessoa" border="0" cellspacing="4" cellpadding="0" style="color:black;" align="center">
		<tr>
			<td width="" class="td_cad" ><div align="right"><b><label for="" style="margin-right:5px;">E-mail</label></b></div></td>
			<td align="left"><input type="text" class="<?php if($erro_email != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="cad_email" name="USR_EMAIL"
									value="<?php if($loginemailtop != ""){ echo $loginemailtop; } ?>" readOnly="true" disabled></td>
		</tr>
		<tr>
			<td width="" class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;">Senha Antiga</label></b></div></td>
			<td align="left"><input type="password" maxlength="100" style="WIDTH:50%;" id="USR_SENHA" name="USR_SENHA" class="<?php if($erro_senha != ""){echo "field_error";}else{echo "input";} ?>"></td>
		</tr>
		<tr>
			<td width="" class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Nova Senha</label></b></div></td>
			<td align="left"><input type="password" maxlength="100" style="WIDTH:50%;" id="NOVA_SENHA" name="NOVA_SENHA" class="<?php if($erro_senha != ""){echo "field_error";}else{echo "input";} ?>"></td>
		</tr>
		<tr>
			<td width="" class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Confirme Nova Senha</label></b></div></td>
			<td align="left"><input type="password" maxlength="100" style="WIDTH:50%;" id="RENOVA_SENHA" name="RENOVA_SENHA" class="<?php if($erro_senha != ""){echo "field_error";}else{echo "input";} ?>"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"></br>
				<input class="btsubmit" type="submit" name="btAlteraSenha" value="Alterar Senha">
			</td>
		</tr>
	</table>
	</br></br>

	<script type="text/javascript">document.formModSenha.USR_SENHA.focus();</script>
</form>
</html>