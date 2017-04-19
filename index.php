<?php
session_start();
ini_set('default_charset','UTF-8');

include("func/config.php");

$sessao = session_id();

// APAGAR COOKIE
//setcookie("ck_sessao");
// APAGAR COOKIE

// INICIALIZACOES
if( !isset($_COOKIE["ck_sessao"]) )
	setcookie("ck_sessao", $sessao,  time()+(30*(3600*24)) );

/* INICIALIZACAO VARIAVEIS DE SESSAO */
$loginemailcad 		= "";
$loginsenhacad 		= "";
$acessoemailcad    	= "";
$acessocep1 		= "";
$acessocep2 		= "";
$c_erro				= "";
$loginemailtop 		= "";
$login_senha 		= "";
$nome 				= "";
$itens 				= 0;
$tipo 				= "";
$errologinemail		= "";
$erroacessoemail 	= "";
$errosenha 			= "";
$errocep 			= "";
$cpf_cnpj 			= "";
$usuar    			= "";
$action   			= "";
$gerente  			= "";
$categ 				= "";
$bt01 				= "";

if (!isset($_SESSION['cpf_cnpj']))			$_SESSION['cpf_cnpj'] 			= "";
if (!isset($_SESSION['ses_cpfcnpj']))		$_SESSION['ses_cpfcnpj'] 		= "";
if (!isset($_SESSION['sesEmailLog']))		$_SESSION['sesEmailLog'] 		= "";
if (!isset($_SESSION['nome']))				$_SESSION['nome'] 				= "";
//if (!isset($_SESSION['acessoemailcad']))	$_SESSION['acessoemailcad'] 	= "";
//if (!isset($_SESSION['acessocep1']))		$_SESSION['acessocep1'] 		= "";
//if (!isset($_SESSION['acessocep2']))		$_SESSION['acessocep2'] 		= "";
if (!isset($_SESSION['tipo']))				$_SESSION['tipo'] 				= "";
if (!isset($_SESSION['errocep']))			$_SESSION['errocep'] 			= "";
if (!isset($_SESSION['ses_gerente']))			$_SESSION['ses_gerente'] 			= "";
if (!isset($_SESSION['itens']))				$_SESSION['itens'] 				= 0;
if (!isset($_SESSION['loginemailcad']))		$_SESSION['loginemailcad'] 		= "";
if (!isset($_SESSION['errologinemail']))	$_SESSION['errologinemail'] 	= "";
if (!isset($_SESSION['errosenha']))			$_SESSION['errosenha'] 			= "";
if (!isset($_SESSION['erroacessoemail']))	$_SESSION['erroacessoemail'] 	= "";
if (!isset($_SESSION['ultPagVisit']))		$_SESSION['ultPagVisit'] 		= "";
if (!isset($_SESSION['sess_link_cad']))		$_SESSION['sess_link_cad'] 		= "";
if (!isset($_SESSION['pedido_passos']))		$_SESSION['pedido_passos'] 		= "";
if (!isset($_SESSION['sesMMO_COD']))		$_SESSION['sesMMO_COD'] 		= "";
if (!isset($_SESSION['sesMMO_MARCA']))		$_SESSION['sesMMO_MARCA'] 		= "";
if (!isset($_SESSION['sesMMO_MODELO'])) 	$_SESSION['sesMMO_MODELO'] 		= "";
if (!isset($_SESSION['seslNew'])) 			$_SESSION['seslNew'] 			= false;
if (!isset($_SESSION['sVM_MMO_COD']))		$_SESSION['sVM_MMO_COD']		= "";
if (!isset($_SESSION['sVM_MMO_MARCA']))		$_SESSION['sVM_MMO_MARCA']		= "";
if (!isset($_SESSION['sVM_MMO_MODELO'])) 	$_SESSION['sVM_MMO_MODELO']		= "";

/* FIM - INICIALIZACAO VARIAVEIS DE SESSAO */

/*sss
function encode5t($str)
	return strrev(base64_encode($str)); //apply base64 first and then reverse the string;
*/
$acao  = "";
if (isset($_GET['ac']))
	$acao = $_GET['ac'];
else
	$acao = "home"; //encode5t("home");

$mod = "";
if (isset($_GET['mod']))
	$mod = $_GET['mod'];

$at = "";
if (isset($_GET['at']))
	$at = $_GET['at'];

//echo " aaaa " . $email . " -- " . $senha . " -- " . $fet_busca['PES_CPFCNPJ'] . " -- " . $fet_busca['PES_NOME'] . "<br>";
//echo " bbbb " . $_SESSION['sesEmailLog'] . " -- " . $_SESSION['senha'] . " -- " . $_SESSION['ses_cpfcnpj'] . " -- ";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

<title>MotoPod®</title>
<meta name="keywords" content="moto, moto noticias, notícia de moto, notícias de motos, comparação de motos, avaliação de motos, formula 1" />
<meta name="description" content="MotoPod - Tudo Sobre Motos" />

	<!-- FAVICONs -->
	<!-- Internet Explorer
	<link href="images/favicon/favicon.ico" type="images/x-icon" rel="shortcut icon">
	<link href="images/favicon/favicon.ico" type="images/x-icon" rel="icon">
	-->
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
	<link rel="manifest" href="images/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- FAVICONs -->
	
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/demos.css">
	<link rel="stylesheet" type="text/css" href="themes/base/jquery.ui.all.css">

	<!-- MENU TOP -->
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	
	<script type='text/javascript' src='script/menu_jquery.js'></script>	
	<!-- MENU TOP -->
	
	<!-- funcao para GOOGLE ANALYTICS -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-41361578-3', 'auto');
	  ga('send', 'pageview');

	</script>

	<script src="script/jquery-1.5.1.js" 				type="text/javascript"></script>
	<script src="script/menu.js" 		 				type="text/javascript"></script>
	<script src="script/jquery.ui.core.js"	 			type="text/javascript"></script>
	<script src="script/jquery.ui.widget.js" 			type="text/javascript"></script>
	<script src="script/jquery.ui.datepicker.js" 		type="text/javascript"></script>
	<script src="script/jquery.ui.datepicker-pt-BR.js"	type="text/javascript"></script>

	<script language="javascript" src="script/x_functions.js"></script>
	<script language="javascript" src="script/x_mascara.js"></script>
	
	<!-- MODAL -->
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script> -->	
	
	<!--<script type="text/javascript" src="script/jquery.js"></script>-->
	<!-- MODAL -->
	
	<script>
		/*
		$(function() {
			$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
			$( "#datepicker" ).datepicker(
				// { $.datepicker.regional[ "pt-BR" ] }
				{
					//showOn: "button",
					//buttonImage: "image_icons/calendar.gif",
					//buttonImageOnly: true,
					
					//defaultDate: new Date(1980, 1 - 1, 1), showTrigger: '#calImg',
					//maxDate: '+1m +2w +10d',
					//maxDate: +30,
					//minDate: new Date(1900, 1 - 1, 26), 
					//maxDate: '01/26/2009',
										
					//minDate: new Date(1990, 1 , 26),
					//maxDate: new Date(2009, 1, 26), 
					//showTrigger: '#calImg',

					yearRange: 'c-110:c+100',
					changeMonth: true,
					changeYear: true
				}				
			);
			
			$( "#locale" ).change(function() {
				$( "#datepicker" ).datepicker( "option", $.datepicker.regional[ $( this ).val() ] );
			});
		});
		*/
		$(function(){
			$('.scroll-pane').jScrollPane({showArrows: true});
		});
	</script>

	<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" /> 
	<style type="text/css" id="page-css">
		/* Styles specific to this particular page */
		.scroll-pane
		{
			width: 100%;
			height: 478px;
			overflow: auto;
		}
		.horizontal-only
		{
			height: auto;
			max-height: 200px;
		}		
	</style>

	<?php require_once("func/Url.class.php"); ?>
	<base href="<?php echo URL::getBase() ?>" />	
	<?php
		$modulo  = Url::getURL( 0 );
		$modulo1 = Url::getURL( 1 );
		$modulo2 = Url::getURL( 2 );
		$modulo3 = Url::getURL( 3 );
	?>
	<?php //echo "modulo >". $modulo . "<  || modulo1 >". $modulo1 . "< || modulo2 >" . $modulo2 ."<"; //header("Location:loja"); // Refresh na tela ?>	
	
	<!-- GALERIA IMAGENS -->
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8">
		google.load("jquery", "1.3");
	</script>
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
	<script src="script/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$(".gallery a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
		});
	</script>
	<!-- GALERIA IMAGENS -->
	
	
	<!-- SLIDER >>> SOMENTE CARREGA SLIDER NA PAGINA PRINCIPAL <<< SLIDER -->
	<?php if ($modulo == "" || $modulo == "principal"){ ?>
	<link href="css/svwp_style.css" rel="stylesheet" type="text/css" />
	<script src="script/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="script/jquery.slideViewerPro.1.0.js" type="text/javascript"></script>
	<!-- Optional plugins  -->
	<script src="script/jquery.timers.js" type="text/javascript"></script>
	<?php } ?>
	<!-- SLIDER >>> SOMENTE CARREGA SLIDER NA PAGINA PRINCIPAL <<< SLIDER -->
	
</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" >
	<center>
		<?php include("top.php"); ?>
		<?php include("main.php"); ?>
		<?php include("bottom.php"); ?>
	</center>
</body>
</html>