<?php
session_start();

include_once("func/config.php");

include("func/func_php_ajax.php");
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/func_library.php");

$xajax = new xajax();
//$xajax->registerFunction("ExibeConteudoInserir");
$xajax->registerFunction("SrcModBD");
$xajax->registerFunction("SrcMarModBD");
$xajax->registerFunction("SrcAnosModBD");
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
$cdmt_cod   = "";
$cdmt_marca = "";
$cdmt_mod	= "";
$ano_mod	= "";

if (isset($_SESSION['sesMMO_COD']))		$cdmt_cod	= $_SESSION['sesMMO_COD'];
if (isset($_SESSION['sesMMO_MARCA']))	$cdmt_marca	= $_SESSION['sesMMO_MARCA'];
if (isset($_SESSION['sesMMO_MODELO'])) 	$cdmt_mod	= $_SESSION['sesMMO_MODELO'];
if (isset($_SESSION['sesANOFAB'])) 		$ano_mod	= $_SESSION['sesANOFAB'];
/*
echo "<br>cdmt_cod 	 - $cdmt_cod";
echo "<br>cdmt_marca - $cdmt_marca";
echo "<br>cdmt_mod	 - $cdmt_mod";
echo "<br>ano_mod	 - $ano_mod";
*/
?>

<form id="frmViewMtAjax" name="frmViewMtAjax" style="background: #333; color: #fff;">
	<input type="hidden" id="hdMMO_COD"		name="hdMMO_COD"	value="<?php echo $cdmt_cod; ?>">
	<input type="hidden" id="hdMMO_MARCA"  	name="hdMMO_MARCA"	value="<?php echo $cdmt_marca; ?>">
	<input type="hidden" id="hdMMO_MODELO" 	name="hdMMO_MODELO"	value="<?php echo $cdmt_mod; ?>">
	<input type="hidden" id="hdANOFAB" 		name="hdANOFAB"		value="<?php echo $ano_mod; ?>">

	<noscript><div id="noscript">Habilite o JavaScript de seu browser para navegar nesta pagina.</div></noscript>
	<div id="carregando" class="desaparece">Carregando...</div>
	<div id="enviando" 	 class="desaparece">Enviando...</div>
	<!--<a href="javascript:;" onClick="javascript:IncReg();">Inserir</a>-->

	<br>
	<center>
	<div style="background: #333; color: #fff;">
		<b><label style="margin-right:5px;">Marca</label></b>
		<select id="cdmt_marca" name="cdmt_marca" onChange="SrcModBD();">
		<?php
			$qr = "SELECT * FROM mp_marca ORDER BY MAR_NOME";
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);

			echo "<option value=''>...Escolha a Marca</option>";
			while($r = mysql_fetch_array($sql)){
				if ($cdmt_marca == $r['MAR_COD']){
					$selecionado = 'selected';
				}else
					$selecionado = '';

				echo "<option value='". $r['MAR_COD'] ."' ". $selecionado .">". $r['MAR_NOME'] ."</option>";
			}
		?>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<b><label style="margin-right:5px;">Modelo</label></b>
		<select id="cdmt_mod" name="cdmt_mod" onChange="SrcMarModBD();">
		<?php 
			$qr = "SELECT * FROM mp_marca_mod
					WHERE MMO_MAR_COD = '$cdmt_marca'
					ORDER BY MMO_MODELO";
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);

			echo "<option value=''>...Escolha o Modelo</option>";
			while($r = mysql_fetch_array($sql)){

				$modelo = $r['MMO_MODELO'];
				
				if ($r['MMO_COD'] == $cdmt_cod)
					$selecionado = 'selected';
				else
					$selecionado = '';

				// estes VALUE não importa, pois será reenviado pelo ajax no PROGRAMA func_php_ajax.php
				echo "<option value='". $r['MMO_COD'] ."' ". $selecionado .">". $modelo ."</option>";
			}
		?>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<b><label style="margin-right:5px;">Ano</label></b>
		<select id="ano_mod" name="ano_mod">
			<option value='0'>...Escolha o Ano</option>
			<?php
				if (isset($_SESSION['sesMMO_COD'])){

					$sql = "
					SELECT MOT_ANOFAB
					  FROM mp_motos
					 WHERE MOT_MMO_COD = '". $_SESSION['sesMMO_COD'] ."' ";
					$qr = mysql_query($sql);
					$total = mysql_num_rows($qr);

					while($r = mysql_fetch_array($qr)){
						$ano_mod = $r['MOT_ANOFAB'];

						if (isset($_SESSION['sesMMO_COD'])){
							if ($ano_mod == $_SESSION['sesANOFAB'])
								$selecionado = 'selected';
							else
								$selecionado = '';
						}
						echo "<option value='". $ano_mod ."' ". $selecionado .">". $ano_mod ."</option>";
					}

				}
			?>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	</center>
	<br>
</form>
</body>
</html>