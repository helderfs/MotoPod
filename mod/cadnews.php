<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
	<script language="javascript" src="script/x_mascara.js"></script>

	<link rel="stylesheet" href="css/jquery.ui.all.css">
	<link type="text/css" rel="stylesheet" href="css/style.css">


<!-- JQuery -->
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>	
<!-- JQuery -->

<!-- JQuery Text Editor -->
<link type="text/css" rel="stylesheet" href="css/jquery-te-1.4.0.css">
<script type="text/javascript" src="script/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<!-- JQuery Text Editor -->

<!-- JQuery Tabs -->
<script src="script/jquery.cookie.js"></script>
<script src="script/jquery.ui.core.js"></script>
<script src="script/jquery.ui.widget.js"></script>
<script src="script/jquery.ui.tabs.js"></script>
<!-- JQuery Tabs -->

	
	<!-- JQuery Text Editor 
	<link type="text/css" rel="stylesheet" href="css/jquery-te-1.4.0.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>	
	<script type="text/javascript" src="script/jquery-te-1.4.0.min.js" charset="utf-8"></script>
	 JQuery Text Editor 

	----------

	JQuery Tabs
	<script src="script/jquery-1.5.1.js"></script>
	<script src="script/jquery.cookie.js"></script>
	<script src="script/jquery.ui.core.js"></script>
	<script src="script/jquery.ui.widget.js"></script>
	<script src="script/jquery.ui.tabs.js"></script>
	JQuery Tabs
	-->

	<script language="javascript" type="text/javascript">

		$(function() {
			$( "#tabs" ).tabs({
				cookie: {
					// store cookie for a day, without, it would be a session cookie
					expires: 1
				}
			});
		});
		
		function delImages(codPai,pathImag){
			if (pathImag == ""){
				if (codPai == ""){
					alert("Selecione uma Notícia.");
					window.parent.document.formCadNews.SelDelNewsImgPai.value = "codPai";
				}else{
					if ( confirm('Deseja excluir as imagens da Notícia ' + codPai) ){
						window.parent.document.formCadNews.SelDelNewsImgPai.value = codPai;
						window.parent.document.formCadNews.submit();
					}
				}
			}else{
				if ( confirm('Deseja excluir a imagem ' + pathImag) ){
					window.parent.document.formCadNews.SelDelNewsImgPai.value = codPai;
					window.parent.document.formCadNews.SelDelNewsImgFil.value = pathImag;
					window.parent.document.formCadNews.submit();
				}
			}
		}
		
		function delCmt(codPai){
			var nomeCampo = "";
			var vCmt = "";
			var select = false;
			
			for (x =0; x < window.document.formCadNews.elements.length; x++){
				if (window.document.formCadNews.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadNews.elements[x].name;
					if (nomeCampo.substring(0,6) == "chkSel"){

						if (window.document.formCadNews.elements[x].checked){
							vCmt = vCmt + "," + window.document.formCadNews.elements[x].value;
							select = true;
						}
					}
				}
			}

			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Deletar!");
			}else{
				window.document.formCadNews.submit();
			}

			if ( confirm('Deseja excluir o(s) Comentários(s) ' + vCmt ) ){
				window.parent.document.formCadNews.SelDelNewsImgPai.value = codPai;
				window.parent.document.formCadNews.SelDelCmt.value = vCmt;
				window.parent.document.formCadNews.submit();
			}
		}

		function selAllCmt(){
			var nomeCampo = "";

			for (x =0; x < window.document.formCadNews.elements.length; x++){
				if (window.document.formCadNews.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadNews.elements[x].name;

					if (nomeCampo.substring(0,6) == "chkSel"){
						if (window.document.formCadNews.chkGridCmt.checked){
							window.document.formCadNews.elements[x].checked = true;
						}else{
							window.document.formCadNews.elements[x].checked = false;
						}
					}
				}
			}
		}

		function gravaCodMarMod(){
			document.formCadNews.hdMMO_COD.value 	= document.getElementById('iframeMarMod').contentWindow.document.getElementById('hdMMO_COD').value;
			document.formCadNews.hdMMO_MARCA.value	= document.getElementById('iframeMarMod').contentWindow.document.getElementById('hdMMO_MARCA').value;
			document.formCadNews.hdMMO_MODELO.value	= document.getElementById('iframeMarMod').contentWindow.document.getElementById('hdMMO_MODELO').value;
		}

		function delVeiRel(CodPost,Mod,Ano){
			if ( confirm('Deseja excluir o Modelo ' + Mod + ' ?') ){
				window.parent.document.formCadNews.SelDelNewsCod.value = CodPost;
				window.parent.document.formCadNews.SelDelNewsMod.value = Mod;
				window.parent.document.formCadNews.SelDelNewsAno.value = Ano;
				window.parent.document.formCadNews.submit();
			}
		}
		
	</script>
	
	</head>

<?php

include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

function zeraCampos(){
	$hdMMO_COD 		= "";
	$hdMMO_MARCA 	= "";
	$hdMMO_MODELO 	= "";

	$_SESSION['sesMMO_COD']		= "";
	$_SESSION['sesMMO_MARCA']  	= "";
	$_SESSION['sesMMO_MODELO']	= "";
	$_SESSION['seslNew'] 		= true;
	
	$PST_COD		= 0;
	$PST_LINK       = "";
	$PST_CATNEWS    = "";
	$PST_TITULO     = "";
	$PST_DATE       = "";
	$PST_HORA       = "";
	$PST_AUTOR      = "";
	$PST_POSTRES	= "";
	$PST_POST       = "";
	
	$PIM_IMAGE = "";
	
	$btIncluir = "Incluir Notícia";
}
/* ################################################ INICIALIZACAO ################################################ */
$c_erros = "";

zeraCampos();

$PST_COD		= 0;
$PST_LINK       = "";
$PST_CATNEWS    = "";
$PST_TITULO     = "";
$PST_DATE       = "";
$PST_HORA       = "";
$PST_AUTOR      = "";
$PST_POSTRES	= "";
$PST_POST       = "";

$btIncluir 		= "";
$btVeiRel		= "";
$SelDelCmt 		= "";
$SelEdtNews 	= "";
$SelDelNews 	= "";
$SelDelNewsCat 	= "";
$SelDelNewsImgFil = "";
$SelDelNewsImgPai = "";
$SelDelNewsCod	= "";
$SelDelNewsMod	= "";
$SelDelNewsAno	= "";

if (isset($_POST['btIncluir'])) 		$btIncluir		= $_POST['btIncluir'];
if (isset($_POST['btVeiRel'])) 			$btVeiRel		= $_POST['btVeiRel'];
if (isset($_POST['SelDelCmt'])) 		$SelDelCmt 		= $_POST['SelDelCmt'];
if (isset($_POST['SelEdtNews'])) 		$SelEdtNews 	= $_POST['SelEdtNews'];
if (isset($_POST['SelDelNews'])) 		$SelDelNews 	= $_POST['SelDelNews'];
if (isset($_POST['SelDelNewsCat'])) 	$SelDelNewsCat 	= $_POST['SelDelNewsCat'];

// INI - Necessario para posicionar no codigo PAI para quando deletar imagens ou comentários...fica posicionado no registro que usuario estava deletando
if (isset($_POST['SelDelNewsImgPai'])){
	$SelDelNewsImgPai = $_POST['SelDelNewsImgPai'];
	if ($SelDelNewsImgPai != "cod")
		$PST_COD = $SelDelNewsImgPai;
}
if (isset($_POST['SelDelNewsImgFil'])){
	$SelDelNewsImgFil = $_POST['SelDelNewsImgFil'];
	if ($PST_COD == "")
		$PST_COD = $SelDelNewsImgPai;
}
if (isset($_POST['SelDelNewsCod'])){
	$SelDelNewsCod = $_POST['SelDelNewsCod'];
	if ($PST_COD == "")
		$PST_COD = $SelDelNewsCod;
}
// FIM - Necessario para posicionar no codigo PAI para quando deletar imagens ou comentários...fica posicionado no registro que usuario estava deletando

if (isset($_POST['SelDelNewsMod'])) 	$SelDelNewsMod = $_POST['SelDelNewsMod'];
if (isset($_POST['SelDelNewsAno'])) 	$SelDelNewsAno = $_POST['SelDelNewsAno'];


/* ##################### INSERCAO ##################### */
if ($btIncluir != ""){

	$c_erros 	  = "";
	$erro_link 	  = "";
	$erro_catnews = "";
	$erro_titulo  = "";
	$erro_autor   = "";
	$erro_post    = "";

	if (isset($_POST['PST_COD']))		$PST_COD	 	= $_POST['PST_COD'];
	if (isset($_POST['PST_LINK']))		$PST_LINK	 	= $_POST['PST_LINK'];
	if (isset($_POST['PST_CATNEWS']))	$PST_CATNEWS	= $_POST['PST_CATNEWS'];
	if (isset($_POST['PST_TITULO']))	$PST_TITULO 	= $_POST['PST_TITULO'];
	if (isset($_POST['PST_AUTOR']))		$PST_AUTOR  	= $_POST['PST_AUTOR'];
	if (isset($_POST['PST_POSTRES']))	$PST_POSTRES	= $_POST['PST_POSTRES'];
	if (isset($_POST['PST_POST']))		$PST_POST   	= $_POST['PST_POST'];
	
	if ($PST_LINK == ""){
		$c_erros = $c_erros . ",Link não informado.";
		$erro_estilo = "erro";
	}
	if ($PST_CATNEWS == ""){
		$c_erros = $c_erros . ",Categoria da Notícia não informada.";
		$erro_estilo = "erro";
	}
	if ($PST_TITULO == ""){
		$c_erros = $c_erros . ",Título não informado.";
		$erro_estilo = "erro";
	}
	if ($PST_AUTOR == ""){
		$c_erros = $c_erros . ",Autor não informado.";
		$erro_estilo = "erro";
	}
	if ($PST_POST == ""){
		$c_erros = $c_erros . ",Notícia não informada.";
		$erro_estilo = "erro";
	}
	
	$cat_news = "";
	switch ($PST_CATNEWS){
		case "1":
			$cat_news = "Moto";
			break;
		case "2":
			$cat_news = "MotoGP";
			break;
		case "3":
			$cat_news = "F1";
			break;
	}

	/* ############################### Verifica se Existem Imagens a enviar ############################### */
	$sql_busca = "
	SELECT * FROM mp_post_img 
	 WHERE PIM_PST_COD = $PST_COD ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$lRet = false;
	for($i = 0 ; $i < 6 ; $i++ ){
		if( $_FILES ) // Verificando se existe o envio de arquivos.
			if( $_FILES['PIM_IMAGE'.$i]['name'] <> "" && !$lRet ) // Verifica se o campo não está vazio.
				$lRet = true;
	}

	if ($num_busca == 0 && !$lRet)
		$c_erros .= ", Obrigatório enviar ao menos uma Imagem na aba de Imagens.";
	/* ############################### FIM ############################### */
	

	/* ############################### Envia IMAGENS ############################### */	
	$path_imagem = "";
	if ($c_erros == ""){

		// INICIO - Gera novo codigo
		if($btIncluir != "Alterar Notícia"){
			$sql_busca = "SELECT MAX(PST_COD) AS MAX_COD FROM mp_posts";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$PST_COD   = $fet_busca['MAX_COD'] + 1;
		}else{
			if (isset($_POST['PST_COD'])) $PST_COD = $_POST['PST_COD'];
		}
		// FIM - Gera novo codigo

		for($i = 0 ; $i < 6 ; $i++ ){
			if( $_FILES ) { // Verificando se existe o envio de arquivos.
				if( $_FILES['PIM_IMAGE'.$i]['name'] <> "" ) { // Verifica se o campo não está vazio.
					/* NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO */

					if(!is_dir("/home/quali197/public_html/imgMotoPod/News/". $cat_news))
						 mkdir("/home/quali197/public_html/imgMotoPod/News/". $cat_news);
					if(!is_dir("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $PST_COD ."/"))
						 mkdir("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $PST_COD ."/");
					/* NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO */
					
					$dir 	 	= "/home/quali197/public_html/imgMotoPod/News/";
					$dir_cat_cd	= $cat_news ."/". $PST_COD ."/";
					$tmpName 	= $_FILES['PIM_IMAGE'.$i]['tmp_name'];	// Recebe o arquivo temporário.
					$name		= $_FILES['PIM_IMAGE'.$i]['name']; 	// Recebe o nome do arquivo.

					if ($name != ""){
						if(!file_exists($dir . $dir_cat_cd . $name)){
							if( !move_uploaded_file( $tmpName, $dir . $dir_cat_cd . $name ) ) // move_uploaded_file irá realizar o envio do arquivo
								$c_erros = $c_erros . ",ERRO no Envio da Imagem";
						} /*else
							$c_erros = $c_erros . ",Imagem já existe";*/

						if ($c_erros == ""){
							/* ####### IMAGEM POST ####### */
							// VALOR CAMPO PAI -- NOME CAMPO PAI -- NOME CAMPO da TABELA -- NOME TABELA
							$cod_son = proxCod1($PST_COD, "PIM_PST_COD", "PIM_COD", "mp_post_img");
							
							$sql_busca = "
							SELECT * FROM mp_post_img 
							 WHERE PIM_PST_COD = $PST_COD
							   AND PIM_COD 	   = $cod_son ";
							$exe_busca = mysql_query($sql_busca) or die (mysql_error());
							$fet_busca = mysql_fetch_assoc($exe_busca);
							$num_busca = mysql_num_rows($exe_busca);
							if ($num_busca == 0){
								// INICIO - VERIFICA SE E A PRIMEIRA IMAGEM CADASTRADA E COLOCA COMO PRINCIPAL
								$sql2 = "							
								SELECT * FROM mp_post_img 
								 WHERE PIM_PST_COD = $PST_COD
								   AND PIM_IMG_PRI = 'S' ";
								$exe2 = mysql_query($sql2) or die (mysql_error());
								$fet2 = mysql_fetch_assoc($exe2);
								$num2 = mysql_num_rows($exe2);

								if ($num2 == 0)
									$sql_exe = "INSERT INTO mp_post_img (PIM_PST_COD,PIM_COD,PIM_IMAGE,PIM_IMG_PRI)
												VALUES ($PST_COD, $cod_son, '". $name ."','S')";
								else
									$sql_exe = "INSERT INTO mp_post_img (PIM_PST_COD,PIM_COD,PIM_IMAGE)
												VALUES ($PST_COD, $cod_son, '". $name ."')";
								// INICIO - VERIFICA SE E A PRIMEIRA IMAGEM CADASTRADA E COLOCA COMO PRINCIPAL
								
								$exe_ret = mysql_query($sql_exe) or die (mysql_error());
								
							}else{
								$sql_busca = "
								UPDATE mp_post_img SET
								PIM_IMAGE = '". $name ."'
								 WHERE PIM_PST_COD = $PST_COD 
								   AND PIM_COD     = $cod_son ";
								$exe_ret = mysql_query($sql_exe) or die (mysql_error());
							}
							/* ####### IMAGEM POST ####### */
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
		$PST_DATE = date("Y-m-d");
		$PST_HORA = date("H:i");
		$PST_LINK = strtolower( retCarEsp( $PST_LINK ) );
	
		$sql_busca = "SELECT * FROM mp_posts WHERE PST_COD = $PST_COD ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca == 0){
			$sql_busca = "INSERT INTO mp_posts (PST_COD,PST_LINK,PST_CATNEWS,PST_TITULO,PST_DATE,PST_HORA,PST_AUTOR,PST_POSTRES,PST_POST)
						  VALUES ($PST_COD,'$PST_LINK','$PST_CATNEWS','$PST_TITULO','$PST_DATE','$PST_HORA','$PST_AUTOR','$PST_POSTRES','$PST_POST')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			
			zeraCampos();
			
		}else{
			$sql_busca = "
			UPDATE mp_posts SET
			PST_LINK  	= '$PST_LINK',
 			PST_CATNEWS = '$PST_CATNEWS',
			PST_TITULO	= '$PST_TITULO',
 			PST_DATE  	= '$PST_DATE',
			PST_HORA  	= '$PST_HORA',
			PST_AUTOR  	= '$PST_AUTOR',
			PST_POSTRES = '$PST_POSTRES',
			PST_POST  	= '$PST_POST'
			WHERE PST_COD = $PST_COD ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
		

		// INI - INSERE MODELOS RELACIONADOS
		if (isset($_POST['hdMMO_COD'])){
			$hdMMO_COD 				= $_POST['hdMMO_COD'];
			$_SESSION['sesMMO_COD'] = $_POST['hdMMO_COD'];
		}

		if ($PST_COD != "" && $hdMMO_COD != ""){
			$sql_busca = "SELECT * FROM mp_post_moto
						   WHERE MPM_COD 	 = $PST_COD
							 AND MPM_MMO_COD = '$hdMMO_COD' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca == 0){
				$sql_busca = "INSERT INTO mp_post_moto (MPM_COD,MPM_MMO_COD)
												VALUES ($PST_COD,'$hdMMO_COD') ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}
		// FIM - INSERE MODELOS RELACIONADOS
		
		
		// INI - VERIFICA IMAGENS PRINCIPAIS
		$tot_img = 0;
		if (isset($_POST['total_img'])) $tot_img = $_POST['total_img'];

		for ($i = 0; $i < $tot_img; $i++){
			$cod_img		= "";
			$chkPrinComp 	= "";
			$chkPrin 		= "";

			if (isset($_POST['PIM_COD'.$i]))
				$cod_img = $_POST['PIM_COD'.$i];
			
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
				UPDATE mp_post_img SET
				PIM_IMG_PRI	= '$chkPrin'
				WHERE PIM_PST_COD = $PST_COD
				  AND PIM_COD 	  = $cod_img ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}
	}
	/* ##################### INSERCAO ##################### */
}

/* ##################### CONSULTA ##################### */
if (($PST_COD != "" || $SelEdtNews != "") && ($c_erros == "")){

	if ($PST_COD == "" && $SelEdtNews != "")
		$PST_COD = $SelEdtNews;

	$sql_busca = "SELECT * FROM mp_posts WHERE PST_COD = $PST_COD ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0){
		$PST_COD		= $fet_busca['PST_COD'];
		$PST_LINK       = $fet_busca['PST_LINK'];
		$PST_CATNEWS    = $fet_busca['PST_CATNEWS'];
		$PST_TITULO     = $fet_busca['PST_TITULO'];
		$PST_DATE       = $fet_busca['PST_DATE'];
		$PST_HORA       = $fet_busca['PST_HORA'];
		$PST_AUTOR      = $fet_busca['PST_AUTOR'];
		$PST_POSTRES	= $fet_busca['PST_POSTRES'];
		$PST_POST       = $fet_busca['PST_POST'];

		$cat_news = "";
		switch ($PST_CATNEWS){
			case "1":
				$cat_news = "Moto";
				break;
			case "2":
				$cat_news = "MotoGP";
				break;
			case "3":
				$cat_news = "F1";
				break;
		}
	}	
}else{
	zeraCampos();
}
/*
// ***Esta funcionalidade deve ficar abaixo da consulta devido ao campo PST_COD
if ($btVeiRel != ""){

	// CHAVES PRIMARIAS
	if (isset($_POST['hdMMO_COD'])){
		$hdMMO_COD 				= $_POST['hdMMO_COD'];
		$_SESSION['sesMMO_COD'] = $_POST['hdMMO_COD'];
	}
	
echo "PST_COD.... $PST_COD";
echo "hdMMO_COD.. $hdMMO_COD";

	$sql_busca = "SELECT * FROM mp_post_moto
				   WHERE MPM_COD 	 = $PST_COD
				     AND MPM_MMO_COD = '$hdMMO_COD' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca == 0){
		$sql_busca = "INSERT INTO mp_post_moto (MPM_COD,MPM_MMO_COD)
									    VALUES ($PST_COD,'$hdMMO_COD') ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	}

}
*/

/* ##################### DELETA COMENTARIOS ##################### */
if ($SelDelCmt != ""){	
	$arrDados = explode(",", $SelDelCmt);
	
	for ($i = 0; $i <= count($arrDados) - 1; $i++){
		if ($arrDados[$i] != ""){
			$qr = "DELETE FROM mp_post_cmt WHERE PCM_COD = '". $arrDados[$i] ."' ";
			mysql_query($qr);
		}
	}
	
}

/* ##################### DELETA TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelNews != ""){

	$qr = "DELETE FROM mp_post_cmt WHERE PCM_PST_COD = '$SelDelNews' ";
	mysql_query($qr);

	$qr = "DELETE FROM mp_post_img WHERE PIM_PST_COD = '$SelDelNews' ";
	mysql_query($qr);

	$qr = "DELETE FROM mp_posts WHERE PST_COD = '$SelDelNews' ";
	mysql_query($qr);

	$cat_news = "";
	switch ($SelDelNewsCat){
		case "1":
			$cat_news = "Moto";
			break;
		case "2":
			$cat_news = "MotoGP";
			break;
		case "3":
			$cat_news = "F1";
			break;
	}

	if( is_dir("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $SelDelNews) )
		rmdir_recurse("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $SelDelNews);

	zeraCampos();
}

/* ##################### DELETA TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelNewsImgFil != "" || $SelDelNewsImgPai != ""){

	if ($SelDelNewsImgFil != ""){
		$qr = "DELETE FROM mp_post_img WHERE PIM_IMAGE = '$SelDelNewsImgFil' AND PIM_PST_COD = $SelDelNewsImgPai ";
		// Deleta imagem
		unlink("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $PST_COD ."/". $SelDelNewsImgFil);
	}else{
		$qr = "DELETE FROM mp_post_img WHERE PIM_PST_COD = '$SelDelNewsImgPai' ";
		if( is_dir("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $SelDelNewsImgPai) )
			rmdir_recurse("/home/quali197/public_html/imgMotoPod/News/". $cat_news ."/". $SelDelNewsImgPai);
	}

	mysql_query($qr);

	$btIncluir = "Alterar Notícia";
}


/* ##################### DELETA MODELOS de VEICULOS RELACIONADOS ##################### */
if ($SelDelNewsCod != ""){

	$qr = "DELETE 
	         FROM mp_post_moto 
	        WHERE MPM_COD 	  = '$PST_COD'
			  AND MPM_MMO_COD = '$SelDelNewsMod'
			";
	mysql_query($qr);

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

if ($SelDelNews != "" && $c_erros == ""){
	echo msgAviso("Notícia $PST_COD Eliminada com Sucesso!","cadnews");
}

if($SelEdtNews != "" || $btIncluir == "Alterar Notícia"){
	$lbButton = "Alterar Notícia";
	$lNew = false;
}else{
	$lbButton = "Incluir Notícia";
	$lNew = true;
}

?>
<!-- <div id="titulo">Notícias</div> -->

<body>

<form id="formCadNews" name="formCadNews" action="cadnews" method="post" accept-charset="utf-8" enctype="multipart/form-data">

	<input type="hidden" id="hdMMO_COD"		name="hdMMO_COD"	value="<?php echo $_SESSION['sesMMO_COD']; ?>">
	<input type="hidden" id="hdMMO_MARCA"	name="hdMMO_MARCA" 	value="<?php echo $_SESSION['sesMMO_MARCA']; ?>">
	<input type="hidden" id="hdMMO_MODELO"	name="hdMMO_MODELO" value="<?php echo $_SESSION['sesMMO_MODELO']; ?>">

	<input type="hidden" name="PST_COD" value="<?php echo $PST_COD; ?>">

	<div class="demo">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Notícia</a></li>
				<li><a href="#tabs-2">Imagens</a></li>
				<li><a href="#tabs-3">Comentários</a></li>
				<li><a href="#tabs-4">Veículos Relacionados</a></li>
			</ul>
			<div id="tabs-1">
				<table border="0" cellspacing="4" cellpadding="0" width="710px" align="center">
					<tr>
						<!-- ########################### COLUNA 01 ########################### -->
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr align="left" height="35px">
									<td colspan="2" width="170px">
										<font size="22px"><b><?php echo $PST_COD; ?></b></font>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Link</label></b></div></td>
									<td align="left" colspan="2"><div ><input type="text" class="<?php if($erro_link != "")echo "field_error"; else echo "input"; ?>" size="45" maxlength="45" name="PST_LINK" value="<?php if($PST_LINK != ""){ echo $PST_LINK; } ?>"></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Título</label></b></div></td>
									<td align="left" colspan="2"><div ><input type="text" class="<?php if($erro_titulo != "")echo "field_error"; else echo "input"; ?>" size="35" maxlength="45" name="PST_TITULO" value="<?php if($PST_TITULO != ""){ echo $PST_TITULO; } ?>"></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Categoria</label></b></div></td>
									<td align="left">
										<select name="PST_CATNEWS" class="<?php if($erro_catnews != ""){echo "field_error";}else{echo "input_select";} ?>">
											<option value="1" <?php if ($PST_CATNEWS == "1") echo "selected"; else echo ""; ?>>Moto</option>
											<option value="2" <?php if ($PST_CATNEWS == "2") echo "selected"; else echo ""; ?>>MotoGP</option>
											<option value="3" <?php if ($PST_CATNEWS == "3") echo "selected"; else echo ""; ?>>F-1</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Autor</label></b></div></td>
									<td align="left">
										<select name="PST_AUTOR" class="<?php if($erro_autor != ""){echo "field_error";}else{echo "input_select";} ?>">
											<option value="1" <?php if ($PST_AUTOR == "1") echo "selected"; else echo ""; ?>>H.F.S</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Resumo</label></b></div></td>
									<td height="40px" colspan="3" align="left">
										<table border="0 " cellspacing="0" cellpadding="0">
											<tr>
												<td><div><textarea name="PST_POSTRES" rows="4" cols="75"><?php if($PST_POSTRES != ""){ echo $PST_POSTRES; } ?></textarea></div></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Notícia</label></b></div></td>
									<td height="40px" colspan="3" align="left">
										
										<table border="0 " cellspacing="0" cellpadding="0">
											<tr>
												<td>
													<!----------------------------- Toggle jQTE Button ----------------------------->
													<!-- <button class="status">Toggle jQTE</button> -->
													<?php 
													$post_editor = "";
													if($PST_POST != "") $post_editor = $PST_POST; 
													?>
													
													<input type="text" class="jqte-test" name="PST_POST" value='<?php echo $post_editor; ?>'>

													<script>
														$('.jqte-test').jqte();
														
														// settings of status
														var jqteStatus = true;
														$(".status").click(function()
														{
															jqteStatus = jqteStatus ? false : true;
															$('.jqte-test').jqte({"status" : jqteStatus})
														});
													</script>
													<!----------------------------- jQUERY TEXT EDITOR ----------------------------->
												</td>
											</tr>
										</table>

									</td>
								</tr>
								
							</table>
						</td>
					</tr>
				</table>
				
			</div>
			
			<!-- ################## IMAGENS ################## -->
			<div id="tabs-2">
				<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
					<tr><td align='left' width="10px"><font size="22px"><b><?php echo $PST_COD; ?></b></font></td></tr>
				</table>
				<table id="dataTable" border="0" cellspacing="0" cellpadding="0" align="center">
				<?php
				$path_img = "";
				if ($PST_COD != ""){
					/* Busca IMAGENS */
					$qr = "
					SELECT * FROM mp_post_img 
					 WHERE PIM_PST_COD = $PST_COD 
					 ORDER BY PIM_IMG_PRI DESC";
					$sql = mysql_query($qr);
					$total_img = mysql_num_rows($sql);
					?>
					<input type="hidden" name="total_img" value="<?php echo $total_img; ?>">
					<?php
					$i = 0;
					while($r = mysql_fetch_array($sql)){
						$path_img = $r['PIM_IMAGE'];

						if ($r['PIM_IMG_PRI'] != "") 
							$img_pri = "checked";
						else
							$img_pri = "";
						?>
						<tr>
							<td valign="middle">
								<input type="text" size="42" name="aux_path_img_<?php echo $i; ?>" value="<?php echo $path_img; ?>" readonly>
							</td>
							<td align="left">
								<img src='<?php echo "http://images.motopod.com.br/News/". $cat_news ."/". $PST_COD ."/". $path_img; ?>' width='80px' height='50px'>
							</td>
							<td align="center" width="120px">
								<input type="hidden"   name="PIM_COD<?php echo $i; ?>" 	   value="<?php echo $r['PIM_COD']; ?>"/>
								<input type="hidden"   name="chkPrinComp<?php echo $i; ?>" value="<?php echo $r['PIM_IMG_PRI']; ?>" />
								<input type="checkbox" name="chkPrin<?php echo $i; ?>"     value="<?php echo $r['PIM_IMG_PRI']; ?>" <?php echo $img_pri; ?> />Principal
							</td>
							<td align="right" width="50px">
								<a href='javascript:void(0);' onClick="delImages('<?php echo $PST_COD; ?>','<?php echo $path_img; ?>')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a>
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
							<input type="file" name="PIM_IMAGE<?php echo $i; ?>" accept="images/*"></br>
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
						<td align='center' width="30px"><a href='javascript:void(0);' onClick="delImages('<?php echo $PST_COD; ?>','')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a></td>
						<td align='center' valign="middle"><a href='javascript:void(0);' onClick="delImages('<?php echo $PST_COD; ?>','')">Deletar Todas Imagens</a></td>
					</tr>
				</table>
				</br>
				<?php
				}	
				?>
			</div>
			
			<!-- ################## COMENTARIOS ################### -->
			<div id="tabs-3">
				<table border="0" cellspacing="2" cellpadding="0" width="800px">
					<thead>
						<tr class="ui-widget-header" height="30px">
							<th align='center'><input type="checkbox" name="chkGridCmt" onclick="selAllCmt();"></th>
							<td align="center"><font size="2"><strong>Cód</strong></font></td>
							<td align="center" width="95px"><font size="2"><strong>Data</strong></font></td>
							<td align="center" width="65px"><font size="2"><strong>Hora</strong></font></td>
							<td align="left">  <font size="2"><strong>E-mail</strong></font></td>
							<td align="left">  <font size="2"><strong>Comentário</strong></font></td>
						</tr>
					</thead>
					<tbody>
					<?php
						$qr = "
						SELECT * 
						  FROM mp_post_cmt
						 WHERE PCM_PST_COD = $PST_COD
						 ORDER BY PCM_PST_COD, PCM_COD  LIMIT 0 , 50";
						$sql   = mysql_query($qr);
						$total = mysql_num_rows($sql);
						$indice = 1;
						while($r = mysql_fetch_array($sql)){
							$email = substr($r['PCM_EMAIL'], 0, 18) . "...";
							$cmt   = substr($r['PCM_POST'], 0, 50) . "...";
							$hora  = substr($r['PCM_HORA'], 0, 2) .":". substr($r['PCM_HORA'], 1, 2);
							
							echo "<tr "; if($indice % 2 == 0) echo "bgcolor='#C2DFFF'";
							echo ">
							<td align='center'><input type='checkbox' name='chkSel". $indice ."' value='". $r['PCM_COD'] ."'></td>
							<td align='center'>". $r['PCM_COD'] ."</td>
							<td align='center'>". $r['PCM_DATE'] ."</td>
							<td align='center'>". $hora ."</td>
							<td align='left'> $email </td>
							<td align='left'> $cmt </td>
							</tr>";

							$indice = $indice + 1;
						}
					?>
					</tbody>
				</table>
				</br>
				<center><a href="javascript:void(0);" onClick="delCmt('<?php echo $PST_COD; ?>');"><img src="images/icons/delete.png" alt="Deleta" title="Deleta" border="0"></a></center>
				
			</div>
			
			<!-- ################## Veículos Relacionados ################### -->
			<div id="tabs-4">
				<table border="0" cellspacing="2" cellpadding="0" width="800px">
					<thead>
						<tr>
							<td valign="middle">
								<iframe name="iframeMarMod" id="iframeMarMod" src="./ajax_marca_mod.php" frameborder="0" scrolling="no" align="center" width="85%" height="68px">
									<p>Sem suporte a iFrames.</p>
								</iframe>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td valign="middle">
								<!--  GRID VEICULOS RELACIONADOS  -->
								<table border="0" cellspacing="2" cellpadding="0" width="100%">
									<thead>
										<tr class="grid-header" height="30px">
											<td align="center"><strong></strong></td>
											<td align="left"><strong>Modelo Veic.</strong></td>
										</tr>
									</thead>
									<tbody>
									<?php
										$qr    	= "SELECT * FROM mp_post_moto 
												    WHERE MPM_COD = $PST_COD
												    LIMIT 0 , 50";
										$sql   	= mysql_query($qr);
										$total	= mysql_num_rows($sql);
										$indice = 1;
										while($r = mysql_fetch_array($sql)){
											echo "<tr class='grid-body' "; if($indice % 2 == 0) echo "bgcolor='#C2DFFF'";
											echo ">
											<td align='center'><a href='javascript:void(0);' onClick=delVeiRel('". $r['MPM_COD'] ."','". $r['MPM_MMO_COD'] ."','". $r['MPM_ANOFAB'] ."')> <img src='../images/icons/delete.png' alt='Deleta' title='Deleta' border='0' width='19px' height='19px'></a></td>
											<td align='left'>". $r['MPM_MMO_COD'] ."</td>
											</tr>";

											//<td align='left'>". $r['MPM_ANOFAB'] ."</td>
											$indice = $indice + 1;
										}
									?>
									</tbody>
								</table>
								<!--  GRID VEICULOS RELACIONADOS  -->
							</td>
						</tr>
					</tbody>
				</table>
				</br>
			</div>
			
		</div>
	</div>

	<center><input type="submit" class="btsubmit" name="btIncluir" value="<?php echo $lbButton; ?>" onClick="gravaCodMarMod()"></center>
	</br>
	
	<?php
	// altura dinamica de acordo com o numero de registros
	$sql_busca = "SELECT COUNT(PST_COD) AS TOTAL FROM mp_posts";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);

	$alt_grid = 0;
	$alt_grid = $fet_busca['TOTAL'] * 30;
	$alt_grid += 40;
	?>
	<!-- ######################################## GRID ######################################## -->
	<div ><!-- style="border-bottom:1px solid #cccccc" -->
	<iframe src="mod/gridnews.php" frameborder="0" scrolling="yes" align="left" width="788px" height="<?php echo $alt_grid; ?>">
		<p>Your browser does not support iframes.</p>
	</iframe>
	</div>

	<div style="margin-bottom:30px">&nbsp;</div>

	<input type="hidden" name="SelDelCmt" 	 	 value="">
	<input type="hidden" name="SelEdtNews" 	 	 value="">
	<input type="hidden" name="SelDelNews" 	 	 value="">
	<input type="hidden" name="SelDelNewsCat" 	 value="">
	<input type="hidden" name="SelDelNewsImgFil" value="">
	<input type="hidden" name="SelDelNewsImgPai" value="">
	<input type="hidden" name="SelDelNewsCod" 	 value="">
	<input type="hidden" name="SelDelNewsMod" 	 value="">
	<input type="hidden" name="SelDelNewsAno" 	 value="">

</form>
</body>
</html>