<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">	

	<!--<link rel="stylesheet" href="css/global.css" type="text/css" media="all">-->	
	<!--<link rel="stylesheet" type="text/css" href="css/style.css"/>-->
	
	<script src="script/x_functions.js"></script>
	<script src="script/jquery-1.5.1.js"></script>
	
	<style type="text/css"> 
			/*Area de usuario*/
			.transparente {
				position:absolute;
				top:50px;
				left:185px;
				background-color:#999999;
				border:solid 2px #CCCCCC;
				width:150px;
				filter:alpha(opacity=90);
				opacity:0.9;
				display:"";
			}
			.mostra {
				position:absolute;
				top:50px;
				left:165px;
				background-color:#999999;
				border:solid 2px #CCCCCC;
				width:150px;
				filter:alpha(opacity=100);
				opacity:1;
				display:"";
			}
			.esconde {
			   position:absolute;
			   display:none;
			}
			/**/
	</style>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-1640709-1']);

	  _gaq.push(['_setDomainName', '.posthaus.com.br']);
	  _gaq.push(['_setAllowLinker', true]);
	  _gaq.push(['_setAllowHash', false]);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>


</head>
<?php 
$pedido = "";
if (isset($_POST['pedido']))
	$pedido = $_POST['pedido'];
	

$at_cmb = "";
if (isset($_POST['at_cmb']))
	$at_cmb = $_POST['at_cmb'];

if ($at_cmb == "s"){
	$c_erros = "";

//echo "<br> TTTTTTTTTTTTTTTT lstProdAltera $lstProdAltera ..... lstProdQtdAltera ". $lstProdQtdAltera ." .... btClicado $btClicado ";
	
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
	}
	*/
}

if ($at_cmb != "" && $c_erros == ""){

	if ($btClicado == "Comprando"){
		?>
		<script language="javascript" type="text/javascript">window.location="loja";</script>
		<?php
	}else if ($btClicado == "Proximo"){
		if ($email_cadastrado == ""){
			?>
			<script language="javascript" type="text/javascript">window.location="cadastro";</script>
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
?>

<body>

<div id="content" align="center">		
	<table width="962" border="0" cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
			<td style="font-size:11px;color:#333;" align="left">Escolha abaixo o endereço onde deseja que seu pedido seja entregue</td>
		</tr>
		</tbody>
	</table>
	
	<div id="baseDados" style="width:962px;height:229px;">
	<form name="frmEndereco" action="https://www.posthaus.com.br/cliente/cadastro?loja=0&anc=0&marc=0" method="post" onsubmit="return prevalidate()">
		<input type="hidden" value="inserirAlterarEndereco" id="acao" name="acao">
		<input type="hidden" name="enderecoEntrega" id="enderecoEntrega">
		<input type="hidden" name="cdende" id="cdende" value="">
		<table width="963" border="0" cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
			<td width="963">
			<div id="endereco2" style="width:962px;border: solid 1px #CCC;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr>
					   <td align="left" height="35" bgcolor="#1088d6" style="padding-left:25px;color:#FFF;font-weight:bold;font-size:13px;">Endereços de entrega</td>
					</tr>
					<tr>
					  <td align="left" valign="top" style="padding-left:25px;padding-right:25px;padding-bottom:22px;">
						 
						 <div style="width: 450px;float: left;padding-top:22px;padding-right: 6px;">
							<table border="0" cellpadding="0" cellspacing="0">
								<tbody><tr><td height="64" valign="top" align="left">
									   <span style="font-size:12px;color:#333;"><strong>Endereço Principal</strong></span><br>
									   <span style="font-size:12px;color:#666;">Helder Fuckner</span><br>
									   <span style="font-size:12px;color:#666;">R Bento Torrens, 75</span><br>
									   <span style="font-size:12px;color:#666;">CEP: 89210-320 - Joinville - SC</span>
									</td>
								</tr>
								<tr>
								  <td align="left">
									  <img border="0" src="./Endereços_files/entregar-neste-endereco.jpg" width="167" height="21" style="cursor: pointer;" onclick="document.frmEndereco.acao.value=&#39;selecionaEndereco&#39;;document.frmEndereco.enderecoEntrega.value=&#39;1&#39;;document.frmEndereco.submit();">
									  <a href="https://www.posthaus.com.br/cliente/cadastro?loja=0&anc=0&marc=0#cadastro" onclick="editarEndereco(&#39;Helder Fuckner&#39;,&#39;0&#39;,&#39;47&#39;,&#39;34361640&#39;,&#39;47&#39;,&#39;92336981&#39;,&#39;&#39;,&#39;&#39;,&#39;Endereço Principal&#39;,&#39;89210&#39;,&#39;320&#39;,&#39;R Bento Torrens&#39;,&#39;75&#39;,&#39; &#39;,&#39;ITAUM&#39;,&#39;Joinville&#39;,&#39;SC&#39;)"><img border="0" src="./Endereços_files/editar.jpg" width="63" height="21" style="margin-left: 4px;cursor: pointer;"></a>
								  </td>
								</tr>  
							</tbody></table>
						 </div>
						 
						 <div style="width: 450px;float: left;padding-top:22px;padding-right: 6px;">
							<table border="0" cellpadding="0" cellspacing="0">
								<tbody><tr><td height="64" valign="top" align="left">
									   <span style="font-size:12px;color:#333;"><strong>Casa</strong></span><br>
									   <span style="font-size:12px;color:#666;">Rosangela Pereira</span><br>
									   <span style="font-size:12px;color:#666;">R Joao Ramalho, 223</span><br>
									   <span style="font-size:12px;color:#666;">CEP: 89232-370 - Joinville - SC</span>
									</td>
								</tr>
								<tr>
								  <td align="left">
									  <img border="0" src="./Endereços_files/entregar-neste-endereco.jpg" width="167" height="21" style="cursor: pointer;" onclick="document.frmEndereco.acao.value=&#39;selecionaEndereco&#39;;document.frmEndereco.enderecoEntrega.value=&#39;2&#39;;document.frmEndereco.submit();">
									  <a href="https://www.posthaus.com.br/cliente/cadastro?loja=0&anc=0&marc=0#cadastro" onclick="editarEndereco(&#39;Rosangela Pereira&#39;,&#39;1&#39;,&#39;47&#39;,&#39;34361640&#39;,&#39;47&#39;,&#39;92336981&#39;,&#39;&#39;,&#39;&#39;,&#39;Casa&#39;,&#39;89232&#39;,&#39;370&#39;,&#39;R Joao Ramalho&#39;,&#39;223&#39;,&#39;Casa&#39;,&#39;BOEHMERWALD&#39;,&#39;Joinville&#39;,&#39;SC&#39;)"><img border="0" src="./Endereços_files/editar.jpg" width="63" height="21" style="margin-left: 4px;cursor: pointer;"></a>
									  
										<a onclick="confirmDialog(&#39;confirmaExcluir&#39;,&#39;Deseja realmente excluir este endereço?&#39;,&#39;excluirEndereco(&quot;1&quot;)&#39;)"><img border="0" src="./Endereços_files/excluir.gif" width="72" height="21" style="margin-left: 4px;cursor: pointer;"></a>
									  
								  </td>
								</tr>  
							</tbody></table>
						 </div>
						 
					  </td>
					</tr>
					<tr>
					  <td align="left" valign="top" style="padding-right:25px;padding-bottom:22px;"><span style="padding-left:25px;padding-top:22px;"><a href="https://www.posthaus.com.br/cliente/cadastro?loja=0&anc=0&marc=0#cadastro" onclick="novoEndereco()"><img border="0" src="./Endereços_files/cadastrar_novo_endereco_de_entrega.gif" width="232" height="21"></a>&nbsp;<a href="https://www.posthaus.com.br/seguranca/cadastro20.jsp"><img src="./Endereços_files/alterar_meu_cadastro.gif" alt="Alterar Meu  Cadastro" width="149" height="21" border="0"></a></span></td>
					</tr>
					</tbody>
				</table>
			</div> 
		   </td>
		</tr>
		
		<tr>
			<td align="left" style="font-size:11px;color:#333;padding-top:20px;">Os campos com (*), são obrigatórios</td>
		</tr>

		<tr>
			<td width="963">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody>
					<tr><td align="left" height="35" bgcolor="#1088d6" style="padding-left:25px;color:#FFF;font-weight:bold;font-size:13px;">Cadastrar novo endereço de entrega</td></tr>
					<tr>
						<td align="left" valign="top">
							<iframe name="iframeCEP" id="iframeCEP" src="./ajax_cep_entr.php" frameborder="0" scrolling="no" align="center" width="100%" height="215px">
								Sem suporte a iFrames.
							</iframe>
						</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
		
		<tr>
			<td align="right" style="padding-top:10px;padding-bottom:30px;"><input id="salvarEndereco" type="image" src="./Endereços_files/salvar.gif" onclick="document.frmEndereco.action+=&#39;#cadastro&#39;"></td>
		</tr>
		</tbody>
		</table>            
	</form>
	</div>
</div>

</body></html>