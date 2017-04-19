<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
				
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../css/demos.css">
	</head>
<?php

include_once("../func/func_db.php");
include_once("../func/config.php");
include_once("../../_func/phpmailer/class.phpmailer.php");

$btIncluirSair = "";
if (isset($_POST['btIncluirSair'])){
	$btIncluirSair = $_POST['btIncluirSair'];
}

$at = "";
if (isset($_GET['at'])){
	$at = $_GET['at'];
}

if ($at == "s"){
	$c_erros = "";
	
	/* ##################### INSERCAO ##################### */	
	
	// ESTILO
	$erro_estilo = "";
	$PRE_ESTILO = "";
	if (isset($_POST['PRE_ESTILO'])){
		$PRE_ESTILO = $_POST['PRE_ESTILO'];
	}
	if ($PRE_ESTILO == ""){ 
		$c_erros = $c_erros . ",Estilo não informado.";
		$erro_estilo = "erro";
	}
	
	$erro_estilo_desc = "";
	$PRE_ESTILO_DESC = "";
	if (isset($_POST['PRE_ESTILO_DESC'])){
		$PRE_ESTILO_DESC = $_POST['PRE_ESTILO_DESC'];
	}
	if ($PRE_ESTILO_DESC == ""){ 
		$c_erros = $c_erros . ",Descrição não informada.";
		$erro_estilo_desc = "erro";
	}

	$erro_pri = "";
	$PRE_PRIORID = "";
	if (isset($_POST['PRE_PRIORID'])){
		$PRE_PRIORID = $_POST['PRE_PRIORID'];
	}
	if ($PRE_PRIORID == ""){ 
		$c_erros = $c_erros . ",PRIORID não informado.";
		$erro_pri = "erro";
	}

	if ($c_erros != ""){
		// Separa a lista de erros
		$campos_erro = "";
		$inicio = 1;
		$conta_palavra = 0;
		for ($i = 1; $i <= strlen($c_erros) - 1; $i++){
			$conta_palavra ++;
			if (trim($c_erros[$i]) == ","){
				if (trim(substr($c_erros, $inicio, $conta_palavra - 1)) != ""){
					$campos_erro = $campos_erro . '<li style="margin-left: 30px;">' . trim(substr($c_erros, $inicio, $conta_palavra - 1)) . "</li>";
					$inicio = $i + 1;
					$conta_palavra = 0;
				}
			}
		}
		// Imprime ultimo campo		
		if ($inicio >= 1){
			$campos_erro = $campos_erro . '<li style="margin-left: 30px;">' . trim(substr($c_erros, $inicio, $i - 1)) . "</li>";
		}

		// MOSTRA ERROS ##############################
		echo
		'<table width="60%" border="0" cellspacing="0" cellpadding="0" >'.
		'	<tr>'.
		'	<td>'.
		'		<div class="avisos_login" id="" style="">'.
		'			<font color="#FF0000" style="font-size:11px;">'.
		'				<center><font style="font-size:17px;"><strong>Atenção !</strong></font></center></br>'. $campos_erro .'</font>'.
		'			</div>'.
		'		</div>'.
		'	</td>'.
		'	</tr>'.
		'</table></br>';
	}else{
		// prod_estilo
		$sql_busca = "SELECT * FROM prod_estilo WHERE PRE_ESTILO = '$PRE_ESTILO'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($num_busca == 0){
			$sql_busca = "INSERT INTO prod_estilo (PRE_ESTILO,PRE_ESTILO_DESC,PRE_PRIORID) VALUES ('$PRE_ESTILO','$PRE_ESTILO_DESC','$PRE_PRIORID')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}else{
			$sql_busca = "UPDATE prod_estilo SET 
						  PRE_ESTILO_DESC = '$PRE_ESTILO_DESC',
						  PRE_PRIORID     = '$PRE_PRIORID'
						   WHERE PRE_ESTILO = '$PRE_ESTILO'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
	}
	/* ##################### INSERCAO ##################### */

	// Sair e atr cad. produt.
	if ($btIncluirSair != ""){
	?>
	<script language="javascript">
		opener.parent.document.formCadProduto.at_cmb.value = "S";
		opener.parent.document.formCadProduto.submit();

		window.close();
	</script>
	<?php
	}
}

/* ##################### CONSULTA #####################  */
$sql_busca = "SELECT MAX(PRE_PRIORID) AS PRIORID FROM prod_estilo ";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);
$num_busca = mysql_num_rows($exe_busca);

$PRIORID = $fet_busca['PRIORID'] + 10;
/* ##################### CONSULTA ##################### */

?>

<form id="formCadEstilo" name="formCadEstilo" action="cad_estilo.php?at=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Estilo</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Estilo</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_estilo != ""){echo "field_error";}else{echo "input";} ?>" maxlength="20" size="15" name="PRE_ESTILO"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Descrição</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_estilo_desc != ""){echo "field_error";}else{echo "input";} ?>" maxlength="40" size="30" name="PRE_ESTILO_DESC"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Prioridade</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_pri != ""){echo "field_error";}else{echo "input";} ?>" maxlength="3" style="WIDTH:30px;" name="PRE_PRIORID" value="<?php if($PRIORID != ""){ echo $PRIORID; } ?>"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"></br>
				<input type="submit" name="btIncluirSair" value="Incluir e Sair" style="width: 89px;">
				<input type="submit" name="btIncluir" 	  value="Incluir" style="width: 80px;">				
				<input type="submit" name="btFechar"  	  value="Fechar"  style="width: 80px;" onclick="window.close();">
			</td>
		</tr>
	</table>	
</form>
</html>