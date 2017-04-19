<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
				
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">
	</head>
<?php
include_once("../func/config.php");
include_once("../../_func/func_library.php");
include_once("../../_func/phpmailer/class.phpmailer.php");

$MAR_COD 	= "";
$MAR_NOME 	= "";
$MAR_NACAO	= "";
$MAR_ANO	= "";
$MAR_ATIVA 	= "N";
$MAR_HISTORY= "";

$btIncluir 		= "";
$btIncluirSair 	= "";

if (isset($_POST['btIncluir']))		$btIncluir 		= $_POST['btIncluir'];
if (isset($_POST['btIncluirSair']))	$btIncluirSair 	= $_POST['btIncluirSair'];


if ($btIncluir != "" || $btIncluirSair != ""){
	$c_erros = "";
	$erro01 = "";
	$erro02 = "";
	$erro03 = "";
	$erro04 = "";
	
	/* ##################### INSERCAO ##################### */
	if (isset($_POST['MAR_COD']))
		$MAR_COD = mb_strtoupper( retSEspOut( $_POST['MAR_COD'] ) );	// Case Sensitive --- Obriga Letras Maiusculo
	if ($MAR_COD == ""){
		$c_erros = $c_erros . ",Marca não informada.";
		$erro01 = "erro";
	}
	
	if (isset($_POST['MAR_NOME']))
		$MAR_NOME = $_POST['MAR_NOME'];
	if ($MAR_NOME == ""){ 
		$c_erros = $c_erros . ",Nome não informado.";
		$erro02 = "erro";
	}

	if (isset($_POST['MAR_NACAO']))
		$MAR_NACAO = $_POST['MAR_NACAO'];
	if ($MAR_NACAO == ""){ 
		$c_erros = $c_erros . ",Nação/País não informado.";
		$erro03 = "erro";
	}

	if (isset($_POST['MAR_ANO']))
		$MAR_ANO = $_POST['MAR_ANO'];
	if ($MAR_ANO == ""){ 
		$c_erros = $c_erros . ",Ano de Início da Empresa não informado.";
		$erro04 = "erro";
	}
	
	if(isset($_POST['MAR_ATIVA'])){
		if($_POST['MAR_ATIVA'] == 'on')
			$MAR_ATIVA = 'S';
	}
	
	if(isset($_POST['MAR_HISTORY']))
		$MAR_HISTORY = $_POST['MAR_HISTORY'];
	
	
	if ($c_erros != "")
		echo msgErro($c_erros);
	else{
		// mp_marca
		$sql_busca = "SELECT * FROM mp_marca WHERE MAR_COD = '$MAR_COD'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($num_busca == 0){
			$sql_busca = "INSERT INTO mp_marca 	(MAR_COD,	MAR_NOME,	MAR_NACAO,	MAR_ANO,	MAR_ATIVA,	MAR_HISTORY) VALUES 
												('$MAR_COD','$MAR_NOME','$MAR_NACAO','$MAR_ANO','$MAR_ATIVA','$MAR_HISTORY')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}else{
			echo msgErro(",Marca já existe");
			/*
			$sql_busca = "UPDATE mp_marca SET 
						  MAR_NOME   	= '$MAR_NOME',
						  MAR_NACAO		= '$MAR_NACAO',
						  MAR_ANO		= '$MAR_ANO',
						  MAR_ATIVA    	= '$MAR_ATIVA',
						  MAR_HISTORY	= '$MAR_HISTORY'
						   WHERE MAR_COD = '$MAR_COD'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			*/
		}
	}
	/* ##################### INSERCAO ##################### */

	// Sair e atr cad. produt.
	if ($btIncluirSair != ""){
	?>
	<script language="javascript">
		window.close()
	</script>
	<?php
	}
}

?>

<form id="frmcadmotomarca" name="frmcadmotomarca" action="cadmotomarca.php" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Marca</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Marca</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro01 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="7" size="10"  name="MAR_COD"	value="<?php if($MAR_COD != "") echo $MAR_COD; ?>"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Nome</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro02 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" size="35" name="MAR_NOME" 	value="<?php if($MAR_NOME != "") echo $MAR_NOME; ?>"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Nação</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro03 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" size="35" name="MAR_NACAO" 	value="<?php if($MAR_NACAO != "") echo $MAR_NACAO; ?>"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Ano</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro04 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="4" size="4"   name="MAR_ANO"   	value="<?php if($MAR_ANO != "") echo $MAR_ANO; ?>"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Ativa</label></b></div></td>
						<td align="left"><input type="checkbox" class="input" name="MAR_ATIVA" <?php if($MAR_ATIVA == "S") echo "checked"; ?>></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">História</label></b></div></td>
						<td align="left"><div ><textarea name="MAR_HISTORY" rows="7" cols="40"><?php if($MAR_HISTORY != "") echo $MAR_HISTORY; ?></textarea></div></td>
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