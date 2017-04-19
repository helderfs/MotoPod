<?php
/* ########################## INICIALIZA CAMPOS */
$at 				= "";
$tipo				= "";
$c_erros 			= "";
$cpf_cnpj 			= "";
$acessocep1			= "";
$acessocep2			= "";
$hdCodEndCtt		= "";
$hdTipEndCtt		= "";
$btCadPes			= "";

$erro_cpf 		 	= "";
$erro_cnpj 		 	= "";
$erro_rg 		 	= "";
$erro_nome 		 	= "";
$erro_dtnasc 	 	= "";
$erro_razaosoc 	 	= "";
$erro_nomefant 	 	= "";
$erro_inscmun 	 	= "";
$erro_inscest 	 	= "";
$erro_resp 		 	= "";
$erro_cep 		 	= "";
//$erro_end_desc = "";
$erro_compl 	 	= "";
$erro_endereco 	 	= "";
$erro_numero 		= "";
$erro_bairro 	 	= "";
$erro_cidade 	 	= "";
$erro_uf 		 	= "";
$erro_fone1_1 	 	= "";
$erro_fone1_2 	 	= "";
$erro_fone_res_1 	= "";
$erro_fone_res_2 	= "";
$erro_fone_com_1 	= "";
$erro_fone_com_2 	= "";

$USR_ATIVO          = "S";
$USR_SESSAO         = "...";
$USR_SENHA          = "";
$REUSR_SENHA        = "";
$USR_EMAIL 	 		= "";
$REUSR_EMAIL 		= "";
$USR_RECEBE_EMAILS  = "";
		
$PES_TIPO 			= "";
$PES_CPFCNPJ 		= "";
$PES_CPF 			= "";
$PES_CNPJ 			= "";
$PES_RG 			= "";
$PES_NOME 			= "";
$PES_RESPONS 		= "";
$PES_SEXO 			= "";
$PES_DT_CAD  		= date("d-m-Y"); //date("Y-m-d H:i:s");
$PES_DT_NASC 		= "";
$PES_RAZAO_SOC 		= "";
$PES_CNPJ_NOME_FANT = "";
$PES_INSC_MUNICIP 	= "";
$PES_INSC_ESTAD 	= "";
$PES_CNPJ_ISENTO 	= "";
$PES_STATUS 		= "";
$PES_OBS 			= "";

$END_CODIGO 		= 1;
$END_PAIS   		= 'Brasil';
//$END_DESC 			= "Endereço de Entrega";
$END_CEP 			= "";
$END_ENTREGA 		= "S";
$END_NOME 			= "";
$END_NUMERO 		= "";
$END_COMPL 			= "";
$END_COMPL_OBS 		= "";
$END_BAIRRO 		= "";
$END_CIDADE 		= "";
$END_ESTADO 		= "";

$CTT_FONE1_1 		= "";
$CTT_FONE1_2 		= "";
$CTT_FONE_RES_RAM 	= "";
$CTT_FONE_RES_1 	= "";
$CTT_FONE_RES_2 	= "";
$CTT_FONE_COM_1 	= "";
$CTT_FONE_COM_2 	= "";
$CTT_FONE_COM_RAM 	= "";

/* ########################## FIM - INICIALIZA CAMPOS */

//if (isset($_SESSION['acessoemailcad']))	$acessoemailcad = $_SESSION['acessoemailcad'];
if (isset($_SESSION['ses_emailcad']))	$acessoemailcad = $_SESSION['ses_emailcad'];

if ($USR_EMAIL == "") $USR_EMAIL = $acessoemailcad;

if (isset($_SESSION['sesEmailLog'])){
	$loginemailtop = $_SESSION['sesEmailLog'];
	$USR_EMAIL = $loginemailtop;
}
if (isset($_SESSION['ses_cpfcnpj'])){
	$cpf_cnpj = soNumero($_SESSION['ses_cpfcnpj']);
	$PES_CPFCNPJ = $cpf_cnpj;
}

if (isset($_SESSION['cadcep1'])){
	if ($_SESSION['cadcep1'] != "")
		$acessocep1 = soNumero($_SESSION['cadcep1']);
}
if (isset($_SESSION['cadcep2'])){
	if ($_SESSION['cadcep2'] != "")
		$acessocep2 = soNumero($_SESSION['cadcep2']);
}

// if (isset($_SESSION['sesAltEnd']) && $_SESSION['sesAltEnd'] != "") 	$sesAltEnd = $_SESSION['sesAltEnd'];

if ($tipo != $_SESSION['tipo'])	 $tipo = $_SESSION['tipo'];

if (isset($_POST['at'])) $at = $_POST['at'];

?>