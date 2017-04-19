<!--
Endereço de Entrega															Endereço do Comprador

Casa, Trabalho

Destinatário: Rosangela Pereira
Rua Bento Torrens, 75
Itaum
Joinville - SC - Brasil
CEP: 89210-320
Tipo: Residencial
Referência: wwwww

Editar

Entrega Normal?Utilizar esta opção de entrega.Clique aqui!
Prazo de entrega: 7 dia(s) útil(eis)


BOTAO----- Entregar neste endereço -> (VERDE) 								Cadastrar Novo Endereço
-->
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


	<script language="javascript" type="text/javascript">
		<!--		
		function Voltar(){
			window.location="pedido";
		}
		
		function Proximo(){
			window.location="pagamento";
		}
		
		function ProximoCadastro(){
		}
		
		function calcProdVlr(indice){
			var qtdInfo = document.getElementById('textPrdQtd' + indice).value;
			var hdProdVlr = document.getElementById('hdProdVlr' + indice).value;

			if (qtdInfo > 0){
				var vlrFinal = qtdInfo * hdProdVlr;

				document.getElementById('vlrTotPrd' + indice).value = "R$ " + formatoMoeda(vlrFinal);
			}
		}
		
		-->
	</script>
</head>

<?php

$acao = $modulo ."/". $modulo1;
//kkk echo "<br>ACAO........ ". $acao;

$_SESSION['pedido_passos'] = "endereco";

$email_cadastrado = "";
$ck_sessao = "";
$at_cmb = "";

if (isset($_SESSION['sesEmailLog'])) 	$email_cadastrado = $_SESSION['sesEmailLog'];
if (isset($_POST['at_cmb']))		$at_cmb = $_POST['at_cmb'];
if( isset($_COOKIE["ck_sessao"]) ) 	$ck_sessao = $_COOKIE["ck_sessao"];

//echo "ck_sessao $ck_sessao";

if ($at_cmb == "s"){
	$c_erros = "";
}

if ($at_cmb != "" && $c_erros == ""){
	?>
	<script language="javascript" type="text/javascript">window.location="pagamento";</script>
	<?php
}

?>

<form id="formPedido" name="formPedido" action="<?php echo $acao; ?>" method="post" accept-charset="utf-8">

	<?php
	$sql_busca = " SELECT PED_SESSION FROM pedido WHERE PED_SESSION = '$ck_sessao' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	
	if ($fet_busca['PED_SESSION'] == ""){
		echo msgErro(" Seu carrinho de compras está vazio!");
	}else{
		$vlr_total = 0;
		$vlr_frete = 0;
//		  LEFT JOIN pessoa 	   		AS pessoa 		 	ON pessoa.PES_CPFCNPJ    		 = pedido.PED_PES_CPFCNPJ		
		$qr = "
		SELECT pedido_produto.PPR_QTD	AS qtd_prod,
			   produto.PRD_VLR_VENDA	AS valorProd,
			   endereco.END_CEP AS END_CEP
		  FROM pedido
		  LEFT JOIN pedido_produto 	AS pedido_produto 	ON pedido_produto.PPR_PED_CODIGO = pedido.PED_CODIGO
		  LEFT JOIN produto 	  	AS produto 		 	ON produto.PRD_CODIGO    		 = pedido_produto.PPR_PRODUTO
		  LEFT JOIN endereco   		AS endereco 		ON endereco.END_PES_CPFCNPJ    	 = pedido.PED_PES_CPFCNPJ
		 WHERE pedido.PED_SESSION = '$ck_sessao'
		   AND endereco.END_ENTREGA = 'S'
		";
		$sql   = mysql_query($qr) or die (mysql_error());
		$total = mysql_num_rows($sql);
		
		while($r = mysql_fetch_array($sql)){
			$vlr_total += ($r['valorProd'] * $r['qtd_prod']);
			$END_CEP = substr($r['END_CEP'], 0, 5) ."-". substr($r['END_CEP'], 5, 3);			
		}
	?>

	<table id="cart_endereco" class="std">
		<thead>
			<tr>
				<th colspan="4" class="">Endereço de Entrega</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2" class="cart_desc_end" width="">
					<div style="margin-left:50px;">
						<table border="0" cellspacing="0" cellpadding="0" class="cart_end_total_delivery">
							<tr>
								<td>
								<div style="padding-bottom:3px;"><font size="4en">CEP: <?php echo $END_CEP; ?></div></font></br>
								<label style="padding-bottom:3px;">Rua: Bento Torrens KKKKKKKKKKKKKKKKKKKKKKKKKK, 75</label></br>
								<font style="">Bairro: Itaum</font></br>
								<font style="">Cidade: Joinville - SC</font>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td colspan="" class="cart_altera_ender" width="">
					<a href="javascript:void(0);" class="exclusive standard-checkout" title="Próximo" onClick="window.location='moddelivery';">« Alterar Endereço Entrega</a>
				</td>
			</tr>
		</tbody>
		<tbody>
			<tr class="" valign="bottom" >
				<td colspan="2">
					<table id="" width="" border="0" cellspacing="0" cellpadding="0" class="">
						<tr valign="top">
							<td width="156" style="padding-left:10PX;" class="cinza-12">Envio:</td>
							<td width="20"><input name="TIPOENVIO" type="radio" id="radio" value="NORMAL" checked="" onclick="atualizaValores(&#39;27,99&#39;,&#39;10,62&#39;,&#39;38,61&#39;,&#39;1&#39;,&#39;N&#39;)"></td>
							<td width="65"><img src="images/icons/entrega_normal.gif" width="60" height="34"></td>
							<td width="378">
								<span class=""><u><font size="2en">Entrega normal</font></u></span><br>
								<span class="cinza-9">Prazo: <strong>6 dias úteis</strong></span><br>
								<span class="cinza-9">Valor: <strong>10,62</strong></span>
							</td>
							
							<td width="150">&nbsp;</td>

							<td width="20"><input type="radio" name="TIPOENVIO" id="radio" value="EXPRESSO" onclick="atualizaValores(&#39;27,99&#39;,&#39;13,06&#39;,&#39;41,05&#39;,&#39;1&#39;,&#39;S&#39;)"></td>
							<td width="66"><img src="images/icons/entrega_expressa.gif" width="60" height="34"></td>
							<td width="370">
								<span class=""><u><font size="2en">Entrega expressa</font></u></span><br>
								<span class="cinza-9">Prazo: <strong>3 dias úteis</strong></span><br>
								<span class="cinza-9">Valor: <strong>13,06</strong></span>
							</td>
						</tr>
					</table>
				</td>
				<td colspan="" align="center" class="cart_end_total_shipping" id=""><font size="3en">Frete Grátis!</font></td>
			</tr>
			<tr class="cart_total_price">
				<td colspan="2" id="cart_voucher" class="cart_voucher"></td>
				<td colspan="" class="price total_price_container" id="total_price_container">
					<p>Total:</p>
					<!-- <span id="total_price">R$ <?php //echo number_format( ($vlr_total + $vlr_frete) , 2, ",", "."); ?></span> -->
					<input type="text" class="vlr_tot_ped" id="vlrTotPed" name="vlrTotPed" value="R$ <?php echo number_format( ($vlr_total + $vlr_frete) , 2, ",", "."); ?>" autocomplete="off">
				</td>
			</tr>
		</tbody>
	</table>
	
	<p class="cart_navigation">
		<a href="javascript:void(0);" class="exclusive standard-checkout" title="Próximo" onClick="<?php echo "Proximo();"; //if ($email_cadastrado == "") echo "Proximo();"; else echo "Proximo();"; ?>">Próximo »</a>
		<a href="javascript:void(0);" class="button_large" title="Voltar" onClick="Voltar();">« Voltar</a>
	</p>

	<script language="javascript" type="text/javascript">
		window.document.formPedido.tot_prod.value = window.document.formLogin.tot_itens.value;
	</script>

	</br></br></br>
	
	<?php } ?>
</form>