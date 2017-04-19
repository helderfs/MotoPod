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

$c_erros 		= "";
$erro_cep		= "";
$erro_endereco	= "";
$erro_bairro	= "";
$erro_cidade	= "";
$erro_uf		= "";

$fastEND_CEP 		= "";
$fastEND_NOME 		= "";
$fastEND_NUMERO 	= "";
$fastEND_COMPL_OBS 	= "";
$fastEND_BAIRRO 	= "";
$fastEND_CIDADE 	= "";
$fastEND_ESTADO 	= "";

if (isset($_SESSION['fastEND_CEP'])) 		$fastEND_CEP 		= $_SESSION['fastEND_CEP'];
if (isset($_SESSION['fastEND_NOME'])) 		$fastEND_NOME 		= $_SESSION['fastEND_NOME'];
if (isset($_SESSION['fastEND_NUMERO'])) 	$fastEND_NUMERO 	= $_SESSION['fastEND_NUMERO'];
if (isset($_SESSION['fastEND_COMPL_OBS'])) 	$fastEND_COMPL_OBS 	= $_SESSION['fastEND_COMPL_OBS'];
if (isset($_SESSION['fastEND_BAIRRO'])) 	$fastEND_BAIRRO 	= $_SESSION['fastEND_BAIRRO'];
if (isset($_SESSION['fastEND_CIDADE'])) 	$fastEND_CIDADE 	= $_SESSION['fastEND_CIDADE'];
if (isset($_SESSION['fastEND_ESTADO'])) 	$fastEND_ESTADO 	= $_SESSION['fastEND_ESTADO'];

if ($_SESSION['ultPagVisit'] == "IniciaCadFast"){
	
	if ($fastEND_CEP == ""){
		$erro_cep = ".";
		$c_erros = $c_erros . ",CEP não informado";
	}
	if ($fastEND_NOME == ""){
		$erro_endereco = ".";
		$c_erros = $c_erros . ",Endereço não informado";
	}
	if ($fastEND_NUMERO == ""){
		$erro_numero = ".";
		$c_erros = $c_erros . ",Número não informado";
	}
	if ($fastEND_BAIRRO == ""){
		$erro_bairro = ".";
		$c_erros = $c_erros . ",Bairro não informado";
	}
	if ($fastEND_CIDADE == ""){
		$erro_cidade = ".";
		$c_erros = $c_erros . ",Cidade não informada";
	}
	if ($fastEND_ESTADO == ""){
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
	<tr>
		<td width="" align="right" nowrap=""><b><label for="name" style="margin-right:5px;" color="">CEP</label></b></td>
		<td align="left">
			<input type="text" id="fastEND_CEP" name="fastEND_CEP" maxlength="9" style="FONT:bold; width:80px;" 
				   class="<?php if($erro_cep != ""){echo "field_error";}else{echo "input";} ?>"
				   value="<?php if($fastEND_CEP != "") echo substr($fastEND_CEP, 0, 5) . "-" . substr(str_replace("-", "", $fastEND_CEP), 5, 7); ?>"				   
				   onkeypress="return valCEP(event,this); return false;"
				   onBlur="BuscaCEPBDFast();">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:janelaSecundaria('cep.php?tipCEP=4', 780, 500);" class="menu03" title="Busca CEP" tabindex="-1"><b>Busca CEP</b></a>
		</td>
	</tr>
	<tr>
		<td class=""><div align="right"><b><label style="margin-right:5px;">Endereço</label></b></div></td>
		<td align="left"><input type="text" id="fastEND_NOME" name="fastEND_NOME" class="<?php if($erro_endereco != "") echo "field_error"; else echo "input"; ?>" maxlength="50" style="width:250px;" value="<?php if($fastEND_NOME != "") echo $fastEND_NOME; ?>"></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Número</label></b></div></td>
		<td align="left">
			<input type="text" class="<?php if($erro_numero != "")echo "field_error"; else echo "input"; ?>" maxlength="15" style="width:70px;" name="fastEND_NUMERO" id="fastEND_NUMERO" value="<?php if($fastEND_NUMERO != "") echo $fastEND_NUMERO; ?>">
		</td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="#B5B5B5">Complemento</font></label></b></div></td>
		<td align="left"><input type="text" id="fastEND_COMPL_OBS" name="fastEND_COMPL_OBS" maxlength="40" style="width:200px;" value="<?php if($fastEND_COMPL_OBS != "") echo $fastEND_COMPL_OBS; ?>">
		&nbsp;&nbsp;<font color="#B5B5B5">Opcional</font>
		</td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Bairro</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_bairro != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="WIDTH:200px;" name="fastEND_BAIRRO" id="fastEND_BAIRRO" value="<?php if($fastEND_BAIRRO != "") echo $fastEND_BAIRRO; ?>"></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Cidade</label></b></div></td>
		<td align="left"><input type="text" class="<?php if($erro_cidade != ""){echo "field_error";}else{echo "input";} ?>" maxlength="50" style="WIDTH:200px;" name="fastEND_CIDADE" id="fastEND_CIDADE" value="<?php if($fastEND_CIDADE != "") echo $fastEND_CIDADE; ?>"></td>
	</tr>
	<tr>
		<td class="td_cad"><div align="right"><b><label style="margin-right:5px;">Estado</label></b></div></td>
		<td align="left">
			<select name="fastEND_ESTADO" id="fastEND_ESTADO" class="<?php if($erro_uf != ""){echo "field_error";}else{echo "input_select";} ?>" style="WIDTH:170px;">
			<?php
				echo "<option value='' selected>:::Escolha o Estado:::</option>";
				while($reg = mysql_fetch_array($busca_uf)){
					if($fastEND_ESTADO == $reg['ufe_sg']){
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