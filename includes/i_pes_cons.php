<?php
	/* ##################### CONSULTA ##################### */
	$sql_busca = 
	"SELECT pessoa.*, contato.*, user.*, endereco.* " . 
	"  FROM pessoa 		  AS pessoa" . 
	"  LEFT JOIN user     AS user     ON user.USR_PES_CPFCNPJ     = pessoa.PES_CPFCNPJ" .
	"  LEFT JOIN contato  AS contato  ON contato.CTT_PES_CPFCNPJ  = pessoa.PES_CPFCNPJ" . 
	"  LEFT JOIN endereco AS endereco ON endereco.END_PES_CPFCNPJ = pessoa.PES_CPFCNPJ" . 
	" WHERE pessoa.PES_CPFCNPJ      = '$cpf_cnpj'";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$PES_CPFCNPJ	  	= formatCPFCNPJ($fet_busca['PES_CPFCNPJ']);
	$PES_TIPO         	= $fet_busca['PES_TIPO'];
	$PES_NOME 		  	= $fet_busca['PES_NOME'];
	
	// INI - Verifica Email informado no inicio do cadastro	
	if (isset($_POST['USR_EMAIL'])) 
		$USR_EMAIL = $_POST['USR_EMAIL'];
	else
		$USR_EMAIL = $fet_busca['USR_EMAIL'];
	
	if ($USR_EMAIL == "") $USR_EMAIL = $acessoemailcad;
	// FIM - Verifica Email informado no inicio do cadastro
	
	$_SESSION['USR_EMAIL'] = $USR_EMAIL;
	$REUSR_EMAIL		= "";
	$PES_SEXO         	= $fet_busca['PES_SEXO'];
	$PES_DT_CAD       	= $fet_busca['PES_DT_CAD'];
	if ($fet_busca['PES_DT_NASC'] != "")
		$PES_DT_NASC    = date('d/m/Y', strtotime($fet_busca['PES_DT_NASC']));
	$PES_STATUS       	= $fet_busca['PES_STATUS'];
	$PES_RG           	= $fet_busca['PES_RG'];
	$PES_OBS          	= $fet_busca['PES_OBS'];
	$PES_RAZAO_SOC		= $fet_busca['PES_RAZAO_SOC'];
	$PES_CNPJ_NOME_FANT	= $fet_busca['PES_CNPJ_NOME_FANT'];
	$PES_INSC_MUNICIP 	= $fet_busca['PES_INSC_MUNICIP'];
	$PES_INSC_ESTAD   	= $fet_busca['PES_INSC_ESTAD'];
	$PES_CNPJ_ISENTO	= $fet_busca['PES_CNPJ_ISENTO'];
	
	$USR_SENHA			= $fet_busca['USR_SENHA'];
	$USR_RECEBE_EMAILS  = $fet_busca['USR_RECEBE_EMAILS'];
	
	$END_CEP 			= $fet_busca['END_CEP'];
	$END_NOME		 	= $fet_busca['END_NOME'];
	$END_NUMERO		 	= $fet_busca['END_NUMERO'];
	$END_COMPL 			= $fet_busca['END_COMPL'];
	$END_COMPL_OBS		= $fet_busca['END_COMPL_OBS'];
	$END_BAIRRO			= $fet_busca['END_BAIRRO'];
	$END_CIDADE			= $fet_busca['END_CIDADE'];
	$END_ESTADO			= $fet_busca['END_ESTADO'];
	$END_ENTREGA		= $fet_busca['END_ENTREGA'];
	
	$CTT_FONE_COM_1		= substr($fet_busca['CTT_FONE_COM'], 0, 2);
	$CTT_FONE_COM_2		= substr($fet_busca['CTT_FONE_COM'], 2, 9);
	$CTT_FONE_COM_RAM	= $fet_busca['CTT_FONE_COM_RAM'];
	$CTT_FONE_RES_1		= substr($fet_busca['CTT_FONE_RES'], 0, 2);
	$CTT_FONE_RES_2		= substr($fet_busca['CTT_FONE_RES'], 2, 9);
	$CTT_FONE_RES_RAM	= $fet_busca['CTT_FONE_RES_RAM'];
	$CTT_FONE1_1		= substr($fet_busca['CTT_FONE1'], 0, 2);
	$CTT_FONE1_2		= substr($fet_busca['CTT_FONE1'], 2, 9);

/* ##################### CONSULTA ##################### */	

	/*
	$month   = substr($horario,5,2);
	$date    = substr($horario,8,2);
	$year    = substr($horario,0,4);
	$hour    = substr($horario,11,2);
	$minutes = substr($horario,14,2);
	$seconds = substr($horario,17,4);	
	*/
?>