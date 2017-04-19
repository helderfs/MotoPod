<?php
session_start();

include_once("../_func/phpmailer/class.phpmailer.php");
include("func/func_php_ajax_cep_bd.php");
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/func_library.php");

$xajax = new xajax();
//$xajax->registerFunction("ExibeConteudoInserir");
$xajax->registerFunction("BuscaCEPBDPed");
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
$END_CEP = "";
?>
<form id="formCEPPedido" name="formCEPPedido" >
	<input type="hidden" id="hdVlrFrete" name="hdVlrFrete" value="">

	<noscript><div id="noscript">Habilite o JavaScript de seu browser para navegar nesta pagina.</div></noscript>
	<div id="carregando" class="desaparece">Carregando...</div>	
	<div id="enviando" class="desaparece">Enviando...</div>
	<!--<a href="javascript:;" onClick="javascript:IncReg();">Inserir</a>-->
		
	<div id="conteudo_ajax"></div>	
	<div id="resposta"></div>

	<table id="cep_ped" width="" border="0" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>
		<td width="" align="left" nowrap="" class="" style="font-size:12px;">Para calcular o <u>valor do Frete</u> de entrega coloque o <u>CEP</u> aqui </td>
		<td width="">
			<input type="text" id="END_CEP" name="END_CEP" maxlength="9" size="9" style="FONT:bold; height:12px;" 
				   value="<?php if($END_CEP != ""){ echo substr($END_CEP, 0, 5) . "-" . substr(str_replace("-", "", $END_CEP), 5, 7); } ?>"
				   onkeypress="return valCEP(event,this); return false;"
				   onBlur="BuscaCEPBDPed();">
		</td>
		<td>
			<a href="javascript:janelaSecundaria('cep.php?tipCEP=3', 780, 500);" class="menu03" title="Busca CEP"><b>Busca CEP</b></a>
		</td>
		<!--<td><img src="./pedidos_files/calcular.gif" alt="Calcular" width="81" height="21" onclick="gravaCEPPed();" style="cursor:pointer;"></td>-->
	</tr>
	</tbody>
	</table>
	
</form>
</body>
</html>