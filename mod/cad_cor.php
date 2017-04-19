<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">
	</head>
<?php

include_once("../../_func/phpmailer/class.phpmailer.php");
include_once("../_func/func_db.php");
include_once("../func/config.php");


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
	$erro_01 = "";
	$PRC_COR = "";
	if (isset($_POST['PRC_COR'])){
		$PRC_COR = $_POST['PRC_COR'];
	}
	if ($PRC_COR == ""){ 
		$c_erros = $c_erros . ",Cor não informado.";
		$erro_01 = "erro";
	}

	$erro_02 = "";
	$PRC_COR_DESC = "";
	if (isset($_POST['PRC_COR_DESC'])){
		$PRC_COR_DESC = $_POST['PRC_COR_DESC'];
	}
	if ($PRC_COR_DESC == ""){
		$c_erros = $c_erros . ",Descrição não informada.";
		$erro_02 = "erro";
	}
	
	$erro_03 = "";
	$PRC_PRIORID = "";
	if (isset($_POST['PRC_PRIORID'])){
		$PRC_PRIORID = $_POST['PRC_PRIORID'];
	}
	if ($PRC_PRIORID == ""){ 
		$c_erros = $c_erros . ",PRIORID não informado.";
		$erro_03 = "erro";
	}

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		// prod_cor
		$sql_busca = "SELECT * FROM prod_cor WHERE PRC_COR = '$PRC_COR'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($num_busca == 0){
			$sql_busca = "INSERT INTO prod_cor (PRC_COR,PRC_COR_DESC,PRC_PRIORID) VALUES ('$PRC_COR','$PRC_COR_DESC','$PRC_PRIORID')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}else{
			$sql_busca = "UPDATE prod_cor SET 
						  PRC_PRIORID  = '$PRC_PRIORID'
						  PRC_COR_DESC = '$PRC_COR_DESC'
						   WHERE PRC_COR = '$PRC_COR'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
	}
	/* ##################### INSERCAO ##################### */

	// Sair e atr cad. produt.
	if ($btIncluirSair != ""){
		?>
		<script language="javascript">
			opener.parent.document.formCadProduto.at_cmbs.value = "S";
			opener.parent.document.formCadProduto.submit();

			window.close();
		</script>
		<?php
	}
}

/* ##################### CONSULTA #####################  */
$sql_busca = "SELECT MAX(PRC_PRIORID) AS PRIORID FROM prod_cor ";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);
$num_busca = mysql_num_rows($exe_busca);

$PRIORID = $fet_busca['PRIORID'] + 10;
/* ##################### CONSULTA ##################### */

?>

<form id="formCadCor" name="formCadCor" action="cad_cor.php?at=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Cor</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Cor</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_01 != ""){echo "field_error";}else{echo "input";} ?>" size="5" maxlength="5" name="PRC_COR"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Nome Cor</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_02 != ""){echo "field_error";}else{echo "input";} ?>" size="20" maxlength="30" name="PRC_COR_DESC"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Prioridade</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_03 != ""){echo "field_error";}else{echo "input";} ?>" size="3" maxlength="3" name="PRC_PRIORID" value="<?php if($PRIORID != ""){ echo $PRIORID; } ?>"></div></td>
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