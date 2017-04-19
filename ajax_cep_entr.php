<?php
session_start();

include_once("../_func/phpmailer/class.phpmailer.php");
include("func/func_php_ajax_cep_bd.php");
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/func_library.php");

$xajax = new xajax();
//$xajax->registerFunction("ExibeConteudoInserir");
$xajax->registerFunction("BuscaCEPBDFast");
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
// ################## DATABASE CEP ##################
include("func/config.php");

//$END_DESC 		= "";
$END_CEP 		= "";
$END_NOME 		= "";
$END_NUMERO 	= "";
$END_COMPL_OBS 	= "";
$END_BAIRRO 	= "";
$END_CIDADE 	= "";
$END_ESTADO 	= "";
$END_ENTREGA 	= "";

//if (isset($_SESSION['END_DESC'])) 		$END_DESC 		= $_SESSION['END_DESC'];
if (isset($_SESSION['END_CEP'])) 		$END_CEP 		= $_SESSION['END_CEP'];
if (isset($_SESSION['END_NOME'])) 		$END_NOME 		= $_SESSION['END_NOME'];
if (isset($_SESSION['END_NUMERO'])) 	$END_NUMERO 	= $_SESSION['END_NUMERO'];
if (isset($_SESSION['END_COMPL_OBS'])) 	$END_COMPL_OBS 	= $_SESSION['END_COMPL_OBS'];
if (isset($_SESSION['END_BAIRRO'])) 	$END_BAIRRO 	= $_SESSION['END_BAIRRO'];
if (isset($_SESSION['END_CIDADE'])) 	$END_CIDADE 	= $_SESSION['END_CIDADE'];
if (isset($_SESSION['END_ESTADO'])) 	$END_ESTADO 	= $_SESSION['END_ESTADO'];
if (isset($_SESSION['END_ENTREGA'])) 	$END_ENTREGA 	= $_SESSION['END_ENTREGA'];

if ($_SESSION['ultPagVisit'] == "IniciaCadFast"){
	
	if ($END_CEP == ""){
		$erro_cep = ".";
		$c_erros = $c_erros . ",CEP não informado";
	}
	if ($END_NOME == ""){
		$erro_endereco = ".";
		$c_erros = $c_erros . ",Endereço não informado";
	}
	if ($END_NUMERO == ""){
		$erro_numero = ".";
		$c_erros = $c_erros . ",Número não informado";
	}
	if ($END_BAIRRO == ""){
		$erro_bairro = ".";
		$c_erros = $c_erros . ",Bairro não informado";
	}
	if ($END_CIDADE == ""){
		$erro_cidade = ".";
		$c_erros = $c_erros . ",Cidade não informada";
	}
	if ($END_ESTADO == ""){
		$erro_uf = ".";
		$c_erros = $c_erros . ",Estado não informado";
	}
}

?>
<form id="formCEPFast" name="formCEPFast" >
	<input type="hidden" id="hdVlrFrete" name="hdVlrFrete" value="">

	<noscript><div id="noscript">Habilite o JavaScript de seu browser para navegar nesta pagina.</div></noscript>
	<div id="carregando" class="desaparece">Carregando...</div>	
	<div id="enviando" class="desaparece">Enviando...</div>
	<!--<a href="javascript:;" onClick="javascript:IncReg();">Inserir</a>-->
		
	<div id="conteudo_ajax"></div>	
	<div id="resposta"></div>
	
	<center>
	<table id="fast_buy" width="" border="0" cellspacing="0" cellpadding="0" class="texto_campo">
	<tbody>
<!--	
	<tr>
		<td align="right">Identifica Endereço*</td>
		<td align="left">
			<input name="END_DESC" id="END_DESC" value="" maxlength="30" type="text" class="edit-car" style="width:200px;">
			&nbsp;&nbsp;<font color="#B5B5B5">(ex: Escritório. sítio, etc...)</font>
		</td>
	</tr>
-->
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Telefone Residencial</label></b></div></td>
		<td align="left">
			<input type="text" class="<?php if($erro_numero != ""){echo "field_error";}else{echo "input";} ?>" maxlength="15" style="width:70px;" name="END_NUMERO" id="END_NUMERO" value="<?php if($END_NUMERO != ""){ echo $END_NUMERO; } ?>">
		</td>
	</tr>
	<tr>
		<td width="" align="right" nowrap=""><b><label for="name" style="margin-right:5px;" color="">CEP</label></b></td>
		<td align="left">
			<input type="text" id="END_CEP" name="END_CEP" maxlength="9" style="FONT:bold; width:80px;"
				   class="<?php if($erro_cep != ""){echo "field_error";}else{echo "input";} ?>"
				   value="<?php if($END_CEP != ""){ echo substr($END_CEP, 0, 5) . "-" . substr(str_replace("-", "", $END_CEP), 5, 7); } ?>"
				   onkeypress="return valCEP(event,this); return false;"
				   onBlur="BuscaCEPBDFast();">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:janelaSecundaria('cep.php?tipCEP=4', 780, 500);" class="menu03" title="Busca CEP" tabindex="-1"><b>Busca CEP</b></a>
		</td>
	</tr>
	<tr>
		<td class=""><div align="right"><b><label style="margin-right:5px;">Endereço</label></b></div></td>
		<td align="left"><input type="text" id="END_NOME" name="END_NOME" class="<?php if($erro_endereco != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="width:250px;" value="<?php if($END_NOME != ""){ echo $END_NOME; } ?>"></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="#B5B5B5">Complemento</font></label></b></div></td>
		<td align="left"><input type="text" id="END_COMPL_OBS" name="END_COMPL_OBS" maxlength="40" style="width:200px;" value="<?php if($END_COMPL_OBS != ""){ echo $END_COMPL_OBS; } ?>">
		&nbsp;&nbsp;<font color="#B5B5B5">Opcional</font>
		</td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Bairro</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_bairro != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="WIDTH:200px;" name="END_BAIRRO" id="END_BAIRRO" value="<?php if($END_BAIRRO != ""){ echo $END_BAIRRO; } ?>"></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Cidade</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_cidade != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="WIDTH:200px;" name="END_CIDADE" id="END_CIDADE" value="<?php if($END_CIDADE != ""){ echo $END_CIDADE; } ?>"></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Estado</label></b></div></td>
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
	</tbody>
	</table>
	</center>	
</form>
</body>
</html>