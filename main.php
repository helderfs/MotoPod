<?php
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");

$lst_pag = CarregaLst('MEN_CODIGO','menus','');
$lst_pag .= "  moto  
news_motos	
news-moto-novidades
news-moto-teste
news_motogp  
news_f1 
 
loja  loja_acess  lj_lubrif  lj_retrovis  lj_pneu  lj_acess  lj_vest  lj_blusa  lj_camisa  lj_jaqueta
mt_compara  viagem  viag_compara  locais  loc_compara

homem  mulher  acessorios  loja  contato juntese

acesso  cadastro  cadgrpusu  cadprod  cadnews  cadmoto    
cad_cor  cad_estilo  cad_marca  cad_material  cad_tamanho  cad_tp_prod  
del_cor  del_estilo  del_marca  del_material  del_tamanho  del_tp_prod  
endereco  gridprod  i_login_cad  juntese  lembrasenha  logar  loja  
moddata  moddelivery  modemail  modsenha  novo_endereco  
pedido  pessoa  principal  prodview  prodviewsel  sidebar

erro";

$lst_cat1_menu = array('cadgrpusu','cadprod','cadnews','cadmoto','','moddata','moddelivery','modemail','modsenha','deleta');

$lst_menu_top = array('moto','logar','pessoa','cadastro','endereco','loja','acesso','contato','email_contato','juntese','quem_somos','politic_seg');

$sesEmailLog = $_SESSION['sesEmailLog'];

// NAO NECESSARIO
//if ( file_exists( "mod/" . $modulo . ".php" ) )
//	require "principal.php";

if (isset($_SESSION['ultPagVisit']))
	$ultPagVisit = $_SESSION['ultPagVisit'];

if ($modulo == null)
	$modulo = "principal";

if ($modulo == "sair"){
	session_destroy();
	// AO SAIR, DEVE DAR REFESH, SOMENTE DESCOMENTAR ESTA LINHA ABAIXO
	?><script language="javascript" type="text/javascript">window.location="http://www.motopod.com.br";</script><?php
}

// Menu Lateral - Modificável no banco de dados
/*
$categ = "001";	// Meus Dados
$categ = "002";	// Loja
$categ = "003";	// Mulher
$categ = "004";	// Acessórios
*/

if( ($modulo == "pessoa" && $loginemailtop != "")){
	$categ = "001";

}elseif( in_array($modulo, buscaDBArr('menus','MEN_CATEG','1','MEN_CODIGO')) ){
	$categ = "001";
}elseif( in_array($modulo, buscaDBArr('menus','MEN_CATEG','3','MEN_CODIGO')) ){
	$categ = "003";		// Menu Lateral
	$modulo = "prodview";
}elseif( in_array($modulo, buscaDBArr('menus','MEN_CATEG','2','MEN_CODIGO')) ){
	$categ = "002";		// Menu Lateral
	$modulo = "prodview";
}elseif( in_array($modulo, buscaDBArr('menus','MEN_CATEG','2','MEN_CODIGO')) ){
	$categ = "002";		// Menu Lateral
	//$categ = "003";	// Sem Menu Lateral
	if ($modulo1 != "")
		$modulo = "prodviewsel";
	else
		$modulo = "prodview";
}elseif( in_array($modulo, $lst_cat1_menu) ){
/*
UPDATE menus_grp SET
MGR_MEN_CODIGO = 'CadGrpUsu'
WHERE MGR_MEN_CODIGO = 'grpusu'
*/
	//$_SESSION['ses_categ'] = "001";
	//include("telaCadProd.php");
}elseif($modulo == "acesso"){
	// inicializa campos, caso usuario tentou acessar antes pelo login ou cadastro, nao dando erro
	$_SESSION['errologinemail']  = "";
	$_SESSION['errosenha']		 = "";
	$_SESSION['erroacessoemail'] = "";
	$_SESSION['errocep']		 = "";
}
?>

<div>
	<table border="0" cellpadding="0" cellspacing="0" width="960px">
	<tr>
		<?php
		// Barrar usuários não autorizados à CATEGORIA 001="Meus Dados...etc"
		/*
		if ($modulo == "moto"){
			echo '<td width="200px" height="800px" valign="top" align="left">';
			//include_once("includes/i_menu_moto.php");
			echo '
			<iframe name="iframeMoto" id="iframeMoto" src="./ajax_view_moto.php" frameborder="0" scrolling="no" align="center" width="85%" height="100%">
				<p>Sem suporte a iFrames.</p>
			</iframe>';
			echo '</td>';
		}else{*/
		
			// Se não está logado, acessa pagina E CATEG if VAZIO
			if ($sesEmailLog != "" && $categ != ""){
				echo '<td width="161px" valign="top" align="left">';
				$_SESSION['ses_categ'] = $categ;
				include_once("includes/i_menu.php");
				echo '</td>';
			}

		//}
		?>
		<td width="" valign="top" align="left">
			<div style="margin-top:10px; margin-left:5px;">
				<?php //echo "<br> >>>>TELA >>>$modulo<<< <br> categ $categ ";

				$sql_busca = "SELECT PST_COD FROM mp_posts WHERE PST_LINK = '$modulo' ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$cod_post = $fet_busca['PST_COD'];

				if ($cod_post != ""){
					$cod_post = strval($cod_post);

					// ##################### INSERE COMENTARIOS #####################
					$btEnvCmnt = "";
					$btEnvCmntMt = "";
					$erro1 = "input";
					$erro2 = "input";
					$erro3 = "input";
					$name = "";
					$email = "";
					$comment = "";
					
					if (isset($_POST['btEnvCmnt']))		$btEnvCmnt   = $_POST['btEnvCmnt'];
					if (isset($_POST['btEnvCmntMt']))	$btEnvCmntMt = $_POST['btEnvCmntMt'];

					if ($btEnvCmnt != "" || $btEnvCmntMt != ""){
						$c_erros = "";

						if (isset($_POST['name']))
							$name = $_POST['name'];

						if (trim($name) == ""){
							$c_erros = $c_erros . ",Nome não informado.";
							$erro1 = "field_error";
						}
						
						if (isset($_POST['email']))
							$email = $_POST['email'];

						if (trim($email) == ""){ 
							$c_erros = $c_erros . ",E-mail não informado.";
							$erro2 = "field_error";
						}

						if (isset($_POST['comment']))
							$comment = $_POST['comment'];

						if (trim($comment) == ""){ 
							$c_erros = $c_erros . ",Comentário não informado.";
							$erro3 = "field_error";
						}

						if ($c_erros != ""){
							echo msgErro($c_erros);
						}else{
							if ($btEnvCmnt != ""){
								$cod_cmt = proxCod1($cod_post,'PCM_PST_COD','PCM_COD','mp_post_cmt'); // VALOR CAMPO PAI -- NOME CAMPO PAI -- NOME CAMPO da TABELA do novo código -- NOME TABELA
								
								if ($cod_cmt > 0){
									$sql_busca = "INSERT INTO mp_post_cmt (PCM_PST_COD,PCM_COD,PCM_DATE,PCM_HORA,PCM_NOME,PCM_EMAIL,PCM_POST) VALUES 
												 ($cod_post,$cod_cmt,'". date("Y-m-d") ."','". date('Hi') ."', '$name', '$email', '$comment')";
									$exe_busca = mysql_query($sql_busca) or die (mysql_error());
								}
							}
							
							if ($btEnvCmntMt != ""){
							
							// VALOR CAMPO PAI -- NOME CAMPO PAI -- NOME CAMPO da TABELA do novo código -- NOME TABELA
							//proxCod2($vlcmppai1, $cmppai1, $vlcmppai2, $cmppai2, $cmp, $tabela){
							
								$cod_cmt = proxCod2($cod_post,'MCM_MMO_COD','MCM_COD','mp_moto_cmt'); // VALOR CAMPO PAI -- NOME CAMPO PAI -- NOME CAMPO da TABELA do novo código -- NOME TABELA
								
								/*
								if ($cod_cmt > 0){
									$sql_busca = "INSERT INTO mp_post_cmt (PCM_PST_COD,PCM_COD,PCM_DATE,PCM_HORA,PCM_NOME,PCM_EMAIL,PCM_POST) VALUES 
												 ($cod_post,$cod_cmt,'". date("Y-m-d") ."','". date('Hi') ."', '$name', '$email', '$comment')";
									$exe_busca = mysql_query($sql_busca) or die (mysql_error());
								}*/
							}
						}
					}
					// ##################### INSERE COMENTARIOS #####################

					// Mostra Notícia
					echo showPosts($modulo,'S',$erro1,$erro2,$erro3,"",""); // PARAM: ($link,$mostraPag,$erro1,$erro2,$erro3,$slider,$cat)

				}elseif ($modulo == "principal"){
					// selecao das ultimas 6º até 10º noticias de todas as categorias
					echo showPosts("","","","","","S",""); 	// PARAM: "link do post", "mostrar todo o conteúdo do post"
				}elseif ($modulo == "news_motos"){
					echo showPosts("","","","","","","1");	// PARAM: ($link,$mostraPag,$erro1,$erro2,$erro3,$slider,$cat)
				}elseif ($modulo == "news_motogp"){
					echo showPosts("","","","","","","2");	// PARAM: ($link,$mostraPag,$erro1,$erro2,$erro3,$slider,$cat)
				}elseif ($modulo == "news_f1"){
					echo showPosts("","","","","","","3");	// PARAM: ($link,$mostraPag,$erro1,$erro2,$erro3,$slider,$cat)
				}else{
					// Barrar usuários não autorizados à CATEGORIA 001="Meus Dados...etc"
					//echo "<br>OPAOPA modulo $modulo sesEmailLog $sesEmailLog";

					// Se... não está logado  OU  acessa pagina de LOGIN / CADASTRO  OU  LISTA (lst_menu_top) de menus acessíveis a todos como MOTOS - CONTATOS.. etc
					if ($sesEmailLog != "" || $modulo == 'logar' || in_array($modulo, $lst_menu_top)){
						if ( in_array($modulo, $lst_menu_top) || in_array($modulo, $lst_cat1_menu) )
							require "mod/". str_replace("-", "_", $modulo) .".php";
						else
							require "mod/erro.php";
					}else{
						require "mod/cadastro.php";
					}
				}
				?>
			<div>
		</td>
	</tr>
	</table>
</div>