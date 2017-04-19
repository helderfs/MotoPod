<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		
		<script src="script/jquery-1.5.1.js" 				type="text/javascript"></script>
		<script src="script/menu.js" 		 				type="text/javascript"></script>
		<script src="script/jquery.ui.core.js"	 			type="text/javascript"></script>
		<script src="script/jquery.ui.widget.js" 		   	type="text/javascript"></script>
		<script src="script/jquery.ui.datepicker.js" 	   	type="text/javascript"></script>
		<script src="script/jquery.ui.datepicker-pt-BR.js" 	type="text/javascript"></script>
		
		<link href="css/_templatemo_style.css" rel="stylesheet" type="text/css" />
		
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

			
			function selAllUsu(){
				var nomeCampo = "";

				for (x =0; x < window.document.formEnvioEmail.elements.length; x++){
					if (window.document.formEnvioEmail.elements[x].type == 'checkbox'){
						nomeCampo = window.document.formEnvioEmail.elements[x].name;

						if (nomeCampo.substring(0,9) == "chkUsuSel"){
							if (window.document.formEnvioEmail.chkGridUsu.checked){
								window.document.formEnvioEmail.elements[x].checked = true;
							}else{
								window.document.formEnvioEmail.elements[x].checked = false;
							}
						}
					}
				}
			}
			
			function EnviaEmail(){
				var select = false;

				for (x =0; x < window.document.formEnvioEmail.elements.length; x++){
					if (window.document.formEnvioEmail.elements[x].type == 'checkbox'){
						nomeCampo = window.document.formEnvioEmail.elements[x].name;

						if (nomeCampo.substring(0,9) == "chkUsuSel"){
							if (window.document.formEnvioEmail.elements[x].checked){
								if (window.document.formEnvioEmail.SelUsuEmail.value == ""){
									window.document.formEnvioEmail.SelUsuEmail.value = window.document.formEnvioEmail.elements[x].value;
								}else{
									window.document.formEnvioEmail.SelUsuEmail.value = window.document.formEnvioEmail.SelUsuEmail.value + "|" + window.document.formEnvioEmail.elements[x].value;
								}								
								select = true;
							}
						}
					}
				}
				
				if(select == false){
					alert("AVISO!\n\nSelecione uma pessoa para Enviar E-mail!");
				}else{
					window.document.formEnvioEmail.submit();
				}
			}
			
		</script>

		<script language="javascript" src="script/x_mascara.js"></script>
		
	</head>

<?php

include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../../_func/phpmailer/class.phpmailer.php");

$qtDias = 0;
$c_erros = "";
$dtIni = "";
$dtFim = "";

$acessoemailcad = "";
$tipo = "";
$email = "";
$CPFCNPJ = "";
$SelUsuEmail = "";
$btProcura = "";
$at = "";

if (isset($_SESSION['acessoemailcad']))	$acessoemailcad = $_SESSION['acessoemailcad'];
if (isset($_SESSION['tipo'])) 			$tipo = $_SESSION['tipo'];
if (isset($_SESSION['sesEmailLog'])) 		$email = $_SESSION['sesEmailLog'];
if (isset($_SESSION['ses_cpfcnpj'])) 	$CPFCNPJ = soNumero($_SESSION['ses_cpfcnpj']);
if (isset($_POST['SelUsuEmail'])) 		$SelUsuEmail = $_POST['SelUsuEmail'];
if (isset($_POST['btProcura']))			$btProcura = $_POST['btProcura'];
if (isset($_POST['at'])) 				$at = $_POST['at'];

if ($btProcura != ""){

	/* ##################### ALTERACAO ##################### */
	$dtIniPost = "";
	$erro_dt_ini = "";
	if (isset($_POST['dtIni'])){
		if ($_POST['dtIni'] != "")
			$dtIniPost = substr($_POST['dtIni'], 6, 4) . '-' . substr($_POST['dtIni'], 3, 2) . '-' . substr($_POST['dtIni'], 0, 2);
	}
	if ($dtIniPost == ""){
		$c_erros = $c_erros . ",Data Inicial não informada.";
		$erro_dt_ini = "erro";
	}

	$dtFimPost = "";
	$erro_dt_fim = "";
	if (isset($_POST['dtFim'])){
		if ($_POST['dtFim'] != "")
			$dtFimPost = substr($_POST['dtFim'], 6, 4) . '-' . substr($_POST['dtFim'], 3, 2) . '-' . substr($_POST['dtFim'], 0, 2);
	}
	if ($dtFimPost == ""){
		$c_erros = $c_erros . ",Data Final não informada.";
		$erro_dt_fim = "erro";
	}

	if ($dtIniPost == $dtFimPost){
		$c_erros = $c_erros . ",Data Inicial e Final não podem ser iguais.";
	}
	
	//$data = implode(“-”,array_reverse(echo explode(“/”,$data)));
	
	if ($dtIniPost != ""){
		$dtIniExplode = explode('-', $dtIniPost);
		$dtIni = $dtIniExplode[2].'/'.$dtIniExplode[1].'/'.$dtIniExplode[0];
	}
	
	if ($dtFimPost != ""){
		$dtFimExplode = explode('-', $dtFimPost);
		$dtFim = $dtFimExplode[2].'/'.$dtFimExplode[1].'/'.$dtFimExplode[0];
	}
	
	// CALCULO DIAS ###############################################################
	if ($dtIniPost != "" && $dtFimPost != ""){
		//calculo timestam das duas datas
		$timestamp1 = mktime(0,0,0,$dtIniExplode[1],$dtIniExplode[2],$dtIniExplode[0]); // mktime(0, 0, 0, date("m"), date("d") - 10, date("Y"));
		$timestamp2 = mktime(0,0,0,$dtFimExplode[1],$dtFimExplode[2],$dtFimExplode[0]); 

		//diminuo a uma data a outra 
		$segundos_diferenca = $timestamp2 - $timestamp1;
		//echo $segundos_diferenca; 

		//converto segundos em dias
		if(is_float($qtDias)) {
			$qtDias = intval( $segundos_diferenca / (60 * 60 * 24) ) + 1;
		}else {
			$qtDias = $segundos_diferenca / (60 * 60 * 24);
		}		
	}
	// CALCULO DIAS ###############################################################
	
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}

}else if ($SelUsuEmail != ""){

	/* ################## ENVIA EMAIL ################## */
	$inicio = 0;
	$conta_palavra = 0;

	for ($i = 0; $i <= strlen($SelUsuEmail) - 1; $i++){
		$conta_palavra ++;
		if (trim($SelUsuEmail[$i]) == "|"){
			if (trim(substr($SelUsuEmail, $inicio, $conta_palavra - 1)) != ""){
				$texto = trim(substr($SelUsuEmail, $inicio, $conta_palavra - 1));
				$arrDados = explode(",", $texto);
				//echo "<br>XXXXXXXXXXXXXXX>>>>".$arrDados[0] . "<br>>>>". $arrDados[1] . "<br>>>>". $arrDados[2];
				enviaEmailParam( $arrDados[0], $arrDados[1], $arrDados[2] );
				
				$inicio = $i + 1;
				$conta_palavra = 0;
			}
		}
	}
	// Imprime ultimo texto
	if ($inicio >= 1){
		$texto = trim(substr($SelUsuEmail, $inicio, $i - 1));
		$arrDados = explode(",", $texto);

		enviaEmailParam( $arrDados[0], $arrDados[1], $arrDados[2] );
	}

	echo msgAviso("E-mails enviados com sucesso!","");
	
}else{	
	$c_erros = "";
	$dtIni = "";
	$dtFim = "";
}

?>

<div style="border-bottom:1px solid #cccccc; width:100%; margin-top:0px; margin-bottom:10px;"><font color="black" style="font-size:25px"><strong>Envio de Emails</strong></font></br></br></div>

<form id="formEnvioEmail" name="formEnvioEmail" action="index.php?ac=<?php echo $acao; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at" 	value="s">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFFFFF; color:black; ">
		<tr>
			<td align="center">
				<table width="63%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="right">
						<div style="margin-left:30px; margin-right:30px; margin-top:20px;">
							<b>Data Inicial &nbsp;</b>
							<input class="<?php if($erro_dt_ini != ""){echo "field_error";}else{echo "input";} ?>" 
								   type="text" id="" name="dtIni" size="10" maxlength="10" value="<?php if($dtIni != ""){ echo $dtIni; } ?>"
								   onkeypress="Mascara('nascimento', event.keyCode, 'document.formEnvioEmail.dtIni');"/>
						</div>
						</td>
						<td align="left">
						<div style="margin-left:30px; margin-right:30px; margin-top:20px;">
							<b>Data Final &nbsp;</b>
							<input class="<?php if($erro_dt_fim != ""){echo "field_error";}else{echo "input";} ?>"
								   type="text" id="" size="10" name="dtFim" maxlength="10" value="<?php if($dtFim != ""){ echo $dtFim; } ?>"
								   onkeypress="Mascara('nascimento', event.keyCode, 'document.formEnvioEmail.dtFim');"/>
						</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<input type="submit" name="btProcura" value="Procura" style="margin-top:10px; margin-bottom:15px; height:30px; width:90px; align:center;">
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<?php if ($qtDias > 0){ ?>
		<tr>
			<td align="center">
				<table border="0" cellspacing="4" cellpadding="0" >
					<thead>
						<tr class="ui-widget-header" height="30px">
							<th align='center'><input type="checkbox" name="chkGridUsu" onclick="selAllUsu();"></th>
							<th align="center" width="99px"><strong>Data</strong></th>
							<th align="left"   width="280px"><strong>Usuário(s) com Débito(s)</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$iPassou = 0;
							$print_data = "";
							for ($i = 0; $i <= $qtDias; $i ++){
								$em_branco = false;
								$tmp_data = SomarData($dtIni, $i, 0, 0); // (data, dias, meses, ano)
								//echo "DATAS $tmp_data ***** $qtDias <br>";
								$qr = "
								SELECT pes.PES_NOME, pes.PES_CPFCNPJ, pes.PES_EMAIL,
								(SELECT pag.HPG_DATA
								   FROM hist_pagto AS pag
								  WHERE pag.HPG_CPFCNPJ = pes.PES_CPFCNPJ
									AND pag.HPG_DATA = '$tmp_data') AS DataPag
								  FROM pessoa AS pes ";
								$indice = 1;
								$sql    = mysql_query($qr);
								$total  = mysql_num_rows($sql);
								// <input type='hidden'   name='chkUsuSelNome".  $indice ."' value='". $r['PES_NOME'] ."'>
								while($r = mysql_fetch_array($sql)){
									if ($print_data != $tmp_data)
										$print_data = $tmp_data;
									else
										$em_branco = true;

									echo "<tr>
										 <td align='center' bgcolor='"; echo linhaCor($indice); echo "'>
											<input type='checkbox' name='chkUsuSel". $indice ."' value='". $r['PES_EMAIL'] . "," . $r['PES_NOME'] . "," . $tmp_data . "'>
										 </td>
										 <td align='center' bgcolor='"; echo linhaCor($indice); echo "'><b>";

									if (!$em_branco) echo $tmp_data; else echo "";
									
									echo "</b></td>
										 <td align='left' bgcolor='"; echo linhaCor($indice); echo "'>" . $r['PES_NOME'] . "</td>
										 </td>
										 </tr>";

									$indice = $indice + 1;
								}

								if ($total == 0){
									$iPassou = $iPassou + 1;
								}								
							}
							
							if ($iPassou = 0){
								$c_erros = $c_erros . ",Nenhum usuário está com pagamentos atrasado!.";
							}
							
							if ($c_erros != "")
								echo "<tr>".
									 "<td align='center'>". msgErro($c_erros) . "</td>" .
									 "</tr>";
						?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<input type="button" name="btEnviaEmail" value="Envia E-mail" onClick="EnviaEmail();" style="margin-top:10px; margin-bottom:15px; height:30px; width:90px; align:center;">
				
				<input type="hidden" name="SelUsuEmail" value="">
			</td>
		</tr>
		<?php } ?>
	</table>
	</br></br>
	
	<script type="text/javascript">document.formEnvioEmail.dtIni.focus();</script>
</form>
</html>