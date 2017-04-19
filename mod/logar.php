<?php

include("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");
include_once("../_func/phpmailer/class.phpmailer.php");

//session_destroy();
//session_cache_expire(10);

// INICIALIZACAO
$usuar = "";
//???$_SESSION['acessoemailcad']  	= "";
$_SESSION['acessocep1']    	 	= "";
$_SESSION['acessocep2']    	 	= "";
$_SESSION['cadcep1']    	 	= "";
$_SESSION['cadcep2']    	 	= "";
$_SESSION['tipo']   	   	 	= "";
$_SESSION['erroacessoemail'] 	= "";
$_SESSION['errocep']       	 	= "";
$_SESSION['sesEmailLog'] 		= "";
$_SESSION['ses_cpfcnpj']   		= "";
$_SESSION['gerente']     	 	= "";
$_SESSION['nome'] 			 	= "";
$_SESSION['nome'] 			 	= "";
$_SESSION['errologinemail']  	= "";
$_SESSION['errosenha'] 		 	= "";

$loginemailtop = "";
$login_senha = "";
$acesso_cad_email = "";
$acesso_cad_senha = "";

$btLoginTop = "";
$btEfetuaLogin = "";
$btIniciaCad = "";
$btCadFast = "";

$sess_qtd_buy = "";
$acessoemailcad = "";
$acessocep1 = "";
$cadcep1 = "";
$acessocep2 = "";
$cadcep2 = "";
// INICIALIZACAO

// login TOP
if (isset($_POST['btLoginTop'])){
	$btLoginTop = $_POST['btLoginTop'];
	$_SESSION['ultPagVisit'] = "EfetuaLoginTop";
}
// login CAD
if (isset($_POST['btEfetuaLogin'])){
	$btEfetuaLogin = $_POST['btEfetuaLogin'];
	$_SESSION['ultPagVisit'] = "EfetuaLogin";
}
// cadastro CAD
if (isset($_POST['btIniciaCad'])){
	$btIniciaCad = $_POST['btIniciaCad'];
	$_SESSION['ultPagVisit'] = "IniciaCad";
}
// cadastro CAD FAST
if (isset($_POST['btCadFast'])){
	$btCadFast = $_POST['btCadFast'];
	$_SESSION['ultPagVisit'] = "IniciaCadFast";
}

if (isset($_SESSION['ultPagVisit']))
	$ultPagVisit = $_SESSION['ultPagVisit'];

if ($btLoginTop != "" || $btEfetuaLogin != ""){
	// LOGIN TOP
	if (isset($_POST['sesEmailLog']))	$loginemailtop = $_POST['sesEmailLog'];
	if (isset($_POST['logsenha']))	$login_senha = base64_encode($_POST['logsenha']);
	
	// LOGIN CAD
	if (isset($_POST['loginemailcad']))	$acesso_cad_email = $_POST['loginemailcad'];
	if (isset($_POST['loginsenhacad']))	$acesso_cad_senha = base64_encode($_POST['loginsenhacad']);
}

if (isset($_SESSION['sess_qtd_buy'])) $sess_qtd_buy = $_SESSION['sess_qtd_buy'];
if (isset($_POST['acessoemailcad']))  $acessoemailcad = $_POST['acessoemailcad'];

if (isset($_POST['acessocep1'])){
	$acessocep1 = $_POST['acessocep1'];
	$cadcep1 = $acessocep1;
}
if (isset($_POST['acessocep2'])){
	$acessocep2 = $_POST['acessocep2'];
	$cadcep2 = $acessocep2;
}

/* CASO USUARIO CLIQUE NO BOTAO ENTER, VAI SEMPRE PARA O BOTAO "btEfetuaLogin", ASSIM FORCA PARA NAO */
if ( ($acessoemailcad.$acessocep1.$acessocep2 != "") && ($acesso_cad_email.$acesso_cad_senha == "") ){	
	$btIniciaCad = "btIniciaCad";
	$_SESSION['ultPagVisit'] = "IniciaCad";
	
	$btEfetuaLogin = "";
}
/* CASO USUARIO CLIQUE NO BOTAO ENTER, VAI SEMPRE PARA O BOTAO "btEfetuaLogin", ASSIM FORCA PARA NAO */

//echo "<br> btLoginTop	   $btLoginTop";
//echo "<br> btEfetuaLogin $btEfetuaLogin";
//echo "<br> btIniciaCad   $btIniciaCad";
//echo "<br> btCadFast	   $btCadFast";

/*
echo "<br>logsenha ". $_POST['logsenha'];
echo "<br>loginsenhacad ". $_POST['loginsenhacad'];

echo "<br>>>>loginemailtop $loginemailtop";
echo "<br>>>>login_senha   $login_senha";

echo "<br>>>>acesso_cad_email $acesso_cad_email";
echo "<br>>>>acesso_cad_senha $acesso_cad_senha";
*/


if($btIniciaCad != ""){
	$erroEmail = "";
	$erroCEP   = "";
	
	// NAO PRECISA MAIS ????? 
	// Verifica se email ja existe
	// $sql_busca = "SELECT USR_EMAIL FROM user WHERE USR_EMAIL = '$acessoemailcad' ";
	// $exe_busca = mysql_query($sql_busca) or die (mysql_error());
	// $fet_busca = mysql_fetch_assoc($exe_busca);
	// $num_busca = mysql_num_rows($exe_busca);

	// if ($num_busca != 0){
		// $erroEmail = "Já existe um usuário com o e-mail informado.";
	// }else{
		// if (!validaEmail($acessoemailcad)){
			// $erroEmail = "Endereço de e-mail inválido";
		// }
	// }
	// NAO PRECISA MAIS ????? 
	
	if ($acessoemailcad == "")
		$erroEmail = "Informar e-mail.";
		
	if (!validaCEP($acessocep1 ."-". $acessocep2))
		$erroCEP = "CEP inválido";

	if ($erroEmail == "" && $erroCEP == ""){
		//$_SESSION['acessoemailcad'] = "acesso...778"; //$acessoemailcad;
		$_SESSION['ses_emailcad']	= $acessoemailcad;
		$_SESSION['acessocep1']    	= $acessocep1;
		$_SESSION['acessocep2']    	= $acessocep2;
		$_SESSION['cadcep1']    	= $acessocep1;
		$_SESSION['cadcep2']    	= $acessocep2;
		$_SESSION['hdEND_NUMERO']   = " "; // Preenche com vazio, senao ao abriri cadastro aparece com vermelho, nao preenchido
		$_SESSION['tipo']   	  	= "cad";
		?><script language="javascript" type="text/javascript">window.location="pessoa";</script><?php
	}else{
		$_SESSION['erroacessoemail'] = $erroEmail;
		$_SESSION['errocep']         = $erroCEP;
		$_SESSION['errologinemail']  = "";
		$_SESSION['errosenha']       = "";
		?><script language="javascript" type="text/javascript">window.location="cadastro";</script><?php
	}
}else if($btEfetuaLogin != "" || ($loginemailtop != "" || $login_senha != "")){
	$erroEmail = "";
	$erroSenha = "";

	if ($acesso_cad_email != "" || $acesso_cad_senha != ""){
		$loginemailtop = $acesso_cad_email;
		$login_senha = $acesso_cad_senha;
		
		// So valida a email e senha quando for pela tela de cadastro
		if (!validaEmail($acesso_cad_email)){
			$erroEmail = "Endereço de e-mail inválido. Tente novamente.<br>";
		}
		if (!validaSenha($acesso_cad_senha)){
			$erroSenha = "Esqueceu a senha? <a href='javascript:void(0);' onClick=''><strong>Clique aqui</strong></a>";
		}
	}

	$sql_busca = "
	SELECT pessoa.*, user.*
	  FROM pessoa, user
	 WHERE pessoa.PES_CPFCNPJ = user.USR_PES_CPFCNPJ
	   AND user.USR_EMAIL	= '$loginemailtop'
	   AND user.USR_SENHA   = '$login_senha' "; // 	   AND user.USR_ATIVO   = 'S'

	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	
	if ($num_busca == 0){
		$erroEmail = "Endereço de e-mail e/ou senha inválidos. Cadastre-se!";
		//echo "<a href='javascript:window.history.go(-1)'>Clique aqui para voltar.</a>";
	}elseif($fet_busca['USR_ATIVO'] == "N"){
		$erroEmail = "Usuário não ativado, verifique seu e-mail para ativa a conta.<br>";
	}else{
		$CNPJ_CPF = $fet_busca['PES_CPFCNPJ'];
		
		$_SESSION['sesEmailLog']	= $loginemailtop;
		$_SESSION['ses_cpfcnpj']  	= soNumero($CNPJ_CPF);
		$_SESSION['gerente']  		= $fet_busca['USR_GERENTE'];
		
		if (strpos($fet_busca['PES_NOME'], " ") == false){
			$_SESSION['nome'] = $fet_busca['PES_NOME'];
		}else{
			$_SESSION['nome'] = substr($fet_busca['PES_NOME'], 0, strpos($fet_busca['PES_NOME'], " "));
		}

//echo "<br> >>>". $ck_sessao ." .... loginemailtop". $loginemailtop;

		// #### ARMAZENA CPF / CNPJ NA SESSAO, caso exista pedido ####
		CPFCNPJSessaoPedido($CNPJ_CPF, $ck_sessao);

		if ($ultPagVisit == "EfetuaLogin" && $sess_qtd_buy != ""){
			?><script language="javascript" type="text/javascript">window.location="moddata";</script><?php
		}else{
			?><script language="javascript" type="text/javascript">window.location="principal";</script><?php
		}
	}

	if ($erroEmail != "" || $erroSenha != ""){
		$_SESSION['errologinemail']  = $erroEmail;
		$_SESSION['errosenha']     	 = $erroSenha;
		$_SESSION['erroacessoemail'] = "";
		$_SESSION['errocep']       	 = "";
		
		?><script language="javascript" type="text/javascript">window.location="cadastro";</script><?php
	}
}else if ($btCadFast != ""){
	if (isset($_POST['fastPES_NOME'])) 			$_SESSION['fastPES_NOME'] 			= $_POST['fastPES_NOME'];
	if (isset($_POST['fastPES_TIPO'])) 			$_SESSION['fastPES_TIPO'] 			= $_POST['fastPES_TIPO'];
	if (isset($_POST['fastPES_CPF'])) 			$_SESSION['fastPES_CPF'] 			= $_POST['fastPES_CPF'];
	if (isset($_POST['fastPES_CNPJ'])) 			$_SESSION['fastPES_CNPJ'] 			= $_POST['fastPES_CNPJ'];
	if (isset($_POST['fastCTT_FONE_RES_1'])) 	$_SESSION['fastCTT_FONE_RES_1'] 	= $_POST['fastCTT_FONE_RES_1'];
	if (isset($_POST['fastCTT_FONE_RES_2'])) 	$_SESSION['fastCTT_FONE_RES_2'] 	= $_POST['fastCTT_FONE_RES_2'];
	if (isset($_POST['fastCTT_FONE_RES_RAM']))	$_SESSION['fastCTT_FONE_RES_RAM'] 	= $_POST['fastCTT_FONE_RES_RAM'];
	if (isset($_POST['fastCTT_FONE1_1'])) 		$_SESSION['fastCTT_FONE1_1'] 		= $_POST['fastCTT_FONE1_1'];
	if (isset($_POST['fastCTT_FONE1_2'])) 		$_SESSION['fastCTT_FONE1_2'] 		= $_POST['fastCTT_FONE1_2'];
	if (isset($_POST['fastUSR_EMAIL'])) 		$_SESSION['fastUSR_EMAIL'] 			= $_POST['fastUSR_EMAIL'];
	if (isset($_POST['fasthdEND_CEP'])) 		$_SESSION['fastEND_CEP'] 			= $_POST['fasthdEND_CEP'];
	if (isset($_POST['fasthdEND_NOME'])) 		$_SESSION['fastEND_NOME'] 			= $_POST['fasthdEND_NOME'];
	if (isset($_POST['fasthdEND_NUMERO'])) 		$_SESSION['fastEND_NUMERO'] 		= $_POST['fasthdEND_NUMERO'];
	if (isset($_POST['fasthdEND_COMPL_OBS'])) 	$_SESSION['fastEND_COMPL_OBS'] 		= $_POST['fasthdEND_COMPL_OBS'];
	if (isset($_POST['fasthdEND_BAIRRO'])) 		$_SESSION['fastEND_BAIRRO'] 		= $_POST['fasthdEND_BAIRRO'];
	if (isset($_POST['fasthdEND_CIDADE'])) 		$_SESSION['fastEND_CIDADE'] 		= $_POST['fasthdEND_CIDADE'];
	if (isset($_POST['fasthdEND_ESTADO'])) 		$_SESSION['fastEND_ESTADO'] 		= $_POST['fasthdEND_ESTADO'];

	?><script language="javascript" type="text/javascript">window.location="acesso";</script><?php
}else{
	$_SESSION['errologinemail'] = "";
	$_SESSION['errosenha']      = "";
	
	if($btIniciaCad != ""){
		$_SESSION['erroacessoemail'] = "Endereço de e-mail e/ou CEP inválidos. Tente novamente.";
	}else{
		$_SESSION['errologinemail'] = "Endereço de e-mail e/ou senha inválidos. Tente novamente.";
	}
	?><script language="javascript" type="text/javascript">window.location="cadastro";</script><?php
}

?>