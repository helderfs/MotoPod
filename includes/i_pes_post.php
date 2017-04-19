<?php

	if (isset($_POST['USR_RECEBE_EMAILS']))
		$USR_RECEBE_EMAILS = "S";
	else
		$USR_RECEBE_EMAILS = "N";

	if (isset($_POST['PES_TIPO']))		$PES_TIPO = $_POST['PES_TIPO'];
	if (isset($_POST['PES_DT_CAD']))	$PES_DT_CAD = $_POST['PES_DT_CAD'];	
	if (isset($_POST['PES_NOME']))		$PES_NOME = $_POST['PES_NOME'];
	
	if ($PES_TIPO == "F"){
		if ($PES_NOME == ""){ 
			$c_erros = $c_erros . ",Nome Completo não informado.";
			$erro_nome = "erro";
		}
		
		/*
		if (isset($_POST['PES_RG']))	$PES_RG = $_POST['PES_RG'];
		if ($PES_RG == ""){
			$c_erros = $c_erros . ",RG não informado."; 
			$erro_rg = "erro";
		}
		*/
		if (isset($_POST['PES_SEXO']))	$PES_SEXO = $_POST['PES_SEXO'];

		if (isset($_POST['PES_DT_NASC']))	$PES_DT_NASC = $_POST['PES_DT_NASC'];
		if ($PES_DT_NASC == "" || $PES_DT_NASC == "//"){ 
			$c_erros = $c_erros . ",Data Nascimento não informada."; 
			$erro_dtnasc = "erro";
		}
	}

	// ######################################################################## JURIDICA
	if ($PES_TIPO == "J"){
		if (isset($_POST['PES_RAZAO_SOC']))	$PES_RAZAO_SOC = $_POST['PES_RAZAO_SOC'];
		if ($PES_RAZAO_SOC == ""){ 
			$c_erros = $c_erros . ",Razão Social não informado.";
			$erro_razaosoc = "erro";
		}

		if (isset($_POST['PES_CNPJ_NOME_FANT'])) $PES_CNPJ_NOME_FANT = $_POST['PES_CNPJ_NOME_FANT'];
		if ($PES_CNPJ_NOME_FANT == ""){ 
			$c_erros = $c_erros . ",Nome Fantasia não informado.";
			$erro_nomefant = "erro";
		}
		
		/* INSC MUNICIP. AINDA NAO UTILIZADO
		if (isset($_POST['PES_INSC_MUNICIP'])){
			$PES_INSC_MUNICIP = $_POST['PES_INSC_MUNICIP'];
		}		
		if ($PES_INSC_MUNICIP == ""){ 
			if ($PES_TIPO == "J"){ 
				$c_erros = $c_erros . ",Insc. Municipal não informado.";
				$erro_inscmun = "erro";
			}
		}*/
		
		if (isset($_POST['PES_INSC_ESTAD'])) $PES_INSC_ESTAD = $_POST['PES_INSC_ESTAD'];
		if ($PES_INSC_ESTAD == ""){ 
			$c_erros = $c_erros . ",Insc. Estadual não informado.";
			$erro_inscest = "erro";
		}
		
		if (isset($_POST['PES_CNPJ_ISENTO'])) $PES_CNPJ_ISENTO = $_POST['PES_CNPJ_ISENTO'];
		if (isset($_POST['PES_RESPONS'])){
			$PES_NOME = $_POST['PES_RESPONS'];
			$PES_RESPONS = $PES_NOME;
		}
		if ($PES_NOME == ""){ 
			$c_erros = $c_erros . ",Responsável não informado.";
			$erro_resp = "erro";
		}

		if (isset($_POST['CTT_FONE_COM_1']))	$CTT_FONE_COM_1 = $_POST['CTT_FONE_COM_1'];
		if (isset($_POST['CTT_FONE_COM_2']))	$CTT_FONE_COM_2 = $_POST['CTT_FONE_COM_2'];
		if ($CTT_FONE_COM_1 != "" && strlen($CTT_FONE_COM_2) < 2){
			$c_erros = $c_erros . ",Código Telefone Comercial incorreto.";
			$erro_fone_com_1 = "erro";
		}
		if ($CTT_FONE_COM_2 != "" && strlen($CTT_FONE_COM_2) < 8){
			$c_erros = $c_erros . ",Telefone Comercial incorreto.";
			$erro_fone_com_2 = "erro";
		}
		if (isset($_POST['CTT_FONE_COM_RAM'])) $CTT_FONE_COM_RAM = $_POST['CTT_FONE_COM_RAM'];
	}
	
	// ######################################################################## ENDERECO
	if($modulo == "pessoa"){
		$sql_busca = "SELECT MAX(END_CODIGO) AS MAX_END_CODIGO FROM endereco
					   WHERE END_PES_CPFCNPJ = '$cpf_cnpj' ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$END_CODIGO	= $fet_busca['MAX_END_CODIGO'] + 1;
		
		if (isset($_POST['hdEND_CEP'])){
			$END_CEP = soNumero($_POST['hdEND_CEP']);
			$_SESSION['hdEND_CEP'] = $END_CEP;
		}
		if ($END_CEP == ""){ 
			$c_erros = $c_erros . ",CEP não informado.";
			$erro_cep = "erro";
		}

		if (isset($_POST['hdEND_NOME'])){
			$END_NOME = $_POST['hdEND_NOME'];
			$_SESSION['hdEND_NOME'] = $END_NOME;
		}
		if ($END_NOME == ""){ 
			$c_erros = $c_erros . ",Endereço não informado.";
			$erro_endereco = "erro";
		}
		
		if (isset($_POST['hdEND_NUMERO'])){
			$END_NUMERO = $_POST['hdEND_NUMERO'];
			$_SESSION['hdEND_NUMERO'] = $END_NUMERO;
		}
		if ($END_NUMERO == ""){ 
			$c_erros = $c_erros . ",Nº Endereço não informado.";
			$erro_numero = "erro";
		}

		if (isset($_POST['hdEND_COMPL'])){
			$END_COMPL = $_POST['hdEND_COMPL'];
			$_SESSION['hdEND_COMPL'] = $END_COMPL;
		}
		/* Nao Precisa ******
		if ($END_COMPL == ""){
			$c_erros = $c_erros . ",Complemento não informado.";
			$erro_compl = "erro";
		}*/
		
		if (isset($_POST['hdEND_COMPL_OBS'])){
			$END_COMPL_OBS = $_POST['hdEND_COMPL_OBS'];
			$_SESSION['hdEND_COMPL_OBS'] = $END_COMPL_OBS;
		}
		
		if (isset($_POST['hdEND_BAIRRO'])){
			$END_BAIRRO = $_POST['hdEND_BAIRRO'];
			$_SESSION['hdEND_BAIRRO'] = $END_BAIRRO;
		}
		if ($END_BAIRRO == ""){ 
			$c_erros = $c_erros . ",Bairro não informado.";
			$erro_bairro = "erro";
		}
		
		if (isset($_POST['hdEND_CIDADE'])){
			$END_CIDADE = $_POST['hdEND_CIDADE'];
			$_SESSION['hdEND_CIDADE'] = $END_CIDADE;
		}
		if ($END_CIDADE == ""){ 
			$c_erros = $c_erros . ",Cidade não informado.";
			$erro_cidade = "erro";
		}
		
		if (isset($_POST['hdEND_ESTADO'])){
			$END_ESTADO = $_POST['hdEND_ESTADO'];
			$_SESSION['hdEND_ESTADO'] = $END_ESTADO;
		}
		if ($END_ESTADO == ""){ 
			$c_erros = $c_erros . ",Estado não informado.";
			$erro_uf = "erro";
		}
	}
	
	// ######################################################################## CONTATO
	if (isset($_POST['CTT_FONE_RES_1']))	$CTT_FONE_RES_1 = $_POST['CTT_FONE_RES_1'];
	if (isset($_POST['CTT_FONE_RES_2']))	$CTT_FONE_RES_2 = $_POST['CTT_FONE_RES_2'];
	if (isset($_POST['CTT_FONE_RES_RAM']))	$CTT_FONE_RES_RAM = $_POST['CTT_FONE_RES_RAM'];
	if ($CTT_FONE_RES_1 != "" && strlen($CTT_FONE_RES_1) < 2){
		$c_erros = $c_erros . ",Código Fone Residencial incorreto.";
		$erro_fone_res_1 = "erro";
	}
	if ($CTT_FONE_RES_2 != "" && strlen($CTT_FONE_RES_2) < 8){
		$c_erros = $c_erros . ",Fone Residencial incorreto.";
		$erro_fone_res_2 = "erro";
	}
	
	if (isset($_POST['CTT_FONE1_1']))	$CTT_FONE1_1 = $_POST['CTT_FONE1_1'];
	if (isset($_POST['CTT_FONE1_2']))	$CTT_FONE1_2 = $_POST['CTT_FONE1_2'];
	if ($CTT_FONE1_1 == ""){
		$c_erros = $c_erros . ",Código Telefone Celular não informado.";
		$erro_fone1_1 = "erro";
	}
	if ($CTT_FONE1_1 != "" && strlen($CTT_FONE1_1) < 2){
		$c_erros = $c_erros . ",Código Telefone Celular incorreto.";
		$erro_fone1_1 = "erro";
	}
	if ($CTT_FONE1_2 == ""){
		$c_erros = $c_erros . ",Telefone Celular não informado.";
		$erro_fone1_2 = "erro";
	}
	if ($CTT_FONE1_2 != "" && strlen($CTT_FONE1_2) < 8){
		$c_erros = $c_erros . ",Telefone Celular incorreto.";
		$erro_fone1_2 = "erro";
	}
?>