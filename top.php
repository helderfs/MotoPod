<script language="javascript" src="script/x_functions.js"></script>
<?php 

$loginemailtop = "";
$nome = "";
$itens = "";

if (isset($_SESSION['sesEmailLog'])) $loginemailtop = $_SESSION['sesEmailLog'];
if (isset($_SESSION['nome'])) 		$nome 			= $_SESSION['nome'];
if (strlen($nome) > 20) 			$nome 			= substr($nome,0,28)."...";
if (isset($_SESSION['itens']))		$itens 			= $_SESSION['itens'];

$menu = Url::getURL(0);

$ck_sessao = "";
if( isset($_COOKIE["ck_sessao"]) ) $ck_sessao = $_COOKIE["ck_sessao"];

// CONSULTA ITENS CARRINHO
$sql_busca = "
SELECT COUNT(pedido_produto.PPR_PRODUTO) AS QTD_PRD
  FROM pedido
  LEFT JOIN pedido_produto AS pedido_produto ON pedido_produto.PPR_PED_CODIGO = pedido.PED_CODIGO
WHERE pedido.PED_SESSION = '". $ck_sessao ."'";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$fet_busca = mysql_fetch_assoc($exe_busca);

$qtd_buy = $fet_busca['QTD_PRD'];
$_SESSION['sess_qtd_buy'] = $qtd_buy;

/* NECESSARIO FAZER BUSCA SEPARADO, POIS QUANDO PRECISA FAZER UMA LISTA, DO OUTRO JEITO O COMANDO "while($r = mysql_fetch_array($sql))" NAO FUNCIONA */
// Busca lista todos produtos p/ controle da qtd itens comprados em JAVASCRIPT
$qr = "
SELECT pedido_produto.PPR_PRODUTO
  FROM pedido
  LEFT JOIN pedido_produto AS pedido_produto ON pedido_produto.PPR_PED_CODIGO = pedido.PED_CODIGO
WHERE pedido.PED_SESSION = '". $ck_sessao ."'";
$sql = mysql_query($qr);
$total = mysql_num_rows($sql);
$indice = 0;
$lista = "";
while($r = mysql_fetch_array($sql)){
	$indice ++;
	
	$lista = $lista .",". $r['PPR_PRODUTO'];
}

?>

<form id="formLogin" name="formLogin" method="post" action="logar" accept-charset="utf-8">

<input type="hidden" name="session_buy" 	  	value="<?php echo $ck_sessao; ?>">
<input type="hidden" name="session_itens_buy" 	value="">
<input type="hidden" name="tot_itens_buy" 	  	value="<?php echo $lista; ?>">
<input type="hidden" name="tot_itens" 	  		value="<?php echo $indice; ?>">
<input type="hidden" id="hd_qtd_prod" 			name="hd_qtd_prod" value="<?php echo $qtd_buy; ?>">

<table border="0" cellspacing="0" cellpadding="0" width="960px">
	<tr height="40px">
		<td id="cabecalho" valign="middle" align="left" >
			<table border="0" cellspacing="0" cellpadding="0" width="100%" bordercolor="">
				<!-- ###################################################################################################### -->
				<?php 
				if ($loginemailtop != ""){ ?>
				<td id="cabecalho" valign="middle" align="left" width="36%">
					<div >
						&nbsp;&nbsp;<?php echo "Bem Vindo(a)  <strong>" . $nome . "</strong>"; ?>
					</div>
				</td>
				<?php }else{ ?>
				<td id="cabecalho" valign="middle" align="left" width="26%">
					<div>
						&nbsp;&nbsp;<?php echo "Faça seu "; ?>
						<u><a href="cadastro" target="_parent" style="color:#FFFFFF; text-decoration: none;">login</a></u> / 
						<u><a href="cadastro" target="_parent" style="color:#FFFFFF; text-decoration: none;">cadastro</a></u>
					</div>
					<!--<div style="float:right; font-size:11px;"><a href="index.php?ac=cadastro" target="_parent" onmouseover="this.style.color='#FFFFFF';" onmouseout="this.style.color='#FFFFFF';" style="color:#FFFFFF; text-decoration: none;">cadastre-se&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>-->
				</td>
				<?php 
				}
				
				//if ($qtd_buy > 0){ ?>
				<!--
				<td id="cabecalho" valign="middle" align="center" width="30%">
					<div style="margin-top:-14px; margin-left:90px; position:absolute; valign:middle;">
						<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
							<tr>
								<td valign="middle"><a href="pedido" style="color:#FFFFFF; text-decoration: none;"><img border="0" id="carrinho" src="images/icons/shopping-bag.png"></a></td>
								<td valign="middle"><a href="pedido" style="color:#FFFFFF; text-decoration: none;">&nbsp;<input name='buy_itens' size='4' value='<?php echo $qtd_buy; //retQtdLista($SIT_ITEM); ?>' style='border-width:0; width:22px; background-color:#7a8189; color:#FFFFFF; text-align:top; font-size:19px;' readonly></a></td>
							</tr>
						</table>
					</div>
				</td>
				-->
				<?php 
				//}
				
				if ($loginemailtop != ""){ ?>
				<td id="cabecalho" valign="middle" align="right" width="33%">
					<table border="0" cellspacing="0" cellpadding="0" >
					<tr valign="middle">
					<td id="cabecalho">
						<a href="moddata" target="_parent" onmouseover="this.style.color='#FFFFFF';" onmouseout="this.style.color='#FFFFFF';" style="color:#FFFFFF; text-decoration: none;" onclick="<?php $_SESSION['ultPagVisit'] = "MeusDados"; ?>">Meus Dados</a>
						&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
						<a href="sair" target="_parent" onmouseover="this.style.color='#FFFFFF';" onmouseout="this.style.color='#FFFFFF';" style="color:#FFFFFF; text-decoration: none;">Sair</a>
						&nbsp;&nbsp;&nbsp;
					</td>
					</tr>
					</table>
				</td>
				<?php
				}else{
				?>
				<td id="cabecalho" valign="middle" align="right" width="53%">
					<table border="0" cellspacing="0" cellpadding="0" >
					<tr valign="middle">
					<td id="cabecalho">
						<label>e-mail&nbsp;&nbsp;</label>
					</td>
					<td id="cabecalho" >
						<input type="text" id="sesEmailLog" name="sesEmailLog" size="18" maxlength="70" value="" tabindex="1">
					</td>
					<td id="cabecalho" width="75" align="right">
						<label>senha&nbsp;&nbsp;</label>
					</td>
					<td id="cabecalho" >
						<input type="password" id="logsenha" name="logsenha" size="10" maxlength="30" value="" tabindex="2">
					</td>
					<td id="cabecalho" width="55" valign="middle" align="center">
						<div style="font-size:18px;">
							<input class="bt_submit" type="submit" id="btLoginTop" name="btLoginTop" value="OK" style="height: 22px; width: 40px;" tabindex="3">
							<!--<strong><a href="javascript:if (document.form1.login.value == '') { alert('Informe e-mail e senha !'); } else { document.form1.submit();}" onclick="document.forms[1].submit();" onmouseover="this.style.color='#FFFFFF';" onmouseout="this.style.color='#FFFFFF';" style="color:#FFFFFF; text-decoration: none;">&nbsp;&nbsp;ok&nbsp;&nbsp;&nbsp;</a></strong>-->
						</div>
					</td>
					</tr>
					</table>
				</td>
				<?php } ?>
			</table>			
		</td>
	</tr>
	<tr height="">
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="100%" height="50px">
			<tr align="left" valign="top">
				<td width="166px"><a href="http://www.motopod.com.br"><img src="images/logo_mp201x74.png" width="161px" height="59px" title="MotoPod®" border="0" style="margin-top:5px;"/></a>&nbsp;</td>
				<td>
					<div id='cssmenu'>
						<ul>
							<li class='has-sub'><a href='principal'><span>NOTÍCIAS</span></a>
								<ul>
									<!--
									<li class='has-sub'><a href='news_motos'><span>MOTOS</span></a>
										<ul>
											<li><a href='news-moto-novidades'><span>Novidades</span></a></li>
											<li><a href='news-moto-teste'><span>Testes e Comparativos</span></a></li>
										</ul>
									</li>
									-->
									<li><a href='news_motos'><span>MOTOS</span></a></li>
									<li><a href='news_motogp'><span>MotoGP</span></a></li>
									<li><a href='news_f1'><span>F-1</span></a></li>
								</ul>
							</li>
							<!--
							<li class='has-sub'><a href='loja'><span>LOJA</span></a>
								<ul>
									<li class='has-sub'><a href='lj_acess'><span>PEÇAS</span></a>
										<ul>
										   <li><a href='lj_lubrif'><span>Lubrificantes</span></a></li>
										   <li><a href='lj_retrovis'><span>Retrovisores</span></a></li>
										   <li class='last'><a href='lj_pneu'><span>Pneus</span></a></li>
										</ul>
									</li>
									<li class='has-sub'><a href='lj_vest'><span>VESTUÁRIO</span></a>
										<ul>
										   <li><a href='lj_blusa'><span>Blusas</span></a></li>
										   <li><a href='lj_camisa'><span>Camisas</span></a></li>
										   <li class='last'><a href='lj_jaqueta'><span>Jaquetas</span></a></li>
										</ul>
									</li>
								</ul>
							</li>
							
							
							<li class='has-sub'><a href='moto'><span>MOTOS</span></a>
							-->							
							<li><a href='moto'><span>MOTOS</span></a>
								<!--<ul>
									<li class='has-sub'><a href='mt_compara'><span>Comparação de Motos</span></a></li>
								</ul>-->
							</li>
							<!--
							<li class='has-sub'><a href='viagem'><span>VIAGEM</span></a>
								<ul>
									<li class='has-sub'><a href='viag_compara'><span>Comparação de Viagens</span></a></li>
								</ul>
							</li>
							<li class='has-sub'><a href='locais'><span>LOCAIS</span></a>
								<ul>
									<li class='has-sub'><a href='loc_compara'><span>Comparação de Lugares/Locais</span></a></li>
								</ul>
							</li>
							-->
							<li><a href='contato'><span>Contato</span></a></li>
							<li class='last'><a href='juntese'><span>Junte-se</span></a></li>
						</ul>
					</div>
				</td> 
			</tr>
			</table> 
		</td>
	</tr>
</table>

</form>