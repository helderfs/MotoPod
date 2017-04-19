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
	$PRM_MATERIAL = "";
	if (isset($_POST['PRM_MATERIAL'])){
		$PRM_MATERIAL = $_POST['PRM_MATERIAL'];
	}
	if ($PRM_MATERIAL == ""){ 
		$c_erros = $c_erros . ",Material não informado.";
		$erro_01 = "erro";
	}
	
	$erro_02 = "";
	$PRM_MATERIAL_DESC = "";
	if (isset($_POST['PRM_MATERIAL_DESC'])){
		$PRM_MATERIAL_DESC = $_POST['PRM_MATERIAL_DESC'];
	}
	if ($PRM_MATERIAL_DESC == ""){ 
		$c_erros = $c_erros . ",Descrição não informada.";
		$erro_02 = "erro";
	}

	$erro_03 = "";
	$PRM_PRIORID = "";
	if (isset($_POST['PRM_PRIORID'])){
		$PRM_PRIORID = $_POST['PRM_PRIORID'];
	}
	if ($PRM_PRIORID == ""){ 
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
		// prod_material
		$sql_busca = "SELECT * FROM prod_material WHERE PRM_MATERIAL = '$PRM_MATERIAL'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($num_busca == 0){
			$sql_busca = "INSERT INTO prod_material (PRM_MATERIAL,PRM_MATERIAL_DESC,PRM_PRIORID) VALUES ('$PRM_MATERIAL','$PRM_MATERIAL_DESC','$PRM_PRIORID')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}else{
			$sql_busca = "UPDATE prod_material SET 
			              PRM_MATERIAL_DESC  = '$PRM_MATERIAL_DESC',
			              PRM_PRIORID        = '$PRM_PRIORID'
						  WHERE PRM_MATERIAL = '$PRM_MATERIAL'";
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
$sql_busca = "SELECT MAX(PRM_PRIORID) AS PRIORID FROM prod_material ";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);
$num_busca = mysql_num_rows($exe_busca);

$PRIORID = $fet_busca['PRIORID'] + 10;
/* ##################### CONSULTA ##################### */

?>

<form id="formCadMaterial" name="formCadMaterial" action="cad_material.php?at=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Material</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Material</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_01 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="20" size="15" name="PRM_MATERIAL"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Descrição</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_02 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="40" size="30" name="PRM_MATERIAL_DESC"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Prioridade</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_03 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="3" style="WIDTH:30px;" name="PRM_PRIORID" value="<?php if($PRIORID != ""){ echo $PRIORID; } ?>"></div></td>
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