<?php
session_start();

include_once("func/config.php");

include("func/func_php_ajax.php");
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/func_library.php");

$xajax = new xajax();
//$xajax->registerFunction("ExibeConteudoInserir");
$xajax->registerFunction("BuscaModeloBD");
$xajax->registerFunction("bscMarModBD");
$xajax->statusMessagesOn();
//$xajax->debugOn();
$xajax->processRequests();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link  href="css/style.css" type="text/css" rel="stylesheet" />
	<?php $xajax->printJavascript('includes/xajax/','',''); ?>
	<script type="text/javascript"	src="script/funcoes_ajax.js"></script>
	<script language="javascript" 	src="script/x_mascara.js"></script>
	<script language="javascript" 	src="script/x_functions.js"></script>
</head>
<body>

<?php
$sel_marca 	= "";

$cdmt_cod   = "";
$cdmt_marca = "";
$cdmt_mod	= "";

$er_marca 	= "";
$er_mod		= "";

if (isset($_SESSION['seslNew'])) 		$lNew		= $_SESSION['seslNew'];
if (isset($_SESSION['sesMMO_COD']))		$cdmt_cod	= $_SESSION['sesMMO_COD'];
if (isset($_SESSION['sesMMO_MARCA']))	$cdmt_marca	= $_SESSION['sesMMO_MARCA'];
if (isset($_SESSION['sesMMO_MODELO'])) 	$cdmt_mod	= $_SESSION['sesMMO_MODELO'];

//echo "<br>lNew ------ $lNew";
//echo "<br>cdmt_cod---	$cdmt_cod";
//echo "<br>cdmt_marca- $cdmt_marca";
//echo "<br>cdmt_mod -- $cdmt_mod";
?>
<form id="formCadMotoAjax" name="formCadMotoAjax" >
	
	<input type="hidden" id="hdMMO_COD"		name="hdMMO_COD"	value="<?php echo $cdmt_cod; ?>">
	<input type="hidden" id="hdMMO_MARCA"	name="hdMMO_MARCA" 	value="<?php echo $cdmt_marca; ?>">
	<input type="hidden" id="hdMMO_MODELO"	name="hdMMO_MODELO"	value="<?php echo $cdmt_mod; ?>">

	<noscript><div id="noscript">Habilite o JavaScript de seu browser para navegar nesta pagina.</div></noscript>
	<div id="carregando" class="desaparece">Carregando...</div>
	<div id="enviando" 	 class="desaparece">Enviando...</div>
	<!--<a href="javascript:;" onClick="javascript:IncReg();">Inserir</a>-->

	<br>
	<center>
	<table id="" width="" border="0" cellspacing="0" cellpadding="0" class="">
	<tbody>
		<tr>
			<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Marca</label></b></td>
			<td align="left">
				<select id="cdmt_marca" name="cdmt_marca" class="<?php if($er_marca != "") echo "field_error"; ?>" onChange="BuscaModeloBD();" <?php if (!$lNew) echo "readonly disabled"; ?>>
				<?php
					$qr = "SELECT MAR_COD, MAR_NOME FROM mp_marca ORDER BY MAR_NOME";
					$sql = mysql_query($qr);
					$total = mysql_num_rows($sql);

					echo "<option value=''>...Escolha a Marca</option>";
					while($r = mysql_fetch_array($sql)){
						if ($cdmt_marca == $r['MAR_COD']){
							$selecionado = 'selected';
							$sel_marca = $r['MAR_COD'];
						}else
							$selecionado = '';

						echo "<option value='". $r['MAR_COD'] ."' ". $selecionado .">". $r['MAR_NOME'] ."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Modelo</label></b></td>
			<td align="left">
				<select id="cdmt_mod" name="cdmt_mod" class="<?php if($er_mod != "") echo "field_error"; ?>" onChange="bscMarModBD();" <?php if (!$lNew) echo "readonly disabled"; ?>>
				<?php
					/*$qr = "SELECT * FROM mp_marca_mod
							WHERE MMO_MAR_COD = '$sel_marca'
							ORDER BY MMO_MODELO";*/
					$qr = "SELECT MMO_COD, MMO_MODELO
							 FROM mp_marca_mod
							WHERE MMO_MAR_COD = '$cdmt_marca'
							ORDER BY MMO_MODELO";
					$sql = mysql_query($qr);
					$total = mysql_num_rows($sql);

					echo "<option value=''>...Escolha o Modelo</option>";
					while($r = mysql_fetch_array($sql)){
						$cd_mr_md  	= $r['MMO_COD'];
						$modelo 	= $r['MMO_MODELO'];

						if ($cd_mr_md == $cdmt_cod)
							$selecionado = 'selected';
						else
							$selecionado = '';

						// estes VALUE não importa, pois será reenviado pelo ajax no PROGRAMA func_php_ajax.php
						echo "<option value='". $cd_mr_md ."' ". $selecionado .">". $modelo ."</option>";
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