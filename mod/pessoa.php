<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	
	<script language="javascript" src="script/x_mascara.js"></script>

	<script language="javascript" type="text/javascript">
		function gravaCEP(){
			document.formCadPessoa.hdEND_CEP.value 			= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CEP').value;
			document.formCadPessoa.hdEND_NOME.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_NOME').value;
			document.formCadPessoa.hdEND_NUMERO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_NUMERO').value;
			document.formCadPessoa.hdEND_COMPL.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_COMPL').value;
			document.formCadPessoa.hdEND_COMPL_OBS.value 	= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_COMPL_OBS').value;
			document.formCadPessoa.hdEND_BAIRRO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_BAIRRO').value;
			document.formCadPessoa.hdEND_CIDADE.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CIDADE').value;
			document.formCadPessoa.hdEND_ESTADO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_ESTADO').value;
		}

		function ControlCPFCNPJ(mostraCPF){
			if (mostraCPF == 'S'){
				document.getElementById('blockCPF01').style.display='block';
				document.getElementById('blockCNPJ01').style.display='none';
				
				document.formCadPessoa.PES_NOME.focus();
			}else{
				document.getElementById('blockCPF01').style.display='none';
				document.getElementById('blockCNPJ01').style.display='block';
				
				document.formCadPessoa.PES_RAZAO_SOC.focus();
			}
		}

	</script>

	<!-- 
	<link rel="stylesheet" type="text/css" href="css/demos.css">
	-->
<!-- kkk
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	
	<link href="css/_templatemo_style.css" rel="stylesheet" type="text/css" />
	
	<link rel="stylesheet" type="text/css" href="themes/base/jquery.ui.all.css">

	<script src="script/jquery-1.5.1.js" 				 type="text/javascript"></script>
	<script src="script/menu.js" 		 				 type="text/javascript"></script>
	<script src="ui/jquery.ui.core.js"	 				 type="text/javascript"></script>
	<script src="ui/jquery.ui.widget.js" 				 type="text/javascript"></script>
	<script src="ui/jquery.ui.datepicker.js" 			 type="text/javascript"></script>
	<script src="ui/i18n/jquery.ui.datepicker-pt-BR.js"  type="text/javascript"></script>

	<script language="javascript" src="script/x_functions.js"></script>
	<script language="javascript" src="script/x_menu.js"></script>
	<script language="javascript" src="script/x_mascara.js"></script>
	<script language="javascript" src="script/x_valida.js"></script>
-->
	<!-- MODAL -->
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script> -->	
	<!-- kkk
	<script type="text/javascript" src="script/jquery.js"></script>
	-->
	<!-- MODAL -->
<!-- kkk datepicker
	<script>
		$(function() {
			$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
			$( "#datepicker" ).datepicker(
				// { $.datepicker.regional[ "pt-BR" ] }
				{
					/*
					showOn: "button",
					buttonImage: "image_icons/calendar.gif",
					buttonImageOnly: true,
					
					defaultDate: new Date(1980, 1 - 1, 1), showTrigger: '#calImg',
					maxDate: '+1m +2w +10d',
					maxDate: +30,
					minDate: new Date(1900, 1 - 1, 26), 
					maxDate: '01/26/2009',
										
					minDate: new Date(1990, 1 , 26),
					maxDate: new Date(2009, 1, 26), 
					showTrigger: '#calImg',
					*/
					yearRange: 'c-110:c+100',
					changeMonth: true,
					changeYear: true
				}				
			);
			
			$( "#locale" ).change(function() {
				$( "#datepicker" ).datepicker( "option", $.datepicker.regional[ $( this ).val() ] );
			});
		});
		
		$(function()
		{
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
-->		
	</head>

	<body style="color: black;">
<?php
/*
echo "sim...<br>";
echo "<br>SESSION ses_emailcad... ". $_SESSION['ses_emailcad'];
echo "<br>SESSION acessoemailcad. ". $_SESSION['acessoemailcad'];
echo "<br>SESSION acessocep1 .... ". $_SESSION['acessocep1'];
echo "<br>SESSION cadcep1 .. .... ". $_SESSION['cadcep1'];
*/
include("func/config.php");
include_once("../_func/phpmailer/class.phpmailer.php");

include("includes/i_pes_ini.php");

if ($at == "s"){
	$c_erros = "";
	
	/* ##################### INSERCAO ##################### */	
	//if ($tipo == "cad" || $tipo == ""){	
	if($modulo == "pessoa" && $acessoemailcad != ""){
		// user
		if (isset($_POST['USR_SENHA'])){
			$USR_SENHA = base64_encode($_POST['USR_SENHA']);
		}
		
		if (isset($_POST['REUSR_SENHA'])){
			$REUSR_SENHA = base64_encode($_POST['REUSR_SENHA']);
		}
		$erro_senha = "";
		if ($USR_SENHA != $REUSR_SENHA){
			$c_erros = $c_erros . ",A senha informada difere da senha de confirmação.";
			$erro_senha = "erro";
		}
		if ($USR_SENHA == "" && $REUSR_SENHA == ""){
			$c_erros = $c_erros . ",Senha não foi informada.";
			$erro_senha = "erro";
		}

		// pessoa
		$erro_email = "";
		$USR_EMAIL = "";
		if (isset($_POST['USR_EMAIL'])) $USR_EMAIL = $_POST['USR_EMAIL'];
		if ($USR_EMAIL == ""){ 
			$c_erros = $c_erros . ",E-mail";
			$erro_email = "erro";
		}
		
		$REUSR_EMAIL = "";
		if (isset($_POST['REUSR_EMAIL'])){
			$REUSR_EMAIL = $_POST['REUSR_EMAIL'];
		}
		if ($REUSR_EMAIL == ""){ 
			$c_erros = $c_erros . ",E-mail de Confirmação não informado.";
			$erro_email = "erro";
		}
		
		if (($USR_EMAIL != "" && $REUSR_EMAIL != "") && ($USR_EMAIL != $REUSR_EMAIL)){
			$c_erros = $c_erros . ",O e-mail informado difere do e-mail de confirmação.";
			$erro_email = "erro";
		}
	}else{
		$USR_EMAIL = "";
		if (isset($_POST['hd_USR_EMAIL'])){
			$USR_EMAIL = $_POST['hd_USR_EMAIL'];
		}
	}	

	// Somente at quando for Primeiro Cadastro
	if($modulo == "pessoa" || $modulo == "cadastro"){
		if (isset($_POST['PES_TIPO'])){
			$PES_TIPO = $_POST['PES_TIPO'];
			
			if ($PES_TIPO == "J"){
				if (isset($_POST['PES_CNPJ'])){
					$PES_CPFCNPJ = $_POST['PES_CNPJ'];
					$PES_CNPJ = $_POST['PES_CNPJ'];
				}
			}else{
				if (isset($_POST['PES_CPF'])){
					$PES_CPFCNPJ = $_POST['PES_CPF'];
					$PES_CPF = $_POST['PES_CPF'];
				}
			}
		}

		if ($PES_CPFCNPJ == ""){
			if ($PES_TIPO == "J"){
				$c_erros = $c_erros . ",CNPJ não informado.";
				$erro_cnpj = "erro";
			}else{
				$c_erros = $c_erros . ",CPF não informado.";
				$erro_cpf = "erro";
			}
		}else{
			// Caso esteja vazio e que nao foi acessado em Meus Dados
			if ($loginemailtop == ""){
				$sql_busca = "SELECT * FROM pessoa WHERE PES_CPFCNPJ = '$PES_CPFCNPJ'";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$num_busca = mysql_num_rows($exe_busca);
				//$num_busca=0 "Sem Registro" | $num_busca=1 "Com Registro"
				if ($num_busca == 1){
					if ($PES_TIPO == "J"){
						$c_erros = $c_erros . ",CNPJ já existe.";
						$erro_cnpj = "erro";
					}else{
						$c_erros = $c_erros . ",CPF já existe.";
						$erro_cpf = "erro";
					}
				}
			}

			// Valida CPF/CNPJ
			if ($PES_TIPO == "J")
				$c_erros = $c_erros . CalculaCNPJ($PES_CPFCNPJ);
			else
				$c_erros = $c_erros . CalculaCPF($PES_CPFCNPJ);
		}
	}else{
		// Busca o CPF/CNPJ para consulta
		if (isset($_SESSION['ses_cpfcnpj'])) $PES_CPFCNPJ = soNumero($_SESSION['ses_cpfcnpj']);

		$sql_busca = "SELECT * FROM pessoa WHERE PES_CPFCNPJ = '$PES_CPFCNPJ'";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca == 1){
			$PES_TIPO = $fet_busca['PES_TIPO'];

			if ($PES_TIPO == "J")
				$PES_CNPJ = $PES_CPFCNPJ;
			else
				$PES_CPF = $PES_CPFCNPJ;

			$PES_RG = $fet_busca['PES_RG'];
		}
	}

	include_once("includes/i_pes_post.php");
	
// echo "<br>action ". $action ."<br>loginemailtop " . $loginemailtop . "<br> login_senha " . $login_senha;

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		cadPessoa(	soNumero($PES_CPFCNPJ),
					$USR_EMAIL,
					$USR_SENHA,
					$USR_ATIVO,
					$USR_SESSAO,
					$USR_RECEBE_EMAILS,
					$PES_TIPO,
					$PES_NOME,
					$PES_SEXO,
					$PES_DT_CAD,
					$PES_DT_NASC,
					$PES_STATUS,
					$PES_RG,
					$PES_OBS,
					$PES_RAZAO_SOC,
					$PES_CNPJ_NOME_FANT,
					$PES_INSC_MUNICIP,
					$PES_INSC_ESTAD,
					$PES_CNPJ_ISENTO);
						
		cadPesEnd(	soNumero($PES_CPFCNPJ),
					$USR_EMAIL,
					$END_CODIGO,
					$END_NOME,
					$END_NUMERO,
					$END_COMPL,
					$END_COMPL_OBS,
					$END_BAIRRO,
					$END_CIDADE,
					$END_ESTADO,
					$END_PAIS,
					soNumero($END_CEP),
					"S");

		cadPesCtt(	soNumero($PES_CPFCNPJ),
					$CTT_FONE_RES_1.$CTT_FONE_RES_2,
					$CTT_FONE_RES_RAM,
					$CTT_FONE_COM_1.$CTT_FONE_COM_2,
					$CTT_FONE_COM_RAM,
					$CTT_FONE1_1.$CTT_FONE1_2);

		// #### ARMAZENA CPF / CNPJ NA SESSAO, caso exista pedido ####
		CPFCNPJSessaoPedido($PES_CPFCNPJ, $ck_sessao);
	}
	/* ##################### INSERCAO ##################### */
}else{
	include_once("includes/i_pes_cons.php"); // CONSULTA
}

// ACESSO SESSAO USUARIO e PASSA PARA PAGINA
if ($at == "s" && $c_erros == ""){
	$_SESSION['action'] = "cad";
	
	if ($PES_TIPO == "J"){
		$_SESSION['ses_cpfcnpj'] = soNumero($PES_CNPJ);
	}else{
		$_SESSION['ses_cpfcnpj'] = soNumero($PES_CPF);
	}

	$_SESSION['sesEmailLog']	= $USR_EMAIL;
	$_SESSION['loginsenha'] = $USR_SENHA;
	$_SESSION['nome'] 		= $PES_NOME;

	if($modulo == "pessoa" && $acessoemailcad != ""){
		// LIMPA DADOS
		$_SESSION['acessocep1']  	= "";
		$_SESSION['acessocep2']  	= "";
		$_SESSION['tipo'] 	  		= "logou";
		$_SESSION['acessoemailcad'] = "";

		if ($_SESSION['pedido_passos'] != ""){
			?>
			<script language="javascript" type="text/javascript">window.location="endereco";</script>
			<?php
		}else{
			echo msgAviso("Cadastro Realizado!","");			
			?>
			<script language="javascript" type="text/javascript">window.location="principal";</script>
			<?php
		}
	}else{
		echo msgAviso("Cadastro Atualizado!","");
	}
}
?>

<div id="titulo_noline">Identificação</div></br>

<form id="formCadPessoa" name="formCadPessoa" action="<?php echo $modulo; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at" 				value="s">
	<input type="hidden" name="PES_DT_CAD" 		value="<?php if($PES_DT_CAD != ""){ echo $PES_DT_CAD; } ?>">
	<input type="hidden" name="hd_USR_EMAIL" 	value="<?php if($USR_EMAIL != ""){ echo $USR_EMAIL; } ?>">
	<input type="hidden" name="hdEND_CODIGO" 	value="">
	<input type="hidden" name="hdEND_CEP" 		value="">
	<input type="hidden" name="hdEND_NOME" 		value="">
	<input type="hidden" name="hdEND_NUMERO" 	value="">
	<input type="hidden" name="hdEND_COMPL" 	value="">
	<input type="hidden" name="hdEND_COMPL_OBS" value="">
	<input type="hidden" name="hdEND_BAIRRO" 	value="">
	<input type="hidden" name="hdEND_CIDADE" 	value="">
	<input type="hidden" name="hdEND_ESTADO" 	value="">
	<input type="hidden" name="hdTipEndCtt" 	value="">

	<?php //if($modulo == "pessoa" || $modulo == "cadastro"){ 
		  if($modulo == "pessoa" && $loginemailtop == ""){
	?>
	<table border="0" cellspacing="0" cellpadding="0" style="font-size:17px;" align="center">
		<tr>
			<td class="td_cad" ><div align="right"><b><label style="margin-right:5px;">Você é: &nbsp;&nbsp;</label></b></div></td>
			<td><input type="radio" name="PES_TIPO" value="F" onclick="ControlCPFCNPJ('S');" <?php if ($PES_TIPO != "J"){echo "checked";} ?>><b><label style="margin-right:5px; color:blue;">Pessoa Física&nbsp;&nbsp;&nbsp;</label></b></td>
			<td><input type="radio" name="PES_TIPO" value="J" onclick="ControlCPFCNPJ();" <?php if ($PES_TIPO == "J"){echo "checked";} ?>><b><label style="margin-right:5px; color:blue;">Pessoa Jurídica</label></b></td>
		</tr>
	</table>
	</br>
	<?php } ?>

	<!-- ########################### DADOS EMPRESA ########################### -->
	<div id="blockCNPJ01">
	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0">
		<tr>
			<td align="left" colspan="2">				
				<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td><label style="font-size:18px"><strong>Dados da Empresa</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-left:55px;">
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Razão Social</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_razaosoc != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" style="WIDTH:142px;" name="PES_RAZAO_SOC" value="<?php if($PES_RAZAO_SOC != ""){ echo $PES_RAZAO_SOC; } ?>"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Nome Fantasia</label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_nomefant != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" style="WIDTH:142px;" name="PES_CNPJ_NOME_FANT" value="<?php if($PES_CNPJ_NOME_FANT != "") echo $PES_CNPJ_NOME_FANT; ?>"></div></td>
					</tr>

					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>CNPJ</label></b></div></td>
						<td align="left">
							<input type="text" class="<?php if($erro_cnpj != ""){echo "field_error";}else{echo "input";} ?>" 
								   name="PES_CNPJ" value="<?php if($PES_CPFCNPJ != ""){ echo $PES_CPFCNPJ; } ?>" maxlength="18" style="width:142px;"
								   onkeypress="return valCNPJ(event,this); return false;"
								   onBlur="ValidarCNPJ(document.formCadPessoa.PES_CNPJ);"
								   <?php if(!($modulo == "pessoa" || $modulo == "cadastro")){echo "readOnly='true' disabled";} ?>>
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;"><font color="grey">Inscrição Estadual</font></label></b></div></td>
						<td align="left"><div ><input type="text" class="<?php if($erro_inscest != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" style="WIDTH:142px;" name="PES_INSC_ESTAD" value="<?php if($PES_INSC_ESTAD != "") echo $PES_INSC_ESTAD; ?>"></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Isento</label></b></div></td>
						<td align="left"><div ><input type="checkbox" class="input" name="PES_CNPJ_ISENTO" <?php if($PES_CNPJ_ISENTO != ""){ echo "checked"; } ?>></div></td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Responsável</label></b></div></td>
						<td align="left">
							<input type="text" class="<?php if($erro_resp != ""){echo "field_error";}else{echo "input";} ?>" size="12" maxlength="80" style="WIDTH:190px;" name="PES_RESPONS" value="<?php if($PES_NOME != "") echo $PES_NOME; ?>">
						</td>
					</tr>
					<tr>
						<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;"><font color="grey">Telefone Comercial</font></label></b></div></td>
						<td align="left">
							<input type="text" style="WIDTH:30px;"  maxlength="2"  name="CTT_FONE_COM_1" value="<?php if($CTT_FONE_COM_1 != "") echo $CTT_FONE_COM_1; ?>" class="<?php if($erro_fone_com_1 != "") echo "field_error"; else echo "input"; ?>" onKeyPress="return(ConsisteNumerico('2',this,event))"> - 
							<input type="text" style="WIDTH:100px;" maxlength="14" name="CTT_FONE_COM_2" value="<?php if($CTT_FONE_COM_2 != "") echo $CTT_FONE_COM_2; ?>" class="<?php if($erro_fone_com_2 != "") echo "field_error"; else echo "input"; ?>" onKeyPress="return(ConsisteNumerico('9',this,event))">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Ramal <input class="input" size="4" maxlength="9" name="CTT_FONE_COM_RAM" value="<?php if($CTT_FONE_COM_RAM != "") echo $CTT_FONE_COM_RAM; ?>" >
						</td>
					</tr>
				</table>
			</td>
		</tr>		
	</table>
	</div>

	<!-- ########################### DADOS PESSOAIS ########################### -->
	<div id="blockCPF01">
	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0">
		<tr>
			<td align="left" colspan="2">
				<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td><label style="font-size:18px"><strong>Dados Pessoais</strong></label></td> 
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0" style="margin-left:63px;">
		<tr>
			<td width="30%" class="td_cad"><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Nome Completo</label></b></div></td>
			<td align="left"><input type="text" class="<?php if($erro_nome != ""){echo "field_error";}else{echo "input";} ?>" maxlength="80" id="name" name="PES_NOME" style="width:300px;" value="<?php if($PES_NOME != "") echo $PES_NOME; ?>"></td>
		</tr>

		<tr>
			<td width="30%" class="td_cad"><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>CPF</label></b></div></td>
			<td align="left">
				<input type="text" class="<?php if($erro_cpf != ""){echo "field_error";}else{echo "input";} ?>" name="PES_CPF"
					   value="<?php if($PES_CPFCNPJ != ""){ echo $PES_CPFCNPJ; } ?>" maxlength="14" style="width:142px;"
					   onkeypress="return valCPF(event,this); return false;"
					   onBlur="ValidarCPF(document.formCadPessoa.PES_CPF);"
					   <?php if(!($modulo == "pessoa" || $modulo == "cadastro")){echo "readOnly='true' disabled";} ?>>
			</td>
		</tr>

		<tr>
			<td class="td_cad" align="right"><div align="right" id="div_txt_rg"><b><label style="margin-right:5px;">RG</label></b></div></td>
			<td align="left">
				<input type="text" class="<?php if($erro_rg != ""){echo "field_error";}else{echo "input";} ?>" maxlength="20" style="WIDTH:142px;" name="PES_RG" value="<?php if($PES_RG != "") echo $PES_RG; ?>"
				<?php if(!($modulo == "pessoa" || $modulo == "cadastro")){echo "readOnly='true' disabled";} ?>>
			</td>
		</tr>
		<tr>
			<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Sexo</label></b></div></td>
			<td align="left">
				<input type="radio" name="PES_SEXO" value="M" <?php if($PES_SEXO == "M" || $PES_SEXO == "") echo "checked"; ?>/>Masculino
				<input type="radio" name="PES_SEXO" value="F" <?php if($PES_SEXO == "F") echo "checked"; ?>/>Feminino
			</td>
		</tr>
		<tr>
			<td class="td_cad"><div align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Data Nascimento</label></b></div></td>
			<td align="left">
			<!-- id="datepicker"  -->
			<input 	type="text" maxlength="10" style="WIDTH:75px;" id="PES_DT_NASC" name="PES_DT_NASC" 
					class="<?php if($erro_dtnasc != ""){echo "field_error";}else{echo "input";} ?>" 
					value="<?php if($PES_DT_NASC != "") echo $PES_DT_NASC; ?>"
					onkeypress="return valData(event,this); return false;"
					onBlur="ValidarData(document.formCadPessoa.PES_DT_NASC)"/> 
					&nbsp; <font color="grey">dd/mm/aaaa</font>
			</td>
		</tr>
	</table>
	</div>
	
	<!-- ########################### EMAIL DE LOGIN E CONTATO ########################### -->
	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0">			
		<!-- ######################  Somente mostra EMAIL ou SENHA ao cadastrar ###################### -->
		<?php if ($modulo == "pessoa" || $modulo == "cadastro"){ ?>
			<tr>
				<td align="left" colspan="2">
					<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB">
						<tr>
							<td><label style="font-size:18px"><strong>Email de Login e Contato</strong></label></td> 
						</tr> 
					</table>
				</td>
			</tr>
			<tr>
				<td width="150" class="td_cad"><div align="right"><b><label for="" style="margin-right:5px;"><font color="red">* </font>E-mail</label></b></div></td>
				<td align="left"><input type="text" class="<?php if($erro_email != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="cad_email" name="USR_EMAIL" value="<?php if($USR_EMAIL != "") echo $USR_EMAIL; ?>"></td>
			</tr>
			<tr>
				<td width="150" class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Repita o E-mail</label></b></div></td>
				<td align="left"><input type="text" class="<?php if($erro_email != ""){echo "field_error";}else{echo "input";} ?>" maxlength="60" style="width:300px;" id="recad_email" name="REUSR_EMAIL" value="<?php if($REUSR_EMAIL != "") echo $REUSR_EMAIL; ?>"></td>
			</tr>
			
			<!-- ########################### SENHA ########################### -->
			<tr>
				<td align="left" colspan="2">
					<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB">
						<tr>
							<td><label style="font-size:18px"><strong>Escolha uma Senha</strong></label></td> 
						</tr> 
					</table>
				</td>
			</tr>
			<tr>
				<td width="150" class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Senha</label></b></div></td>
				<td align="left"><input type="password" maxlength="100" style="WIDTH:50%;" id="cad_senha" name="USR_SENHA" class="<?php if($erro_senha != ""){echo "field_error";}else{echo "input";} ?>"></td>
			</tr>
			<tr>
				<td width="150" class="td_cad" ><div align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font>Repita a Senha</label></b></div></td>
				<td align="left"><input type="password" maxlength="100" style="WIDTH:50%;" id="recad_senha" name="REUSR_SENHA" class="<?php if($erro_senha != ""){echo "field_error";}else{echo "input";} ?>"></td>
			</tr>
			<!-- SENHA DE ACESSO -->
		<?php } ?>

		<!-- ######################  ENDERECO ###################### -->
		<tr>
			<td align="left" colspan="2">
				<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td><label style="font-size:18px"><strong>Endereço de Entrega</strong></label></td> 
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" width="82%" class="td_cad">
				<iframe name="iframeCEP" id="iframeCEP" src="./ajax_cep.php" frameborder="0" scrolling="no" align="center" width="100%" height="246px" style="margin-left:62px;">
					Sem suporte a iFrames.
				</iframe>
			</td>
		</tr>
		<tr>
			<td class="td_cad"><div align="right" id="fone01"><b><font color="red">* </font><label style="margin-right:5px;">Celular</label></b></div></td>
			<td align="left">
				<input type="text" style="WIDTH:30px;"  maxlength="2" id="CTT_FONE1_1" name="CTT_FONE1_1" value="<?php if($CTT_FONE1_1 != "") echo $CTT_FONE1_1; ?>" class="<?php if($erro_fone1_1 != ""){echo "field_error";}else{echo "input";} ?>" onKeyPress="return(ConsisteNumerico('2',this,event))" onkeyup="if(this.value.length == 2) document.formCadPessoa.CTT_FONE1_2.focus()"> - 
				<input type="text" style="WIDTH:100px;" maxlength="9" id="CTT_FONE1_2" name="CTT_FONE1_2" value="<?php if($CTT_FONE1_2 != "") echo $CTT_FONE1_2; ?>" class="<?php if($erro_fone1_2 != ""){echo "field_error";}else{echo "input";} ?>" onKeyPress="return(ConsisteNumerico('9',this,event))">
			</td>
		</tr>
		<tr>
			<td class="td_cad"><div align="right" id="fone01"><b><label style="margin-right:5px;"><font color="grey">Telefone</font></label></b></div></td>
			<td align="left">
				<input type="text" style="WIDTH:30px;"  maxlength="2" id="CTT_FONE_RES_1" name="CTT_FONE_RES_1" value="<?php if($CTT_FONE_RES_1 != ""){ echo $CTT_FONE_RES_1; } ?>" class="<?php if($erro_fone_res_1 != "") echo "field_error"; else echo "input"; ?>" onKeyPress="return(ConsisteNumerico('2',this,event))" onkeyup="if(this.value.length == 2) document.formCadPessoa.CTT_FONE_RES_2.focus()"> - 
				<input type="text" style="WIDTH:100px;" maxlength="9" id="CTT_FONE_RES_2" name="CTT_FONE_RES_2" value="<?php if($CTT_FONE_RES_2 != ""){ echo $CTT_FONE_RES_2; } ?>" class="<?php if($erro_fone_res_2 != "") echo "field_error"; else echo "input"; ?>" onKeyPress="return(ConsisteNumerico('9',this,event))">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ramal&nbsp;&nbsp;<input type="text" class="input" size="4" maxlength="9" name="CTT_FONE_RES_RAM" value="<?php if($CTT_FONE_RES_RAM != ""){ echo $CTT_FONE_RES_RAM; } ?>" >
			</td>
		</tr>
		<!--
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font style="color:;"><u>Operadora</u></font>&nbsp;&nbsp;
		<select name="CTT_FONE1_OPER" class="select">
			<option value=""      <?php //if($CTT_FONE1_OPER == ""){     echo "selected";} ?>>::Operadora::</option>
			<option value="VIVO"  <?php //if($CTT_FONE1_OPER == "VIVO"){ echo "selected";} ?>>VIVO</option>
			<option value="Oi"    <?php //if($CTT_FONE1_OPER == "Oi"){   echo "selected";} ?>>Oi</option>
			<option value="TIM"   <?php //if($CTT_FONE1_OPER == "TIM"){  echo "selected";} ?>>TIM</option>
			<option value="Claro" <?php //if($CTT_FONE1_OPER == "Claro"){echo "selected";} ?>>Claro</option>
		</select>
		-->
		<!-- ###################### FIM - ENDERECO ###################### -->
		
		<tr><td colspan="2" align="center"></br><font color="red">* Campos Obrigatórios</font></td></tr>
		<tr align="center">
			<td colspan="2" valign="middle">
				<table border="0" cellspacing="0" cellpadding="0" style="padding-top:15px;">
					<tr>
						<td width="25"><input type="checkbox" name="USR_RECEBE_EMAILS" <?php if($USR_RECEBE_EMAILS == "N")echo ""; else echo "checked"; ?>></td>
						<td>Aceita receber e-mails com notícias e novidades?</td>
					</tr>
				</table>
				</br>
			</td>
		</tr>		
		<tr>
			<td colspan="2" align="center">
				<!--<a class="button01" href="document.forms['form1'].submit();" onclick="">atr</a>-->
				<?php 
				//if ($tipo == "logou"){
				if($modulo == "pessoa" && $loginemailtop != ""){
				?>
					<input class="btsubmit" type="submit" name="btCadPes" value="Alterar" onclick="gravaCEP()">
				<?php }else{ ?>
					<input class="btsubmit" type="submit" name="btCadPes" value="Cadastrar" onclick="gravaCEP()">
				<?php } ?>
			</td>
		</tr>
		<!-- FIM endereco -->
	</table>
	</br></br>
	
	<?php if($PES_TIPO == "J"){ ?>
		<script type="text/javascript">ControlCPFCNPJ('');</script>
	<?php }else{ ?>
		<script type="text/javascript">ControlCPFCNPJ('S');</script>
	<?php } ?>
</form>

</body>
</html>