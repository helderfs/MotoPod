<?php
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");
include_once("../_func/phpmailer/class.phpmailer.php");

$xajax = new xajax();
$xajax->registerFunction("GravaItensCompr");
$xajax->statusMessagesOn();
//$xajax->debugOn();
$xajax->processRequests();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php $xajax->printJavascript('includes/xajax/','',''); ?>

<script type="text/javascript" src="script/funcoes_ajax_cep_bd.js"></script>

<style>
.bordaBox {bbackground: ttransparent; width:90px;}
.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b4, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b, .bordaBox .b4b {display:block; overflow:hidden; font-size:1px;}
.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b {height:1px;}
.bordaBox .b2, .bordaBox .b3, .bordaBox .b4 {background:#CECECE; border-left:1px solid #999; border-right:1px solid #999;}
.bordaBox .b1 {margin:0 5px; background:#999;}
.bordaBox .b2 {margin:0 3px; border-width:0 2px;}
.bordaBox .b3 {margin:0 2px;}
.bordaBox .b4 {height:2px; margin:0 1px;}
.bordaBox .conteudo {padding:5px;display:block; background:#CECECE; border-left:1px solid #999; border-right:1px solid #999;}
</style>

<script language="javascript" type="text/javascript">
<!--
function buy(produto){

	window.document.formLogin.session_itens_buy.value = produto;

	GravaItensCompr();
}
-->
</script>
</head>

<?php

if (isset($_SESSION['ses_categ'])){
	$categ = $_SESSION['ses_categ'];
}

if (isset($_SESSION['itens'])){
	$itens = $_SESSION['itens'];
}

if (isset($_POST['bt01'])){
	$bt01 = $_POST['bt01'];
	//header("Location:index.php?ac=resum_prod&prod=".$bt01);
	$_SESSION['itens'] = $itens .','. $bt01;
}

?>
<!--
<form id="formProduto" name="formProduto" action="index.php?ac=01" method="post" accept-charset="utf-8">
-->
	<table border="0" cellpadding="0" cellspacing="1" width="100%">
	<?php
	switch ($categ) {
		case '002':
			$tp_sexo = 'M';
			break;
		case '003':
			$tp_sexo = 'F';
			break;
	}
	
	$qr = "
	SELECT * FROM produto
	LEFT JOIN prod_img AS prod_img ON prod_img.PRD_PRI_CODIGO = produto.PRD_CODIGO
	WHERE PRD_TIPO_SEXO = '$tp_sexo'
	LIMIT 0 , 64";
	$sql = mysql_query($qr);
	$total = mysql_num_rows($sql);
	$lin = 0;
	$col = 0;	
	
	echo "<tr>";
	while($r = mysql_fetch_array($sql)){
		$lin ++;
		$col ++;
		$array = explode(",",$r['PRI_IMAGEM']);
		$i = 0;
		$img_princ = substr( $array[$i], 0, strrpos($array[$i], "/") ) ."/small/". substr( strrchr($array[$i],"/"), 1);
		$nomeProd = substr( $r['PRD_MODELO'] ." - ". $r['PRD_NOME'], 0, 37 );
		
		//<a href='index.php?ac=lst&prd="; echo $r['PRD_CODIGO']; echo "')><div class='conteudo'>COMPRAR</div></a>
		echo "
			<td>
				<table border='0' cellpadding='0' cellspacing='4' width='100%'>
					<!--<tr><td align='center'><font size='3'><b>". buscaDB('prod_marca', 'PMA_MARCA', $r['PRD_MARCA'], 'PMA_MARCA_DESC') ."</b></font><br></td></tr>-->

					<tr><td align='center'>
						<a href='". $modulo ."/". $r['PRD_CODIGO'] ."'><div class='conteudo'><img src='". $img_princ ."' width='150px' height='200px'></div></a>
					</td></tr>
					<tr><td align='center' height='30px'>". $nomeProd ."</td></tr>
					<tr><td align='center'>
						<font color='#88b717' size='4'>Frete Grátis</font></br>
					
						<font color='gray' size='1'>De R$ <strike>". number_format($r['PRD_VLR_VENDA'], 2, ',','.') ."</strike></font>
						
						<font color='gray' size='2'><b>por R$ ". number_format($r['PRD_VLR_PROMO'], 2, ',','.') ."</b></font>
						
						<font color='gray'>ou</font><br>
						<font color='red' size='5'><b>4x</b></font>
						<font color='gray'><b>de </font>
						<font color='red' size='5'><b>R$ ". number_format($r['PRD_VLR_VENDA'] / 4, 2, ',','.') ."</b></font>
						<font color='gray' size='1'><br>sem juros no cartão</font>
					</tr>
					<tr>
						<td align='center' height='25px'>
							<table border='0' cellpadding='0' cellspacing='0' width='190px'>
								<tr>
								<td align='center' height='25px'>
									<div class='bordaBox'>
										<input type='hidden' name='hdBuy01' value='Jaqueta EJ001'>
										<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
										<a href='". $modulo ."/". $r['PRD_CODIGO'] ."'><div class='conteudo'>COMPRAR</div></a>
										<b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b>
									</div>
								</td>
								<td align='center' height='20px'>
									<div class='bordaBox'>
										<input type='hidden' name='hdBuy01' value='Jaqueta EJ001'>
										<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
										<a href='javascript:void(0);' onclick=javascrip:buy('". $r['PRD_CODIGO'] ."')><div class='conteudo'>Adicionar</div></a>
										<b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b>
									</div>
								</td>
								<tr>
							</table>
						</td>
					</tr>
				</table>
			</td>";

		if ($col == 4){
			$col = 0;
			echo '
				</tr>
				<tr><td colspan="7"><div align="center" style="margin-top:5px; margin-bottom:5px; margin-left:5px; margin-right:5px; border-bottom:2px dotted #6E5D5D; text-align:center; "></div></td></tr>
				<tr>';
		}else{
			echo '<td><div align="center" style="height:320px; margin-bottom:0px; margin-left:0px; margin-right:0px; border-left:2px dotted #6E5D5D; text-align:center; "></div></td>';
		}
	}
	?>
	</table>