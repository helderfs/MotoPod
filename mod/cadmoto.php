<!--
Adicionar nova ABA com:
-Manual 
-Vídeos
-->
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
	<script language="javascript" src="script/x_mascara.js"></script>

	<link rel="stylesheet" href="css/jquery.ui.all.css">
	
	<link  href="css/style.css" type="text/css" rel="stylesheet" />
	<script language="javascript" src="script/x_mascara.js"></script>
	<script language="javascript" src="script/x_functions.js"></script>

	<script src="script/jquery-1.5.1.js"></script>
	<script src="script/jquery.cookie.js"></script>
	<script src="script/jquery.ui.core.js"></script>
	<script src="script/jquery.ui.widget.js"></script>
	<script src="script/jquery.ui.tabs.js"></script>

	<script language="javascript" type="text/javascript">

		$(function(){
			$( "#tabs" ).tabs({
				cookie: {
					// store cookie for a day, without, it would be a session cookie
					expires: 1
				}
			});
		});

		function delImages(cod,ano,pathImag){
			if (pathImag == ""){
				if (cod == ""){
					alert("Selecione uma Moto.");
					window.parent.document.formCadMoto.SelDelMtImgCod.value = "cod";
					window.parent.document.formCadMoto.SelDelMtImgAno.value = "ano";
				}else{
					if ( confirm('Deseja excluir as imagens da Moto ' + cod) ){
						window.parent.document.formCadMoto.SelDelMtImgCod.value = cod;
						window.parent.document.formCadMoto.SelDelMtImgAno.value = ano;
						window.parent.document.formCadMoto.submit();
					}
				}
			}else{
				if ( confirm('Deseja excluir a imagem ' + pathImag) ){
					window.parent.document.formCadMoto.SelDelMtImgCod.value = cod;
					window.parent.document.formCadMoto.SelDelMtImgAno.value = ano;
					window.parent.document.formCadMoto.SelDelMtImgPath.value = pathImag;
					window.parent.document.formCadMoto.submit();
				}
			}
		}

		function gravaCodMarMod(){
			document.formCadMoto.hdMMO_COD.value 	= document.getElementById('iframeMarMod').contentWindow.document.getElementById('hdMMO_COD').value;
			document.formCadMoto.hdMMO_MARCA.value	= document.getElementById('iframeMarMod').contentWindow.document.getElementById('hdMMO_MARCA').value;
			document.formCadMoto.hdMMO_MODELO.value	= document.getElementById('iframeMarMod').contentWindow.document.getElementById('hdMMO_MODELO').value;
		}

		function copyReg(){
			window.parent.document.formCadMoto.submit();
		}
		
	</script>

	</head>

<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

/* ###################### INI - FUNCOES ###################### */
function zeraCampos(){
	$hdMMO_COD 		= "";
	$hdMMO_MARCA 	= "";
	$hdMMO_MODELO 	= "";

	$marca_cod		= "";
	$modelo_lb		= "";

	$_SESSION['sesMMO_COD']		= "";
	$_SESSION['sesMMO_MARCA']  	= "";
	$_SESSION['sesMMO_MODELO']	= "";

	$MOT_MMO_COD	= "";
	$MOT_ANOFAB		= "";
	$MOT_DTCAD		= "";
	$MOT_CATEG		= "";
	$MOT_CC			= "";
	$MOT_CIL		= "";
	$MOT_TPMOTOR	= "";
	$MOT_HP			= "";
	$MOT_KGFM		= "";
	$MOT_MARCHAS	= "";
	$MOT_DIA_CUR	= "";
	$MOT_TXCOMPR	= "";
	$MOT_ALIMENT	= "";
	$MOT_EMBREAG    = "";
	$MOT_COMB       = "";
	$MOT_PARTIDA	= "";
	$MOT_TRANSSEC	= "";
	$MOT_TANQUE     = "";
	$MOT_TPCHASSI   = "";
	$MOT_EIXODIS	= "";
	$MOT_PNEUD		= "";
	$MOT_PNEUT		= "";
	$MOT_PESO       = "";
	$MOT_SUSPDIA	= "";
	$MOT_SUSPTRA	= "";
	$MOT_COMPRIM	= "";
	$MOT_LARG		= "";
	$MOT_ALTURA		= "";
	$MOT_ALTASS		= "";
	$MOT_DISTSOLO	= "";
	$MOT_SISIGNI	= "";
	$MOT_FREIOD   	= "";
	$MOT_FREIOT  	= "";
	$MOT_LAMPDIA	= "";
	$MOT_LAMPTRA    = "";
	$MOT_LAMPEJ     = "";
	$MOT_PISCAAL    = "";
	$MOT_SISELE     = "";
	$MOT_BATERIA    = "";
	$MOT_OBS    	= "";
	
	$MIM_PATH 		= "";

	$btIncluir = "Incluir Moto";
}
/* ###################### FIM - FUNCOES ###################### */



/* ################################################ INICIALIZACAO ################################################ */
$c_erros = "";

zeraCampos();

$MOT_MMO_COD	= "";
$MOT_ANOFAB		= "";
$MOT_DTCAD		= "";
$MOT_CATEG      = "";
$MOT_CC         = "";
$MOT_CIL        = "";
$MOT_TPMOTOR    = "";
$MOT_HP         = "";
$MOT_KGFM       = "";
$MOT_MARCHAS    = "";
$MOT_LUB		= "";
$MOT_OLEO       = "";
$MOT_DIA_CUR	= "";
$MOT_TXCOMPR   	= "";
$MOT_ALIMENT  	= "";
$MOT_EMBREAG    = "";
$MOT_COMB       = "";
$MOT_PARTIDA	= "";
$MOT_TRANSSEC	= "";
$MOT_TANQUE     = "";
$MOT_TPCHASSI   = "";
$MOT_EIXODIS	= "";
$MOT_PNEUD		= "";
$MOT_PNEUT		= "";
$MOT_PESO       = "";
$MOT_SUSPDIA    = "";
$MOT_SUSPTRA    = "";
$MOT_COMPRIM	= "";
$MOT_LARG		= "";
$MOT_ALTURA		= "";
$MOT_ALTASS		= "";
$MOT_DISTSOLO	= "";
$MOT_SISIGNI	= "";
$MOT_FREIOD		= "";
$MOT_FREIOT		= "";
$MOT_LAMPDIA	= "";
$MOT_LAMPTRA    = "";
$MOT_LAMPEJ     = "";
$MOT_PISCAAL    = "";
$MOT_SISELE     = "";
$MOT_BATERIA    = "";
$MOT_OBS    	= "";

// Modelo
$_SESSION['sesMMO_COD']		= "";
$_SESSION['sesMMO_MARCA']  	= "";
$_SESSION['sesMMO_MODELO']	= "";


$MIM_PATH = "";

$btIncluir 		= "";
$btCopia 		= "";
$SelEdtMtCod 	= "";
$SelEdtMtAno 	= "";
$SelDelMtCod 	= "";
$SelDelMtAno 	= "";
$SelDelMtImgCod = "";
$SelDelMtImgAno = "";
$SelDelMtImgPath = "";

if (isset($_POST['btIncluir'])) 		$btIncluir			= $_POST['btIncluir'];
if (isset($_POST['btCopia'])) 			$btCopia			= $_POST['btCopia'];
if (isset($_POST['SelEdtMtCod'])) 		$SelEdtMtCod 		= $_POST['SelEdtMtCod'];
if (isset($_POST['SelEdtMtAno'])) 		$SelEdtMtAno 		= $_POST['SelEdtMtAno'];
if (isset($_POST['SelDelMtCod'])) 		$SelDelMtCod 		= $_POST['SelDelMtCod'];
if (isset($_POST['SelDelMtAno'])) 		$SelDelMtAno 		= $_POST['SelDelMtAno'];
if (isset($_POST['SelDelMtImgPath']))	$SelDelMtImgPath 	= $_POST['SelDelMtImgPath'];
// Necessario para posicionar no codigo PAI para quando deletar imagens ou comentários...fica posicionado no registro que usuario estava deletando
if (isset($_POST['SelDelMtImgCod'])){
	$SelDelMtImgCod = $_POST['SelDelMtImgCod'];
	if ($SelDelMtImgCod != "cod")
		$MOT_MMO_COD = $SelDelMtImgCod;
}
if (isset($_POST['SelDelMtImgAno'])){
	$SelDelMtImgAno = $_POST['SelDelMtImgAno'];
	if ($SelDelMtImgAno != "ano")
		$MOT_ANOFAB = $SelDelMtImgAno;
}


/* ##################### COPIAR ##################### */
if ($btCopia != ""){

	$MOT_MMO_COD 	= "";
	$marca_cod 		= "";
	$modelo_lb 		= "";
	$MOT_ANOFAB		= "";
	$MOT_DTCAD		= "";
	
	if (isset($_POST['MOT_CATEG']))		$MOT_CATEG		= $_POST['MOT_CATEG'];
	if (isset($_POST['MOT_CC']))		$MOT_CC	 		= $_POST['MOT_CC'];
	if (isset($_POST['MOT_CIL']))		$MOT_CIL	 	= $_POST['MOT_CIL'];
	if (isset($_POST['MOT_TPMOTOR']))	$MOT_TPMOTOR	= $_POST['MOT_TPMOTOR'];
	if (isset($_POST['MOT_HP']))		$MOT_HP	 		= $_POST['MOT_HP'];
	if (isset($_POST['MOT_KGFM']))		$MOT_KGFM	 	= $_POST['MOT_KGFM'];
	if (isset($_POST['MOT_MARCHAS']))	$MOT_MARCHAS	= $_POST['MOT_MARCHAS'];
	if (isset($_POST['MOT_LUB']))		$MOT_LUB		= $_POST['MOT_LUB'];
	if (isset($_POST['MOT_OLEO']))		$MOT_OLEO		= $_POST['MOT_OLEO'];
	if (isset($_POST['MOT_PESO']))		$MOT_PESO	 	= $_POST['MOT_PESO'];
	if (isset($_POST['MOT_COMB']))		$MOT_COMB	 	= $_POST['MOT_COMB'];
	if (isset($_POST['MOT_PARTIDA']))	$MOT_PARTIDA	= $_POST['MOT_PARTIDA'];
	if (isset($_POST['MOT_TRANSSEC']))	$MOT_TRANSSEC	= $_POST['MOT_TRANSSEC'];
	if (isset($_POST['MOT_TANQUE']))	$MOT_TANQUE	 	= $_POST['MOT_TANQUE'];
	if (isset($_POST['MOT_EIXODIS']))	$MOT_EIXODIS	= $_POST['MOT_EIXODIS'];
	if (isset($_POST['MOT_PNEUD']))		$MOT_PNEUD		= $_POST['MOT_PNEUD'];
	if (isset($_POST['MOT_PNEUT']))		$MOT_PNEUT		= $_POST['MOT_PNEUT'];
	if (isset($_POST['MOT_DIA_CUR']))	$MOT_DIA_CUR	= $_POST['MOT_DIA_CUR'];
	if (isset($_POST['MOT_TXCOMPR']))	$MOT_TXCOMPR	= $_POST['MOT_TXCOMPR'];
	if (isset($_POST['MOT_ALIMENT']))	$MOT_ALIMENT	= $_POST['MOT_ALIMENT'];
	if (isset($_POST['MOT_EMBREAG']))	$MOT_EMBREAG	= $_POST['MOT_EMBREAG'];
	if (isset($_POST['MOT_TPCHASSI']))	$MOT_TPCHASSI	= $_POST['MOT_TPCHASSI'];
	if (isset($_POST['MOT_SUSPDIA']))	$MOT_SUSPDIA	= $_POST['MOT_SUSPDIA'];
	if (isset($_POST['MOT_SUSPTRA']))	$MOT_SUSPTRA	= $_POST['MOT_SUSPTRA'];
	if (isset($_POST['MOT_COMPRIM']))	$MOT_COMPRIM	= $_POST['MOT_COMPRIM'];
	if (isset($_POST['MOT_LARG']))		$MOT_LARG		= $_POST['MOT_LARG'];
	if (isset($_POST['MOT_ALTURA']))	$MOT_ALTURA		= $_POST['MOT_ALTURA'];
	if (isset($_POST['MOT_ALTASS']))	$MOT_ALTASS		= $_POST['MOT_ALTASS'];
	if (isset($_POST['MOT_DISTSOLO']))	$MOT_DISTSOLO	= $_POST['MOT_DISTSOLO'];
	if (isset($_POST['MOT_SISIGNI']))	$MOT_SISIGNI	= $_POST['MOT_SISIGNI'];
	if (isset($_POST['MOT_FREIOD']))	$MOT_FREIOD		= $_POST['MOT_FREIOD'];
	if (isset($_POST['MOT_FREIOT']))	$MOT_FREIOT		= $_POST['MOT_FREIOT'];
	if (isset($_POST['MOT_LAMPDIA']))	$MOT_LAMPDIA	= $_POST['MOT_LAMPDIA'];
	if (isset($_POST['MOT_LAMPTRA']))	$MOT_LAMPTRA	= $_POST['MOT_LAMPTRA'];
	if (isset($_POST['MOT_LAMPEJ']))	$MOT_LAMPEJ		= $_POST['MOT_LAMPEJ'];
	if (isset($_POST['MOT_PISCAAL']))	$MOT_PISCAAL	= $_POST['MOT_PISCAAL'];
	if (isset($_POST['MOT_SISELE']))	$MOT_SISELE		= $_POST['MOT_SISELE'];
	if (isset($_POST['MOT_BATERIA']))	$MOT_BATERIA	= $_POST['MOT_BATERIA'];
	if (isset($_POST['MOT_OBS']))		$MOT_OBS		= $_POST['MOT_OBS'];
}


/* ##################### INSERCAO ##################### */
if ($btIncluir != ""){

	$c_erros 	  	= "";
	$er_MOT_ANOFAB	= "";
	$er_MOT_CC		= "";
	$er_MOT_CIL 	= "";
	$er_MOT_TPMOTOR = "";
	$er_MOT_HP 		= "";
	$er_MOT_KGFM 	= "";
	$er_MOT_MARCHAS = "";
	$er_MOT_PESO 	= "";
	$er_MOT_TANQUE 	= "";
	$er_MOT_EIXODIS = "";
	$er_MOT_PNEUD 	= "";
	$er_MOT_PNEUT 	= "";

	// CHAVES PRIMARIAS
	if (isset($_POST['hdMMO_COD'])){
		$MOT_MMO_COD 			= $_POST['hdMMO_COD'];
		$_SESSION['sesMMO_COD']	= $_POST['hdMMO_COD'];
	}
	if (isset($_POST['hdMMO_MARCA'])){
		$marca_cod 				  = $_POST['hdMMO_MARCA'];
		$_SESSION['sesMMO_MARCA'] = $_POST['hdMMO_MARCA'];
	}
	if (isset($_POST['hdMMO_MODELO']))
		$_SESSION['sesMMO_MODELO'] = retSEspOut( $_POST['hdMMO_MODELO'] );

	if ( isset($_POST['MOT_ANOFAB']) )
		$MOT_ANOFAB	= $_POST['MOT_ANOFAB'];
	elseif( isset($_POST['hdMOT_ANOFAB']) )
		$MOT_ANOFAB	= $_POST['hdMOT_ANOFAB'];
	
	// Busca a descrição do Modelo Completo   --- buscaDB( Table Search , Field Search , Value Search , Field Return )
	$modelo_lb = mb_strtoupper( retSEspOut( buscaDB('mp_marca_mod', 'MMO_COD', $MOT_MMO_COD, 'MMO_MODELO') ) );
	// CHAVES PRIMARIAS

	if (isset($_POST['MOT_CATEG']))		$MOT_CATEG		= $_POST['MOT_CATEG'];
	if (isset($_POST['MOT_CC']))		$MOT_CC	 		= $_POST['MOT_CC'];
	if (isset($_POST['MOT_CIL']))		$MOT_CIL	 	= $_POST['MOT_CIL'];
	if (isset($_POST['MOT_TPMOTOR']))	$MOT_TPMOTOR	= $_POST['MOT_TPMOTOR'];
	if (isset($_POST['MOT_HP']))		$MOT_HP	 		= $_POST['MOT_HP'];
	if (isset($_POST['MOT_KGFM']))		$MOT_KGFM	 	= $_POST['MOT_KGFM'];
	if (isset($_POST['MOT_MARCHAS']))	$MOT_MARCHAS	= $_POST['MOT_MARCHAS'];
	if (isset($_POST['MOT_LUB']))		$MOT_LUB		= $_POST['MOT_LUB'];
	if (isset($_POST['MOT_OLEO']))		$MOT_OLEO		= $_POST['MOT_OLEO'];
	if (isset($_POST['MOT_PESO']))		$MOT_PESO	 	= $_POST['MOT_PESO'];
	if (isset($_POST['MOT_COMB']))		$MOT_COMB	 	= $_POST['MOT_COMB'];
	if (isset($_POST['MOT_PARTIDA']))	$MOT_PARTIDA	= $_POST['MOT_PARTIDA'];
	if (isset($_POST['MOT_TRANSSEC']))	$MOT_TRANSSEC	= $_POST['MOT_TRANSSEC'];
	if (isset($_POST['MOT_TANQUE']))	$MOT_TANQUE	 	= $_POST['MOT_TANQUE'];
	if (isset($_POST['MOT_EIXODIS']))	$MOT_EIXODIS	= $_POST['MOT_EIXODIS'];
	if (isset($_POST['MOT_PNEUD']))		$MOT_PNEUD		= $_POST['MOT_PNEUD'];
	if (isset($_POST['MOT_PNEUT']))		$MOT_PNEUT		= $_POST['MOT_PNEUT'];
	if (isset($_POST['MOT_DIA_CUR']))	$MOT_DIA_CUR	= $_POST['MOT_DIA_CUR'];
	if (isset($_POST['MOT_TXCOMPR']))	$MOT_TXCOMPR	= $_POST['MOT_TXCOMPR'];
	if (isset($_POST['MOT_ALIMENT']))	$MOT_ALIMENT	= $_POST['MOT_ALIMENT'];
	if (isset($_POST['MOT_EMBREAG']))	$MOT_EMBREAG	= $_POST['MOT_EMBREAG'];
	if (isset($_POST['MOT_TPCHASSI']))	$MOT_TPCHASSI	= $_POST['MOT_TPCHASSI'];
	if (isset($_POST['MOT_SUSPDIA']))	$MOT_SUSPDIA	= $_POST['MOT_SUSPDIA'];
	if (isset($_POST['MOT_SUSPTRA']))	$MOT_SUSPTRA	= $_POST['MOT_SUSPTRA'];
	if (isset($_POST['MOT_COMPRIM']))	$MOT_COMPRIM	= $_POST['MOT_COMPRIM'];
	if (isset($_POST['MOT_LARG']))		$MOT_LARG		= $_POST['MOT_LARG'];
	if (isset($_POST['MOT_ALTURA']))	$MOT_ALTURA		= $_POST['MOT_ALTURA'];
	if (isset($_POST['MOT_ALTASS']))	$MOT_ALTASS		= $_POST['MOT_ALTASS'];
	if (isset($_POST['MOT_DISTSOLO']))	$MOT_DISTSOLO	= $_POST['MOT_DISTSOLO'];
	if (isset($_POST['MOT_SISIGNI']))	$MOT_SISIGNI	= $_POST['MOT_SISIGNI'];
	if (isset($_POST['MOT_FREIOD']))	$MOT_FREIOD		= $_POST['MOT_FREIOD'];
	if (isset($_POST['MOT_FREIOT']))	$MOT_FREIOT		= $_POST['MOT_FREIOT'];
	if (isset($_POST['MOT_LAMPDIA']))	$MOT_LAMPDIA	= $_POST['MOT_LAMPDIA'];
	if (isset($_POST['MOT_LAMPTRA']))	$MOT_LAMPTRA	= $_POST['MOT_LAMPTRA'];
	if (isset($_POST['MOT_LAMPEJ']))	$MOT_LAMPEJ		= $_POST['MOT_LAMPEJ'];
	if (isset($_POST['MOT_PISCAAL']))	$MOT_PISCAAL	= $_POST['MOT_PISCAAL'];
	if (isset($_POST['MOT_SISELE']))	$MOT_SISELE		= $_POST['MOT_SISELE'];
	if (isset($_POST['MOT_BATERIA']))	$MOT_BATERIA	= $_POST['MOT_BATERIA'];
	if (isset($_POST['MOT_OBS']))		$MOT_OBS		= $_POST['MOT_OBS'];


	if ($_SESSION['sesMMO_MARCA'] == ""){
		$c_erros .= ",Marca não informada.";
		$hdMMO_MARCA = ".";
	}
	if ($_SESSION['sesMMO_MODELO'] == ""){
		$c_erros .= ",Modelo não informado.";
		$er_hdMMO_MODELO = ".";
	}
	if ($MOT_ANOFAB == ""){
		$c_erros .= ",Ano não informado.";
		$er_MOT_ANOFAB = ".";
	}
	if ($MOT_CATEG == ""){
		$c_erros .= ",Categoria não informada.";
		$er_MOT_CATEG = ".";
	}
	if ($MOT_CC == ""){
		$c_erros .= ",Cilindrada não informada.";
		$er_MOT_CC = ".";
	}
	if ($MOT_CIL == ""){
		$c_erros .= ",Cilindros não informado.";
		$er_MOT_CIL = ".";
	}
	if ($MOT_TPMOTOR == ""){
		$c_erros .= ",Tipo de Motor não informado.";
		$er_MOT_TPMOTOR = ".";
	}
	if ($MOT_HP == ""){
		$c_erros .= ",CV/HP não informado.";
		$er_MOT_HP = ".";
	}
	if ($MOT_KGFM == ""){
		$c_erros .= ",KGFM não informado.";
		$er_MOT_KGFM = ".";
	}
	if ($MOT_MARCHAS == ""){
		$c_erros .= ",Marchas não informada.";
		$er_MOT_MARCHAS = ".";
	}
	if ($MOT_PESO == ""){
		$c_erros .= ",Peso não informado.";
		$er_MOT_PESO = ".";
	}
	if ($MOT_TANQUE == ""){
		$c_erros .= ",Tanque não informado.";
		$er_MOT_TANQUE = ".";
	}
	if ($MOT_EIXODIS == ""){
		$c_erros .= ",Distância Entre-eixos não informado.";
		$er_MOT_EIXODIS = ".";
	}
	if ($MOT_PNEUD == ""){
		$c_erros .= ",Pneu Dianteiro não informado.";
		$er_MOT_PNEUD = ".";
	}
	if ($MOT_PNEUT == ""){
		$c_erros .= ",Pneu Traseiro não informado.";
		$er_MOT_PNEUT = ".";
	}

	/* ############################### Verifica se Existem Imagens a enviar ############################### */
	$sql_busca = "
	SELECT * FROM mp_moto_img
	 WHERE MIM_MMO_COD = '$MOT_MMO_COD'
	   AND MIM_MOT_ANO = '$MOT_ANOFAB' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$lRet = false;
	for($i = 0 ; $i < 6 ; $i++ ){
		if( $_FILES ) // Verificando se existe o envio de arquivos.
			if( $_FILES['MIM_PATH'.$i]['name'] <> "" && !$lRet ) // Verifica se o campo não está vazio.
				$lRet = true;
	}

	if ($num_busca == 0 && !$lRet)
		$c_erros .= ", Obrigatório enviar ao menos uma Imagem na aba de Imagens.";
	/* ############################### FIM ############################### */
	
	/* ############################### Envia IMAGENS ############################### */
	if ($c_erros == ""){

		for($i = 0 ; $i < 6 ; $i++ ){
			if( $_FILES ) { // Verificando se existe o envio de arquivos.
				if( $_FILES['MIM_PATH'.$i]['name'] <> "" ) { // Verifica se o campo não está vazio.

					// NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO
					if(!is_dir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod))
						 mkdir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod);
					if(!is_dir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/"))
						 mkdir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/");
					if(!is_dir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB ."/"))
						 mkdir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB ."/");
					// NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO

					$dir 	 	= "/home/quali197/public_html/imgMotoPod/Moto/";
					$dir_cat_cd	= $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB ."/";
					$tmpName 	= $_FILES['MIM_PATH'.$i]['tmp_name'];	// Recebe o arquivo temporário.
					$name		= $_FILES['MIM_PATH'.$i]['name']; 		// Recebe o nome do arquivo.

					if ($name != ""){
						if(!file_exists($dir . $dir_cat_cd . $name)){
							if( !move_uploaded_file( $tmpName, $dir . $dir_cat_cd . $name ) ) // move_uploaded_file irá realizar o envio do arquivo
								$c_erros = $c_erros . ",ERRO no Envio da Imagem";
						}/*else // comentado...pois se já existe, seria o mesmo que somente atualizar
							$c_erros = $c_erros . ",Imagem já existe";*/

						if ($c_erros == ""){
							// ####### IMAGEM POST #######
							// VALOR CAMPO PAI -- NOME CAMPO PAI -- NOME CAMPO da TABELA -- NOME TABELA
							$cod_son = proxCod2($MOT_MMO_COD, "MIM_MMO_COD", $MOT_ANOFAB, "MIM_MOT_ANO", "MIM_COD", "mp_moto_img");

							$sql_busca = "
							SELECT * FROM mp_moto_img 
							 WHERE MIM_MMO_COD	= '$MOT_MMO_COD'
							   AND MIM_MOT_ANO	= '$MOT_ANOFAB'
							   AND MIM_COD		= $cod_son ";
							$exe_busca = mysql_query($sql_busca) or die (mysql_error());
							$fet_busca = mysql_fetch_assoc($exe_busca);
							$num_busca = mysql_num_rows($exe_busca);
							if ($num_busca == 0){
								// INICIO - VERIFICA SE E A PRIMEIRA IMAGEM CADASTRADA E COLOCA COMO PRINCIPAL
								$sql2 = "							
								SELECT * FROM mp_moto_img 
								 WHERE MIM_MMO_COD = '$MOT_MMO_COD'
								   AND MIM_MOT_ANO = '$MOT_ANOFAB'
								   AND MIM_IMG_PRI = 'S' ";
								$exe2 = mysql_query($sql2) or die (mysql_error());
								$fet2 = mysql_fetch_assoc($exe2);
								$num2 = mysql_num_rows($exe2);

								if ($num2 == 0)
									$sql_exe = "INSERT INTO mp_moto_img (MIM_MMO_COD,MIM_MOT_ANO,MIM_COD,MIM_PATH,MIM_IMG_PRI)
																 VALUES ('$MOT_MMO_COD', '$MOT_ANOFAB', $cod_son, '". $name ."','S')";
								else
									$sql_exe = "INSERT INTO mp_moto_img (MIM_MMO_COD,MIM_MOT_ANO,MIM_COD,MIM_PATH)
																 VALUES ('$MOT_MMO_COD', '$MOT_ANOFAB', $cod_son, '". $name ."')";

								$exe_ret = mysql_query($sql_exe) or die (mysql_error());
								// INICIO - VERIFICA SE E A PRIMEIRA IMAGEM CADASTRADA E COLOCA COMO PRINCIPAL
							}else{
								$sql_busca = "
								UPDATE mp_moto_img SET
								MIM_PATH = '". $name ."'
								 WHERE MIM_MMO_COD = '$MOT_MMO_COD'
								   AND MIM_MOT_ANO = '$MOT_ANOFAB'
								   AND MIM_COD     = $cod_son ";
								$exe_ret = mysql_query($sql_exe) or die (mysql_error());
							}
							// ####### IMAGEM POST #######
						}
					}
				}
			}
		}
	}
	/* ############################### Envia IMAGENS ############################### */	

	
	/* ##################### INSERCAO DADOS ##################### */
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		$MOT_DTCAD = date("Y-m-d");

		$sql_busca = "
		SELECT MOT_MMO_COD FROM mp_motos 
		 WHERE MOT_MMO_COD 	= '$MOT_MMO_COD'
		   AND MOT_ANOFAB	= '$MOT_ANOFAB' ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca == 0){
			$sql_busca = "INSERT INTO mp_motos (MOT_MMO_COD, MOT_ANOFAB, MOT_DTCAD, MOT_CATEG, MOT_CC, MOT_CIL, MOT_TPMOTOR, MOT_HP, MOT_KGFM, MOT_MARCHAS, MOT_LUB, MOT_OLEO, MOT_DIA_CUR, MOT_TXCOMPR, MOT_ALIMENT, MOT_EMBREAG, MOT_COMB, MOT_PARTIDA, MOT_TRANSSEC, MOT_TANQUE, MOT_TPCHASSI, MOT_EIXODIS, MOT_PNEUD, MOT_PNEUT, MOT_PESO, MOT_SUSPDIA, MOT_SUSPTRA, MOT_COMPRIM, MOT_LARG, MOT_ALTURA, MOT_ALTASS, MOT_DISTSOLO, MOT_SISIGNI, MOT_FREIOD, MOT_FREIOT, MOT_LAMPDIA, MOT_LAMPTRA, MOT_LAMPEJ, MOT_PISCAAL, MOT_SISELE, MOT_BATERIA, MOT_OBS)
										VALUES ('$MOT_MMO_COD','$MOT_ANOFAB','$MOT_DTCAD','$MOT_CATEG','$MOT_CC','$MOT_CIL','$MOT_TPMOTOR','$MOT_HP','$MOT_KGFM','$MOT_MARCHAS','$MOT_LUB','$MOT_OLEO','$MOT_DIA_CUR','$MOT_TXCOMPR','$MOT_ALIMENT','$MOT_EMBREAG','$MOT_COMB', '$MOT_PARTIDA', '$MOT_TRANSSEC', '$MOT_TANQUE','$MOT_TPCHASSI','$MOT_EIXODIS','$MOT_PNEUD','$MOT_PNEUT','$MOT_PESO','$MOT_SUSPDIA','$MOT_SUSPTRA','$MOT_COMPRIM','$MOT_LARG','$MOT_ALTURA','$MOT_ALTASS','$MOT_DISTSOLO','$MOT_SISIGNI','$MOT_FREIOD','$MOT_FREIOT','$MOT_LAMPDIA','$MOT_LAMPTRA','$MOT_LAMPEJ','$MOT_PISCAAL','$MOT_SISELE','$MOT_BATERIA','$MOT_OBS')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			zeraCampos();
		}else{
			$sql_busca = "
			UPDATE mp_motos SET
			MOT_DTCAD 	= '$MOT_DTCAD',
			MOT_CATEG   = '$MOT_CATEG',
			MOT_CC      = '$MOT_CC',
			MOT_CIL     = '$MOT_CIL',
			MOT_TPMOTOR	= '$MOT_TPMOTOR',
			MOT_HP		= '$MOT_HP',
			MOT_KGFM	= '$MOT_KGFM',
			MOT_MARCHAS	= '$MOT_MARCHAS',
			MOT_LUB		= '$MOT_LUB',
			MOT_OLEO	= '$MOT_OLEO',
			MOT_DIA_CUR = '$MOT_DIA_CUR',
			MOT_TXCOMPR = '$MOT_TXCOMPR',
			MOT_ALIMENT = '$MOT_ALIMENT',
			MOT_EMBREAG = '$MOT_EMBREAG',
			MOT_COMB    = '$MOT_COMB',
			MOT_PARTIDA	= '$MOT_PARTIDA',
			MOT_TRANSSEC= '$MOT_TRANSSEC',
			MOT_TANQUE  = '$MOT_TANQUE',
			MOT_TPCHASSI= '$MOT_TPCHASSI',
			MOT_EIXODIS = '$MOT_EIXODIS',
			MOT_PNEUD   = '$MOT_PNEUD',
			MOT_PNEUT   = '$MOT_PNEUT',
			MOT_PESO    = '$MOT_PESO',
			MOT_SUSPDIA = '$MOT_SUSPDIA',
			MOT_SUSPTRA = '$MOT_SUSPTRA',
			MOT_COMPRIM = '$MOT_COMPRIM',
			MOT_LARG    = '$MOT_LARG',
			MOT_ALTURA  = '$MOT_ALTURA',
			MOT_ALTASS  = '$MOT_ALTASS',
			MOT_DISTSOLO= '$MOT_DISTSOLO',
			MOT_SISIGNI = '$MOT_SISIGNI',
			MOT_FREIOD  = '$MOT_FREIOD',
			MOT_FREIOT  = '$MOT_FREIOT',
			MOT_LAMPDIA = '$MOT_LAMPDIA',
			MOT_LAMPTRA = '$MOT_LAMPTRA',
			MOT_LAMPEJ  = '$MOT_LAMPEJ',
			MOT_PISCAAL = '$MOT_PISCAAL',
			MOT_SISELE  = '$MOT_SISELE',
			MOT_BATERIA = '$MOT_BATERIA',
			MOT_OBS 	= '$MOT_OBS'
			
			WHERE MOT_MMO_COD = '$MOT_MMO_COD'
			  AND MOT_ANOFAB  = '$MOT_ANOFAB' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}

		// VERIFICA IMAGENS PRINCIPAIS
		$tot_img = 0;
		if (isset($_POST['total_img'])) $tot_img = $_POST['total_img'];

		for ($i = 0; $i < $tot_img; $i++){
			$cod_img		= "";
			$chkPrinComp 	= "";
			$chkPrin 		= "";

			if (isset($_POST['MIM_COD'.$i]))
				$cod_img = $_POST['MIM_COD'.$i];
			
			if (isset($_POST['chkPrinComp'.$i])){
				if ($_POST['chkPrinComp'.$i] == "S")
					$chkPrinComp = "S";
				else
					$chkPrinComp = "";
			}

			if (isset($_POST['chkPrin'.$i]))
				$chkPrin = "S";

			if ($chkPrin != $chkPrinComp){
				$sql_busca = "
				UPDATE mp_moto_img SET
				MIM_IMG_PRI	= '$chkPrin'
				WHERE MIM_MMO_COD = '$MOT_MMO_COD'
				  AND MIM_MOT_ANO = '$MOT_ANOFAB'
				  AND MIM_COD 	  = $cod_img ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}
	}
	/* ##################### INSERCAO ##################### */
}


/* ##################### CONSULTA ##################### */
if ( ($MOT_MMO_COD != "" || ($SelEdtMtCod != "" && $SelEdtMtAno != "")) && ($c_erros == "") ){

	if ($MOT_MMO_COD == "" && $MOT_ANOFAB == "" && $SelEdtMtCod != "" && $SelEdtMtAno != ""){
		$MOT_MMO_COD = $SelEdtMtCod;
		$MOT_ANOFAB	 = $SelEdtMtAno;
	}

	$sql_busca = "
	SELECT MOT.*, MMO.*
	  FROM mp_motos MOT
	  LEFT JOIN mp_marca_mod MMO ON MMO.MMO_COD = MOT.MOT_MMO_COD
	 WHERE MOT.MOT_MMO_COD = '$MOT_MMO_COD'
	   AND MOT.MOT_ANOFAB  = '$MOT_ANOFAB' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0){

		$hdMMO_COD 		= $MOT_MMO_COD;
		$hdMMO_MARCA 	= $fet_busca['MMO_MAR_COD'];
		$hdMMO_MODELO 	= mb_strtoupper( retSEspOut( $fet_busca['MMO_MODELO'] ) );
		$_SESSION['sesMMO_COD']		= $hdMMO_COD;
		$_SESSION['sesMMO_MARCA']  	= $hdMMO_MARCA;
		$_SESSION['sesMMO_MODELO']	= $hdMMO_MODELO;
		$marca_cod		= $hdMMO_MARCA;
		$modelo_lb		= $hdMMO_MODELO;

		$MOT_MMO_COD	= $fet_busca['MOT_MMO_COD'];
		$MOT_ANOFAB		= $fet_busca['MOT_ANOFAB'];
		$MOT_CATEG		= $fet_busca['MOT_CATEG'];
		$MOT_CC         = $fet_busca['MOT_CC'];
		$MOT_CIL        = $fet_busca['MOT_CIL'];
		$MOT_TPMOTOR    = $fet_busca['MOT_TPMOTOR'];
		$MOT_HP         = $fet_busca['MOT_HP'];
		$MOT_KGFM       = $fet_busca['MOT_KGFM'];
		$MOT_MARCHAS    = $fet_busca['MOT_MARCHAS'];
		$MOT_LUB		= $fet_busca['MOT_LUB'];
		$MOT_OLEO		= $fet_busca['MOT_OLEO'];
		$MOT_DIA_CUR  	= $fet_busca['MOT_DIA_CUR'];
		$MOT_TXCOMPR	= $fet_busca['MOT_TXCOMPR'];
		$MOT_ALIMENT	= $fet_busca['MOT_ALIMENT'];
		$MOT_EMBREAG    = $fet_busca['MOT_EMBREAG'];
		$MOT_COMB       = $fet_busca['MOT_COMB'];
		$MOT_PARTIDA	= $fet_busca['MOT_PARTIDA'];
		$MOT_TRANSSEC	= $fet_busca['MOT_TRANSSEC'];
		$MOT_TANQUE     = $fet_busca['MOT_TANQUE'];
		$MOT_TPCHASSI   = $fet_busca['MOT_TPCHASSI'];
		$MOT_EIXODIS	= $fet_busca['MOT_EIXODIS'];
		$MOT_PNEUD    	= $fet_busca['MOT_PNEUD'];
		$MOT_PNEUT   	= $fet_busca['MOT_PNEUT'];
		$MOT_PESO       = $fet_busca['MOT_PESO'];
		$MOT_SUSPDIA	= $fet_busca['MOT_SUSPDIA'];
		$MOT_SUSPTRA	= $fet_busca['MOT_SUSPTRA'];		
		$MOT_COMPRIM	= $fet_busca['MOT_COMPRIM'];
		$MOT_LARG       = $fet_busca['MOT_LARG'];
		$MOT_ALTURA		= $fet_busca['MOT_ALTURA'];
		$MOT_ALTASS     = $fet_busca['MOT_ALTASS'];
		$MOT_DISTSOLO   = $fet_busca['MOT_DISTSOLO'];
		$MOT_SISIGNI   	= $fet_busca['MOT_SISIGNI'];
		$MOT_FREIOD   	= $fet_busca['MOT_FREIOD'];
		$MOT_FREIOT  	= $fet_busca['MOT_FREIOT'];
		$MOT_LAMPDIA  	= $fet_busca['MOT_LAMPDIA'];
		$MOT_LAMPTRA  	= $fet_busca['MOT_LAMPTRA'];
		$MOT_LAMPEJ   	= $fet_busca['MOT_LAMPEJ'];
		$MOT_PISCAAL  	= $fet_busca['MOT_PISCAAL'];
		$MOT_SISELE   	= $fet_busca['MOT_SISELE'];
		$MOT_BATERIA  	= $fet_busca['MOT_BATERIA'];
		$MOT_OBS  		= $fet_busca['MOT_OBS'];

		$btIncluir = "Alterar Moto";
	}
}else{
	//echo "pasosu;;;; zera....";
	//zeraCampos();
}


/* ##################### DELETA MOTO e TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelMtCod != "" && $SelDelMtAno != ""){

	$MOT_MMO_COD = $SelDelMtCod;
	$MOT_ANOFAB	 = $SelDelMtAno;

	$qr = "DELETE FROM mp_moto_img 
				 WHERE MIM_MMO_COD = '$SelDelMtCod'
				   AND MIM_MOT_ANO = '$SelDelMtAno' ";
	mysql_query($qr);

	$qr = "DELETE FROM mp_motos 
				 WHERE MOT_MMO_COD = '$SelDelMtCod'
				   AND MOT_ANOFAB  = '$SelDelMtAno' ";
	mysql_query($qr);

	$sql_busca = "
	SELECT MMO_MAR_COD, MMO_MODELO
	  FROM mp_marca_mod
	 WHERE MMO_COD = '$SelDelMtCod' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0){
		$marca_cod = $fet_busca['MMO_MAR_COD'];
		$modelo_lb = mb_strtoupper( retSEspOut( $fet_busca['MMO_MODELO'] ) );
	}

	// Apaga Diretorio de Ano do Modelo e seus arquivos 
	if( is_dir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $SelDelMtAno ."/") )
		rmdir_recurse("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $SelDelMtAno);

	zeraCampos();
}


/* ##################### DELETA TODAS IMAGENS do BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelMtImgCod != "" && $SelDelMtImgAno != ""){

	if ($SelDelMtImgPath != ""){
		$qr = "DELETE FROM mp_moto_img 
					 WHERE MIM_MMO_COD = '$SelDelMtImgCod'
					   AND MIM_MOT_ANO = '$MOT_ANOFAB'
					   AND MIM_PATH    = '$SelDelMtImgPath' ";
		// Deleta imagem
		unlink("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB ."/". $SelDelMtImgPath);
	}else{
		$qr = "DELETE FROM mp_moto_img 
					 WHERE MIM_MMO_COD = '$SelDelMtImgCod'
					   AND MIM_MOT_ANO = '$MOT_ANOFAB' ";
		if( is_dir("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB) )
			rmdir_recurse("/home/quali197/public_html/imgMotoPod/Moto/". $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB);
	}

	mysql_query($qr);

	$btIncluir = "Alterar Moto";
}


/* ########################################## FUNCOES ########################################## */
function rmdir_recurse($path){
    $path = rtrim($path, '/').'/';
    $handle = opendir($path);
    while(false !== ($file = readdir($handle))) {
        if($file != '.' and $file != '..' ) {
            $fullpath = $path.$file;
            if(is_dir($fullpath)) rmdir_recurse($fullpath); else unlink($fullpath);
        }
    }
    closedir($handle);
    rmdir($path);
}

/* ########################################## FUNCOES ########################################## */

if ($SelDelMtCod != "" && $c_erros == ""){
	echo msgAviso("Moto de Código $MOT_MMO_COD e Ano $MOT_ANOFAB Eliminada com Sucesso!","cadmoto");
}


if($SelEdtMtCod != "" || $btIncluir == "Alterar Moto"){
	$lbButton = "Alterar Moto";
	$lNew = false;
	$_SESSION['seslNew'] = false;
}else{
	$lbButton = "Incluir Moto";
	$lNew = true;
	$_SESSION['seslNew'] = true;
}

?>

<!-- <div id="titulo">Motos</div> -->

<form id="formCadMoto" name="formCadMoto" action="cadmoto" method="post" accept-charset="utf-8" enctype="multipart/form-data">

	<input type="hidden" id="hdMMO_COD"		name="hdMMO_COD"	value="<?php echo $_SESSION['sesMMO_COD']; ?>">
	<input type="hidden" id="hdMMO_MARCA"	name="hdMMO_MARCA" 	value="<?php echo $_SESSION['sesMMO_MARCA']; ?>">
	<input type="hidden" id="hdMMO_MODELO"	name="hdMMO_MODELO" value="<?php echo $_SESSION['sesMMO_MODELO']; ?>">
	<input type="hidden" id="hdMOT_ANOFAB"	name="hdMOT_ANOFAB"	value="<?php if($MOT_ANOFAB != "") echo $MOT_ANOFAB; ?>">

	<div class="demo">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Moto</a></li>
				<li><a href="#tabs-2">Imagens</a></li>
				<li><a href="#tabs-3">Observações</a></li>
			</ul>
			<div id="tabs-1">
				<table border="0" cellspacing="0" cellpadding="0" width="610px" align="center">
					<tr>
						<td colspan="2">
							<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" height="25px">
								<tr align="center" height="25px">
									<td><font size="4em;"><b><u>Cadastro Marca</font></u></b></td>
									<td><font size="4em;"><b><u>Cadastro Modelo</font></u></b></td>
								</tr>
								<tr align="center">
									<td>
										<a href="javascript:janelaSecundaria('mod/cadmotomarca.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/delmotomarca.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
									<td>
										<a href="javascript:janelaSecundaria('mod/cadmotomod.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/delmotomarmod.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
								</tr>
							</table></br>
						</td>
					</tr>
					<tr>
						<td colspan="2" valign="middle">
							<iframe name="iframeMarMod" id="iframeMarMod" src="./ajax_marca_mod.php" frameborder="0" scrolling="no" align="center" width="85%" height="68px">
								<p>Sem suporte a iFrames.</p>
							</iframe>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Ano</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_ANOFAB != "") echo "field_error"; ?>" size="4" maxlength="4" name="MOT_ANOFAB" value="<?php if($MOT_ANOFAB != "") echo $MOT_ANOFAB; ?>" <?php if (!$lNew) echo "readonly disabled"; ?>></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Categoria</label></b></td>
						<td align="left">
							<select name="MOT_CATEG" class="<?php if($er_MOT_CATEG != "") echo "field_error"; ?>">
								<option value=""  <?php if ($MOT_CATEG == "")  echo "selected"; else echo ""; ?>>...Escolha a Categoria</option>
								<option value="U" <?php if ($MOT_CATEG == "U") echo "selected"; else echo ""; ?>>Urbana</option>
								<option value="C" <?php if ($MOT_CATEG == "C") echo "selected"; else echo ""; ?>>Custom</option>
								<option value="L" <?php if ($MOT_CATEG == "L") echo "selected"; else echo ""; ?>>Clássica</option>
								<option value="N" <?php if ($MOT_CATEG == "N") echo "selected"; else echo ""; ?>>Naked</option>
								<option value="R" <?php if ($MOT_CATEG == "R") echo "selected"; else echo ""; ?>>Scooter</option>
								<option value="P" <?php if ($MOT_CATEG == "P") echo "selected"; else echo ""; ?>>Sport</option>
								<option value="S" <?php if ($MOT_CATEG == "S") echo "selected"; else echo ""; ?>>Supersport</option>
								<option value="A" <?php if ($MOT_CATEG == "A") echo "selected"; else echo ""; ?>>Aventureira</option>
								<option value="O" <?php if ($MOT_CATEG == "O") echo "selected"; else echo ""; ?>>Off-Road</option>
								<option value="V" <?php if ($MOT_CATEG == "V") echo "selected"; else echo ""; ?>>Vintage</option>
							</select>
						</td>
					</tr>
					
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td colspan="2" bgcolor="#CBCBCB" width="100%" height="20px" style="padding:10px 10px 10px 10px;"><center><label style="font-size:18px;"><strong>- MOTOR -</strong></label></center></td>
				</tr>
				
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Cilindros</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_CIL != "")echo "field_error"; else echo "input"; ?>" size="10" maxlength="10" name="MOT_CIL" value="<?php if($MOT_CIL != ""){ echo $MOT_CIL; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Cilindrada</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_CC != "") echo "field_error"; ?>" size="10" maxlength="10" name="MOT_CC" value="<?php if($MOT_CC != ""){ echo $MOT_CC; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Diâmetro x Curso Pistão</label></b></td>
						<td align="left"><input type="text" size="20" maxlength="20" name="MOT_DIA_CUR" value="<?php if($MOT_DIA_CUR != ""){ echo $MOT_DIA_CUR; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Taxa Compressão</label></b></td>
						<td align="left"><input type="text" size="20" maxlength="20" name="MOT_TXCOMPR" value="<?php if($MOT_TXCOMPR != ""){ echo $MOT_TXCOMPR; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Tipo Motor</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_TPMOTOR != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="150" name="MOT_TPMOTOR" value="<?php if($MOT_TPMOTOR != ""){ echo $MOT_TPMOTOR; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">CV / HP</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_HP != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="40" name="MOT_HP" value="<?php if($MOT_HP != ""){ echo $MOT_HP; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">KGFM</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_KGFM != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="40" name="MOT_KGFM" value="<?php if($MOT_KGFM != ""){ echo $MOT_KGFM; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Embreagem</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_EMBREAG" value="<?php if($MOT_EMBREAG != ""){ echo $MOT_EMBREAG; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Marchas</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_MARCHAS != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="40" name="MOT_MARCHAS" value="<?php if($MOT_MARCHAS != ""){ echo $MOT_MARCHAS; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Lubrificação</label></b></td>
						<td align="left">
							<select name="MOT_LUB">
								<option value="U" <?php if ($MOT_LUB == "U" || $MOT_LUB == "") echo "selected"; else echo ""; ?>>Cárter Úmido</option>
								<option value="S" <?php if ($MOT_LUB == "S") echo "selected"; else echo ""; ?>>Cárter Seco</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Óleo Motor</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="90" name="MOT_OLEO" value="<?php if($MOT_OLEO != "") echo $MOT_OLEO; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Combustível</label></b></td>
						<td align="left">
							<select name="MOT_COMB">
								<option value="G" <?php if ($MOT_COMB == "G" || $MOT_COMB == "") echo "selected"; else echo ""; ?>>Gasolina</option>
								<option value="A" <?php if ($MOT_COMB == "A") echo "selected"; else echo ""; ?>>Etanol</option>
								<option value="F" <?php if ($MOT_COMB == "F") echo "selected"; else echo ""; ?>>Flex</option>
								<option value="P" <?php if ($MOT_COMB == "P") echo "selected"; else echo ""; ?>>Pódium somente</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Alimentação</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_ALIMENT" value="<?php if($MOT_ALIMENT != ""){ echo $MOT_ALIMENT; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Sistema de Ignição</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_SISIGNI" value="<?php if($MOT_SISIGNI != "") echo $MOT_SISIGNI; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Sistema de Partida</label></b></td>
						<td align="left">
							<select name="MOT_PARTIDA">
								<option value="E" <?php if ($MOT_PARTIDA == "E" || $MOT_PARTIDA == "") echo "selected"; else echo ""; ?>>Elétrica</option>
								<option value="P" <?php if ($MOT_PARTIDA == "P") echo "selected"; else echo ""; ?>>Pedal</option>
								<option value="A" <?php if ($MOT_PARTIDA == "A") echo "selected"; else echo ""; ?>>Elétrica/Pedal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Transmissão Secundária</label></b></td>
						<td align="left">
							<select name="MOT_TRANSSEC">
								<option value="C" <?php if ($MOT_TRANSSEC == "C" || $MOT_TRANSSEC == "") echo "selected"; else echo ""; ?>>Corrente</option>
								<option value="A" <?php if ($MOT_TRANSSEC == "A") echo "selected"; else echo ""; ?>>Cardã</option>
								<option value="O" <?php if ($MOT_TRANSSEC == "O") echo "selected"; else echo ""; ?>>Correia Dentada</option>
							</select>
						</td>
					</tr>

				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td colspan="2" bgcolor="#CBCBCB" width="100%" height="20px" style="padding:10px 10px 10px 10px;"><center><label style="font-size:18px;"><strong>- CHASSI e SUSPENSÃO -</strong></label></center></td>
				</tr>

					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Tipo Chassi</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_TPCHASSI" value="<?php if($MOT_TPCHASSI != ""){ echo $MOT_TPCHASSI; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Suspensão Dianteira</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_SUSPDIA" value="<?php if($MOT_SUSPDIA != ""){ echo $MOT_SUSPDIA; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Suspensão Traseira</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_SUSPTRA" value="<?php if($MOT_SUSPTRA != ""){ echo $MOT_SUSPTRA; } ?>"></td>
					</tr>
					
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td colspan="2" bgcolor="#CBCBCB" width="100%" height="20px" style="padding:10px 10px 10px 10px;"><center><label style="font-size:18px;"><strong>- DIMENSÕES -</strong></label></center></td>
				</tr>

					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Entreeixos</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_EIXODIS != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="40" name="MOT_EIXODIS" value="<?php if($MOT_EIXODIS != ""){ echo $MOT_EIXODIS; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Comprimento</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_COMPRIM" value="<?php if($MOT_COMPRIM != "") echo $MOT_COMPRIM; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Largura</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_LARG" value="<?php if($MOT_LARG != "") echo $MOT_LARG; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Altura</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_ALTURA" value="<?php if($MOT_ALTURA != "") echo $MOT_ALTURA; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Altura do Assento</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_ALTASS" value="<?php if($MOT_ALTASS != "") echo $MOT_ALTASS; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Distância Solo</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_DISTSOLO" value="<?php if($MOT_DISTSOLO != "") echo $MOT_DISTSOLO; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Peso</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_PESO != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="40" name="MOT_PESO" value="<?php if($MOT_PESO != "") echo $MOT_PESO; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Tanque (Lt)</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_TANQUE != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="40" name="MOT_TANQUE" value="<?php if($MOT_TANQUE != "") echo $MOT_TANQUE; ?>"></td>
					</tr>
					
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td colspan="2" bgcolor="#CBCBCB" width="100%" height="20px" style="padding:10px 10px 10px 10px;"><center><label style="font-size:18px;"><strong>- FREIOS e PNEUS -</strong></label></center></td>
				</tr>

					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Freio Dianteiro</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_FREIOD" value="<?php if($MOT_FREIOD != "") echo $MOT_FREIOD; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Freio Traseiro</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="150" name="MOT_FREIOT" value="<?php if($MOT_FREIOT != "") echo $MOT_FREIOT; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Pneu Dianteiro</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_PNEUD != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="150" name="MOT_PNEUD" value="<?php if($MOT_PNEUD != "") echo $MOT_PNEUD; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Pneu Traseiro</label></b></td>
						<td align="left"><input type="text" class="<?php if($er_MOT_PNEUT != "")echo "field_error"; else echo "input"; ?>" size="40" maxlength="150" name="MOT_PNEUT" value="<?php if($MOT_PNEUT != "") echo $MOT_PNEUT; ?>"></td>
					</tr>
					
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td colspan="2" bgcolor="#CBCBCB" width="100%" height="20px" style="padding:10px 10px 10px 10px;"><center><label style="font-size:18px;"><strong>- ELÉTRICA -</strong></label></center></td>
				</tr>

					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Lâmpada Dianteira</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_LAMPDIA" value="<?php if($MOT_LAMPDIA != "") echo $MOT_LAMPDIA; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Lâmpada Traseira</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_LAMPTRA" value="<?php if($MOT_LAMPTRA != "") echo $MOT_LAMPTRA; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Lampejador</label></b></td>
						<td align="left">
							<select name="MOT_LAMPEJ">
								<option value="S" <?php if ($MOT_LAMPEJ == "S" || $MOT_LAMPEJ == "") echo "selected"; else echo ""; ?>>Sim</option>
								<option value="N" <?php if ($MOT_LAMPEJ == "N") echo "selected"; else echo ""; ?>>Não</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Pisca Alerta</label></b></td>
						<td align="left">
							<select name="MOT_PISCAAL">
								<option value=""  <?php if ($MOT_PISCAAL == "") echo "selected"; else echo ""; ?>>...Escolha</option>
								<option value="S" <?php if ($MOT_PISCAAL == "S") echo "selected"; else echo ""; ?>>Sim</option>
								<option value="N" <?php if ($MOT_PISCAAL == "N") echo "selected"; else echo ""; ?>>Não</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Sistema Elétrico</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_SISELE" value="<?php if($MOT_SISELE != "") echo $MOT_SISELE; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Bateria</label></b></td>
						<td align="left"><input type="text" size="40" maxlength="40" name="MOT_BATERIA" value="<?php if($MOT_BATERIA != "") echo $MOT_BATERIA; ?>"></td>
					</tr>
				</table>
			</div>

			<!-- ################## IMAGENS ################## -->
			<div id="tabs-2">
				<table id="dataTable" border="0" cellspacing="0" cellpadding="0" align="center">
				<?php
				$path_img = "";
				if ($MOT_MMO_COD != ""){
					/* Busca IMAGENS */
					$qr = "
					SELECT * FROM mp_moto_img
					 WHERE MIM_MMO_COD = '$MOT_MMO_COD'
					   AND MIM_MOT_ANO = '$MOT_ANOFAB'
					 ORDER BY MIM_IMG_PRI DESC";
					$sql = mysql_query($qr);
					$total_img = mysql_num_rows($sql);
					?>
					<input type="hidden" name="total_img" value="<?php echo $total_img; ?>">
					<?php
					$i = 0;
					while($r = mysql_fetch_array($sql)){
						$path_img = $r['MIM_PATH'];
						
						if ($r['MIM_IMG_PRI'] != "") 
							$img_pri = "checked";
						else
							$img_pri = "";
						?>
						<tr>
							<td valign="middle">
								<input type="text" size="42" name="aux_path_img_<?php echo $i; ?>" value="<?php echo $path_img; ?>" readonly>
							</td>
							<td align="left">
								<img src='<?php echo "http://images.motopod.com.br/Moto/". $marca_cod ."/". $modelo_lb ."/". $MOT_ANOFAB ."/". $path_img; ?>' width='80px' height='50px'>
							</td>
							<td align="center" width="120px">
								<input type="hidden" 	name="MIM_COD<?php echo $i; ?>" 	value="<?php echo $r['MIM_COD']; ?>">
								<input type="hidden" 	name="chkPrinComp<?php echo $i; ?>" value="<?php echo $r['MIM_IMG_PRI']; ?>" />
								<input type="checkbox" 	name="chkPrin<?php echo $i; ?>"   	value="<?php echo $r['MIM_IMG_PRI']; ?>" <?php echo $img_pri; ?> />Principal
							</td>
							<td align="right" width="50px">
								<a href='javascript:void(0);' onClick="delImages('<?php echo $MOT_MMO_COD; ?>','<?php echo $MOT_ANOFAB; ?>','<?php echo $path_img; ?>')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a>
							</td>
						</tr>
						<tr><td height="30px" colspan="3"><hr color="red"></hr></td></tr>
				<?php
						$i += 1;
					}
				}
				?>
				</table>
				<br>
				<hr>&nbsp;</hr>
				<br>
				<table id="dataTable" border="0" cellspacing="0" cellpadding="0" align="center">
				<?php for($i = 0 ; $i < 6 ; $i++ ){ ?>
					<tr>
						<td>
							<input type="file" name="MIM_PATH<?php echo $i; ?>" accept="images/*"></br>
						</td>
					</tr>
					<tr><td height="30px" colspan="3"><hr color="red"></hr></td></tr>
				<?php }	
				?>
				</table>

				<?php
				if ($path_img != ""){
				?>
				</br>

				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td align='center' width="30px"><a href='javascript:void(0);' onClick="delImages('<?php echo $MOT_MMO_COD; ?>','<?php echo $MOT_ANOFAB; ?>','')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a></td>
						<td align='center' valign="middle"><a href='javascript:void(0);' onClick="delImages('<?php echo $MOT_MMO_COD; ?>','<?php echo $MOT_ANOFAB; ?>','')">Deletar Todas Imagens</a></td>
					</tr>
				</table>

				</br>
				<?php
				}
				?>
			</div>			
			
			<!-- ################## OBSERVACAO ################## -->
			<div id="tabs-3">
				<table id="dataTable" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td><b><label style="margin-right:5px;">Observações</label></b></td>
					</tr>
					<tr>
						<td align="left">
							<textarea name="MOT_OBS" rows="20" cols="90"><?php if($MOT_OBS != "") echo $MOT_OBS; ?></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<center>
		<input type="submit" class="btsubmit" name="btIncluir" 	value="<?php echo $lbButton; ?>" onClick="gravaCodMarMod()">
		<?php
		if ($lbButton == "Alterar Moto" && $_SESSION['sesMMO_COD'] != "" && $_SESSION['sesMMO_MARCA'] != "" && $_SESSION['sesMMO_MODELO'] != "" && $MOT_ANOFAB != "")
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" class="btsubmit" name="btCopia" 	value="Copiar" onClick="copyReg()">';
		?>
	</center>
	</br>
	
	<?php
	// altura dinamica de acordo com o numero de registros
	$sql_busca = "SELECT COUNT(MOT_MMO_COD) AS TOTAL FROM mp_motos";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);

	$alt_grid = 0;
	$alt_grid = $fet_busca['TOTAL'] * 25;
	$alt_grid += 80;
	?>
	<!-- ######################################## GRID ######################################## -->
	<div ><!-- style="border-bottom:1px solid #cccccc" -->
	<iframe src="mod/gridmoto.php" frameborder="0" scrolling="yes" align="left" width="100%" height="<?php echo $alt_grid; ?>">
		<p>Your browser does not support iframes.</p>
	</iframe>
	</div>

	<div style="margin-bottom:30px">&nbsp;</div>

	<input type="hidden" name="SelEdtMtCod"   	value="">
	<input type="hidden" name="SelEdtMtAno"   	value="">
	<input type="hidden" name="SelDelMtCod"		value="">
	<input type="hidden" name="SelDelMtAno"		value="">
	<input type="hidden" name="SelDelMtImgCod" 	value="">
	<input type="hidden" name="SelDelMtImgAno" 	value="">
	<input type="hidden" name="SelDelMtImgPath"	value="">

</form>
</html>