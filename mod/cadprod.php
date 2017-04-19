<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
	<script language="javascript" src="script/x_mascara.js"></script>

	<link rel="stylesheet" href="css/jquery.ui.all.css">

	<script src="script/jquery-1.5.1.js"></script>
	<script src="script/jquery.cookie.js"></script>
	<script src="script/jquery.ui.core.js"></script>
	<script src="script/jquery.ui.widget.js"></script>
	<script src="script/jquery.ui.tabs.js"></script>
	

	<script language="javascript" type="text/javascript">
		
		$(function() {
			$( "#tabs" ).tabs({
				cookie: {
					// store cookie for a day, without, it would be a session cookie
					expires: 1
				}
			});
		});
	
		function focusField(){
			/*
			if (window.document.formCadProduto.PRD_VLR_CUSTO.value = 0){
				window.document.formCadProduto.PRD_VLR_CUSTO.value = '';
			}
			*/
		}
		
		function calcPerc(){
			var vlrVenda    = window.document.formCadProduto.PRD_VLR_VENDA.value;
			var vlrPromocao = window.document.formCadProduto.PRD_VLR_PROMO.value;
			var vlrDesconto = window.document.formCadProduto.PRD_VLR_DES.value;				
							
			if (window.document.formCadProduto.PRD_VLR_DES.value == ""){
				if (window.document.formCadProduto.PRD_VLR_PROMO.value != "")
					window.document.formCadProduto.PRD_VLR_DES.value = "78999";
			}

			if (vlrPromocao == ""){
				if (vlrDesconto != ""){
					/*
					alert(vlrDesconto);
					alert(vlrVenda);
					alert( ((vlrVenda * vlrDesconto) / 100) );
					*/
					/*window.document.formCadProduto.PRD_VLR_PROMO.value = window.document.formCadProduto.PRD_VLR_VENDA.value * ( (window.document.formCadProduto.PRD_VLR_VENDA.value - window.document.formCadProduto.PRD_VLR_DES.value) / 100 );*/
				}
			}
		}
		
		function delProdImg(produto){
			if (produto == ""){
				alert("Selecione um Produto.");
				window.parent.document.formCadProduto.SelDelProdImg.value = "produto";
			}else{
				if ( confirm('Deseja excluir as imagens do Produto ' + produto) ){
					window.parent.document.formCadProduto.SelDelProdImg.value = produto;
					window.parent.document.formCadProduto.submit();
				}
			}
		}
	</script>
	</head>

<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

/* ################################################ INICIALIZACAO ################################################ */
$c_erros = "";

$PRD_CODIGO 	= "";
$PRD_TIPO_SEXO  = "";
$PRD_ESTILO		= "";
$PRD_TIPO_PROD	= "";
$PRD_MODELO		= "";
$PRD_NOME		= "";
$PRI_IMAGEM		= "";
$PRD_MARCA		= "";
$PRD_DATA_INI	= "";
$PRD_DATA_FIM	= "";
$PRD_ATIVO		= "";
$PRD_FRET_GRAT	= "";
$PRD_QTD_ESTQ	= "";
$PRD_VLR_CUSTO  = "";
$PRD_VLR_VENDA  = "";
$PRD_VLR_PROMO  = "";
$PRD_VLR_DESC 	= "";
$PRD_MATERIAL	= "";
$PRD_OBS		= "";
$PRD_COR		= "";
$PRD_TAM		= "";

$PRI_IMAGEM_path = "";

$erro_tam = "input";

/* ################################################ INICIALIZACAO ################################################ */

$btIncluir = "";
$SelEdtProd = "";
$SelDelProd = "";
$SelDelProdImg = "";

if (isset($_POST['btIncluir']))	$btIncluir = $_POST['btIncluir'];
if (isset($_POST['SelEdtProd']))$SelEdtProd = $_POST['SelEdtProd'];
if (isset($_POST['SelDelProd']))$SelDelProd = $_POST['SelDelProd'];
if (isset($_POST['SelDelProdImg'])){
	$SelDelProdImg = $_POST['SelDelProdImg'];
	if ($SelDelProdImg != "produto")
		$PRD_CODIGO = $SelDelProdImg;
}

// at_o_combo
$at_cmb = "";
if (isset($_POST['at_cmb']))	$at_cmb = $_POST['at_cmb'];

/* ##################### INSERCAO ##################### */
if ($at_cmb == "s" && $SelEdtProd == "" && $SelDelProd == "" && $SelDelProdImg == ""){
	$c_erros = "";	
	
	// Verifica codigo do produto
	//$num_busca=0 "Sem Registro" | $num_busca=1 "Com Registro"
	if($btIncluir != "Alterar Produto"){
		$sql_busca = "SELECT MAX(PRD_CODIGO) AS MAX_COD FROM produto";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$PRD_CODIGO	= $fet_busca['MAX_COD'] + 1;
	}else{
		$PRD_CODIGO = "";
		if (isset($_POST['PRD_CODIGO'])){
			$PRD_CODIGO = $_POST['PRD_CODIGO'];
		}
	}

	$PRD_TIPO_SEXO = "";
	if (isset($_POST['PRD_TIPO_SEXO'])){
		$PRD_TIPO_SEXO = $_POST['PRD_TIPO_SEXO'];
	}

	$erro_estilo = "";
	$PRD_ESTILO = "";
	if (isset($_POST['PRD_ESTILO'])){
		$PRD_ESTILO = $_POST['PRD_ESTILO'];
	}
	if ($PRD_ESTILO == ""){
		$c_erros = $c_erros . ",Estilo não informado.";
		$erro_estilo = "erro";
	}	
	
	$erro_tp_prd = "";
	$PRD_TIPO_PROD = "";
	if (isset($_POST['PRD_TIPO_PROD'])){
		$PRD_TIPO_PROD = $_POST['PRD_TIPO_PROD'];
	}	
	if ($PRD_TIPO_PROD == ""){ 
		$c_erros = $c_erros . ",Tipo de Produto não informado.";
		$erro_tp_prd = "erro";
	}

	$erro_modelo = "";
	$PRD_MODELO	= "";
	if (isset($_POST['PRD_MODELO'])){
		$PRD_MODELO = $_POST['PRD_MODELO'];
	}
	if ($PRD_MODELO == ""){ 
		$c_erros = $c_erros . ",Modelo não informado.";
		$erro_modelo = "erro";
	}
	
	$erro_marca = "";
	$PRD_MARCA = "";
	if (isset($_POST['PRD_MARCA'])){
		$PRD_MARCA = $_POST['PRD_MARCA'];
	}
	if ($PRD_MARCA == ""){ 
		$c_erros = $c_erros . ",Marca não informada.";
		$erro_marca = "erro";
	}
	
	$erro_nome_prd = "";
	$PRD_NOME = "";
	if (isset($_POST['PRD_NOME'])){
		$PRD_NOME = $_POST['PRD_NOME'];
	}
	if ($PRD_NOME == ""){ 
		$c_erros = $c_erros . ",Nome não informado.";
		$erro_nome_prd = "erro";
	}
	
	$erro_material = "";
	$PRD_MATERIAL = "";
	if (isset($_POST['PRD_MATERIAL'])){
		$PRD_MATERIAL = $_POST['PRD_MATERIAL'];
	}
	if ($PRD_MATERIAL == ""){ 
		$c_erros = $c_erros . ",Material não informado.";
		$erro_material = "erro";
	}

	/* COR */
	$lst_cor = "";
	for($i = 0 ; $i < 6 ; $i++ ){
		if (isset($_POST['_cor'. $i])){
			if ($_POST['_cor'. $i] != ""){
				if ($lst_cor != "")
					$lst_cor = $lst_cor .",". $_POST['_cor'. $i];
				else
					$lst_cor = $_POST['_cor'. $i];
			}
		}
	}

	$PRD_COR = $lst_cor;
	if ($PRD_COR == ""){
		$c_erros = $c_erros . ",Informe ao menos uma Cor.";
	}else{
		$_SESSION['sess_lst_cor'] = $PRD_COR;
	}

	/* COR DESCRICAO */
	$lst_cor_desc = "";
	for($i = 0 ; $i < 6 ; $i++ ){
		if (isset($_POST['_cor_desc'. $i])){
			if ($_POST['_cor_desc'. $i] != ""){
				if ($lst_cor_desc != "")
					$lst_cor_desc = $lst_cor_desc .",". $_POST['_cor_desc'. $i];
				else
					$lst_cor_desc = $_POST['_cor_desc'. $i];
			}
		}
	}

	$PRD_COR_DESC = $lst_cor_desc;
	if ($PRD_COR_DESC == ""){
		$c_erros = $c_erros . ",Informe a Descrição da Cor.";
	}else{
		$_SESSION['sess_lst_cor_desc'] = $PRD_COR_DESC;
	}
	
	$lst_tam = "";
	for($i = 0 ; $i < 9 ; $i++ ){
		if (isset($_POST['PRD_TAM'. $i])){
			if ($_POST['PRD_TAM'. $i] != ""){
				if ($lst_tam != "")
					$lst_tam = $lst_tam .",". $_POST['PRD_TAM'. $i];
				else
					$lst_tam = $_POST['PRD_TAM'. $i];
			}
		}
	}
	$PRD_TAM = $lst_tam;
	if ($PRD_TAM == ""){
		$c_erros = $c_erros . ",Informe ao menos um Tamanho.";
		$erro_tam = "erro";
	}

	$PRD_DATA_INI = "";
	if (isset($_POST['PRD_DATA_INI'])){
		$PRD_DATA_INI = $_POST['PRD_DATA_INI'];
	}

	$PRD_ATIVO = 'N';
	if(isset($_POST['PRD_ATIVO']))
		if($_POST['PRD_ATIVO'] == 'on')
			$PRD_ATIVO = 'S';
	
	$PRD_FRET_GRAT = 'N';
	if(isset($_POST['PRD_FRET_GRAT']))
		if($_POST['PRD_FRET_GRAT'] == 'on')
			$PRD_FRET_GRAT = 'S';
	
	$erro_qtd_estq = "";
	$PRD_QTD_ESTQ = "";
	if (isset($_POST['PRD_QTD_ESTQ'])){
		$PRD_QTD_ESTQ = $_POST['PRD_QTD_ESTQ'];
	}
	if ($PRD_QTD_ESTQ == ""){
		$c_erros = $c_erros . ",Quantidade em Estoque não informada.";
		$erro_qtd_estq = "erro";
	}
	if ($PRD_QTD_ESTQ <= 0){
		$c_erros = $c_erros . ",Quantidade em Estoque deve ser maior que zero.";
		$erro_qtd_estq = "erro";
	}
	
	$PRD_DATA_FIM = "";
	if (isset($_POST['PRD_DATA_FIM'])){
		$PRD_DATA_FIM = $_POST['PRD_DATA_FIM'];
	}

	$erro_vlrcusto = "";
	$PRD_VLR_CUSTO = 0;
	if (isset($_POST['PRD_VLR_CUSTO'])){
		$PRD_VLR_CUSTO = $_POST['PRD_VLR_CUSTO'];
		$PRD_VLR_CUSTO = str_replace(",",".",str_replace(".","",$PRD_VLR_CUSTO));
	}
	if ($PRD_VLR_CUSTO == ""){ 
		$c_erros = $c_erros . ",Valor Custo não informado.";
		$erro_vlrcusto = "erro";
	}

	$erro_vlrvenda = "";
	$PRD_VLR_VENDA = 0;
	if (isset($_POST['PRD_VLR_VENDA'])){
		$PRD_VLR_VENDA = $_POST['PRD_VLR_VENDA'];
		$PRD_VLR_VENDA = str_replace(",",".",str_replace(".","",$PRD_VLR_VENDA));
	}
	if ($PRD_VLR_VENDA == ""){ 
		$c_erros = $c_erros . ",Valor Venda não informado.";
		$erro_vlrvenda = "erro";
	}

	$erro_vlrpromo = "";
	$PRD_VLR_PROMO = 0;
	if (isset($_POST['PRD_VLR_PROMO'])){
		$PRD_VLR_PROMO = $_POST['PRD_VLR_PROMO'];
		// Para gravar no banco vc ira usar a funcao php str_replace
		$PRD_VLR_PROMO = str_replace(",",".",str_replace(".","",$PRD_VLR_PROMO));
	}
	if ($PRD_VLR_PROMO == ""){ 
		$c_erros = $c_erros . ",Valor Promocional não informado.";
		$erro_vlrpromo = "erro";
	}

	$erro_per_desc = "";
	$PRD_VLR_DESC = 0;
	if (isset($_POST['PRD_VLR_DESC'])){
		$PRD_VLR_DESC = $_POST['PRD_VLR_DESC'];
		$PRD_VLR_DESC = str_replace(",",".",str_replace(".","",$PRD_VLR_DESC));
	}
	if ($PRD_VLR_DESC == ""){ 
		$c_erros = $c_erros . ",Valor Desconto não informado.";
		$erro_per_desc = "erro";
	}
	
	$PRD_OBS = "";
	if (isset($_POST['PRD_OBS'])){
		$PRD_OBS = $_POST['PRD_OBS'];
	}

	/* ############################### Envia IMAGENS ############################### */
	for($i = 0 ; $i < 6 ; $i++ ){
		if( $_FILES ) { // Verificando se existe o envio de arquivos.
			if( $_FILES['PRI_IMAGEM'.$i]['name'] <> "" ) { // Verifica se o campo não está vazio.
				/* NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO */
				if(!is_dir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA))
					 mkdir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA);
				if(!is_dir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO))
					 mkdir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO);
				if(!is_dir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/"))
					 mkdir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/");
				if(!is_dir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/". $PRD_CODIGO ."/"))
					 mkdir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/". $PRD_CODIGO ."/");
				/* NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO */
				
				$dir 	 = "/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/". $PRD_CODIGO ."/";
				$tmpName = $_FILES['PRI_IMAGEM'.$i]['tmp_name']; // Recebe o arquivo temporário.
				$name 	 = $_FILES['PRI_IMAGEM'.$i]['name']; 	 // Recebe o nome do arquivo.

				if ($name != ""){
					// move_uploaded_file( $arqTemporário, $nomeDoArquivo )
					if(!file_exists($dir . $name)){
						if( move_uploaded_file( $tmpName, $dir . $name ) ) { // move_uploaded_file irá realizar o envio do arquivo.
							// ################################ Copia p/ thumb
							if(!is_dir($dir ."thumb/"))
								mkdir($dir ."thumb/");
							if (!copy($dir . $name, $dir ."thumb/". $name )) {
								$c_erros = $c_erros . ",ERRO ao copiar imagem thumbnail";
							}
							// ################################ Copia p/ Imagem em tamanho medio
							if(!is_dir($dir ."small/"))
								mkdir($dir ."small/");
							if (!copy($dir . $name, $dir ."small/". $name )) {
								$c_erros = $c_erros . ",ERRO ao copiar imagem Média";
							}
						}else{
							$c_erros = $c_erros . ",ERRO no Envio da Imagem";
						}
					}else{
						$c_erros = $c_erros . ",Imagem já existe";
					}

					$txt_path = $dir . $name;
					if ($txt_path != ""){
						if ($PRI_IMAGEM_path != "")
							$PRI_IMAGEM_path = $PRI_IMAGEM_path .",". $txt_path;
						else
							$PRI_IMAGEM_path = $txt_path;
					}
				}
			}else{
				// ################################ IMAGEM Principal				
				$txt_path = $_POST['PRI_IMAGEM_path'.$i];
				if ($txt_path != ""){
					if ($PRI_IMAGEM_path != "")
						$PRI_IMAGEM_path = $PRI_IMAGEM_path .",". $txt_path;
					else
						$PRI_IMAGEM_path = $txt_path;
				}
			}
		}
	}	
	if ($PRI_IMAGEM_path == ""){
		$c_erros = $c_erros . ",Insira ao menos uma Imagem.";
		$erro_img = "erro";
	}
	$PRI_IMAGEM = $PRI_IMAGEM_path;
	/* ############################### Envia IMAGENS ############################### */
	
	
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		// produto
		$sql_busca = "SELECT * FROM produto WHERE PRD_CODIGO = $PRD_CODIGO ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca == 0){
			$sql_busca = "INSERT INTO produto (PRD_CODIGO,PRD_TIPO_SEXO,PRD_TIPO_PROD,PRD_ESTILO,PRD_MODELO,PRD_NOME,PRD_MARCA,PRD_DATA_INI,PRD_DATA_FIM,PRD_ATIVO,PRD_FRET_GRAT,PRD_QTD_ESTQ,PRD_VLR_CUSTO,PRD_VLR_DESC,PRD_VLR_VENDA,PRD_VLR_PROMO,PRD_MATERIAL,PRD_OBS,PRD_COR,PRD_COR_DESC,PRD_TAM)
						  VALUES ($PRD_CODIGO,'$PRD_TIPO_SEXO','$PRD_TIPO_PROD','$PRD_ESTILO','$PRD_MODELO','$PRD_NOME','$PRD_MARCA','$PRD_DATA_INI','$PRD_DATA_FIM','$PRD_ATIVO','$PRD_FRET_GRAT','$PRD_QTD_ESTQ','$PRD_VLR_CUSTO','$PRD_VLR_DESC','$PRD_VLR_VENDA','$PRD_VLR_PROMO','$PRD_MATERIAL','$PRD_OBS','$PRD_COR','$PRD_COR_DESC','$PRD_TAM')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			
			$PRD_TIPO_SEXO   = "";
			$PRD_ESTILO		 = "";
			$PRD_TIPO_PROD	 = "";
			$PRD_MODELO		 = "";
			$PRD_NOME		 = "";
			$PRD_MARCA		 = "";
			$PRD_DATA_INI	 = "";
			$PRD_DATA_FIM	 = "";
			$PRD_ATIVO		 = "";
			$PRD_FRET_GRAT	 = "";
			$PRD_QTD_ESTQ	 = "";
			$PRD_VLR_CUSTO   = "";
			$PRD_VLR_VENDA   = "";
			$PRD_VLR_PROMO	 = "";
			$PRD_VLR_DESC = "";
			$PRD_MATERIAL	 = "";
			$PRD_OBS		 = "";
			$PRD_COR		 = "";
			$PRD_COR_DESC	 = "";
			$PRD_TAM		 = "";
			
			/* zera sessao listagem de cores */
			$_SESSION['sess_lst_cor'] = "";
			$_SESSION['sess_lst_cor_desc'] = "";
		}else{
			$sql_busca = "
			UPDATE produto SET
			PRD_TIPO_SEXO   = '$PRD_TIPO_SEXO',
 			PRD_TIPO_PROD   = '$PRD_TIPO_PROD',
			PRD_ESTILO      = '$PRD_ESTILO',
			PRD_MODELO	  	= '$PRD_MODELO',
 			PRD_NOME        = '$PRD_NOME',
			PRD_MARCA       = '$PRD_MARCA',
			PRD_MODELO      = '$PRD_MODELO',
			PRD_DATA_INI    = '$PRD_DATA_INI',
			PRD_DATA_FIM    = '$PRD_DATA_FIM',
			PRD_ATIVO		= '$PRD_ATIVO',
			PRD_FRET_GRAT   = '$PRD_FRET_GRAT',
			PRD_QTD_ESTQ	= '$PRD_QTD_ESTQ',
			PRD_VLR_CUSTO   = '$PRD_VLR_CUSTO',
			PRD_VLR_DESC	= '$PRD_VLR_DESC',
			PRD_VLR_VENDA   = '$PRD_VLR_VENDA',
			PRD_VLR_PROMO   = '$PRD_VLR_PROMO',
			PRD_MATERIAL    = '$PRD_MATERIAL',
			PRD_OBS         = '$PRD_OBS',
			PRD_COR         = '$PRD_COR',
			PRD_COR_DESC    = '$PRD_COR_DESC',
			PRD_TAM         = '$PRD_TAM'
			WHERE PRD_CODIGO = $PRD_CODIGO ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			/* zera sessao listagem de cores */
			$_SESSION['sess_lst_cor'] = "";
			$_SESSION['sess_lst_cor_desc'] = "";
		}

		$sql_busca = "SELECT * FROM prod_img WHERE PRD_PRI_CODIGO = $PRD_CODIGO ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca == 0){
			$sql_busca = "INSERT INTO prod_img (PRD_PRI_CODIGO,PRI_IMAGEM)
						  VALUES ($PRD_CODIGO,'$PRI_IMAGEM_path')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());

			$PRI_IMAGEM_path = "";
		}else{
			$sql_busca = "
			UPDATE prod_img SET
 			PRI_IMAGEM = '$PRI_IMAGEM_path'
			WHERE PRD_PRI_CODIGO = $PRD_CODIGO ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
	}
	/* ##################### INSERCAO ##################### */
}

/* ##################### CONSULTA ##################### */
if (($PRD_CODIGO != "" || $SelEdtProd != "") && ($c_erros == "")){
	
	if ($PRD_CODIGO == "" && $SelEdtProd != ""){
		$PRD_CODIGO = $SelEdtProd;
		$_SESSION['PRD_CODIGO'] = $SelEdtProd;
	}
	
	/* zera sessao listagem de cores */
	$_SESSION['sess_lst_cor'] = "";
	$_SESSION['sess_lst_cor_desc'] = "";
	
	$sql_busca = "SELECT * FROM produto WHERE PRD_CODIGO = $PRD_CODIGO ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0){
		$PRD_TIPO_SEXO   = $fet_busca['PRD_TIPO_SEXO'];
		$PRD_ESTILO		 = $fet_busca['PRD_ESTILO'];
		$PRD_TIPO_PROD	 = $fet_busca['PRD_TIPO_PROD'];
		$PRD_MODELO		 = $fet_busca['PRD_MODELO'];
		$PRD_NOME		 = $fet_busca['PRD_NOME'];
		$PRD_MARCA		 = $fet_busca['PRD_MARCA'];
		$PRD_DATA_INI	 = $fet_busca['PRD_DATA_INI'];
		$PRD_DATA_FIM	 = $fet_busca['PRD_DATA_FIM'];
		$PRD_ATIVO		 = $fet_busca['PRD_ATIVO'];
		$PRD_FRET_GRAT	 = $fet_busca['PRD_FRET_GRAT'];
		$PRD_QTD_ESTQ	 = $fet_busca['PRD_QTD_ESTQ'];
		$PRD_VLR_CUSTO   = str_replace(".",",",$fet_busca['PRD_VLR_CUSTO']);
		$PRD_VLR_DESC = str_replace(".",",",$fet_busca['PRD_VLR_DESC']);
		$PRD_VLR_VENDA   = str_replace(".",",",$fet_busca['PRD_VLR_VENDA']);
		$PRD_VLR_PROMO   = str_replace(".",",",$fet_busca['PRD_VLR_PROMO']);
		$PRD_MATERIAL	 = $fet_busca['PRD_MATERIAL'];
		$PRD_OBS		 = $fet_busca['PRD_OBS'];
		$PRD_COR		 = $fet_busca['PRD_COR'];
		$PRD_COR_DESC	 = $fet_busca['PRD_COR_DESC'];
		$PRD_TAM		 = $fet_busca['PRD_TAM'];
	}
	
	/* Busca IMAGENS */
	$sql_busca = "SELECT * FROM prod_img WHERE PRD_PRI_CODIGO = $PRD_CODIGO ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0){
		$PRI_IMAGEM		 = $fet_busca['PRI_IMAGEM'];
	}
}else{
	zeraCampos();
}

/* ##################### DELETA TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelProd != ""){
		
	$qr = "DELETE FROM produto WHERE PRD_CODIGO = '$SelDelProd' ";
	mysql_query($qr);	
	$qr = "DELETE FROM prod_img WHERE PRD_PRI_CODIGO = '$SelDelProd' ";
	mysql_query($qr);	

	zeraCampos();
}

/* ##################### DELETA TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelProdImg != ""){
	if( is_dir("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/". $PRD_CODIGO ."/") )
		rmdir_recurse("/home/quali197/public_html/imgMotoPod/Prod/". $PRD_MARCA ."/". $PRD_TIPO_SEXO ."/". $PRD_TIPO_PROD ."/". $PRD_CODIGO ."/");
	
	$qr = "DELETE FROM prod_img WHERE PRD_PRI_CODIGO = '$SelDelProdImg' ";
	mysql_query($qr);
	
	$PRI_IMAGEM = "";
	$btIncluir = "Alterar Produto";
}


/* ########################################## FUNCOES ########################################## */		
function rmdir_recurse($path) {
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

function zeraCampos(){
	if (isset($_SESSION['PRD_CODIGO'])){
		$_SESSION['PRD_CODIGO'] = "";
	}
	
	$PRD_TIPO_SEXO   = "";
	$PRD_ESTILO		 = "";
	$PRD_TIPO_PROD	 = "";
	$PRD_MODELO		 = "";
	$PRD_NOME		 = "";
	$PRI_IMAGEM		 = "";
	$PRD_MARCA		 = "";
	$PRD_DATA_INI	 = "";
	$PRD_DATA_FIM	 = "";
	$PRD_ATIVO		 = "";
	$PRD_FRET_GRAT	 = "";
	$PRD_QTD_ESTQ	 = "";
	$PRD_VLR_CUSTO   = "";
	$PRD_VLR_VENDA   = "";
	$PRD_VLR_PROMO   = "";
	$PRD_VLR_DESC = "";
	$PRD_MATERIAL	 = "";
	$PRD_OBS		 = "";
	$PRD_COR		 = "";
	$PRD_COR_DESC	 = "";
	$PRD_TAM		 = "";
}
/* ########################################## FUNCOES ########################################## */
/*if ($at_cmb == "s" && $c_erros == ""){
	if($btIncluir == "Incluir Produto")	
		echo msgAviso("Produto Incluído com Sucesso!","cadprod");
}

if ($at_cmb == "s" && $c_erros == ""){
	if($btIncluir == "Alterar Produto")
		echo msgAviso("Produto Alterado com Sucesso!","cadprod");
}
*/

if ($SelDelProd != "" && $c_erros == ""){
	echo msgAviso("Produto $PRD_CODIGO Eliminado com Sucesso!","cadprod");
}

?>

<!-- <div id="titulo">Produto</div> -->

<form id="formCadProduto" name="formCadProduto" action="cadprod" method="post" accept-charset="utf-8" enctype="multipart/form-data">

	<input type="hidden" name="at_cmb" value="s">
	<input type="hidden" name="PRD_CODIGO" value="<?php echo $PRD_CODIGO; ?>">

	<input type="hidden" name="_cor0" value="">
	<input type="hidden" name="_cor1" value="">
	<input type="hidden" name="_cor2" value="">
	<input type="hidden" name="_cor3" value="">
	<input type="hidden" name="_cor4" value="">
	<input type="hidden" name="_cor5" value="">	
	<input type="hidden" name="_cor_desc0" value="">
	<input type="hidden" name="_cor_desc1" value="">
	<input type="hidden" name="_cor_desc2" value="">
	<input type="hidden" name="_cor_desc3" value="">
	<input type="hidden" name="_cor_desc4" value="">
	<input type="hidden" name="_cor_desc5" value="">

	<div class="demo">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Produto</a></li>
				<li><a href="#tabs-2">Imagens</a></li>
				<li><a href="#tabs-3">Cores</a></li>
				<li><a href="#tabs-4">Tamanhos</a></li>
			</ul>
			<div id="tabs-1">
				<table border="0" cellspacing="4" cellpadding="0" width="760px" align="center">
					<!-- ########################### DADOS EMPRESA ########################### -->
					<tr>
						<td colspan="3">
							<table border="0" cellspacing="0" cellpadding="0" align="center" width="700px" height="25px">
								<tr align="center" height="25px">
									<td rowspan="2" width="170px"><font size="22px"><b><?php echo $PRD_CODIGO; ?></b></font></td>
									<td><u>Estilos</u></td>
									<td><u>Produtos</u></td>
									<td><u>Tamanhos</u></td>
									<td><u>Cores</u></td>
									<td><u>Materiais</u></td>
									<td><u>Marcas</u></td>
								</tr>
								<tr align="center">
									<td>
										<a href="javascript:janelaSecundaria('mod/cad_estilo.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/del_estilo.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
									<td>
										<a href="javascript:janelaSecundaria('mod/cad_tipo_prod.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/del_tipo_prod.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
									<td>
										<a href="javascript:janelaSecundaria('mod/cad_tamanho.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/del_tamanho.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
									<td>
										<a href="javascript:janelaSecundaria('mod/cad_cor.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/del_cor.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
									<td>
										<a href="javascript:janelaSecundaria('mod/cad_material.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/del_material.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
									<td>
										<a href="javascript:janelaSecundaria('mod/cad_marca.php', 700, 500);" title="Incluir"><img src="images/icons/plus.png"></a>
										&nbsp;&nbsp;
										<a href="javascript:janelaSecundaria('mod/del_marca.php', 700, 500);" title="Exkluir"><img src="images/icons/minus.png"></a>
									</td>
								</tr>
							</table></br>
						</td>
					</tr>
					<tr>
						<!-- ########################### COLUNA 01 ########################### -->
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Público</label></b></div></td>
									<td align="left">
										<?php 
										$tp_sex_sel_f = "";
										$tp_sex_sel_m = "";
										if ($PRD_TIPO_SEXO == "M") $tp_sex_sel_m = "selected"; else $tp_sex_sel = "selected";
										?>
										<select name="PRD_TIPO_SEXO" class="<?php if($erro_publico != ""){echo "field_error";}else{echo "input_select";} ?>">
											<option value='F' <?php echo $tp_sex_sel_f; ?>>Feminino</option>
											<option value='M' <?php echo $tp_sex_sel_m; ?>>Masculino</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Estilo</label></b></div></td>
									<td align="left">
										<select name="PRD_ESTILO" class="<?php if($erro_estilo != ""){echo "field_error";}else{echo "input_select";} ?>">
										<?php
											$qr = "SELECT * FROM prod_estilo ORDER BY PRE_PRIORID";
											$sql = mysql_query($qr);
											$total = mysql_num_rows($sql);	

											if($PRD_ESTILO == "")
												echo "<option value='' selected>...Escolha...</option>";

											while($r = mysql_fetch_array($sql)){
												$selec = "";
												if($PRD_ESTILO == $r['PRE_ESTILO'])
													$selec = "selected";
												
												echo "<option value='". $r['PRE_ESTILO'] ."'". $selec . ">". $r['PRE_ESTILO_DESC'] ."</option>";
											}
										?>
										</select>
										<!-- Social - Casual - Contemporâneo - Esportivo - Infantil -->
									</td>
								</tr>					
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Tipo Produto</label></b></div></td>
									<td align="left">
										<select name="PRD_TIPO_PROD" class="<?php if($erro_tp_prd != ""){echo "field_error";}else{echo "input_select";} ?>">
										<?php
											$qr = "SELECT * FROM prod_tip_prod ORDER BY PTP_PRIORID";
											$sql = mysql_query($qr);
											$total = mysql_num_rows($sql);

											if($PRD_TIPO_PROD == "")
												echo "<option value='' selected>...Escolha...</option>";
											while($reg = mysql_fetch_array($sql)){
												$selec = "";
												if($PRD_TIPO_PROD == $reg['PTP_TIPO_PROD'])										
													$selec = "selected";

												echo "<option value='". $reg['PTP_TIPO_PROD'] ."'". $selec . ">". $reg['PTP_TIPO_PROD_DESC'] ."</option>";
											}
										?>
										</select>
										<!--Camiseta - Camisa Social - Camisa Polo - Camisa Xadrez - Vestido - Blusinha - Suéter - Bermuda - Short - Calça - Jaqueta - Bolsa - Calçado - Boné-->
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Marca</label></b></div></td>
									<td align="left">
										<select name="PRD_MARCA" class="<?php if($erro_marca != ""){echo "field_error";}else{echo "input_select";} ?>">
										<?php
											$qr = "SELECT * FROM prod_marca ORDER BY PMA_PRIORID";
											$sql = mysql_query($qr);
											$total = mysql_num_rows($sql);	
											
											if($PRD_MARCA == "")
												echo "<option value='' selected>...Escolha...</option>";
											while($reg = mysql_fetch_array($sql)){
												$selec = "";
												if($PRD_MARCA == $reg['PMA_MARCA'])
													$selec = "selected";

												echo "<option value='". $reg['PMA_MARCA'] ."'". $selec . ">". $reg['PMA_MARCA_DESC'] ."</option>";
											}
										?>
										</select>			
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Nome Produto</label></b></div></td>
									<td align="left"><div ><input type="text" class="<?php if($erro_nome_prd != ""){echo "field_error";}else{echo "input";} ?>" size="20" maxlength="45" name="PRD_NOME" value="<?php if($PRD_NOME != ""){ echo $PRD_NOME; } ?>"></div></td>
								</tr>
							</table>
						</td>
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
								<!-- ???
								<tr>								
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Cor</label></b></div></td>
									<td align="left" colspan="2">
										<select name="PRD_COR" class="<?php //if($erro_cor != ""){echo "field_error";}else{echo "input_select";} ?>">
										<?php
											/*
											$qr = "SELECT * FROM prod_cor ORDER BY PRC_PRIORID";
											$sql = mysql_query($qr);
											$total = mysql_num_rows($sql);
											
											if($PRD_COR == "")
												echo "<option value='' selected>...Escolha...</option>";
											while($reg = mysql_fetch_array($sql)){
												$selec = "";
												if($PRD_COR == $reg['PRC_COR'])
													$selec = "selected";

												echo "<option value='". $reg['PRC_COR'] ."'". $selec . ">". $reg['PRC_COR_DESC'] ."</option>";
											}*/
										?>
										</select>
									</td>
								</tr>
								-->
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Material</label></b></div></td>
									<td align="left" colspan="2">
										<select name="PRD_MATERIAL" class="<?php if($erro_material != ""){echo "field_error";}else{echo "input_select";} ?>">
										<?php
											$qr = "SELECT * FROM prod_material ORDER BY PRM_PRIORID";
											$sql = mysql_query($qr);
											$total = mysql_num_rows($sql);
											
											if($PRD_MATERIAL == "")
												echo "<option value='' selected>...Escolha...</option>";
											while($reg = mysql_fetch_array($sql)){
												$selec = "";
												if($PRD_MATERIAL == $reg['PRM_MATERIAL'])
													$selec = "selected";

												echo "<option value='". $reg['PRM_MATERIAL'] ."'". $selec . ">". $reg['PRM_MATERIAL_DESC'] ."</option>";
											}
										?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Modelo</label></b></div></td>
									<td align="left" colspan="2"><div ><input type="text" class="<?php if($erro_modelo != ""){echo "field_error";}else{echo "input";} ?>" size="15" maxlength="150" name="PRD_MODELO" value="<?php if($PRD_MODELO != ""){ echo $PRD_MODELO; } ?>"></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Ativo</label></b></div></td>
									<td align="left">
										<div>
											<input type="checkbox" class="input" name="PRD_ATIVO" <?php if($PRD_ATIVO == "N"){ echo ""; }{ echo "checked"; } ?>>
										</div>
									</td>
									<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Frete Grátis</label></b></div></td>
									<td align="left">
										<div><input type="checkbox" class="input" name="PRD_FRET_GRAT" <?php if($PRD_FRET_GRAT == "S"){ echo "checked"; } ?>></div>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Qtd Estoque</label></b></div></td>
									<td align="left" colspan="2"><div ><input type="text" class="<?php if($erro_qtd_estq != ""){echo "field_error";}else{echo "input";} ?>" size="5" maxlength="5" name="PRD_QTD_ESTQ" value="<?php if($PRD_QTD_ESTQ != ""){ echo $PRD_QTD_ESTQ; } ?>"></div></td>
								</tr>
							</table>
						</td>

						<!-- ########################### SEGUNDA COLUNA ########################### -->
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Vlr Custo</label></b></div></td>
									<td align="left"><div><input type="text" class="<?php if($erro_vlrcusto != ""){echo "field_error";}else{echo "input_moeda";} ?>" size="12" maxlength="12" id="PRD_VLR_CUSTO" name="PRD_VLR_CUSTO" value="<?php if($PRD_VLR_CUSTO != ""){ echo $PRD_VLR_CUSTO; } ?>" onkeypress="FormataValor(this.id, 6, event)" onfocus="javascript:focusField();" onblur="">
									</div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Vlr Venda</label></b></div></td>
									<td align="left"><div><input type="text" class="<?php if($erro_vlrvenda != ""){echo "field_error";}else{echo "input_moeda";} ?>" size="12" maxlength="12" id="PRD_VLR_VENDA" name="PRD_VLR_VENDA" value="<?php if($PRD_VLR_VENDA != ""){ echo $PRD_VLR_VENDA; } ?>" onkeypress="FormataValor(this.id, 6, event)" onfocus="javascript:focusField();" ></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Vlr Promo.</label></b></div></td>
									<td align="left"><div><input type="text" class="<?php if($erro_vlrpromo != ""){echo "field_error";}else{echo "input_moeda";} ?>" size="12" maxlength="12" id="PRD_VLR_PROMO" name="PRD_VLR_PROMO" value="<?php if($PRD_VLR_PROMO != ""){ echo $PRD_VLR_PROMO; } ?>" onkeypress="FormataValor(this.id, 6, event)" onblur="javascript:calcPerc();"></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">% Desc.</label></b></div></td>
									<td align="left"><div><input type="text" class="<?php if($erro_per_desc != ""){echo "field_error";}else{echo "input_moeda";} ?>" size="12" maxlength="12" id="PRD_VLR_DES" name="PRD_VLR_DESC" value="<?php if($PRD_VLR_DESC != ""){ echo $PRD_VLR_DESC; } ?>" onkeypress="FormataValor(this.id, 4, event)" onblur="javascript:calcPerc();"></div></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="40px" colspan="3">
							<table border="0 " cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td align="right" valign="middle"><b><label style="margin-right:5px;">OBS: </label></b></td>
									<td><div><textarea name="PRD_OBS" rows="1" cols="99"><?php if($PRD_OBS != ""){ echo $PRD_OBS; } ?></textarea></div></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div id="tabs-2">
				<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
					<tr><td align='left' width="10px"><font size="22px"><b><?php echo $PRD_CODIGO; ?></b></font></td>
					<td width="">
						<table border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td align='center' width="30px"><a href='javascript:void(0);' onClick="delProdImg('<?php echo $PRD_CODIGO; ?>')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a></td>
								<td align='center' valign="middle"><a href='javascript:void(0);' onClick="delProdImg('<?php echo $PRD_CODIGO; ?>')">Deletar Todas Imagens</a></td>
							</tr>
						</table>
					</td>
					</tr>
				</table>
				</br>
				
				<table id="dataTable" border="0" cellspacing="0" cellpadding="0" align="center">
				<?php
					$array = "";
					$array = explode(",",$PRI_IMAGEM);
					$path_img = "";
					//$n_palavras = count($array);
					for($i = 0 ; $i < 6 ; $i++ ){
						if (isset($array[$i]))
							$path_img = $array[$i];
						else
							$path_img = "";
				?>
						<tr>
							<td>
								<input type="file" name="PRI_IMAGEM<?php echo $i; ?>" accept="images/*"></br>
								<input type="text" size="42" name="PRI_IMAGEM_path<?php echo $i; ?>" value="<?php if($path_img != ""){ echo $path_img; } ?>" readonly>
							</td>
							<td align="left">
								<img src='<?php echo "../" . $array[$i] ?>' width='50px' height='50px'>
							</td>
							<td>
								<?php 
								/* 
								$img_compara 	= "";
								$img_comp_princ = "";
								if ($PRI_IMAGEM <> "")
									$img_compara 	= substr( strrchr($array[$i],"/"), 1);
								*/
								?>
								<!-- <input type="checkbox" name="chkPrincipal<?php //echo $i; ?>" <?php //if ( ($img_compara != "" && ($img_compara == $PRI_IMG_PRINCIP)) || ($PRI_IMAGEM == "" && $i == 0)) echo "checked"; ?> />Principal -->
							</td>
						</tr>
						<tr><td height="30px" colspan="3"><hr color="red"></hr></td></tr>
				<?php }	?>
				</table>
			</div>
			<div id="tabs-3">
				<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
					<tr><td valign="top" align='left' width="10px"><font size="22px"><b><?php echo $PRD_CODIGO; ?></b></font></td>
					<td width="">
						<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" height="100%">
						<tr><td>
							<div><!-- style="border-bottom:1px solid #cccccc" -->
							<iframe src="./colorpicker/color.php" frameborder="0" scrolling="yes" align="left" width="600px" height="330px" align="center">
								<p>Your browser does not support iframes.</p>
							</iframe>
							</div>
						</td></tr>
						</table>
					</td>
					</tr>
				</table>
			</div>
			<div id="tabs-4">
				<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
					<tr><td valign="top" align='left' width="10px"><font size="22px"><b><?php echo $PRD_CODIGO; ?></b></font></td>
					<td width="">
						<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" height="100%">
						<?php
						$arr_tam = explode(",",$PRD_TAM);
						$n_tam = count($arr_tam);
						for($i = 0 ; $i < 9 ; $i++ ){
							$tam = "";
							if (isset($arr_tam[$i])){
								if($arr_tam[$i] != "")
									$tam = $arr_tam[$i];
							}
							
							echo '<tr>
							<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Tamanho</label></b></div></td>
							<td align="left"><input type="text" class="'. $erro_tam .'" size="6" maxlength="9" name="PRD_TAM'. $i .'" value="'. $tam .'" ></td>
							</tr>';
						}
						?>
						</table>
					</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<center><input type="submit" class="btsubmit" name="btIncluir" value="<?php if($SelEdtProd != "" || $btIncluir == "Alterar Produto"){echo "Alterar Produto";}else{echo "Incluir Produto";} ?>"></center>
	<br>
	<?php
	// altura dinamica de acordo com o numero de produtos
	$sql_busca = "SELECT MAX(PRD_CODIGO) AS TOT_PROD FROM produto";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$alt_grid = 0;

	$alt_grid = $fet_busca['TOT_PROD'] * 25;
	
	$alt_grid = $alt_grid + 40;
	
	if($alt_grid == 0)
		$alt_grid = 200;
	?>
	<!-- ######################################## GRID ######################################## -->
	<div ><!-- style="border-bottom:1px solid #cccccc" -->
	<iframe src="mod/gridprod.php" frameborder="0" scrolling="yes" align="left" width="100%" height="<?php echo $alt_grid; ?>">
		<p>Your browser does not support iframes.</p>
	</iframe>
	</div>

	<div style="margin-bottom:30px">&nbsp;</div>

	<input type="hidden" name="SelEdtProd" 	 	value="">
	<input type="hidden" name="SelDelProd" 	 	value="">
	<input type="hidden" name="SelDelProdImg" 	value="">

</form>
</html>