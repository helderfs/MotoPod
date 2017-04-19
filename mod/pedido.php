<?php
require_once("includes/xajax/xajax.inc.php");
include_once("../_func/phpmailer/class.phpmailer.php");
include_once("../_func/func_db.php");
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">	

	<!--<link rel="stylesheet" href="css/global.css" type="text/css" media="all">-->	
	<!--<link rel="stylesheet" type="text/css" href="css/style.css"/>-->
	
	<script src="script/x_functions.js"></script>
	<script src="script/jquery-1.5.1.js"></script>
	<script language="javascript" src="./script/x_mascara.js"></script>


	<script language="javascript" type="text/javascript">
		<!--		
		function gravaCEPPed(){
			document.formPedido.hdEND_CEP.value  = document.getElementById('iframeCEPPed').contentWindow.document.getElementById('END_CEP').value;
			document.formPedido.hdVlrFrete.value = document.getElementById('iframeCEPPed').contentWindow.document.getElementById('hdVlrFrete').value;
			
			if (window.parent.document.formPedido.hdVlrFrete.value != 0)
				window.parent.document.formPedido.vlrFrete.value = "R$ " + substPontoVirgula(window.parent.document.formPedido.hdVlrFrete.value);
			else
				window.parent.document.formPedido.vlrFrete.value = "Grátis";

			calcProdVlr();
			
			/*
			document.getElementById('divVlrFrete').style.visibility = 'visible';
			document.getElementById('freteGratis').style.visibility = 'hidden';
			*/
		}
		
		function alteraQtd(){
			var lstProd = "";
			var lstQtd  = "";
			var qtdProdutos = window.parent.document.formLogin.hd_qtd_prod.value;

			for (i = 1; i <= qtdProdutos ; i++ ){
				var hdProd 	   = document.getElementById('hdProd' + i).value;
				var hdProdQtd  = document.getElementById('hdProdQtd' + i).value;
				var textPrdQtd = document.getElementById('textPrdQtd' + i).value;

				if ( hdProdQtd != textPrdQtd ){
					if (lstProd == ""){
						lstProd = hdProd;
						lstQtd  = textPrdQtd;
					}else{
						lstProd = lstProd + "," + hdProd;
						lstQtd = lstQtd + "," + textPrdQtd;
					}
				}
			}
			
			if ( (lstProd != "") || (lstQtd != "") ){
				window.parent.document.formPedido.lstProdAltera.value 	 = lstProd;
				window.parent.document.formPedido.lstProdQtdAltera.value = lstQtd;
			}
		}
		
		function Comprando(){
			alteraQtd();
			
			if (window.parent.document.formPedido.lstProdAltera.value != ""){
				window.parent.document.formPedido.btClicado.value = "Comprando";
				window.parent.document.formPedido.submit();
			}else{
				window.location="loja";
			}
		}
		
		function Proximo(){
			alteraQtd();
			
			if (window.parent.document.formPedido.lstProdAltera.value != ""){
				window.parent.document.formPedido.btClicado.value = "Proximo";
				window.parent.document.formPedido.submit();
			}else{
				window.location="endereco";
			}
		}

		function ProximoCadastro(){
			alteraQtd();

			if (window.parent.document.formPedido.lstProdAltera.value != ""){
				window.parent.document.formPedido.btClicado.value = "Proximo";
				window.parent.document.formPedido.submit();				
			}else{
				window.location="acesso";
			}
		}

		function edtProd(produto){
			/*
			window.parent.document.formPedido.SelEdtProd.value = produto;
			window.parent.document.formPedido.submit();
			*/
		}

		function delProd(produto){
			if ( confirm('Deseja excluir Produto?') ){
				window.parent.document.formPedido.SelDelProd.value = produto;
				window.parent.document.formPedido.submit();
			}
		}

		function imgGera(imagem){
			window.open('../' + imagem, 'WindowC', 'left=20,top=20,width=800,height=600,resizable=yes');
		}
				
		function calcProdVlr(indice){
			var qtdInfo   = document.getElementById('textPrdQtd' + indice).value;
			var hdProdVlr = document.getElementById('hdProdVlr' + indice).value;
			/* frete ???? */
			
			if (qtdInfo > 0){
				var vlrFinal = qtdInfo * hdProdVlr;

				document.getElementById('vlrTotPrd'   + indice).value = "R$ " + formatoMoeda(vlrFinal);
				document.getElementById('hdVlrTotPrd' + indice).value = vlrFinal;
			}
			
			/* Soma Total de Produtos */
			var valorTotal = 0;
			var qtdInfo    = 0;
			var hdProdVlr  = 0;
			var qtdProdutos = window.parent.document.formLogin.hd_qtd_prod.value;
			for (i = 1; i <= qtdProdutos ; i++ ){
				qtdInfo   = document.getElementById('textPrdQtd' + i).value;
				hdProdVlr = document.getElementById('hdProdVlr' + i).value;
				window.parent.document.formPedido.hdVlrFrete.value
				
				valorTotal = valorTotal + (qtdInfo * hdProdVlr);
			}

			document.getElementById('vlrSubTot').value = "R$ " + formatoMoeda(valorTotal);
			document.getElementById('vlrTotPed').value = "R$ " + formatoMoeda(valorTotal);
		}
		
		function plusPrdQtde(indice){
			document.getElementById('textPrdQtd' + indice).value = parseFloat( document.getElementById('textPrdQtd' + indice).value ) + 1;
			
			calcProdVlr(indice);
		}

		function minusPrdQtde(indice){
			var qtde = parseFloat( document.getElementById('textPrdQtd' + indice).value ) - 1;
			if (qtde >= 1){
				document.getElementById('textPrdQtd' + indice).value = qtde;
			}

			calcProdVlr(indice);
		}
		-->
	</script>
</head>

<?php

$acao = $modulo ."/". $modulo1;

$_SESSION['pedido_passos'] = "resumo";

$email_cadastrado = "";
$SelDelProd = "";
$btClicado = "";
$lstProdQtdAltera = "";
$lstProdAltera = "";
$pedido = "";
$at_cmb = "";

if (isset($_SESSION['sesEmailLog']))		$email_cadastrado = $_SESSION['sesEmailLog'];
if (isset($_POST['SelDelProd']))		$SelDelProd = $_POST['SelDelProd'];
if (isset($_POST['btClicado']))			$btClicado = $_POST['btClicado'];
if (isset($_POST['lstProdQtdAltera']))	$lstProdQtdAltera = $_POST['lstProdQtdAltera'];
if (isset($_POST['lstProdAltera']))		$lstProdAltera = $_POST['lstProdAltera'];
if (isset($_POST['pedido']))			$pedido = $_POST['pedido'];
if (isset($_POST['at_cmb']))			$at_cmb = $_POST['at_cmb'];

if ($at_cmb == "s"){
	$c_erros = "";

//echo "<br> TTTTTTTTTTTTTTTT lstProdAltera $lstProdAltera ..... lstProdQtdAltera ". $lstProdQtdAltera ." .... btClicado $btClicado ";

	$hdVlrFrete = "";
	if (isset($_POST['hdVlrFrete']))
		$hdVlrFrete = $_POST['hdVlrFrete'];
	
	if ($SelDelProd != "")
		retiraProdPed($pedido, $SelDelProd);
	
	if ($lstProdAltera != ""){
//echo "<br>passou";
		$array_Prod    = explode(",",$lstProdAltera);
		$array_ProdQtd = explode(",",$lstProdQtdAltera);
		
		$qtd_prod = count($array_Prod);
		if ($array_Prod != ""){
			for($i = 0 ; $i < $qtd_prod ; $i++ ){
//echo "<br>passou = $i";
				alteraQtdProdPed($pedido, $array_Prod[$i], $array_ProdQtd[$i]);
			}
		}
	}
	
	/*
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{		
	}*/
	
}

// ###################### FUNCIONA AO APAGAR ITENS DO PEDIDO
if ($at_cmb != "" && $c_erros == ""){

	if ($btClicado == "Comprando"){
		?>
		<script language="javascript" type="text/javascript">window.location="loja";</script>
		<?php
	}else if ($btClicado == "Proximo"){
		if ($email_cadastrado == ""){
			?>
			<script language="javascript" type="text/javascript">window.location="acesso";</script>
			<?php
		}else{
			?>
			<script language="javascript" type="text/javascript">window.location="endereco";</script>
			<?php
		}
	}else{
		?>
		<script language="javascript" type="text/javascript">window.location="pedido";</script>
		<?php
	}
}
// ###################### FUNCIONA AO APAGAR ITENS DO PEDIDO
?>

<form id="formPedido" name="formPedido" action="<?php echo $acao; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at_cmb" 				value="s">
	<input type="hidden" name="PRD_CODIGO" 			value="<?php echo $modulo1; ?>">
	<input type="hidden" name="SelDelProd" 			value="">
	<input type="hidden" name="lstProdAltera"		value="">
	<input type="hidden" name="lstProdQtdAltera"	value="">
	<input type="hidden" name="btClicado"			value="">
	<input type="hidden" name="hdEND_CEP" 			value="">
	<input type="hidden" name="hdVlrFrete" 			value="">
	
	<!-- Steps -->
	<!--
	<center>
	<ul class="step" id="order_step">
		<li class="step_current"><span>1. Resumo</span></li>
		<li class="step_todo"><span>2. Identificação</span></li>
		<li class="step_todo"><span>3. Endereço</span></li>
		<li class="step_todo"><span>4. Envio</span></li>
		<li id="step_end" class="step_todo"><span>5. Pagamento</span></li>
	</ul>
	</center>
	-->
	<!-- Steps -->
	
	<?php
	$ck_sessao = "";
	if( isset($_COOKIE["ck_sessao"]) ) $ck_sessao = $_COOKIE["ck_sessao"];

	$sql_busca = "
	SELECT PED_SESSION FROM pedido WHERE PED_SESSION = '$ck_sessao' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	if ($fet_busca['PED_SESSION'] == ""){
		echo msgErro(" Seu carrinho de compras está vazio!");
	}else{ 
	?>
	Seu carrinho de compras contém: &nbsp;<span id="summary_products_quantity"><input type="text" name="tot_prod" id="tot_prod" style="width:19px; border-style:none; border-width:thin;"/> produto(s)</span>
	<div id="order-detail-content" class="table_block">
		<table id="cart_summary" class="std">
			<thead>
				<tr>
					<th class="cart_product first_item">Produto</th>
					<th class="cart_description item">Descrição</th>
					<th class="cart_unit item">Preço unitário</th>
					<th class="cart_quantity item">Quantidade</th>
					<th class="cart_total item">Total</th>
					<th class="cart_delete last_item">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$vlr_total 	= 0;
				$indice 	= 0;
				
				$qr = "
				SELECT pedido.PED_CODIGO 			AS ped_cod,
					   pedido_produto.PPR_PRODUTO 	AS prod,
					   pedido_produto.PPR_COR 		AS cores,
					   pedido_produto.PPR_TAM 		AS tamanho,
					   pedido_produto.PPR_QTD 		AS qtd_prod,
					   produto.PRD_NOME				AS nomeProd,
					   produto.PRD_VLR_VENDA		AS valorProd,
					   prod_img.PRI_IMAGEM			AS imagem
				  FROM pedido
				  LEFT JOIN pedido_produto AS pedido_produto ON pedido_produto.PPR_PED_CODIGO = pedido.PED_CODIGO
				  LEFT JOIN produto 	   AS produto 		 ON produto.PRD_CODIGO    		  = pedido_produto.PPR_PRODUTO
				  LEFT JOIN prod_img 	   AS prod_img 		 ON prod_img.PRD_PRI_CODIGO    	  = pedido_produto.PPR_PRODUTO
				 WHERE pedido.PED_SESSION = '$ck_sessao'
				";
				$sql   = mysql_query($qr);
				$total = mysql_num_rows($sql);
				
				while($r = mysql_fetch_array($sql)){
					$indice = $indice + 1;
					
					if($indice % 2 == 0)
						$firstItem = "cart_item address_0 even";
					else
						$firstItem = "first_item cart_item address_0 odd";

					$array_img = explode(",",$r['imagem']);
					$array_cor = explode(",",$r['cores']);

					echo '
					<tr id="product_2_2_0_0" class="'. $firstItem .'">
						<td class="cart_product">
							<a href="javascript:void(0);" onClick=imgGera("'. $array_img[0] .'")>	<img src="'. $array_img[0] .'" title="'. $r['nomeProd'] .'" border="0" width="75px" height="99px" ></a>
						</td>
						<td class="cart_description">
							<p class="s_title_block">'. $r['nomeProd'] .'</p>
							Cor : '. $array_cor[0] .'</br>
							Tam : '. $array_cor[0] .'
						</td>
						<td class="cart_unit">
							<span class="price" id="">R$ '. number_format( $r['valorProd'] , 2, ",", ".") .'</span>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<a href="javascript:void(0);" rel="nofollow" class="cart_quantity_up" id="" title="Adicionar" onClick=plusPrdQtde("'. $indice .'");>
									<img src="images/icons/quantity_up.gif" alt="Adicionar" width="14" height="9">
								</a><br>
								<a href="javascript:void(0);" rel="nofollow" class="cart_quantity_down" id="" title="Retirar" onClick=minusPrdQtde("'. $indice .'");>
									<img src="images/icons/quantity_down.gif" alt="Retirar" width="14" height="9">
								</a>
							</div>
							<input type="text" 	 id="textPrdQtd'. 	$indice .'" name="textPrdQtd'. 	$indice .'" value="'. $r['qtd_prod'] .'" onblur=calcProdVlr("'. $indice .'"); size="2" autocomplete="off" class="cart_quantity_input" >
							
							<input type="hidden" id="hdProd'.    	$indice .'" name="hdProd'. 		$indice .'" value="'. $r['prod'] .'">
							<input type="hidden" id="hdProdQtd'.	$indice .'" name="hdProdQtd'. 	$indice .'" value="'. $r['qtd_prod'] .'">							
							<input type="hidden" id="hdProdVlr'.    $indice .'" name="hdProdVlr'. 	$indice .'" value="'. $r['valorProd'] .'">
							<input type="hidden" id="hdVlrTotPrd'. 	$indice .'" name="hdVlrTotPrd'. $indice .'" value="'. number_format( ($r['valorProd'] * $r['qtd_prod']) , 2, ",", ".") .'">
							<input type="hidden" id="pedido" 					name="pedido" 					value="'. $r['ped_cod'] .'">
						</td>
						<td class="cart_total">
							<input type="text"  id="vlrTotPrd'. $indice .'" name="vlrTotPrd'. $indice .'" value="R$ '. number_format( ($r['valorProd'] * $r['qtd_prod']) , 2, ",", ".") .'" autocomplete="off" class="price" style="font-size:12px;">
						</td>
						<td class="cart_delete">
							<div><a rel="nofollow" class="cart_quantity_delete" id="2_2_0_0" href="javascript:void(0);" onClick=delProd("'. $r['prod'] .'"); >&nbsp;&nbsp;Apagar&nbsp;&nbsp;</a></div>
						</td>
					</tr>';
					/*<span class="price" id="total_product_price_2_2_0">R$ '. number_format( ($r['valorProd'] * $r['qtd_prod']) , 2, ",", ".") .'</span>*/
					
					$vlr_total += ($r['valorProd'] * $r['qtd_prod']); 
				}
				
				/* Fazer funcao Frete de acordo com CEP */
				$vlr_frete = 0;
			?>
				</tbody>
				<tfoot>
					<tr >
						<td style="border-right:1px solid #999;" colspan="4">&nbsp;</td>
						<td style="border-bottom:1px solid #999;">Subtotal:</td>
						<td style="border-bottom:1px solid #999; border-right:1px solid #999;"><input type="text" id="vlrSubTot" name="vlrSubTot" value="R$ <?php echo number_format($vlr_total , 2, ",", ".") ?>" autocomplete="off" class="price" style="font-size:12px;"></td>
					</tr>
					<tr class="" style="display:;">
						<td style="border-right:1px solid #999;" align="right" colspan="4" valign="top">
							<iframe id="iframeCEPPed" name="iframeCEPPed" src="./ajax_cep_ped.php" frameborder="0" scrolling="no" align="left" width="90%" height="20px">
								<p>Sem suporte a iFrames.</p>
							</iframe>
							<img src="./pedidos_files/calcular.gif" alt="Calcular" width="81" height="21" onclick="gravaCEPPed();" style="cursor:pointer; margin-top:-20px;">
							<!--
							<table width="642" border="0" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
								<td width="427" align="right" nowrap="" class="" style="">Para calcular o <u>valor do Frete</u> de entrega coloque o <u>CEP</u> aqui</td>
								<td width="">
									<input type="text" id="END_CEP" name="END_CEP" maxlength="9" size="9" style="FONT:bold; height:12px;"
										   value="<?php //if($END_CEP != ""){ echo substr($END_CEP, 0, 5) . "-" . substr(str_replace("-", "", $END_CEP), 5, 7); } ?>"
										   onkeypress="Mascara('cep', event.keyCode, 'document.formPedido.END_CEP');">
								</td>
								<td width="109" style="padding-left:10px;"><img src="./pedidos_files/calcular.gif" alt="Calcular" width="81" height="21" onclick="BuscaCEPBD();" style="cursor:pointer;"></td>
							</tr>
							</tbody>
							</table>
							-->
						</td>
						<td align="left" valign="middle">Frete:</td>
						<td style="border-right:1px solid #999;" >
							<!--<div id="freteGratis" class="shipping preco_total">Grátis<div>-->
							<div id="divVlrFrete"><input type="text" id="vlrFrete" name="vlrFrete" value="" autocomplete="off" class="price" style="font-size:12px;"></div>
						</td>
					</tr>
					<!-- FAZER FUNCIONAR ???
					<tr class="" style="display:;" >
						<td align="right" colspan="4" valign="top">Cupom de desconto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="textCupomDesc" name="textCupomDesc" onblur=buscaCupom("'. $indice .'"); size="10" autocomplete="off" style="height:12px;" ></td>
						<td align="left">Desconto:</td>
						<td><input type="text" id="vlrDesconto" name="vlrDesconto" value="R$ <?php echo number_format($vlr_total , 2, ",", ".") ?>" autocomplete="off" class="price" style="font-size:12px;"></td>
					</tr>
					-->
					<tr class="cart_total_price">
						<td colspan="4" id="cart_voucher" class="cart_voucher" style="border-right:1px solid #999;" ></td>
						<td colspan="2" class="price total_price_container" id="total_price_container">
							<p>Total:</p>
							<!-- <span id="total_price">R$ <?php //echo number_format( ($vlr_total + $vlr_frete) , 2, ",", "."); ?></span> -->
							<input type="text" class="vlr_tot_ped" id="vlrTotPed" name="vlrTotPed" value="R$ <?php echo number_format( ($vlr_total + $vlr_frete) , 2, ",", "."); ?>" autocomplete="off">
						</td>
					</tr>
				</tfoot>
			</table>
	</div>
	<p class="cart_navigation">
		<a href="javascript:void(0);" class="exclusive" title="Próximo" onClick="
			<?php 
			$_SESSION['sess_link_cad'] = "comprando";

			if ($email_cadastrado == ""){
				echo "ProximoCadastro();"; 
			}else{
				echo "Proximo();";
			}
			?>">FINALIZAR PEDIDO »
		</a>
		<a href="javascript:void(0);" class="button_large" title="Continuar comprando" onClick="Comprando();">« Continuar comprando</a>
	</p>
	
	<script language="javascript" type="text/javascript">
		window.document.formPedido.tot_prod.value = window.document.formLogin.tot_itens.value;
	</script>
	<?php } ?>
	
	</br></br></br>	
</form>