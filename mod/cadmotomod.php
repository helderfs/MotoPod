<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
				
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">
		
		<script language="javascript" type="text/javascript">

			function addCodMarca(){
				window.parent.document.frmcadmotomod.MMO_COD.value = window.parent.document.frmcadmotomod.MMO_MAR_COD.value;
			}

			function addCodMod(){
				var marca  = window.parent.document.frmcadmotomod.MMO_MAR_COD.value;
				var modelo = window.parent.document.frmcadmotomod.MMO_MODELO.value;

				window.parent.document.frmcadmotomod.MMO_COD.value = marca + modelo;
			}

		</script>
	</head>
<?php
include_once("../func/config.php");
include_once("../../_func/func_library.php");
include_once("../../_func/phpmailer/class.phpmailer.php");

$MMO_COD 		= "";
$MMO_MAR_COD 	= "";
$MMO_MODELO		= "";

$btIncluir 		= "";
$btIncluirSair 	= "";

if (isset($_POST['btIncluir']))		$btIncluir 		= $_POST['btIncluir'];
if (isset($_POST['btIncluirSair']))	$btIncluirSair 	= $_POST['btIncluirSair'];


if ($btIncluir != "" || $btIncluirSair != ""){
	$c_erros = "";
	$erro01 = "";
	$erro02 = "";
	$erro03 = "";
	
	/* ##################### INSERCAO ##################### */
	if (isset($_POST['MMO_COD']))
		$MMO_COD = mb_strtoupper( retSEspOut( $_POST['MMO_COD'] ) );	// Case Sensitive --- Obriga Letras Maiusculo
	if ($MMO_COD == ""){
		$c_erros = $c_erros . ",Código não informado.";
		$erro01 = "erro";
	}

	if (isset($_POST['MMO_MAR_COD']))
		$MMO_MAR_COD = mb_strtoupper($_POST['MMO_MAR_COD']);
	if ($MMO_MAR_COD == "0"){ 
		$c_erros = $c_erros . ",Marca não informada.";
		$erro02 = "erro";
	}

	if (isset($_POST['MMO_MODELO']))
		$MMO_MODELO = $_POST['MMO_MODELO'];
	if ($MMO_MODELO == ""){ 
		$c_erros = $c_erros . ",Modelo não informado.";
		$erro03 = "erro";
	}

	
	if ($c_erros != "")
		echo msgErro($c_erros);
	else{
		// mp_marca_mod
		$sql_busca = "SELECT * FROM mp_marca_mod WHERE MMO_COD = '$MMO_COD'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($num_busca == 0){
			$sql_busca = "INSERT INTO mp_marca_mod 	(MMO_COD,	MMO_MAR_COD,	MMO_MODELO) 
							   VALUES 				('$MMO_COD','$MMO_MAR_COD','$MMO_MODELO')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}else{
			echo msgErro(",Modelo já existe");
			/*
			$sql_busca = "UPDATE mp_marca_mod SET 
						  MMO_MAR_COD   = '$MMO_MAR_COD',
						  MMO_MODELO	= '$MMO_MODELO'
						   WHERE MMO_COD = '$MMO_COD'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			*/
		}
	}
}

// Sair e atr cad. produt.
if ($btIncluirSair != ""){
?>
<script language="javascript">
	window.close()
</script>
<?php
}

?>

<form id="frmcadmotomod" name="frmcadmotomod" action="cadmotomod.php" method="post" accept-charset="utf-8">
	
	<input type="hidden" name="at" value="s">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Modelo</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Marca</label></b></td>
						<td align="left">
							<select name="MMO_MAR_COD" class="<?php if($erro_marca != ""){echo "field_error";}else{echo "input_select";} ?>" onBlur="addCodMarca()();">
							<?php
								$qr = "SELECT * FROM mp_marca ORDER BY MAR_NOME";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='0'>...Escolha a Marca</option>";
								while($r = mysql_fetch_array($sql)){
									if ($MMO_MAR_COD == $r['MAR_COD'])
										$selecionado = 'selected';
									else
										$selecionado = '';

									echo "<option value='". $r['MAR_COD'] ."' ". $selecionado .">". $r['MAR_NOME'] ."</option>";
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Modelo</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro02 != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" size="40"	name="MMO_MODELO"	value="<?php if($MMO_MODELO != "") echo $MMO_MODELO; ?>" onBlur="addCodMod()"></div></td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font size="4px" color="red">* </font><b><label style="margin-right:5px;">Código</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro01 != "") echo "field_error"; else echo "input"; ?>" maxlength="20" size="20"	name="MMO_COD"		value="<?php if($MMO_COD != "") echo $MMO_COD; ?>"></div></td>
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