<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" charset="utf-8"/>

	<link rel="stylesheet" href="css/jquery.ui.all.css">

	<script src="script/jquery-1.5.1.js"></script>
	<script src="script/jquery.cookie.js"></script>
	<script src="script/jquery.ui.core.js"></script>
	<script src="script/jquery.ui.widget.js"></script>
	<script src="script/jquery.ui.tabs.js"></script>
	
	<link rel="stylesheet" href="css/demos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	
	<script>
	$(function() {
		$( "#tabs" ).tabs({
			cookie: {
				// store cookie for a day, without, it would be a session cookie
				expires: 1
			}
		});
	});
	</script>
	
	<script>
		/*########################################################## Grupo Usuario ########################################################## */
		function edtGrpUsu(){
			var select = false;
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,9) == "chkPrdSel"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelEdtGrpUsu.value = window.document.formCadUsu.SelEdtGrpUsu.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}
			
			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Alterar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}

		function delGrpUsu(){
			var select = false;

			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,9) == "chkPrdSel"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelDelGrpUsu.value = window.document.formCadUsu.SelDelGrpUsu.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}
			
			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Deletar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}

		function selAllGrpUsu(){
			var nomeCampo = "";

			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,9) == "chkPrdSel"){
						if (window.document.formCadUsu.chkGridGrpUsu.checked){
							window.document.formCadUsu.elements[x].checked = true;
						}else{
							window.document.formCadUsu.elements[x].checked = false;
						}
					}
				}
			}
		}
		/*########################################################## Grupo Usuario ########################################################## */
		
		/*########################################################## CATEGORIAS ########################################################## */
		function edtCat(){
			var select = false;
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,8) == "chkCateg"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelEdtCat.value = window.document.formCadUsu.SelEdtCat.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}

			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Alterar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}

		function delCat(){
			var select = false;
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,8) == "chkCateg"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelDelCat.value = window.document.formCadUsu.SelDelCat.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}

			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Deletar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}
		/*########################################################## CATEGORIAS ########################################################## */
		
		/*########################################################## MENU ########################################################## */
		function edtMenu(){
			var select = false;
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,9) == "chkMenSel"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelEdtMenu.value = window.document.formCadUsu.SelEdtMenu.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}

			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Alterar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}

		function delMenu(){
			var select = false;
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,9) == "chkMenSel"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelDelMenu.value = window.document.formCadUsu.SelDelMenu.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}

			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Deletar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}

		function selAllMen(){
			var nomeCampo = "";

			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;
					
					if (nomeCampo.substring(0,9) == "chkMenSel"){
						if (window.document.formCadUsu.chkGridMenu1.checked){
							window.document.formCadUsu.elements[x].checked = true;
						}else{
							window.document.formCadUsu.elements[x].checked = false;
						}
						if (window.document.formCadUsu.chkGridMenu2.checked){
							window.document.formCadUsu.elements[x].checked = true;
						}else{
							window.document.formCadUsu.elements[x].checked = false;
						}
					}
				}
			}
		}
		/*########################################################## MENU ########################################################## */

		/*########################################################## GRP USUARIO x MENU ########################################################## */
		function selAllGrpUsuMenu(){
			var nomeCampo = "";

			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,16) == "chkGrpUsuMenuSel"){
						if (window.document.formCadUsu.chkGridGrpUsuMenu.checked){
							window.document.formCadUsu.elements[x].checked = true;
						}else{
							window.document.formCadUsu.elements[x].checked = false;
						}
					}
				}
			}
		}

		function gravaGrpUsuMenu(){
			var nomeCampo = "";
			var ind = "";
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,16) == "chkGrpUsuMenuSel"){
						if (window.document.formCadUsu.elements[x].checked){
							if (window.document.formCadUsu.elements[x].value != ""){
								window.document.formCadUsu.MGR_MEN_CODIGO_CHANGE.value = window.document.formCadUsu.MGR_MEN_CODIGO_CHANGE.value + "," + window.document.formCadUsu.elements[x].value;
								if (nomeCampo.substring(17) != ""){
									ind = nomeCampo.substring(17);
								}
							}
						}
					}
				}				
			}
			/*bbb
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				nomeCampo = window.document.formCadUsu.elements[x].name;
				
				if (nomeCampo.substring(0,19) == "txtNivGrpUsuMenuSel"){
						if (window.document.formCadUsu.elements[x].value != ""){
							window.document.formCadUsu.MGR_MEN_NIVEL_CHANGE.value = window.document.formCadUsu.MGR_MEN_NIVEL_CHANGE.value + "," + window.document.formCadUsu.elements[x].value;
						}
				}
			}*/
		}
		
		function changeGrpUsuMenu(vlr1,vlr2){
			
			window.document.formCadUsu.MGR_GRU_CODIGO_CHANGE.value = vlr1;
			window.document.formCadUsu.GUM_CATEG_CHANGE.value      = vlr2;

			window.document.formCadUsu.submit();
		}
		/*########################################################## GRP USUARIO x MENU ########################################################## */
		
		/*########################################################## USUARIO x GRP USUARIO ########################################################## */
		function fnBlurUsuGrpUsu(){
			window.document.formCadUsu.BlurUsuGrpUsu.value = "iii";
			
			/*
			window.document.formCadUsu.USG_USR_PES_CPFCNPJ.value
			window.document.formCadUsu.PES_NOME.value
			window.document.formCadUsu.USR_GRU_CODIGO.value
			window.document.formCadUsu.GRU_NOME_02.value*/
			
			window.document.formCadUsu.submit();
		}

		function edtUsuGrpUsu(){
			var select = false;
			
			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,12) == "chkUsuGrpUsu"){
						if (window.document.formCadUsu.elements[x].checked){
							window.document.formCadUsu.SelEdtUsuGrpUsu.value = window.document.formCadUsu.SelEdtUsuGrpUsu.value + "," + window.document.formCadUsu.elements[x].value;
							select = true;
						}
					}
				}
			}

			if(select == false){
				alert("AVISO!\n\nSelecione um registro para Alterar!");
			}else{
				window.document.formCadUsu.submit();
			}
		}

		function selAllUsuGrpUsu(){
			var nomeCampo = "";

			for (x =0; x < window.document.formCadUsu.elements.length; x++){
				if (window.document.formCadUsu.elements[x].type == 'checkbox'){
					nomeCampo = window.document.formCadUsu.elements[x].name;

					if (nomeCampo.substring(0,12) == "chkUsuGrpUsu"){
						if (window.document.formCadUsu.chkGridUsuGrpUsu.checked){
							window.document.formCadUsu.elements[x].checked = true;
						}else{
							window.document.formCadUsu.elements[x].checked = false;
						}
					}
				}
			}
		}
		/*########################################################## USUARIO x GRP USUARIO ########################################################## */
	</script>
		
<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

/* ##################### CONSULTA ##################### */
$GRU_CODIGO      	= "";
$GRU_NOME 	     	= "";
$GRU_PERMISSAO   	= ""; 

$CTG_CODIGO			= 0;
$CTG_DESCRICAO		= "";

$MEN_CODIGO      	= "";
$MEN_NOME	     	= "";
$MEN_NIVEL       	= 0;
$MEN_CATEG		 	= "";
$MEN_PRIORID     	= 0;
$MEN_NIVEL_tmp   	= 99;
$MEN_CATEG_tmp	 	= "";

$MGR_MEN_CODIGO		= "";					
$MGR_GRU_CODIGO 	= 0;
$MGR_MEN_CODIGO_tmp = "";
$MGR_GRU_CODIGO_tmp = 0;

$USG_USR_PES_CPFCNPJ = "";
$PES_NOME			 = "";

$USR_GRU_CODIGO 	 = "";
$GRU_NOME_02		 = "";

$erro_t3_1 = "";
$erro_t3_2 = "";
$erro_t3_3 = "";
$erro_t3_4 = "";

/*########################################################## GRUPO USUARIO ########################################################## */
$btGrpUsu = "";
$SelEdtGrpUsu = "";
$SelDelGrpUsu = "";

if (isset($_POST['btGrpUsu']))		$btGrpUsu 	  = $_POST['btGrpUsu'];
if (isset($_POST['SelEdtGrpUsu']))	$SelEdtGrpUsu = $_POST['SelEdtGrpUsu'];
if (isset($_POST['SelDelGrpUsu']))	$SelDelGrpUsu = $_POST['SelDelGrpUsu'];

/*########################################################## CATEGORIA ########################################################## */
$btCateg = "";
$SelEdtCat = "";
$SelDelCat = "";

if (isset($_POST['btCateg']))	$btCateg = $_POST['btCateg'];
if (isset($_POST['SelEdtCat']))	$SelEdtCat = $_POST['SelEdtCat'];
if (isset($_POST['SelDelCat']))	$SelDelCat = $_POST['SelDelCat'];

/*########################################################## MENU ########################################################## */
$btMenus = "";
$SelEdtMenu = "";
$SelDelMenu = "";

if (isset($_POST['btMenus']))		$btMenus = $_POST['btMenus'];
if (isset($_POST['SelEdtMenu']))	$SelEdtMenu = $_POST['SelEdtMenu'];
if (isset($_POST['SelDelMenu']))	$SelDelMenu = $_POST['SelDelMenu'];

/*########################################################## GRUPO USUARIO x MENU ########################################################## */
$btGrpUsuMenu = "";
$MGR_GRU_CODIGO = "";
$MGR_GRU_CODIGO_CHANGE = "";
$MGR_MEN_CODIGO_CHANGE = "";
$MGR_MEN_NIVEL_CHANGE = "";
$GUM_CATEG_CHANGE = "";
$GUM_CATEG = "";

if (isset($_POST['btGrpUsuMenu']))			$btGrpUsuMenu = $_POST['btGrpUsuMenu'];
if (isset($_POST['MGR_GRU_CODIGO']))		$MGR_GRU_CODIGO = $_POST['MGR_GRU_CODIGO'];
if (isset($_POST['MGR_GRU_CODIGO_CHANGE']))	$MGR_GRU_CODIGO_CHANGE = $_POST['MGR_GRU_CODIGO_CHANGE'];
if (isset($_POST['MGR_MEN_CODIGO_CHANGE']))	$MGR_MEN_CODIGO_CHANGE = $_POST['MGR_MEN_CODIGO_CHANGE'];
if (isset($_POST['MGR_MEN_NIVEL_CHANGE']))	$MGR_MEN_NIVEL_CHANGE = $_POST['MGR_MEN_NIVEL_CHANGE'];
if (isset($_POST['GUM_CATEG_CHANGE']))		$GUM_CATEG_CHANGE = $_POST['GUM_CATEG_CHANGE'];
if (isset($_POST['GUM_CATEG']))				$GUM_CATEG = $_POST['GUM_CATEG'];

/*########################################################## MENU x GRUPO USUARIO ########################################################## */
$btUsuGrpUsu = "";
$USG_USR_PES_CPFCNPJ = "";
$USR_GRU_CODIGO = "";
$SelEdtUsuGrpUsu = "";
$BlurUsuGrpUsu = "";

if (isset($_POST['btUsuGrpUsu']))			$btUsuGrpUsu 		 = $_POST['btUsuGrpUsu'];
if (isset($_POST['USG_USR_PES_CPFCNPJ']))	$USG_USR_PES_CPFCNPJ = $_POST['USG_USR_PES_CPFCNPJ'];
if (isset($_POST['USR_GRU_CODIGO']))		$USR_GRU_CODIGO 	 = $_POST['USR_GRU_CODIGO'];
if (isset($_POST['SelEdtUsuGrpUsu']))		$SelEdtUsuGrpUsu 	 = $_POST['SelEdtUsuGrpUsu'];
if (isset($_POST['BlurUsuGrpUsu']))			$BlurUsuGrpUsu 		 = $_POST['BlurUsuGrpUsu'];

/* ########################################## INSERCAO GRUPO USUARIO */
if ($btGrpUsu != "" || $SelEdtGrpUsu != "" || $SelDelGrpUsu != ""){
	$c_erros = "";

	if($btGrpUsu != ""){
		$GRU_CODIGO = "";
		if (isset($_POST['GRU_CODIGO']))	$GRU_CODIGO = $_POST['GRU_CODIGO'];

		$erro_t1_1 = "";
		$GRU_NOME = "";
		if (isset($_POST['GRU_NOME']))		$GRU_NOME = $_POST['GRU_NOME'];
		if ($GRU_NOME == ""){
			$c_erros = $c_erros . ",Nome não informado (Aba 'Cad. Grupo Usuário').";
			$erro_t1_1 = "erro";
		}

		$erro_t1_2 = "";
		$GRU_PERMISSAO = "";
		if (isset($_POST['GRU_PERMISSAO']))	$GRU_PERMISSAO = $_POST['GRU_PERMISSAO'];
		if ($GRU_PERMISSAO == ""){
			$c_erros = $c_erros . ",Código não informado (Aba 'Cad. Grupo Usuário').";
			$erro_t1_2 = "erro";
		}
	}

	$tmp = "";
	$conta = 0;
	$inicio = 1;			
	$conta_palavra = 0;
	for ($i = 1; $i <= strlen($SelEdtGrpUsu) - 1; $i++){
		$conta_palavra ++;
		if (trim($SelEdtGrpUsu[$i]) == ","){
			if (trim(substr($SelEdtGrpUsu, $inicio, $conta_palavra - 1)) != ""){
				$tmp = trim(substr($SelEdtGrpUsu, $inicio, $conta_palavra - 1));
				$conta ++;
				$inicio = $i + 1;
				$conta_palavra = 0;
			}
		}
	}
	// Imprime ultimo campo
	if ($inicio >= 1 && (trim(substr($SelEdtGrpUsu, $inicio, $i - 1))) != ""){
		$conta ++;
		$tmp = trim(substr($SelEdtGrpUsu, $inicio, $i - 1));
	}
	if ($tmp != ""){
		$SelEdtGrpUsu = $tmp;
	}

	if($conta > 1){
		$c_erros = $c_erros . ", Selecionar somente um registro para alterar.";
	}

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		// ################## GRUPO USUARIO
		if($btGrpUsu == "Inclui Grupo Usuário"){
			do {
				$cod = 0;
				$ind = 0;
				$sql_busca = "SELECT MAX(GRU_CODIGO) AS COD_FIM FROM grupousr ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);

				$cod = $fet_busca['COD_FIM'];
				$ind ++;
				$cod = $cod + $ind;

				$sql_busca = "SELECT * FROM grupousr WHERE GRU_CODIGO = '$cod'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$num_busca = mysql_num_rows($exe_busca);
			} while ($num_busca != 0);

			if ($num_busca == 0){
				$sql_busca = "INSERT INTO grupousr (GRU_CODIGO,GRU_NOME,GRU_PERMISSAO)" .
							 "VALUES ('$cod','$GRU_NOME','$GRU_PERMISSAO')";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}

			// cria GRUPO USUARIOS da tabela "menus_grp"
			criaGrupoMenu($cod);

			$GRU_CODIGO    = "";
			$GRU_NOME 	   = "";
			$GRU_PERMISSAO = "";

		}else if($btGrpUsu == "Altera Grupo Usuário"){
			$sql_busca = "SELECT * FROM grupousr WHERE GRU_CODIGO = '$GRU_CODIGO'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca != 0){
				$sql_busca = "UPDATE grupousr SET " .
							 "GRU_NOME 	  	   = '$GRU_NOME', " . 
							 "GRU_PERMISSAO    = '$GRU_PERMISSAO' " .
							 "WHERE GRU_CODIGO = '$GRU_CODIGO'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}

			// cria GRUPO USUARIOS da tabela "menus_grp"
			criaGrupoMenu($GRU_CODIGO);
			
			$GRU_CODIGO    = "";
			$GRU_NOME 	   = "";
			$GRU_PERMISSAO = "";		
			
		}else if($SelEdtGrpUsu != ""){
			$sql_busca = "SELECT * FROM grupousr WHERE GRU_CODIGO = '$SelEdtGrpUsu'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);

			$GRU_CODIGO    = $fet_busca['GRU_CODIGO'];
			$GRU_NOME 	   = $fet_busca['GRU_NOME'];
			$GRU_PERMISSAO = $fet_busca['GRU_PERMISSAO'];

		}else if($SelDelGrpUsu != ""){
			$tmp = "";
			$inicio = 1;
			$conta_palavra = 0;
			for ($i = 1; $i <= strlen($SelDelGrpUsu) - 1; $i++){
				$conta_palavra ++;
				if (trim($SelDelGrpUsu[$i]) == ","){
					if (trim(substr($SelDelGrpUsu, $inicio, $conta_palavra - 1)) != ""){
						$tmp = trim(substr($SelDelGrpUsu, $inicio, $conta_palavra - 1));

						$sql_busca = "DELETE FROM grupousr WHERE GRU_CODIGO = '$tmp'";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());

						$sql_busca = "DELETE FROM menus_grp WHERE MGR_GRU_CODIGO = '$tmp' ";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());

						$inicio = $i + 1;
						$conta_palavra = 0;
					}
				}
			}

			// Imprime ultimo campo
			if ($inicio >= 1 && (trim(substr($SelDelGrpUsu, $inicio, $i - 1))) != ""){
				$tmp = trim(substr($SelDelGrpUsu, $inicio, $i - 1));
				$sql_busca = "DELETE FROM grupousr WHERE GRU_CODIGO = '$tmp'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());

				$sql_busca = "DELETE FROM menus_grp WHERE MGR_GRU_CODIGO = '$tmp' ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}
	}


/* ########################################## INSERCAO CATEGORIA */
}else if ($btCateg != "" || $SelEdtCat != "" || $SelDelCat != ""){
	$c_erros = "";

	if($btCateg != ""){
		$erro_t2_1 = "";
		$CTG_CODIGO = "";
		if (isset($_POST['CTG_CODIGO']))	$CTG_CODIGO = $_POST['CTG_CODIGO'];
		if ($CTG_CODIGO == ""){
			$c_erros = $c_erros . ",Código não informado (Aba 'Categ. Menus').";
			$erro_t2_1 = "erro";
		}
		
		$erro_t2_2 = "";
		$CTG_DESCRICAO = "";
		if (isset($_POST['CTG_DESCRICAO']))	$CTG_DESCRICAO = $_POST['CTG_DESCRICAO'];
		if ($CTG_DESCRICAO == ""){
			$c_erros = $c_erros . ",Descrição não informada (Aba 'Categ. Menus').";
			$erro_t2_2 = "erro";
		}
	}

	$tmp = "";
	$conta = 0;
	$inicio = 1;			
	$conta_palavra = 0;
	for ($i = 1; $i <= strlen($SelEdtCat) - 1; $i++){
		$conta_palavra ++;
		if (trim($SelEdtCat[$i]) == ","){
			if (trim(substr($SelEdtCat, $inicio, $conta_palavra - 1)) != ""){
				$tmp = trim(substr($SelEdtCat, $inicio, $conta_palavra - 1));
				$conta ++;
				$inicio = $i + 1;
				$conta_palavra = 0;
			}
		}
	}
	// Imprime ultimo campo
	if ($inicio >= 1 && (trim(substr($SelEdtCat, $inicio, $i - 1))) != ""){
		$conta ++;
		$tmp = trim(substr($SelEdtCat, $inicio, $i - 1));
	}
	if ($tmp != ""){
		$SelEdtCat = $tmp;
	}

	if($conta > 1){
		$c_erros = $c_erros . ", Selecionar somente um registro para alterar.";
	}

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		if($btCateg == "Incluir"){
			$cod = proxCod('CTG_CODIGO', 'menus_cat');
			
			$sql_busca = "INSERT INTO menus_cat (CTG_CODIGO,CTG_DESCRICAO)" .
						 "VALUES ($cod,'$CTG_DESCRICAO')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			
			$CTG_CODIGO    = "";
			$CTG_DESCRICAO = "";

		}else if($btCateg == "Alterar"){
			$sql_busca = "SELECT * FROM menus_cat WHERE CTG_CODIGO = '$CTG_CODIGO'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca != 0){
				$sql_busca = "UPDATE menus_cat SET " .
							 "CTG_DESCRICAO    = '$CTG_DESCRICAO' " .
							 "WHERE CTG_CODIGO = $CTG_CODIGO ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}else if($SelEdtCat != ""){
			$sql_busca = "SELECT * FROM menus_cat WHERE CTG_CODIGO = '$SelEdtCat'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);

			$CTG_CODIGO    = $fet_busca['CTG_CODIGO'];
			$CTG_DESCRICAO = $fet_busca['CTG_DESCRICAO'];
			
		}else if($SelDelCat != ""){
			$tmp = "";
			$inicio = 1;
			$conta_palavra = 0;
			for ($i = 1; $i <= strlen($SelDelCat) - 1; $i++){
				$conta_palavra ++;
				if (trim($SelDelCat[$i]) == ","){
					if (trim(substr($SelDelCat, $inicio, $conta_palavra - 1)) != ""){
						$tmp = trim(substr($SelDelCat, $inicio, $conta_palavra - 1));

						$sql_busca = "DELETE FROM menus_cat WHERE CTG_CODIGO = '$tmp'";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());
						
						$inicio = $i + 1;
						$conta_palavra = 0;
					}
				}
			}

			// Imprime ultimo campo
			if ($inicio >= 1 && (trim(substr($SelDelCat, $inicio, $i - 1))) != ""){
				$tmp = trim(substr($SelDelCat, $inicio, $i - 1));
				$sql_busca = "DELETE FROM menus_cat WHERE CTG_CODIGO = '$tmp'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}
	}

// ########################################## INSERCAO GRUPO USUARIO
}else if ($btMenus != "" || $SelEdtMenu != "" || $SelDelMenu != ""){
	$c_erros = "";
	
	if($btMenus != ""){
		if (isset($_POST['MEN_CODIGO']))	$MEN_CODIGO = $_POST['MEN_CODIGO'];
		if ($MEN_CODIGO == ""){
			$c_erros = $c_erros . ",Código não informado (Aba 'Cad. Menus').";
			$erro_t3_1 = "erro";
		}

		if (isset($_POST['MEN_CATEG']))		$MEN_CATEG = $_POST['MEN_CATEG'];
		if ($MEN_CATEG == ""){
			$c_erros = $c_erros . ",Categoria do Menu não informada (Aba 'Cad. Menus').";
			$erro_t3_2 = "erro";
		}
		
		if (isset($_POST['MEN_NOME']))		$MEN_NOME = $_POST['MEN_NOME'];
		if ($MEN_NOME == ""){
			$c_erros = $c_erros . ",Descrição Menu não informado (Aba 'Cad. Menus').";
			$erro_t3_3 = "erro";
		}

		if (isset($_POST['MEN_NIVEL']))		$MEN_NIVEL = $_POST['MEN_NIVEL'];
		if ($MEN_NIVEL == 0){
			$c_erros = $c_erros . ",Nível não informado (Aba 'Cad. Menus').";
			$erro_t3_4 = "erro";
		}

		if (isset($_POST['MEN_PRIORID'])){
			if ($_POST['MEN_PRIORID'] <> "")
				$MEN_PRIORID = $_POST['MEN_PRIORID'];
		}
	}

	$tmp = "";
	$conta = 0;
	$inicio = 1;			
	$conta_palavra = 0;
	for ($i = 1; $i <= strlen($SelEdtMenu) - 1; $i++){
		$conta_palavra ++;
		if (trim($SelEdtMenu[$i]) == ","){
			if (trim(substr($SelEdtMenu, $inicio, $conta_palavra - 1)) != ""){
				$tmp = trim(substr($SelEdtMenu, $inicio, $conta_palavra - 1));
				$conta ++;
				$inicio = $i + 1;
				$conta_palavra = 0;
			}
		}
	}
	// Imprime ultimo campo
	if ($inicio >= 1 && (trim(substr($SelEdtMenu, $inicio, $i - 1))) != ""){
		$conta ++;
		$tmp = trim(substr($SelEdtMenu, $inicio, $i - 1));
	}
	if ($tmp != ""){
		$SelEdtMenu = $tmp;
	}

	if($conta > 1){
		$c_erros = $c_erros . ", Selecionar somente um registro para alterar.";
	}
	
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		if($btMenus != ""){
			if ($MEN_PRIORID == 0){
				$sql_busca = "SELECT MAX(MEN_PRIORID) AS MAX_PRIORID FROM menus WHERE MEN_CATEG = '$MEN_CATEG' AND MEN_NIVEL = $MEN_NIVEL ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$MEN_PRIORID = $fet_busca['MAX_PRIORID'] + 10;
			}

			$sql_busca = "SELECT * FROM menus WHERE MEN_CODIGO = '$MEN_CODIGO'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca == 0){
				$sql_busca = "INSERT INTO menus (MEN_CODIGO, MEN_NOME, MEN_NIVEL, MEN_CATEG, MEN_PRIORID)" .
							 "VALUES ('$MEN_CODIGO', '$MEN_NOME', '$MEN_NIVEL, '$MEN_CATEG', $MEN_PRIORID)";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}else{
				$sql_busca = "UPDATE menus SET " .
							 "MEN_NOME 	 	   = '$MEN_NOME', " .
							 "MEN_NIVEL  	   =  $MEN_NIVEL, " .
							 "MEN_CATEG		   = '$MEN_CATEG', " .
							 "MEN_PRIORID	   =  $MEN_PRIORID " .
							 "WHERE MEN_CODIGO = '$MEN_CODIGO'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}

			// Insere o menu no Acesso dos Grupos de Menus
			$sql_busca = "SELECT * FROM menus_grp WHERE MGR_MEN_CODIGO = '$MEN_CODIGO'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca == 0){
					$qr = "SELECT * FROM grupousr";
					$sql = mysql_query($qr);
					while($r = mysql_fetch_array($sql)){
						$tmp = $r['GRU_CODIGO'];
						$sql_busca = "INSERT INTO menus_grp (MGR_MEN_CODIGO, MGR_GRU_CODIGO)" .
									 "VALUES ('$MEN_CODIGO', $tmp)";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());						
					}
			}
			
			$MEN_CODIGO    = "";
			$MEN_NOME	   = "";
			$MEN_NIVEL     = 0;
			$MEN_CATEG	   = "";
			$MEN_PRIORID   = 0;
			$MEN_NIVEL_tmp = 99;
			$MEN_CATEG_tmp = "";
			
		}else if($SelEdtMenu != ""){
			$sql_busca = "SELECT * FROM menus WHERE MEN_CODIGO = '$SelEdtMenu'";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);

			$MEN_CODIGO    = $fet_busca['MEN_CODIGO'];
			$MEN_NOME      = $fet_busca['MEN_NOME'];
			$MEN_NIVEL_tmp = $fet_busca['MEN_NIVEL'];
			$MEN_CATEG_tmp = $fet_busca['MEN_CATEG'];
			$MEN_PRIORID   = $fet_busca['MEN_PRIORID'];

		}else if($SelDelMenu != ""){
			$tmp = "";
			$inicio = 1;			
			$conta_palavra = 0;
			for ($i = 1; $i <= strlen($SelDelMenu) - 1; $i++){
				$conta_palavra ++;
				if (trim($SelDelMenu[$i]) == ","){
					if (trim(substr($SelDelMenu, $inicio, $conta_palavra - 1)) != ""){
						$tmp = trim(substr($SelDelMenu, $inicio, $conta_palavra - 1));

						$sql_busca = "DELETE FROM menus WHERE MEN_CODIGO = '$tmp'";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());

						$sql_busca = "DELETE FROM menus_grp WHERE MGR_MEN_CODIGO = '$tmp'";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());

						$inicio = $i + 1;
						$conta_palavra = 0;
					}
				}
			}
			// Imprime ultimo campo
			if ($inicio >= 1 && (trim(substr($SelDelMenu, $inicio, $i - 1))) != ""){
				$tmp = trim(substr($SelDelMenu, $inicio, $i - 1));
				
				$sql_busca = "DELETE FROM menus WHERE MEN_CODIGO = '$tmp'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				
				$sql_busca = "DELETE FROM menus_grp WHERE MGR_MEN_CODIGO = '$tmp'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		/* ORDENACAO
		}else if($OrdMenuUP != "" || $OrdMenuDOWN != ""){
			$tmp = "";
			$inicio = 1;			
			$conta_palavra = 0;
			for ($i = 1; $i <= strlen($SelDelMenu) - 1; $i++){
				$conta_palavra ++;
				if (trim($SelDelMenu[$i]) == ","){
					if (trim(substr($SelDelMenu, $inicio, $conta_palavra - 1)) != ""){
						$tmp = trim(substr($SelDelMenu, $inicio, $conta_palavra - 1));

						$sql_busca = "DELETE FROM menus WHERE MEN_CODIGO = '$tmp'";
						$exe_busca = mysql_query($sql_busca) or die (mysql_error());
						
						$inicio = $i + 1;
						$conta_palavra = 0;
					}
				}
			}
			// Imprime ultimo campo
			if ($inicio >= 1 && (trim(substr($SelDelMenu, $inicio, $i - 1))) != ""){
				$tmp = trim(substr($SelDelMenu, $inicio, $i - 1));
				
				$sql_busca = "DELETE FROM menus WHERE MEN_CODIGO = '$tmp'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}*/
		}
	}
}else if ($btGrpUsuMenu != "" || $MGR_GRU_CODIGO_CHANGE != ""){
	$c_erros = "";

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		if($btGrpUsuMenu != ""){
			$qr = "SELECT menus.* FROM menus WHERE menus.MEN_CATEG = '$GUM_CATEG' ";
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);
			while($r = mysql_fetch_array($sql)){
				// EXISTE "MEN_CODIGO" NA LISTA "MGR_MEN_CODIGO_CHANGE"
				if (preg_match("/". $r['MEN_CODIGO'] ."/i", $MGR_MEN_CODIGO_CHANGE)){
					$tmp = $r['MEN_CODIGO'];								
					$sql_busca = "UPDATE menus_grp SET
								  MGR_SHOW = 'S'
								  WHERE MGR_MEN_CODIGO = '$tmp'
									AND MGR_GRU_CODIGO = $MGR_GRU_CODIGO ";
					$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				}else{
					$tmp = $r['MEN_CODIGO'];
					$sql_busca = "UPDATE menus_grp SET
								  MGR_SHOW = 'N'
								  WHERE MGR_MEN_CODIGO = '$tmp'
									AND MGR_GRU_CODIGO = $MGR_GRU_CODIGO ";
					$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				}
			}

		/*
			$qr = "
			SELECT menus_grp.*, menus.*
			  FROM menus_grp AS menus_grp
			  LEFT JOIN menus AS menus ON menus.MEN_CODIGO = menus_grp.MGR_MEN_CODIGO
			 WHERE menus_grp.MGR_GRU_CODIGO = $MGR_GRU_CODIGO
			   AND menus.MEN_CATEG = '$GUM_CATEG'
			 GROUP BY MEN_CATEG, MEN_NIVEL, MEN_PRIORID ";			 
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);
			while($r = mysql_fetch_array($sql)) {
			echo ">>> ".$r['MGR_MEN_CODIGO'];
				if (preg_match("/". $r['MGR_MEN_CODIGO'] ."/i", $MGR_MEN_CODIGO_CHANGE)){
					$tmp = $r['MGR_MEN_CODIGO'];
					$sql_busca = "UPDATE menus_grp SET
								  MGR_SHOW = 'S'
								  WHERE MGR_MEN_CODIGO = '$tmp'
								    AND MGR_GRU_CODIGO = $MGR_GRU_CODIGO ";
					$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				}else{
					$tmp = $r['MGR_MEN_CODIGO'];
					$sql_busca = "UPDATE menus_grp SET
								  MGR_SHOW = 'N'
								  WHERE MGR_MEN_CODIGO = '$tmp'
								    AND MGR_GRU_CODIGO = $MGR_GRU_CODIGO ";
					$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				}
			}
		*/
			$qr = "
			SELECT menus_grp.*, menus.*
			  FROM menus_grp AS menus_grp
			  LEFT JOIN menus AS menus ON menus.MEN_CODIGO = menus_grp.MGR_MEN_CODIGO
			 WHERE menus_grp.MGR_GRU_CODIGO = $MGR_GRU_CODIGO
			   AND menus.MEN_CATEG = '$GUM_CATEG'
			 ORDER BY MEN_CATEG, MEN_NIVEL, MEN_PRIORID ";
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);

			while($r = mysql_fetch_array($sql)) {
				$MGR_GRU_CODIGO_tmp = $r['MGR_GRU_CODIGO'];
				$MGR_MEN_CODIGO_tmp = $MGR_MEN_CODIGO_tmp . "," . $r['MGR_MEN_CODIGO'];
			}
		}else if($MGR_GRU_CODIGO_CHANGE != ""){
//bbb echo "LLLLLLLLLLLLLLLLLL>>>>>>>>>>>  $MGR_GRU_CODIGO_CHANGE LLLLLLLLLLLLLL UUUUU $GUM_CATEG_CHANGE";
			$qr = "
			SELECT menus_grp.*, menus.*
			  FROM menus_grp AS menus_grp
			  LEFT JOIN menus AS menus ON menus.MEN_CODIGO = menus_grp.MGR_MEN_CODIGO
			 WHERE menus_grp.MGR_GRU_CODIGO = $MGR_GRU_CODIGO_CHANGE
			   AND menus.MEN_CATEG = '$GUM_CATEG_CHANGE'
			 ORDER BY MEN_CATEG, MEN_NIVEL, MEN_PRIORID ";
			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);

			while($r = mysql_fetch_array($sql)) {
				$MGR_GRU_CODIGO_tmp = $r['MGR_GRU_CODIGO'];
				$MGR_MEN_CODIGO_tmp = $MGR_MEN_CODIGO_tmp . "," . $r['MGR_MEN_CODIGO'];
			}
		}
	}
}else if ($btUsuGrpUsu != "" || $SelEdtUsuGrpUsu != "" || $BlurUsuGrpUsu != ""){
	$c_erros = "";

	if($btUsuGrpUsu != ""){
		$erro_t5_1 = "";
		$USG_USR_PES_CPFCNPJ = "";
		if (isset($_POST['USG_USR_PES_CPFCNPJ'])){
			$USG_USR_PES_CPFCNPJ = $_POST['USG_USR_PES_CPFCNPJ'];
		}
		if ($USG_USR_PES_CPFCNPJ == ""){
			$c_erros = $c_erros . ",Usuário não informado.";
			$erro_t5_1 = "erro";
		}
		
		$erro_t5_2 = "";
		$USR_GRU_CODIGO = "";
		if (isset($_POST['USR_GRU_CODIGO'])){
			$USR_GRU_CODIGO = $_POST['USR_GRU_CODIGO'];
		}
		if ($USR_GRU_CODIGO == ""){
			$c_erros = $c_erros . ",Grupo de Usuário não informado.";
			$erro_t5_2 = "erro";
		}
	}

	$tmp = "";
	$conta = 0;
	$inicio = 1;			
	$conta_palavra = 0;
	for ($i = 1; $i <= strlen($SelEdtUsuGrpUsu) - 1; $i++){
		$conta_palavra ++;
		if (trim($SelEdtUsuGrpUsu[$i]) == ","){
			if (trim(substr($SelEdtUsuGrpUsu, $inicio, $conta_palavra - 1)) != ""){
				$tmp = trim(substr($SelEdtUsuGrpUsu, $inicio, $conta_palavra - 1));
				$conta ++;
				$inicio = $i + 1;
				$conta_palavra = 0;
			}
		}
	}
	// Imprime ultimo campo
	if ($inicio >= 1 && (trim(substr($SelEdtUsuGrpUsu, $inicio, $i - 1))) != ""){
		$conta ++;
		$tmp = trim(substr($SelEdtUsuGrpUsu, $inicio, $i - 1));
	}
	if ($tmp != ""){
		$SelEdtUsuGrpUsu = $tmp;
	}
	
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		// ################## GRUPO USUARIO x MENU
		if($btUsuGrpUsu != ""){
			// atualiza "user" 4 = Comprador
			$sql_busca = "UPDATE user SET
						  USR_GRU_CODIGO = '$USR_GRU_CODIGO'
						  WHERE USR_PES_CPFCNPJ = '$USG_USR_PES_CPFCNPJ' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());

			/*
			$sql_busca = "SELECT * FROM user WHERE USG_USR_PES_CPFCNPJ = '$USG_USR_PES_CPFCNPJ' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca == 0){
				$sql_busca = "INSERT INTO user (USG_USR_PES_CPFCNPJ, USR_GRU_CODIGO)" .
							 "VALUES ('$USG_USR_PES_CPFCNPJ', '$USR_GRU_CODIGO')";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}else{
				$sql_busca = "UPDATE user SET ".
							 "USR_GRU_CODIGO            = '$USR_GRU_CODIGO' ".
							 "WHERE USG_USR_PES_CPFCNPJ = '$USG_USR_PES_CPFCNPJ'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
			*/

			$USR_GRU_CODIGO = "";
			$USG_USR_PES_CPFCNPJ = "";

		}else if($SelEdtUsuGrpUsu != ""){
			$sql_busca = "
			SELECT user.USR_PES_CPFCNPJ, pessoa.PES_NOME, grupousr.GRU_NOME
			  FROM user AS user
			  LEFT JOIN grupousr ON grupousr.GRU_CODIGO = user.USR_GRU_CODIGO
			 INNER JOIN pessoa	 ON pessoa.PES_CPFCNPJ  = user.USR_PES_CPFCNPJ
			 WHERE user.USR_PES_CPFCNPJ = '$SelEdtUsuGrpUsu'
			 ORDER BY pessoa.PES_NOME ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);

			$USG_USR_PES_CPFCNPJ = $fet_busca['USR_PES_CPFCNPJ'];
			$PES_NOME		     = $fet_busca['PES_NOME'];
			$USR_GRU_CODIGO      = $fet_busca['USR_GRU_CODIGO'];
			$GRU_NOME_02		 = $fet_busca['GRU_NOME'];

		}else if($BlurUsuGrpUsu != ""){
			if ($USG_USR_PES_CPFCNPJ != ""){
				$sql_busca = "SELECT * FROM pessoa WHERE PES_CPFCNPJ = '$USG_USR_PES_CPFCNPJ' ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$num_busca = mysql_num_rows($exe_busca);

				if ($fet_busca['PES_NOME'] != ""){
					$PES_NOME = $fet_busca['PES_NOME'];
				}
			}
			
			if ($USR_GRU_CODIGO != ""){
				$sql_busca = "SELECT * FROM grupousr WHERE GRU_CODIGO = $USR_GRU_CODIGO ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$num_busca = mysql_num_rows($exe_busca);
				
				if ($fet_busca['GRU_NOME'] != ""){
					$GRU_NOME_02 = $fet_busca['GRU_NOME'];
				}
			}
		}
	}
}

?>

<?php
if ($at == "s" && $c_erros == "")
	echo msgAviso("Dados Cadastrados com Sucesso!","");
?>

<!--<div style="border-bottom:1px solid #cccccc"><label style="font-size:25px"><strong>Cadastro Grupo de Usuário</strong></label></br></br></div>-->
<form id="formCadUsu" name="formCadUsu" action="cadgrpusu" method="post" accept-charset="utf-8">

	<div class="demo">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Cad. Grupo Usuário</a></li>
				<li><a href="#tabs-2">Categ. Menus</a></li>
				<li><a href="#tabs-3">Cad. Menus</a></li>
				<li><a href="#tabs-4">Grupo Usu. x Menus</a></li>
				<li><a href="#tabs-5">Usuário x Grupo Usu.</a></li>
			</ul>
			<div id="tabs-1">
				<table border="0" cellspacing="4" cellpadding="0" align="center">
					<tr>
						<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Nome</label></b></div></td>
						<td align="left"><input type="text" class="<?php if($erro_t1_1 != ""){echo "field_error";}else{echo "input";} ?>" size="40" maxlength="45" name="GRU_NOME" value="<?php if($GRU_NOME != ""){ echo $GRU_NOME; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Permissão</label></b></div></td>
						<td align="left">
							<select name="GRU_PERMISSAO" class="<?php if($erro_t1_2 != ""){echo "field_error";}else{echo "input_select";} ?>">
								<option value='2' <?php if($GRU_PERMISSAO == 2) echo "selected"; ?>>Usuário</option>
								<option value='3' <?php if($GRU_PERMISSAO == 3) echo "selected"; ?>>Vendedor</option>
								<option value='4' <?php if($GRU_PERMISSAO == 4) echo "selected"; ?>>Comprador</option>
								<option value='1' <?php if($GRU_PERMISSAO == 1) echo "selected"; ?>>Administrador</option>
								<option value='5' <?php if($GRU_PERMISSAO == 5) echo "selected"; ?>>Outro</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="btGrpUsu" value="<?php if($GRU_CODIGO != ""){echo "Altera Grupo Usuário";}else{echo "Inclui Grupo Usuário";} ?>" style="margin-top:10px; margin-bottom:15px; height:30px; align:center;">
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<table border="0" cellspacing="4" cellpadding="0" >
								<thead>
									<tr class="ui-widget-header " height="30px">
										<th align='center'><input type="checkbox" name="chkGridGrpUsu" onclick="selAllGrpUsu();"></th>
										<th>Nome</th>
										<th align="left">Permissão</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$qr = "SELECT * FROM grupousr ORDER BY GRU_CODIGO LIMIT 0 , 50";
										$sql = mysql_query($qr);
										$total = mysql_num_rows($sql);
										$ind = 1;
										while($r = mysql_fetch_array($sql)){
											echo "<tr>".
												 "<td align='center' bgcolor='"; echo linhaCor($ind); echo "'><input type='checkbox' name='chkPrdSel". $ind ."' value='". $r['GRU_CODIGO'] ."'></td>" .
												 "<td align='left'   bgcolor='"; echo linhaCor($ind); echo "' width='180px'>" . $r['GRU_NOME'] . "</td>" .
											     "<td align='left'   bgcolor='"; echo linhaCor($ind); echo "' >" ;
											switch ($r['GRU_PERMISSAO']) {
												case 1:
													echo "Administrador&nbsp;&nbsp;";
													break;
												case 2:
													echo "Usuário&nbsp;&nbsp;";
													break;
												case 3:
													echo "Vendedor";
													break;
												case 4:
													echo "Comprador";
													break;
												case 5:
													echo "Outro";
													break;
											}
											echo "</td>" .
												 "</tr>";
											$ind ++;
										}
									?>
									<tr height="40px">
										<td colspan="4" align="center">
											<a href="javascript:void(0);" onClick="edtGrpUsu();"><img src="images/icons/edit.png"   alt="Altera" title="Altera" border="0" style="margin-right:20px;"></a>
											<a href="javascript:void(0);" onClick="delGrpUsu();"><img src="images/icons/delete.png" alt="Deleta" title="Deleta" border="0"></a>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
			
			<div id="tabs-2">
				<table border="0" cellspacing="4" cellpadding="0" align="center">
					<tr>
						<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Código</label></b></div></td>
						<td align="left"><input type="text" name="CTG_CODIGO" value="<?php if($CTG_CODIGO != "") echo $CTG_CODIGO; ?>"></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Descrição</label></b></div></td>
						<td align="left"><input type="text" name="CTG_DESCRICAO" value="<?php if($CTG_DESCRICAO != "") echo $CTG_DESCRICAO; ?>"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="btCateg" value="<?php if($CTG_CODIGO != 0) echo "Alterar"; else echo "Incluir"; ?>" style="margin-top:10px; margin-bottom:15px; height:30px; width:90px; align:center;">
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<table border="0" cellspacing="4" cellpadding="0" width="100%">
								<thead>
									<tr class="ui-widget-header" height="30px">
										<th align='center'><!-- <input type="checkbox" name="chkGridMenu<?php //echo $indPai; ?>" onclick="selAllMen();"> --></th>
										<th align="center" width="30px"><strong>Código</strong></th>
										<th align="left" width="80px"><strong>Categoria</strong></th>
									</tr>
								</thead>
								<tbody>
								<?php
								$qr 	= "SELECT * FROM menus_cat ORDER BY CTG_CODIGO";
								$sql    = mysql_query($qr);
								$total  = mysql_num_rows($sql);
								$ind = 1;
								while($r = mysql_fetch_array($sql)){
									echo "<tr>".
										 "<td align='center' width='35px' bgcolor='"; echo linhaCor($ind); echo "'><input type='checkbox' name='chkCateg". $ind ."' value='". $r['CTG_CODIGO'] ."'></td>" .
										 "<td align='center' width='80px' bgcolor='"; echo linhaCor($ind); echo "'>". $r['CTG_CODIGO'] ."</td>".
										 "<td align='left' 	 bgcolor='"; echo linhaCor($ind); echo "'>". $r['CTG_DESCRICAO'] ."</td>".
										 "</tr>";

									$ind ++;
								}
								?>
								<tr height="40px">
									<td colspan="6" align="center">
										<a href="javascript:void(0);" onClick="edtCat();"><img src="images/icons/edit.png"   alt="Altera" title="Altera" border="0" style="margin-right:20px;"></a>
										<a href="javascript:void(0);" onClick="delCat();"><img src="images/icons/delete.png" alt="Deleta" title="Deleta" border="0"></a>
									</td>
								</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
			
			<div id="tabs-3">
				<table border="0" cellspacing="4" cellpadding="0" align="center">
					<?php
					$only_read = "";
					if($MEN_CODIGO != "" && $erro_t3_1 == ""){
					?>
						<tr>
							<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Código</label></b></div></td>
							<td align="left">
								<input type="text" size="40" maxlength="50" name="MEN_CODIGO_aux" value="<?php if($MEN_CODIGO != ""){ echo $MEN_CODIGO; } ?>" readonly disabled>
								<input type="hidden" name="MEN_CODIGO" value="<?php if($MEN_CODIGO != ""){ echo $MEN_CODIGO; } ?>">
							</td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Código</label></b></div></td>
							<td align="left"><input type="text" class="<?php if($erro_t3_1 != ""){echo "field_error";}else{echo "input";} ?>" size="40" maxlength="50" name="MEN_CODIGO" value="<?php if($MEN_CODIGO != ""){ echo $MEN_CODIGO; } ?>"></td>
						</tr>
					<?php } ?>
					<tr>
						<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Descrição Menu</label></b></div></td>
						<td align="left"><input type="text" class="<?php if($erro_t3_3 != ""){echo "field_error";}else{echo "input";} ?>" size="40" maxlength="50" name="MEN_NOME" value="<?php if($MEN_NOME != ""){ echo $MEN_NOME; } ?>"></td>
					</tr>
					<tr>
						<td class="td_cad"><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Categoria</label></b></div></td>
						<td align="left">
							<select name="MEN_CATEG" class="<?php if($erro_t3_2 != ""){echo "field_error";}else{echo "input_select";} ?>" onchange="">
							<?php
								$qr = "SELECT * FROM menus_cat ORDER BY CTG_CODIGO";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='0'>...Escolha...</option>";
								while($r = mysql_fetch_array($sql)){
									if ($MEN_CATEG_tmp == $r['CTG_CODIGO'])
										$selecionado = 'selected';
									else
										$selecionado = '';

									echo "<option value='". $r['CTG_CODIGO'] ."' ". $selecionado .">". $r['CTG_CODIGO'] ." - ". $r['CTG_DESCRICAO'] ."</option>";
								}
							?>
							</select>
						</td>
					</tr>
					<?php if ($MEN_NIVEL_tmp != 0){ ?>
					<tr>
						<td class="td_cad"><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Aninhar em</label></b></div></td>
						<td align="left">
							<select name="MEN_NIVEL" class="<?php if($erro_t3_4 != ""){echo "field_error";}else{echo "input_select";} ?>">
							<?php
								if ($MEN_CATEG_tmp == ""){
									//$qr = "SELECT * FROM menus WHERE MEN_NIVEL = 0 ORDER BY MEN_PRIORID";
								}else{
									//$qr = "SELECT * FROM menus WHERE MEN_NIVEL = 0 AND MEN_CATEG = '". $MEN_CATEG_tmp ."' ORDER BY MEN_PRIORID";
									//$qr = "SELECT * FROM menus WHERE MEN_NIVEL = 0 AND MEN_CATEG = '". $MEN_CATEG_tmp ."' ORDER BY MEN_CATEG";
								}
								
								$qr = "SELECT * FROM menus WHERE MEN_NIVEL = 0 ORDER BY MEN_CATEG";
								
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);
								$ind = 1;

								echo "<option value='0'>...Escolha...</option>";
								while($r = mysql_fetch_array($sql)){
									if ($MEN_NIVEL_tmp == $ind){
										$selecionado = 'selected';
									}else{
										$selecionado = '';
									}
									echo "<option value='". $ind ."' ". $selecionado .">". $ind ." - ". $r['MEN_NOME'] ."</option>";
									$ind ++;
								}
							?>
							</select>
						</td>
					</tr>
					<?php }else{ ?>
						<input type="hidden" name="MEN_NIVEL" value="0">
					<?php } ?>
					<tr>
						<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;"><font color="red">* </font>Prioridade</label></b></div></td>
						<td align="left"><input type="text" class="<?php if($erro_t3_5 != ""){echo "field_error";}else{echo "input";} ?>" size="9" maxlength="8" name="MEN_PRIORID" value="<?php if($MEN_PRIORID != ""){ echo $MEN_PRIORID; } ?>"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="btMenus" value="<?php if($MEN_CODIGO != ""){echo "Altera Menu";}else{echo "Incluir Menu";} ?>" style="margin-top:10px; margin-bottom:15px; height:30px; align:center;">
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">&nbsp;</td>
					</tr>
					<?php
					// ######################## INI - CONSULTA DE TODAS AS CATEGORIAS ########################
					$qrCTG = "SELECT * FROM menus_cat ";
					$sqlCTG = mysql_query($qrCTG);
					while($rCTG = mysql_fetch_array($sqlCTG)){
					?>
					<tr>
						<td colspan="2" align="center">
							<?php 
							echo "<br><h1>". $rCTG['CTG_DESCRICAO'] ."</h1><br>";

							$qr01 = "SELECT *
									   FROM menus 
									  WHERE MEN_CATEG = ". $rCTG['CTG_CODIGO'] ."
									  GROUP BY MEN_CATEG ";
							$sql01 = mysql_query($qr01);
							$total01 = mysql_num_rows($sql01);
							$indPai = 1;
							while($r01 = mysql_fetch_array($sql01)){
							?>
							<table border="0" cellspacing="4" cellpadding="0" align="center">
							<tr>
								<td align="center">
									<table border="0" cellspacing="4" cellpadding="0" width="100%">
										<thead>
											<tr class="ui-widget-header" height="30px">
												<th align='center'><!-- <input type="checkbox" name="chkGridMenu<?php //echo $indPai; ?>" onclick="selAllMen();"> --></th>
												<th align="left"   width="150px"><strong>Código</strong></th>
												<th align="left"   width="220px"><strong>Descrição Menu</strong></th>
												<th align="center" width="70px"><strong>Ordem</strong></th>
												<th align="left"   width="110px"><strong>Categoria</strong></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$qr = "SELECT * 
													 FROM menus
													WHERE MEN_CATEG = '". $r01['MEN_CATEG'] ."' 
													  AND MEN_NIVEL = 0
													ORDER BY MEN_CATEG, MEN_PRIORID";
											$sql    = mysql_query($qr);
											$total  = mysql_num_rows($sql);
											$indLin = 1;
											while($r = mysql_fetch_array($sql)){

												echo "<tr>
													  <td align='center' width='35px' bgcolor='"; echo linhaCor($indLin); echo "'><input type='checkbox' name='chkMenSel". $indPai ."' value='". $r['MEN_CODIGO'] ."'></td>
													  <td align='left'   bgcolor='"; echo linhaCor($indLin); echo "'>" . $r['MEN_CODIGO'] . "</td>";
												if ($r['MEN_NIVEL'] == "0"){ echo "<td align='left' bgcolor='"; echo linhaCor($indLin); echo "'><strong>" . $r['MEN_NOME'] . "</strong></td>"; }else{ echo "<td align='left'>" . $r['MEN_NOME'] . "</td>"; }
												echo "<td align='center' bgcolor='"; echo linhaCor($indLin); echo "'>". $r['MEN_PRIORID'] ."</td>".
													 "<td align='left'   bgcolor='"; echo linhaCor($indLin); echo "'>". buscaDB('menus_cat', 'CTG_CODIGO', $r['MEN_CATEG'], 'CTG_DESCRICAO') ."</td>";
													 //FUNCAO ALTERA POSICAO dos MENUS
													 //<td align='center' bgcolor='"; echo linhaCor($indLin); echo "'>
													 //	<a href='javascript:void(0);' onClick='edtMenu();'><img src='images/icons/ord_up.png'   alt='Sobe'  title='Sobe'  width='22px' height='22' border='0'></a>
													 // <a href='javascript:void(0);' onClick='edtMenu();'><img src='images/icons/ord_down.png' alt='Desce' title='Desce' width='22px' height='22' border='0'></a>
													 //</td>
												echo "</tr>";

												$indLin ++;
												
												$qr02 = "SELECT * FROM menus
														  WHERE MEN_CATEG = '". $r01['MEN_CATEG'] ."'
															AND MEN_NIVEL = '". $r['MEN_PRIORID'] ."'
														  ORDER BY MEN_NIVEL, MEN_CATEG, MEN_PRIORID";
												$sql02   = mysql_query($qr02);
												$total02 = mysql_num_rows($sql02);
												while($r02 = mysql_fetch_array($sql02)){
													$desc_cat = buscaDB('menus_cat', 'CTG_CODIGO', $r02['MEN_CATEG'], 'CTG_DESCRICAO');

													echo "<tr>
														  <td align='center' bgcolor='"; echo linhaCor($indLin); echo "'><input type='checkbox' name='chkMenSel". $indPai ."' value='". $r02['MEN_CODIGO'] ."'></td>
														  <td align='left'   bgcolor='"; echo linhaCor($indLin); echo "'>" . $r02['MEN_CODIGO'] . "</td>";
													if ($r02['MEN_NIVEL'] == "0"){ echo "<td align='left' bgcolor='"; echo linhaCor($indLin); echo "'><strong>&nbsp;&nbsp;&nbsp;&nbsp;". $r02['MEN_NOME'] ."</strong></td>"; }else{ echo "<td align='left' bgcolor='"; echo linhaCor($indLin); echo "'>&nbsp;&nbsp;&nbsp;&nbsp;" . $r02['MEN_NOME'] . "</td>"; }
													echo "<td align='center' bgcolor='"; echo linhaCor($indLin); echo "'>". $r02['MEN_PRIORID'] ."</td>
														  <td align='left'   bgcolor='"; echo linhaCor($indLin); echo "'>$desc_cat</td>";
														  //FUNCAO ALTERA POSICAO dos MENUS
														  //<td align='center' bgcolor='"; echo linhaCor($indLin); echo "'>
														  //<a href='javascript:void(0);' onClick='edtMenu();'><img src='images/icons/ord_up.png'   alt='Sobe'  title='Sobe'  width='22px' height='22' border='0'></a>
														  //<a href='javascript:void(0);' onClick='edtMenu();'><img src='images/icons/ord_down.png' alt='Desce' title='Desce' width='22px' height='22' border='0'></a>
														  //</td>
													echo "</tr>";

													$indLin ++;
												}

											}
											?>
											<tr height="40px">
												<td colspan="6" align="center">
													<a href="javascript:void(0);" onClick="edtMenu();"><img src="images/icons/edit.png"   alt="Altera" title="Altera" border="0" style="margin-right:20px;"></a>
													<a href="javascript:void(0);" onClick="delMenu();"><img src="images/icons/delete.png" alt="Deleta" title="Deleta" border="0"></a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							</table>
							<?php 
								$indPai ++;
							} 
							// ######################## INI - CONSULTA DE TODAS AS CATEGORIAS ########################
							?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			
			<div id="tabs-4">
				<table border="0" cellspacing="4" cellpadding="0" align="center" width="100%">
					<tr>
						<td width="30%" class="td_cad"><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Categoria</label></b></div></td>
						<td width="30%" class="td_cad" align="left">
							<select name="GUM_CATEG" class="<?php if($erro_t4_2 != ""){echo "field_error";}else{echo "input_select";} ?>" onchange="changeGrpUsuMenu(window.document.formCadUsu.MGR_GRU_CODIGO.value,this.value);">
							<?php
								$qr = "SELECT * FROM menus_cat ORDER BY CTG_CODIGO";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);
								
								echo "<option value=''>...Escolha...</option>";
								while($r = mysql_fetch_array($sql)){
									if ($GUM_CATEG == $r['CTG_CODIGO']){
										$selecionado = 'selected';
									}else{
										$selecionado = '';
									}
									echo "<option value='". $r['CTG_CODIGO'] ."' ". $selecionado .">". $r['CTG_DESCRICAO'] ."</option>";
								}
							?>
						</td>
					</tr>
					<tr>
						<td width="30%" class="td_cad" align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Grupo Usuário</label></b></td>
						<td width="30%" class="td_cad" align="left">
							<select name="MGR_GRU_CODIGO" class="<?php if($erro_uf != ""){echo "field_error";}else{echo "input_select";} ?>" onchange="changeGrpUsuMenu(this.value,window.document.formCadUsu.GUM_CATEG.value);">
							<?php
								$qr = "SELECT * FROM grupousr ORDER BY GRU_CODIGO";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='' selected>...Escolha...</option>";
								while($r = mysql_fetch_array($sql)){
									if ($MGR_GRU_CODIGO_tmp == $r['GRU_CODIGO']){
										$selecionado = 'selected';
									}else{
										$selecionado = '';
									}
									echo "<option value='". $r['GRU_CODIGO'] ."' ". $selecionado .">". $r['GRU_NOME'] ."</option>";
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div style="margin-bottom:5px; margin-right:550px;"></div>
						</td>
					</tr>
				</table>
				
				<table border="0" cellspacing="4" cellpadding="0" width="100%">
					<tr>
						<td class="td_cad" align="center">
							<table border="0" cellspacing="4" cellpadding="0" >
								<thead>
									<?php if($MGR_GRU_CODIGO_tmp != ""){ ?>
									<tr class="ui-widget-header" height="30px">
										<th align='center'><input type="checkbox" name="chkGridGrpUsuMenu" onclick="selAllGrpUsuMenu();"></th>
										<th align="center" width="230"><strong>Menus</strong></th>
									</tr>
									<?php } ?>
								</thead>
								<tbody>
									<?php
										// ################### PAI
										$qr = "
										SELECT menus_grp.*, menus.*
										  FROM menus_grp AS menus_grp
										  LEFT JOIN menus AS menus ON menus.MEN_CODIGO = menus_grp.MGR_MEN_CODIGO
										 WHERE menus_grp.MGR_GRU_CODIGO = $MGR_GRU_CODIGO_tmp
										   AND menus.MEN_NIVEL = 0
										   AND menus.MEN_CATEG = '$GUM_CATEG'
										 ORDER BY MEN_CATEG, MEN_NIVEL, MEN_PRIORID ";
										$sql     = mysql_query($qr);
										$total   = mysql_num_rows($sql);
										$ind  = 1;
										$indLin  = 1;
										$tmp_categ = 0;										
										while($r = mysql_fetch_array($sql)){
											if ($r['MGR_SHOW'] == "S"){
												$selecionado = 'checked';
											}else{
												$selecionado = '';
											}

											echo "<tr>
												 <td align='center' bgcolor='"; echo linhaCor($indLin); echo "'>
													<input type='checkbox' name='chkGrpUsuMenuSel". $ind ."' value='". $r['MEN_CODIGO'] ."' ". $selecionado  .">
												 </td>
												 <td align='left'   bgcolor='"; echo linhaCor($indLin); echo "'><strong><font size='3'>" . $r['MEN_NOME'] . "</font></strong></td>
												 </tr>";												

											$indLin ++;
											
											$tmp_categ = $r['MEN_CATEG'];
											$qrFilho = "
											SELECT menus_grp.*, menus.*
											  FROM menus_grp AS menus_grp
											  LEFT JOIN menus AS menus ON menus.MEN_CODIGO = menus_grp.MGR_MEN_CODIGO
											 WHERE menus_grp.MGR_GRU_CODIGO = $MGR_GRU_CODIGO_tmp
											   AND menus.MEN_CATEG = '$tmp_categ'
											   AND menus.MEN_NIVEL = $ind
											 GROUP BY MEN_CATEG, MEN_NIVEL, MEN_PRIORID ";
											$sqlFilho   = mysql_query($qrFilho);
											$totalFilho = mysql_num_rows($sqlFilho);
											$indFilho   = 1;
											while($r2 = mysql_fetch_array($sqlFilho)){
												if ($r2['MGR_SHOW'] == "S"){
													$selecionado2 = 'checked';
												}else{
													$selecionado2 = '';
												}

												echo "<tr>".
													 "<td align='center' bgcolor='"; echo linhaCor($indLin); echo "'>
														<input type='checkbox' name='chkGrpUsuMenuSel". $ind . $indFilho ."' value='". $r2['MEN_CODIGO'] ."' ". $selecionado2  .">
													 </td>".
													 "<td align='left'   bgcolor='"; echo linhaCor($indLin); echo "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $r2['MEN_NOME'] ."</td>".
													 "</tr>";
													 
												$indFilho ++;
												$indLin ++;
											}
											$ind ++;
										}
									?>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center">
							<?php if($MGR_GRU_CODIGO_tmp != ""){ ?>
							<input type="submit" name="btGrpUsuMenu" value="Gravar" onclick="gravaGrpUsuMenu();" style="margin-top:10px; margin-bottom:15px; height:30px; width:90px; align:center;">
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">&nbsp;</td>
					</tr>
				</table>
			</div>
			
			<div id="tabs-5">
				<table border="0" cellspacing="4" cellpadding="0" align="center">
					<tr>
						<td class="td_cad" align="right">
							<b><label for="name" style="margin-right:5px;"><font color="red">* </font>Usuário(CPF/CNPJ)</label></b></div>
							<input type="text" class="<?php if($erro_t5_1 != ""){echo "field_error";}else{echo "input";} ?>" size="21" maxlength="20" name="USG_USR_PES_CPFCNPJ" value="<?php if($USG_USR_PES_CPFCNPJ != ""){ echo $USG_USR_PES_CPFCNPJ; } ?>" onblur="fnBlurUsuGrpUsu();">
						</td>
						<td>
							<a href="javascript:janelaSecundaria('BuscaUsu.php', 550, 450);">
								<img src="images/icons/search.png" width="16" height="16" alt="Procurar" title="Procurar" border="0">
							</a>
							<input type="text" size="30" name="PES_NOME" value="<?php if($PES_NOME != ""){ echo $PES_NOME; } ?>" readonly disabled>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right">
							<b><label for="name" style="margin-right:5px;"><font color="red">* </font>Grupo Usuário</label></b>
							<input type="text" class="<?php if($erro_t5_2 != ""){echo "field_error";}else{echo "input";} ?>" size="9" maxlength="11" name="USR_GRU_CODIGO" value="<?php if($USR_GRU_CODIGO != ""){ echo $USR_GRU_CODIGO; } ?>" onblur="fnBlurUsuGrpUsu();">
						</td>
						<td>
							<a href="javascript:janelaSecundaria('BuscaGrpUsu.php', 450, 350);">
								<img src="images/icons/search.png" width="16" height="16" alt="Procurar" title="Procurar" border="0">
							</a>
							<input type="text" size="30" name="GRU_NOME_02" value="<?php if($GRU_NOME_02 != ""){ echo $GRU_NOME_02; } ?>" readonly disabled>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="center">
							<input type="submit" name="btUsuGrpUsu" value="<?php if($PES_NOME != ""){echo "Alterar";}else{echo "Incluir";} ?>" style="margin-top:10px; margin-bottom:15px; height:30px; width:90px; align:center;">
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td class="td_cad" colspan="4" align="center">
							<table border="0" cellspacing="4" cellpadding="0" >
								<thead>
									<tr class="ui-widget-header" height="30px">
										<th align='center'><input type="checkbox" name="chkGridUsuGrpUsu" onclick="selAllUsuGrpUsu();"></th>
										<th align="left" width="130px"><strong>CPF / CNPJ</strong></th>
										<th align="left" width="250px"><strong>Nome Usuário</strong></th>
										<th align="left" width="120px"><strong>Grupo Usuário</strong></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$qr = " SELECT user.USR_PES_CPFCNPJ, pessoa.PES_NOME, grupousr.GRU_NOME
												  FROM user AS user
												  LEFT JOIN grupousr ON grupousr.GRU_CODIGO = user.USR_GRU_CODIGO
												 INNER JOIN pessoa	 ON pessoa.PES_CPFCNPJ  = user.USR_PES_CPFCNPJ
												 ORDER BY pessoa.PES_NOME ";
										$sql = mysql_query($qr);
										$total = mysql_num_rows($sql);
										$ind = 1;
										while($r = mysql_fetch_array($sql)){
											echo "<tr>".
												 "<td align='center' bgcolor='"; echo linhaCor($ind); echo "'><input type='checkbox' name='chkUsuGrpUsu". $ind ."' value='". $r['USR_PES_CPFCNPJ'] ."'></td>" .
												 "<td align='left'   bgcolor='"; echo linhaCor($ind); echo "'width='145px'>" . $r['USR_PES_CPFCNPJ'] . "&nbsp;</td>".
											     "<td align='left'   bgcolor='"; echo linhaCor($ind); echo "'>" . $r['PES_NOME'] . "&nbsp;&nbsp;</td>".
												 "<td align='left'   bgcolor='"; echo linhaCor($ind); echo "'>" . $r['GRU_NOME'] . "</td>".
												 "</tr>";
											$ind ++;
										}
									?>
									<tr height="40px">
										<td colspan="4" align="center">
											<a href="javascript:void(0);" onClick="edtUsuGrpUsu();"><img src="images/icons/edit.png" alt="Altera" title="Altera" border="0"></a>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<input type="hidden" name="GRU_CODIGO" value="<?php if($GRU_CODIGO != ""){ echo $GRU_CODIGO; } ?>">	
	<input type="hidden" name="SelEdtGrpUsu" 	value="">
	<input type="hidden" name="SelDelGrpUsu" 	value="">
	<input type="hidden" name="SelEdtCat" 		value="">
	<input type="hidden" name="SelDelCat" 		value="">
	<input type="hidden" name="SelEdtMenu"   	value="">
	<input type="hidden" name="SelDelMenu" 	 	value="">
	<input type="hidden" name="SelEdtUsuGrpUsu" value="">
	<input type="hidden" name="SelDelUsuGrpUsu" value="">
	<input type="hidden" name="SelDelGrpUsu" 	value="">
	<input type="hidden" name="BlurUsuGrpUsu"   value="">
	<input type="hidden" name="MGR_GRU_CODIGO_CHANGE" value="">
	<input type="hidden" name="MGR_MEN_CODIGO_CHANGE" value="">
	<input type="hidden" name="MGR_MEN_NIVEL_CHANGE"  value="">
	<input type="hidden" name="GUM_CATEG_CHANGE" 	  value="">
	
</form>
</html>