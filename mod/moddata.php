<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

	<link rel="stylesheet" type="text/css" href="css/style.css"/>

	<script language="javascript" src="script/x_mascara.js"></script>

	<script language="javascript" type="text/javascript">
	</script>
	</head>

	<body style="color: black;">
<?php

include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");
include_once("includes/i_pes_ini.php");

if ($at == "s"){

	include_once("includes/i_pes_post.php");

	if (isset($_POST['PES_CPFCNPJ'])) $PES_CPFCNPJ = $_POST['PES_CPFCNPJ'];

	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		cadPesCtt(	soNumero($PES_CPFCNPJ),
					$CTT_FONE_RES_1.$CTT_FONE_RES_2,
					$CTT_FONE_RES_RAM,
					$CTT_FONE_COM_1.$CTT_FONE_COM_2,
					$CTT_FONE_COM_RAM,
					$CTT_FONE1_1.$CTT_FONE1_2);
	}
	/* ##################### INSERCAO ##################### */
}else{	
}

include_once("includes/i_pes_cons.php"); // CONSULTA

?>
<div id="titulo_noline">Alterar Dados</div>

<form id="formCadPessoa" name="formCadPessoa" action="<?php echo $modulo; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at" value="s">
	<input type="hidden" name="hd_USR_EMAIL" 	value="<?php if ($USR_EMAIL != "")   echo $USR_EMAIL; ?>">
	<input type="hidden" name="PES_CPFCNPJ" 	value="<?php if ($PES_CPFCNPJ != "") echo soNumero($PES_CPFCNPJ); ?>">
	<input type="hidden" name="PES_RG" 			value="<?php if ($PES_RG != "") 	 echo $PES_RG; ?>">
	<input type="hidden" name="PES_TIPO" 		value="<?php if ($PES_TIPO != "") 	 echo $PES_TIPO; ?>">
	
	<!-- ################################################################################# 
	###################################### DADOS EMPRESA #################################
	###################################################################################### -->
	<?php if ($PES_TIPO == "J"){ ?>
	
	<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB" style="margin-top:10px; margin-bottom:10px;">
		<tr>
			<td><label style="font-size:18px"><strong>
			Dados da Empresa
			</strong></label></td>
		</tr>
	</table>

	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0">
		<tr>
			<td width="300x" align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Razão Social</label></b></td>
			<td align="left"><div ><input type="text" class="<?php if($erro_razaosoc != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" style="WIDTH:142px;" name="PES_RAZAO_SOC" value="<?php if($PES_RAZAO_SOC != ""){ echo $PES_RAZAO_SOC; } ?>"></div></td>
		</tr>
		<tr>
			<td align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Nome Fantasia</label></b></td>
			<td align="left"><div ><input type="text" class="<?php if($erro_nomefant != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" style="WIDTH:142px;" name="PES_CNPJ_NOME_FANT" value="<?php if($PES_CNPJ_NOME_FANT != ""){ echo $PES_CNPJ_NOME_FANT; } ?>"></div></td>
		</tr>

		<tr>
			<td align="right"><b><label style="margin-right:5px;">CNPJ</label></b></td>
			<td align="left">
				<input type="text" class="input" name="CNPJ" value="<?php if($PES_CPFCNPJ != "") echo $PES_CPFCNPJ; ?>" style="width:142px;" readOnly='true' disabled>
			</td>
		</tr>
		<tr>
			<td align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Inscrição Estadual</label></b></td>
			<td align="left"><div ><input type="text" class="<?php if($erro_inscest != ""){echo "field_error";}else{echo "input";} ?>" maxlength="30" style="WIDTH:142px;" name="PES_INSC_ESTAD" value="<?php if($PES_INSC_ESTAD != "") echo $PES_INSC_ESTAD; ?>"></div></td>
		</tr>
		<tr>
			<td align="right"><b><label style="margin-right:5px;">Isento</label></b></td>
			<td align="left"><div ><input type="checkbox" class="input" name="PES_CNPJ_ISENTO" <?php if($PES_CNPJ_ISENTO != "") echo "checked"; ?>></div></td>
		</tr>
		<tr>
			<td align="right"><b><label style="margin-right:5px;"><font color="grey">Telefone Comercial</font></label></b></td>
			<td align="left">
				<input type="text" style="WIDTH:30px;"  maxlength="2"  name="CTT_FONE_COM_1" value="<?php if($CTT_FONE_COM_1 != "") echo $CTT_FONE_COM_1; ?>" class="input" onKeyPress="return(ConsisteNumerico('2',this,event))"> - 
				<input type="text" style="WIDTH:100px;" maxlength="14" name="CTT_FONE_COM_2" value="<?php if($CTT_FONE_COM_2 != "") echo $CTT_FONE_COM_2; ?>" class="input" onKeyPress="return(ConsisteNumerico('9',this,event))">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ramal:<input class="input" size="4" maxlength="9" name="CTT_FONE_COM_RAM" value="<?php if($CTT_FONE_COM_RAM != "") echo $CTT_FONE_COM_RAM; ?>" >
			</td>
		</tr>
	</table>
	<?php } ?>

	<!-- ################################################################################# 
	###################################### DADOS PESSOAIS ################################
	###################################################################################### -->
	<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB" style="margin-top:10px; margin-bottom:10px;">
		<tr>
			<td>
				<label style="font-size:18px"><strong>
				<?php if ($PES_TIPO == "F"){ ?>
				<div>Dados Pessoais</div>
				<?php }else{ ?>
				<div>Dados do Contato na Empresa</div>
				<?php } ?>
				</strong></label>
			</td> 
		</tr>
	</table>
	
	<table class="pessoa" width="100%" border="0" cellspacing="4" cellpadding="0">
		<tr>
			<td width="300x" align="right"><b><label for="name" style="margin-right:5px;"><font color="red">* </font><?php if ($PES_TIPO == "F") echo "Nome Completo"; else echo "Responsável"; ?></label></b></td>
			<td align="left"><input type="text" class="<?php if($erro_nome != "") echo "field_error"; else echo "input"; ?>" maxlength="80" id="name" name="PES_NOME" style="width:300px;" value="<?php if($PES_NOME != "") echo $PES_NOME; ?>"></td>
		</tr>
		<?php if ($PES_TIPO == "F"){ ?>
		<tr>
			<td width="300x" align="right"><b><label for="name" style="margin-right:5px;">CPF</label></b></td>
			<td align="left">
				<input type="text" class="input" name="CPF" value="<?php if($PES_CPFCNPJ != "") echo $PES_CPFCNPJ; ?>" style="width:142px;" readOnly='true' disabled>
			</td>
		</tr>
		<tr>
			<td class="td_cad" align="right"><b><label style="margin-right:5px;">RG</label></b></td>
			<td align="left">
				<input type="text" class="<?php if($erro_rg != "") echo "field_error"; else echo "input"; ?>" maxlength="20" style="WIDTH:142px;" name="PES_RG" value="<?php if($PES_RG != ""){ echo $PES_RG; } ?>">
			</td>
		</tr>
		<tr>
			<td class="td_cad" align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Sexo</label></b></td>
			<td align="left">
				<input type="radio" name="PES_SEXO" value="M" <?php if($PES_SEXO == "M") echo "checked"; ?>/>Masculino
				<input type="radio" name="PES_SEXO" value="F" <?php if($PES_SEXO == "F") echo "checked"; ?>/>Feminino
			</td>
		</tr>
		<tr>
			<td class="td_cad" align="right"><b><label style="margin-right:5px;"><font color="red">* </font>Data Nascimento</label></b></td>
			<td align="left">
			<!-- id="datepicker"  -->
			<input id="" class="<?php if($erro_dtnasc != ""){echo "field_error";}else{echo "input";} ?>"
				   type="text" maxlength="10" style="WIDTH:75px;" name="PES_DT_NASC" value="<?php if($PES_DT_NASC != "") echo $PES_DT_NASC; ?>"
				   onkeypress="return valData(event,this); return false;"/> &nbsp; <font color="grey">dd/mm/aaaa</font>
			</td>
		</tr>
		<?php } ?>
		
		<tr>
			<td class="td_cad" align="right"><div id="fone01"><b><font color="red">* </font><label style="margin-right:5px;">Celular</label></b></div></td>
			<td align="left">
				<input type="text" style="WIDTH:30px;"  maxlength="2" name="CTT_FONE1_1" value="<?php if($CTT_FONE1_1 != "") echo $CTT_FONE1_1; ?>" class="<?php if($erro_fone1_1 != ""){echo "field_error";}else{echo "input";} ?>" onKeyPress="return(ConsisteNumerico('2',this,event))"> - 
				<input type="text" style="WIDTH:100px;" maxlength="9" name="CTT_FONE1_2" value="<?php if($CTT_FONE1_2 != "") echo $CTT_FONE1_2; ?>" class="<?php if($erro_fone1_2 != ""){echo "field_error";}else{echo "input";} ?>" onKeyPress="return(ConsisteNumerico('9',this,event))">
			</td>
		</tr>
		<tr>
			<td class="td_cad" align="right"><div id="fone01"><b><label style="margin-right:5px;"><font color="grey">Telefone</font></label></b></div></td>
			<td align="left">
				<input type="text" style="WIDTH:30px;"  maxlength="2" name="CTT_FONE_RES_1" value="<?php if($CTT_FONE_RES_1 != ""){ echo $CTT_FONE_RES_1; } ?>" class="<?php if($erro_fone_res_1 != ""){echo "field_error";}else{echo "input";} ?>" onKeyPress="return(ConsisteNumerico('2',this,event))"> - 
				<input type="text" style="WIDTH:100px;" maxlength="9" name="CTT_FONE_RES_2" value="<?php if($CTT_FONE_RES_2 != ""){ echo $CTT_FONE_RES_2; } ?>" class="<?php if($erro_fone_res_2 != ""){echo "field_error";}else{echo "input";} ?>" onKeyPress="return(ConsisteNumerico('9',this,event))">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ramal&nbsp;&nbsp;<input type="text" class="input" size="4" maxlength="9" name="CTT_FONE_RES_RAM" value="<?php if($CTT_FONE_RES_RAM != ""){ echo $CTT_FONE_RES_RAM; } ?>" >
			</td>
		</tr>
		
		<tr><td colspan="2" align="center"></br><font color="red">* Campos Obrigatórios</font></td></tr>
		<tr align="center">
			<td colspan="2" valign="middle">
				<table border="0" cellspacing="0" cellpadding="0" style="padding-top:15px;">
					<tr>
						<td width="25"><input type="checkbox" name="USR_RECEBE_EMAILS" <?php if($USR_RECEBE_EMAILS == "N") echo ""; else echo "checked"; ?>></td>
						<td>Aceita receber e-mails com notícias e novidades?</td>
					</tr>
				</table>
			</td>
		</tr>		
		<tr>
			<td colspan="2" align="center">
				<input class="btsubmit" type="submit" name="btCadPes" value="Alterar" onclick="">
			</td>
		</tr>
	</table>
	</br></br>

</form>
</body>
</html>