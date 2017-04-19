<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
				
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">
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
	$erro_01 = "";
	$PTP_TIPO_PROD = "";
	if (isset($_POST['PTP_TIPO_PROD'])){
		$PTP_TIPO_PROD = $_POST['PTP_TIPO_PROD'];
	}
	if ($PTP_TIPO_PROD == ""){ 
		$c_erros = $c_erros . ",Tipo Produto não informado.";
		$erro_01 = "erro";
	}

	$erro_02 = "";
	$PTP_TIPO_PROD_DESC = "";
	if (isset($_POST['PTP_TIPO_PROD_DESC'])){
		$PTP_TIPO_PROD_DESC = $_POST['PTP_TIPO_PROD_DESC'];
	}
	if ($PTP_TIPO_PROD_DESC == ""){ 
		$c_erros = $c_erros . ",Descrição não informada.";
		$erro_02 = "erro";
	}
	
	$erro_03 = "";
	$PTP_PRIORID = "";
	if (isset($_POST['PTP_PRIORID'])){
		$PTP_PRIORID = $_POST['PTP_PRIORID'];
	}
	if ($PTP_PRIORID == ""){ 
		$c_erros = $c_erros . ",PRIORID não informado.";
		$erro_03 = "erro";
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
		// prod_tip_prod
		$sql_busca = "SELECT * FROM prod_tip_prod WHERE PTP_TIPO_PROD = '$PTP_TIPO_PROD'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($num_busca == 0){
			$sql_busca = "INSERT INTO prod_tip_prod (PTP_TIPO_PROD,PTP_TIPO_PROD_DESC,PTP_PRIORID) VALUES ('$PTP_TIPO_PROD','$PTP_TIPO_PROD_DESC','$PTP_PRIORID')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}else{
			$sql_busca = "UPDATE prod_tip_prod SET 
						  PTP_TIPO_PROD_DESC = '$PTP_TIPO_PROD_DESC',
						  PTP_PRIORID = '$PTP_PRIORID'
						   WHERE PTP_TIPO_PROD = '$PTP_TIPO_PROD'";
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
$sql_busca = "SELECT MAX(PTP_PRIORID) AS PRIORID FROM prod_tip_prod ";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);
$num_busca = mysql_num_rows($exe_busca);

$PRIORID = $fet_busca['PRIORID'] + 10;
/* ##################### CONSULTA ##################### */

?>

<form id="formCadProduto" name="formCadProduto" action="cad_tp_prod.php?at=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Tipo Produto</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Tipo Produto</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_01 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="20" size="15" name="PTP_TIPO_PROD"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Descrição</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_01 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="40" size="30" name="PTP_TIPO_PROD"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Prioridade</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_03 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="3" style="WIDTH:30px;" name="PTP_PRIORID" value="<?php if($PRIORID != ""){ echo $PRIORID; } ?>"></div></td>
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