<?php
session_start();
include_once("../_func/phpmailer/class.phpmailer.php");
include("func/func_php_ajax_cep_bd.php");
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/func_library.php");

$xajax = new xajax();
//$xajax->registerFunction("ExibeConteudoInserir");
$xajax->registerFunction("BuscaCEPBD");
$xajax->statusMessagesOn();
//$xajax->debugOn();
$xajax->processRequests();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link  href="css/style.css" type="text/css" rel="stylesheet" />
	<?php $xajax->printJavascript('includes/xajax/','',''); ?>
	<script type="text/javascript" src="script/funcoes_ajax_cep_bd.js"></script>
	<script language="javascript" src="script/x_mascara.js"></script>
	<script language="javascript" src="script/x_functions.js"></script>
</head>
<body>

<?php
// ################## DATABASE CEP ##################
include_once("func/config_cep.php");

// ############### INI BUSCA ESTADOS
$sql_busca = "SELECT * FROM log_faixa_uf ORDER BY ufe_no";
$busca_uf  = mysql_query($sql_busca);
$total_uf  = mysql_num_rows($busca_uf);
// ############### FIM BUSCA ESTADOS

$c_erros = "";
$acessocep1 = "";
$acessocep2 = "";
$END_CODIGO = "";
$END_CEP = "";
$END_NOME 	= "";
$END_BAIRRO = "";
$END_CIDADE = "";
$END_ESTADO	= "";
$END_NUMERO = "";
$END_COMPL = "";
$END_COMPL_OBS = "";
$END_ENTREGA = "";
/*
$sesAltEnd = "";
if ($_SESSION['sesAltEnd'] <> ""){
	if ($_SESSION['sesAltEnd'] <> "")
		$sesAltEnd = $_SESSION['sesAltEnd'];
}
*/

if ($_SESSION['cadcep1'] <> ""){
	if ($_SESSION['cadcep1'] <> "")
		$acessocep1 = soNumero($_SESSION['cadcep1']);
}
if ($_SESSION['cadcep2'] <> ""){
	if ($_SESSION['cadcep2'] <> "")
		$acessocep2 = soNumero($_SESSION['cadcep2']);
}
$END_CEP = $acessocep1 . $acessocep2;


if ($END_CEP == "" && isset($_SESSION['hdEND_CEP']))
	$END_CEP = $_SESSION['hdEND_CEP'];

// Busca dados de acordo com CEP
$sql_busca = "
SELECT logra.cep, logra.log_nome, logra.ufe_sg, bairro.bai_no, cidade.loc_nosub
  FROM log_logradouro AS logra
 INNER JOIN log_localidade AS cidade ON cidade.loc_nu_sequencial = logra.loc_nu_sequencial
 INNER JOIN log_bairro 	   AS bairro ON bairro.bai_nu_sequencial = logra.bai_nu_sequencial_ini
 WHERE logra.cep = '$END_CEP' ";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);
$num_busca = mysql_num_rows($exe_busca);

$END_NOME   = $fet_busca['log_nome'];
$END_BAIRRO = $fet_busca['bai_no'];
$END_CIDADE = $fet_busca['loc_nosub'];
$END_ESTADO = $fet_busca['ufe_sg'];

if ($_SESSION['ultPagVisit'] == "IniciaCad"){
	$erro_cep = "";
	if ($END_CEP == ""){
		$erro_cep = ".";
		$c_erros = $c_erros . ",CEP não informado";
	}
	
	$erro_endereco = "";
	if ($END_NOME == ""){
		$erro_endereco = ".";
		$c_erros = $c_erros . ",Endereço não informado";
	}
	
	$erro_numero = "";
	if ($END_NUMERO == ""){
		if ($_SESSION['hdEND_NUMERO'] == ""){
			$erro_numero = ".";
			$c_erros = $c_erros . ",Número não informado";
		}
	}
	
	$erro_bairro = "";
	if ($END_BAIRRO == ""){
		$erro_bairro = ".";
		$c_erros = $c_erros . ",Bairro não informado";
	}
	
	$erro_cidade = "";
	if ($END_CIDADE == ""){
		$erro_cidade = ".";
		$c_erros = $c_erros . ",Cidade não informada";
	}
	
	$erro_uf = "";
	if ($END_ESTADO == ""){
		$erro_uf = ".";
		$c_erros = $c_erros . ",Estado não informado";
	}
}

if (isset($_SESSION['hdEND_CODIGO']))		$END_CODIGO   	 = $_SESSION['hdEND_CODIGO'];
if (isset($_SESSION['hdEND_NOME']))			$END_NOME   	 = $_SESSION['hdEND_NOME'];
if (isset($_SESSION['hdEND_NUMERO']))		$END_NUMERO 	 = soNumero($_SESSION['hdEND_NUMERO']);
if (isset($_SESSION['hdEND_COMPL']))		$END_COMPL 		 = $_SESSION['hdEND_COMPL'];
if (isset($_SESSION['hdEND_COMPL_OBS']))	$END_COMPL_OBS 	 = $_SESSION['hdEND_COMPL_OBS'];
if (isset($_SESSION['hdEND_BAIRRO']))		$END_BAIRRO 	 = $_SESSION['hdEND_BAIRRO'];
if (isset($_SESSION['hdEND_CIDADE']))		$END_CIDADE 	 = $_SESSION['hdEND_CIDADE'];
if (isset($_SESSION['hdEND_ESTADO']))		$END_ESTADO 	 = $_SESSION['hdEND_ESTADO'];
if (isset($_SESSION['hdEND_ENTREGA']))		$END_ENTREGA 	 = $_SESSION['hdEND_ENTREGA'];

?>
<form id="formCEPPessoa" name="formCEPPessoa" >
	<noscript><div id="noscript">Habilite o JavaScript de seu browser para navegar nesta pagina.</div></noscript>
	<div id="carregando" class="desaparece">Carregando...</div>	
	<div id="enviando" class="desaparece">Enviando...</div>
	<!--<a href="javascript:;" onClick="javascript:IncReg();">Inserir</a>-->
<!--
	<div id="conteudo_ajax"></div>
	<div id="resposta"></div>
-->

	<input type="hidden" id="END_CODIGO" name="END_CODIGO"  value="<?php if ($END_CODIGO != "") echo $END_CODIGO; ?>">
	
	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0" style="background:#FFFFFF; margin-left:128px;">
	<tr>
		<td width="150" class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>CEP</label></b></div></td>
		<td align="left">
			<table width="290px" border="0" cellspacing="0" cellpadding="0" style="margin-left:-5px;">
				<tr>
					<td>
						<input 	type="text" maxlength="9" size="10" style="FONT:bold;" id="END_CEP" name="END_CEP"
								class="<?php if($erro_cep != ""){echo "field_error";}else{echo "input";} ?>"
								value="<?php if($END_CEP != ""){ echo substr($END_CEP, 0, 5) . "-" . substr(str_replace("-", "", $END_CEP), 5, 7); } ?>"
								onkeypress="return valCEP(event,this); return false;"
								onBlur="BuscaCEPBD();">
						<!--
						<input 	type="text" class="<?php //if($erroacessoemail != "" || $errocep != ""){echo "field_error";}else{echo "input";} ?>" maxlength="5" size="4" style="FONT:bold; margin-right:0px;" id="acessocep1" name="acessocep1"
								value="<?php //echo substr($END_CEP, 0, 5); ?>" > -
						<input 	type="text" class="<?php //if($erroacessoemail != "" || $errocep != ""){echo "field_error";}else{echo "input";} ?>" maxlength="3" size="2" style="FONT:bold; margin-right:20px;" id="acessocep2" name="acessocep2" 
								value="<?php //echo substr(str_replace("-", "", $END_CEP), 5, 7); ?>"
								onBlur="">
						-->
					</td>
					<td>
						<a href="javascript:janelaSecundaria('cep.php?tipCEP=2', 780, 500);" class="menu02" title="Busca CEP" tabindex="-1"><h3>Não sei meu CEP</h3></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>		
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Endereço</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_endereco != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="width:200px;" name="END_NOME" id="END_NOME" value="<?php if($END_NOME != ""){ echo $END_NOME; } ?>" ></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Número</label></b></div></td>
		<td align="left">
			<input type="text" class="<?php if($erro_numero != ""){echo "field_error";}else{echo "input";} ?>" maxlength="15" style="WIDTH:50px;" name="END_NUMERO" id="END_NUMERO" value="<?php if($END_NUMERO != ""){ echo $END_NUMERO; } ?>" >
		</td>
	</tr>
	<tr>
		<td class="td_cad" align="right"><b><label style="margin-right:5px;">Complemento</label></b></td>
		<td align="left">
			<select name="END_COMPL" id="END_COMPL" type="text" onchange="liberaCampo('complemento', this.value)" style="WIDTH:100px;">
				<option value='casa'   <?php if($END_COMPL == "" || $END_COMPL == "casa"){echo "selected";} ?>>Casa</option>
				<option value='apto'   <?php if($END_COMPL == "apto"){  echo "selected";} ?>>Apto.</option>
				<option value='comerc' <?php if($END_COMPL == "comer"){ echo "selected";} ?>>Comercial</option>
				<option value='lote'   <?php if($END_COMPL == "lote"){  echo "selected";} ?>>Lote</option>
				<option value='outros' <?php if($END_COMPL == "outros"){echo "selected";} ?>>Outros</option>
			</select>
			<?php //if ($END_COMPL != "outros"){
				//$outros = "readOnly='true' disabled";
			?>
				<!--<script type="text/javascript"> liberaCampo('complemento', '') </script>-->
			<?php //}else{ $outros = ""; } ?>
			<input type="text" maxlength="40" style="WIDTH:150px;" name="END_COMPL_OBS" id="END_COMPL_OBS" value="<?php if($END_COMPL_OBS != ""){ echo $END_COMPL_OBS; } ?>">
			<font color="grey">Ex Apto 201 ou Esquina c/ Rua Cedros</font>
		</td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Bairro</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_bairro != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="WIDTH:200px;" name="END_BAIRRO" id="END_BAIRRO" value="<?php if($END_BAIRRO != ""){ echo $END_BAIRRO; } ?>" ></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Cidade</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_cidade != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="WIDTH:200px;" name="END_CIDADE" id="END_CIDADE" value="<?php if($END_CIDADE != ""){ echo $END_CIDADE; } ?>" ></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Estado</label></b></div></td>
		<td align="left">
			<select name="END_ESTADO" id="END_ESTADO" class="<?php if($erro_uf != ""){echo "field_error";}else{echo "input_select";} ?>" style="WIDTH:170px;">
			<?php
				echo "<option value='' selected>:::Escolha o Estado:::</option>";
				while($reg = mysql_fetch_array($busca_uf)){
					if($END_ESTADO == $reg['ufe_sg']){
						$selecionado = " selected";
					}else{
						$selecionado = "";
					}
					//echo $reg['ufe_sg']. " - " . $reg['ufe_no'] . "<br>";
					echo "<option value='". $reg['ufe_sg'] ."'". $selecionado . ">". $reg['ufe_no'] ."</option>";
				}
			?>
			</select>
		</td>
	</tr>
	</table>
	
</form>
</body>
</html>