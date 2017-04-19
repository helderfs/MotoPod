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

	<script language="javascript" src="script/x_mascara.js"></script>

	<script src="script/jquery-1.6.js" type="text/javascript"></script>
	<script src="script/jquery.jqzoom-core.js" type="text/javascript"></script>

	<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">

	<script language="javascript" type="text/javascript">
		<!--
		function MostraEmail(){			
			document.formCadPessoa.USR_EMAIL.readOnly = false;
			document.formCadPessoa.USR_EMAIL.disabled = false;
			document.formCadPessoa.REUSR_EMAIL.readOnly = false;
			document.formCadPessoa.REUSR_EMAIL.disabled = false;
		}

		function buySel(produto){
			window.document.formLogin.session_itens_buy.value = produto;

			GravaItensCompr();
		}

		function efetuaCompra(){
			window.document.formProdViewSel.submit();
		}		
		-->
	</script>
	
	<style type="text/css" id="page-css">
		.model {
			text-transform: uppercase;
			width: 100%;
			color: #333;
			font-size: 20px;
		}
		.model2 {
			margin-top:10px;
			border-bottom: solid 1px #7A7A7A;
		}
		
		.value-p2 {
			display: block;
			<!--text-decoration: overline;-->
			text-decoration: line-through;
			color: #006666;
			font-size: 12px;
			margin-top:10px;
			margin-bottom:10px;
		}
		
		.rs3 {
			font-size: 36px;
			color: #CD2626;
			font-weight: bold;
			font-family: Arial, Helvetica, sans-serif;
			margin-top:10px;
			margin-bottom:10px;
		}
		
		.item-t {
			padding: 2px 10px;
			padding-bottom: 3px;
			float: left;
			margin: 2px;
		}
		
		.more {
			font-size: 16px;
			font-family: Arial, Helvetica, sans-serif;
			font-weight: inherit;
			color: #939598;
		}
		
	body{margin:0px;padding:0px;font-family:Arial;}
	a img,:link img,:visited img { border: none; }
	table { border-collapse: collapse; border-spacing: 0; }
	:focus { outline: none; }
	*{margin:0;padding:0;}
	p, blockquote, dd, dt{margin:0 0 8px 0;line-height:1.5em;}
	fieldset {padding:0px;padding-left:7px;padding-right:7px;padding-bottom:7px;}
	fieldset legend{margin-left:15px;padding-left:3px;padding-right:3px;color:#333;}
	dl dd{margin:0px;}
	dl dt{}

	.clearfix:after{clear:both;content:".";display:block;font-size:0;height:0;line-height:0;visibility:hidden;}
	.clearfix{display:block;zoom:1}

	ul#thumblist{display:block;}
	ul#thumblist li{float:left;margin-right:2px;list-style:none;}
	ul#thumblist li a{display:block;border:1px solid #CCC;}
	ul#thumblist li a.zoomThumbActive{border:1px solid red;}

	.jqzoom{
		text-decoration:none;
		float:left;
	}

	.bordaBox {bbackground: ttransparent; width:133px;}
	.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b4, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b, .bordaBox .b4b {display:block; overflow:hidden; font-size:1px;}
	.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b {height:1px;}
	.bordaBox .b2, .bordaBox .b3, .bordaBox .b4 {background:#FF6600; border-left:1px solid #FF6600; border-right:1px solid #FF6600;}
	.bordaBox .b1 {margin:0 5px; background:#FF6600;}
	.bordaBox .b2 {margin:0 3px; border-width:0 2px;}
	.bordaBox .b3 {margin:0 2px;}
	.bordaBox .b4 {height:2px; margin:0 1px;}
	.bordaBox .conteudo {padding:5px;display:block; background:#FF6600; border-left:1px solid #FF6600; border-right:1px solid #FF6600; color: #FFFFFF;}

	.bordaBox2 {bbackground: ttransparent; width:150px;}
	.bordaBox2 .b1, .bordaBox2 .b2, .bordaBox2 .b3, .bordaBox2 .b4, .bordaBox2 .b1b, .bordaBox2 .b2b, .bordaBox2 .b3b, .bordaBox2 .b4b {display:block; overflow:hidden; font-size:1px;}
	.bordaBox2 .b1, .bordaBox2 .b2, .bordaBox2 .b3, .bordaBox2 .b1b, .bordaBox2 .b2b, .bordaBox2 .b3b {height:1px;}
	.bordaBox2 .b2, .bordaBox2 .b3, .bordaBox2 .b4 {background:#006666; border-left:1px solid #006666; border-right:1px solid #006666;}
	.bordaBox2 .b1 {margin:0 5px; background:#006666 ;}
	.bordaBox2 .b2 {margin:0 3px; border-width:0 2px;}
	.bordaBox2 .b3 {margin:0 2px;}
	.bordaBox2 .b4 {height:2px; margin:0 1px;}
	.bordaBox2 .conteudo {padding:5px;display:block; background:#006666; border-left:1px solid #006666; border-right:1px solid #006666; color: #FFFFFF;}
	
	</style>

	<script type="text/javascript">

	$(document).ready(function() {
		$('.jqzoom').jqzoom({
				zoomType: 'reverse',
				zoomWidth:519,
				zoomHeight:430,
				lens:true,
				preloadImages: false,
				alwaysOn:false
			});
		//$('.jqzoom').jqzoom();
	});
	</script>

	</head>

<?php

$acao = $modulo ."/". $modulo1;

$ck_sessao = "";
if( isset($_COOKIE["ck_sessao"]) ){
	$ck_sessao = $_COOKIE["ck_sessao"];
}

$categ = "";
if (isset($_SESSION['ses_categ'])){
	$categ = $_SESSION['ses_categ'];
}
$itens = "";
if (isset($_SESSION['itens'])){
	$itens = $_SESSION['itens'];
}

$at_cmb = "";
if (isset($_POST['at_cmb'])){
	$at_cmb = $_POST['at_cmb'];
}

if ($at_cmb == "s"){
	$c_erros = "";

	/* ##################### INSERCAO ##################### */
	$erro_nome = "";
	$PRD_CODIGO = "";
	if (isset($_POST['PRD_CODIGO'])){
		$PRD_CODIGO = $_POST['PRD_CODIGO'];
	}

	$tamanho = "";
	$erro_tamanho = "";
	if (isset($_POST['tamanho'])){
		$tamanho = $_POST['tamanho'];
	}
	if ($tamanho == ""){ 
		$c_erros = $c_erros . ",Informe o tamanho.";
		$erro_tamanho = "erro";
	}

	$qtdProd = "1";
	$cor = "";
/*
	$erro_qtdProd = "";
	if (isset($_POST['qtdProd'])){
		$qtdProd = $_POST['qtdProd'];
	}
	if ($qtdProd == ""){ 
		$c_erros = $c_erros . ",Quantidade não informada.";
		$erro_qtdProd = "erro";
	}

	if (isset($_POST['cor'])){
		$cor = $_POST['cor'];
	}
*/
	
	$vlrProd = "";
	if (isset($_POST['PRD_VLR_VENDA']))
		$vlrProd = $_POST['PRD_VLR_VENDA'];
echo ">>>> PRD_CODIGO $PRD_CODIGO cor $cor tamanho $tamanho qtdProd $qtdProd vlrProd $vlrProd";

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		Pedidos($ck_sessao, $PRD_CODIGO, $cor, $tamanho, $qtdProd, $vlrProd);
	}
	/* ##################### INSERCAO ##################### */
}

/* ##################### CONSULTA ##################### */
$sql_busca = "
SELECT * FROM produto 
LEFT JOIN prod_img AS prod_img ON prod_img.PRD_PRI_CODIGO = produto.PRD_CODIGO
WHERE PRD_CODIGO = '$modulo1'
";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);
$num_busca = mysql_num_rows($exe_busca);

$PRD_QTD_ESTQ 	= $fet_busca['PRD_QTD_ESTQ'];
$PRD_VLR_VENDA	= $fet_busca['PRD_VLR_VENDA'];
$PRD_TAM	  	= $fet_busca['PRD_TAM'];

$arr_cor = explode(",",$fet_busca['PRD_COR']);
$qtd_cor = count($arr_cor);
$arr_cor_desc = explode(",",$fet_busca['PRD_COR_DESC']);
$qtd_cor_desc = count($arr_cor_desc);

$arr_imagem = explode(",",$fet_busca['PRI_IMAGEM']);
$qtd_img = count($arr_imagem);

$i = 0;
$principal = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/small/". substr( strrchr($arr_imagem[$i],"/"), 1);
$big_princ = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/". substr( strrchr($arr_imagem[$i],"/"), 1);
/* ##################### CONSULTA ##################### */


if ($at_cmb != "" && $c_erros == ""){
	?>
	<script language="javascript" type="text/javascript">window.location="pedido";</script>
	<?php
}
/*
$PRD_TIPO_SEXO	= ""
$PRD_TIPO_PROD	= ""
$PRD_ESTILO		= ""
$PRD_NOME		= ""
$PRD_MARCA		= ""
$PRD_MODELO		= ""
$PRD_DATA_INI	= ""
$PRD_DATA_FIM	= ""
$PRD_ATIVO		= ""
$PRD_FRET_GRAT	= ""
$PRD_VLR_CUSTO	= ""
$PRD_VLR_DESC	= ""
$PRD_VLR_PROMO	= ""
$PRD_MATERIAL	= ""
$PRD_OBS		= ""

*/
?>

<form id="formProdViewSel" name="formProdViewSel" action="<?php echo $acao; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at_cmb" 			value="s">
	<input type="hidden" name="PRD_CODIGO" 		value="<?php echo $modulo1; ?>">
	<input type="hidden" name="PRD_VLR_VENDA" 	value="<?php echo $PRD_VLR_VENDA; ?>">
	
	<?php //aaa echo $modulo1; ?>
	
	<table width="100%" border="0" cellspacing="4" cellpadding="0" >
		<tr>
			<td valign="top">
				<div class="clearfix" id="content" ><!-- style="margin-top:100px;margin-left:350px; height:500px;width:500px;" -->
					<div class="clearfix">
						<a href="<?php echo $big_princ; ?>" class="jqzoom" rel='gal1' title="..." >
							<img src="<?php echo $principal; ?>" title="..." ><!-- style="border: 4px solid #666;" -->
						</a>
					</div>
					<br/>
					<div class="clearfix">
						<ul id="thumblist" class="clearfix">
							<?php
								$i = 0;
								$big_img = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/thumb/". substr( strrchr($arr_imagem[$i],"/"), 1);
								$thumb   = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/thumb/". substr( strrchr($arr_imagem[$i],"/"), 1);
								$small   = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/small/". substr( strrchr($arr_imagem[$i],"/"), 1);
							?>
							<li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $small; ?>',largeimage: '<?php echo $big_img; ?>'}"><img src='<?php echo $thumb; ?>'></a></li>
							<?php
							for($i = 1 ; $i < $qtd_img ; $i++ ){
								$thumb = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/thumb/". substr( strrchr($arr_imagem[$i],"/"), 1);
								$small = substr( $arr_imagem[$i], 0, strrpos($arr_imagem[$i], "/") ) ."/small/". substr( strrchr($arr_imagem[$i],"/"), 1);
							?>
								<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $small; ?>',largeimage: '<?php echo $arr_imagem[$i]; ?>'}"><img src='<?php echo $thumb; ?>' ></a></li><!-- width="93" height="116" -->
							<?php
							} 
							?>
						</ul>
					</div>
				</div>
			</td>
			<td valign="top">
				<div style="margin-left:10px;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td colspan="2">
							<div style="margin-bottom:10px;"><font size='3'><b><?php echo buscaDB('prod_marca', 'PMA_MARCA', $fet_busca['PRD_MARCA'], 'PMA_MARCA_DESC'); ?></b></font></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="model" ><span><?php echo $fet_busca['PRD_NOME'] ." - ". $fet_busca['PRD_MODELO']; ?></span></div>
							<div class="model2" ><span></span></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>
										<div class="rs3">
											<font size="2px" color="red">De: R$ <?php echo number_format($fet_busca['PRD_VLR_VENDA'], 2, ',','.'); ?></font><br><br>
											<font size="2px" color="black">por </font> <font color="#88b717">R$ <?php echo number_format($fet_busca['PRD_VLR_PROMO'], 2, ',','.') ; ?></font>
										</div>
										Economize <b>R$ <?php echo number_format( ($fet_busca['PRD_VLR_VENDA'] - $fet_busca['PRD_VLR_PROMO']) , 2, ',','.'); ?></b> nesta compra</br>
									</td>
									<td align="right">
										<?php if ($fet_busca['PRD_FRET_GRAT'] != "") ?>
										<div class="rs3"><font size="5px" color="#88b717">*FRETE GRÁTIS</font></div>
									</td>
								</tr>
								<!--
								<tr height="40px">
									<td width="150px"><h3 class="more" style="margin-top:10px;">ESCOLHA A COR</h3></td>
									<td>
										<table border="0" cellpadding="0" cellspacing="5"><tr>
										<?php
										/*
										for($i = 0 ; $i < $qtd_cor ; $i++ ){
											if ($arr_cor[$i] != ""){
												if ($i == 0) $isChecked = "checked"; else $isChecked = "";

												echo '<td align="center" width="30">
												<table border="0" cellpadding="0" cellspacing="10" width="" >
													<tr><td width="20px" height="10px" id="'. $i .'" style="background-color:#'. $arr_cor[$i] .'; "></td>
													<tr><td width="20px" align="center" >
															<input type="radio"  name="cor" value="'. $arr_cor_desc[$i] .'" title="'. $arr_cor_desc[$i] .'" '. $isChecked .'/>
														</td></tr>
												</table>
												</td>
												';
											}
										}*/
										?>
										</tr>
										</table>
									</td>
								</tr>
								<tr height="40px">
									<td><h3 class="more" style="margin-top:10px;">QUANTIDADE</h3></td>
									<td><input type='input' name='qtdProd' value='1' maxlength="6" size="3" onkeypress="return SomenteNumero(event)"></td>
								</tr>
								-->
								<tr height="60px">
									<td width="200px"><h3 class="more"><b>Selecione o Tamanho</b></h3></td>
									<td>
										<select name="tamanho" ><!-- onchange="liberaCampo('complemento', this.value)" -->
										<?php
										$arr_tam = explode(",",$PRD_TAM);
										$n_tam = count($arr_tam);
										for($i = 0 ; $i < $n_tam ; $i++ ){
											echo "<option value='". $arr_tam[$i] ."' >". $arr_tam[$i] ."</option>";
										}
										?>
										</select>
									</td>
								</tr>
								<tr><td colspan="2" align='center'><div class="model2" ><span></span></div><br></td></tr>
							</table>
						</td>
					</tr>

					<tr>
						<td align='center'>
						<div class='bordaBox' style="margin-bottom:10px; margin-top:10px;">
							<input type='hidden' name='hdBuy01' value='Jaqueta EJ001'>
							<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
							<!-- <a href='index.php?ac=lst&aaa&prd="<?php //echo $fet_busca['PRD_CODIGO']; ?>"')><div class='conteudo'><h3>EFETUAR COMPRA</h3></div></a> -->
							<a href="javascript:void(0);" onClick="efetuaCompra();"><div class='conteudo'><h3>COMPRAR</h3></div></a>
							<b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b>
						</div></td>
						<td align='center'>
						<div class='bordaBox2' style="margin-bottom:10px; margin-top:10px;">
							<input type='hidden' name='hdBuy01' value='Jaqueta EJ001'>
							<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
							<a href='javascript:void(0);' onclick='javascrip:buySel("<?php echo $fet_busca['PRD_CODIGO']; ?>")'><div class='conteudo'><h4>Adicionar ao Carrinho</h4></div></a>
							<b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b>
						</div></td>
					</tr>

					<tr><td colspan="2">
					<div class="model2" ><span></span></div>
					OBS: Pode haver uma leve variação de cor/tom em relação à foto do produto de monitor para monitor, visto que cada aparelho possui uma calibragem diferente.</br>
					</td></tr>
				</table>
				</div>
			</td>
		</tr>
	</table>
	</br></br></br>
<!--
</form>
-->