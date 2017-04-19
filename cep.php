<?php

$btIncluirSair = "";
if (isset($_POST['btIncluirSair'])){
	$btIncluirSair = $_POST['btIncluirSair'];
}

$at = "";
if (isset($_GET['at'])){
	$at = $_GET['at'];
}

// tipCEP 1=Verifica Cadastro   2=Tela de Cadastro
$tipCEP = "";
if ( isset($_GET['tipCEP']) || isset($_POST['tipCEP']) ){
	if (isset($_GET['tipCEP']) <> "")
		$tipCEP = $_GET['tipCEP'];
		
	if (isset($_POST['tipCEP']) <> "")	
		$tipCEP = $_POST['tipCEP'];
}

//echo "YYYYYYYY ". $tipCEP;
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		<link rel="stylesheet" href="css/jquery.ui.all.css">				
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">

		<style type="text/css" id="page-css">
			a:link {
				color: blue;
				text-decoration: none;
			}
			a:visited {
				color: red;
				text-decoration: none;
			}
			a:hover {
				color: red;
				text-decoration: none;
			}
			a:active {
				color: orange;
				text-decoration: none;
			}
		</style>
		
		<script language="javascript" type="text/javascript">
			function sendCad(){
				opener.parent.document.formVerifCad.acessocep1.value = window.document.formBuscaCEP.hd_cep1.value;
				opener.parent.document.formVerifCad.acessocep2.value = window.document.formBuscaCEP.hd_cep2.value;

				//opener.parent.document.formCEP.submit();
				window.close();				
			}

			function sendPessoa(){
				opener.parent.document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CEP').value 	 = window.document.formBuscaCEP.hd_cep1.value + "-" + window.document.formBuscaCEP.hd_cep2.value;
				opener.parent.document.getElementById('iframeCEP').contentWindow.document.getElementById('END_NOME').value   = window.document.formBuscaCEP.hd_rua.value;
				opener.parent.document.getElementById('iframeCEP').contentWindow.document.getElementById('END_BAIRRO').value = window.document.formBuscaCEP.hd_bairro.value;
				opener.parent.document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CIDADE').value = window.document.formBuscaCEP.hd_cidade.value;
				opener.parent.document.getElementById('iframeCEP').contentWindow.document.getElementById('END_ESTADO').value = window.document.formBuscaCEP.hd_estado.value;
				
				opener.parent.document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CEP').focus();

				window.close();
			}
			
			function sendPedido(){
				opener.parent.document.getElementById('iframeCEPPed').contentWindow.document.getElementById('END_CEP').value = window.document.formBuscaCEP.hd_cep1.value + "-" + window.document.formBuscaCEP.hd_cep2.value;
				
				window.close();
			}

			function sendFastCad(){
				opener.parent.document.getElementById('iframeCEPFastCad').contentWindow.document.getElementById('fastEND_CEP').value 	= window.document.formBuscaCEP.hd_cep1.value + "-" + window.document.formBuscaCEP.hd_cep2.value;
				opener.parent.document.getElementById('iframeCEPFastCad').contentWindow.document.getElementById('fastEND_NOME').value   = window.document.formBuscaCEP.hd_rua.value;
				opener.parent.document.getElementById('iframeCEPFastCad').contentWindow.document.getElementById('fastEND_BAIRRO').value = window.document.formBuscaCEP.hd_bairro.value;
				opener.parent.document.getElementById('iframeCEPFastCad').contentWindow.document.getElementById('fastEND_CIDADE').value = window.document.formBuscaCEP.hd_cidade.value;
				opener.parent.document.getElementById('iframeCEPFastCad').contentWindow.document.getElementById('fastEND_ESTADO').value = window.document.formBuscaCEP.hd_estado.value;

				opener.parent.document.getElementById('iframeCEPFastCad').contentWindow.document.getElementById('fastEND_CEP').focus();

				window.close();
			}
			
			function changeEnd(){
				//&nbsp;&nbsp;&nbsp;&nbsp;
			}
		</script>
	</head>
<?php
include_once("func/config_cep.php");
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");
include_once("../_func/phpmailer/class.phpmailer.php");

$estado = "";
$cidade = "";
$bairro = "";
$rua = "";

if ($at == "s"){
	$c_erros = "";

	if (isset($_POST['estado'])){
		$estado = $_POST['estado'];
	}

	if (isset($_POST['cidade'])){
		$cidade = $_POST['cidade'];
	}

	if (isset($_POST['bairro'])){
		$bairro = $_POST['bairro'];
	}

	if (isset($_POST['rua'])){
		$rua = $_POST['rua'];
	}
/*
	$sql_busca = 
	"SELECT LOGRA.CEP, LOGRA.LOG_NOME, LOGRA.UFE_SG, BAIRRO.BAI_NO, LOCAL.LOC_NO" .
	"  FROM LOG_LOGRADOURO AS LOGRA," .
	"       LOG_BAIRRO     AS BAIRRO," .
	"       LOG_LOCALIDADE AS LOCAL" .
	" WHERE LOGRA.CEP = '$acessocep'" .
	"   AND LOGRA.BAI_NU_SEQUENCIAL_INI = BAIRRO.BAI_NU_SEQUENCIAL" .
	"   AND LOGRA.LOC_NU_SEQUENCIAL     = LOCAL.LOC_NU_SEQUENCIAL";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

		 
	$END_CODIGO			= "";
	$END_TIPO			= "";
	$END_NUMERO			= "";
	$END_COMPL	= "";
	$END_CEP	= $fet_busca['CEP'];
	$END_NOME 	= $fet_busca['LOG_NOME'];
	$END_BAIRRO = $fet_busca['BAI_NO'];
	$END_CIDADE = $fet_busca['LOC_NO'];
	$END_ESTADO	= $fet_busca['UFE_SG'];
*/	

	// Sair e Alterar
	/*if ($btCEP___ != ""){
		?>
		<script language="javascript">
			//opener.parent.document.formCadPessoa.END_CEP.value = "00000";
			//opener.parent.document.formCadProduto.submit();
			opener.parent.document.formCadPessoa.END_CEP.value = "00000";
			window.close();
		</script>
		<?php
	}*/
}

?>

<form id="formBuscaCEP" name="formBuscaCEP" action="cep.php?at=s" method="post" accept-charset="utf-8">
	<input type="hidden" name="tipCEP" value="<?php if ($tipCEP <> "") echo $tipCEP; ?>">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Busca CEP</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="td_cad" align="left">
							<select id="estado" name="estado" onchange="window.document.formBuscaCEP.submit();">
							<?php
								$qr = "SELECT ufe_sg, ufe_no  FROM log_faixa_uf ORDER BY ufe_sg";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='' selected>:::Estado:::</option>";
								$selecionado = '';
								while($r = mysql_fetch_array($sql)){
									if ($estado == $r['ufe_sg']){
										$selecionado = 'selected';
										$hd_estado = $r['ufe_sg'];
									}else{
										$selecionado = '';
									}
									echo "<option value='". $r['ufe_sg'] ."' ". $selecionado .">". $r['ufe_sg'] . " - " . $r['ufe_no'] ."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">window.document.formBuscaCEP.estado.focus();</script>
						</td>
						<?php if($estado != ""){ ?>
						<td class="td_cad" align="left">							
							<select id="cidade" name="cidade" onchange="window.document.formBuscaCEP.submit();">
							<?php
								$qr = "SELECT loc_nu_sequencial, loc_nosub, loc_no 
								         FROM log_localidade AS cidade
										WHERE cidade.ufe_sg = '$estado' 
										ORDER BY cidade.loc_nosub";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='' selected>:::Cidade:::</option>";
								$selecionado = '';
								while($r = mysql_fetch_array($sql)){
									if ($cidade == $r['loc_nu_sequencial']){
										$selecionado = 'selected';
										$hd_cidade = $r['loc_nosub'];
									}else{
										$selecionado = '';
									}
									echo "<option value='". $r['loc_nu_sequencial'] ."' ". $selecionado .">". $r['loc_nosub'] ."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">window.document.formBuscaCEP.cidade.focus();</script>
						</td>
						<?php } if($estado != "" && $cidade != ""){ ?>
						<td class="td_cad" align="left">
							<select id="bairro" name="bairro" onchange="window.document.formBuscaCEP.submit();">
							<?php
								$qr = "SELECT bai_nu_sequencial, bai_no 
										 FROM log_bairro AS bairro
    									WHERE bairro.ufe_sg = '$estado'
									      AND bairro.loc_nu_sequencial = $cidade ";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='' selected>:::Bairro:::</option>";
								$selecionado = '';
								while($r = mysql_fetch_array($sql)){
									if ($bairro == $r['bai_nu_sequencial']){
										$selecionado = 'selected';
										$hd_bairro = $r['bai_no'];
									}else{
										$selecionado = '';
									}
									echo "<option value='". $r['bai_nu_sequencial'] ."' ". $selecionado .">". $r['bai_no'] ."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">window.document.formBuscaCEP.bairro.focus();</script>
						</td>
						<?php } if($estado != "" && $cidade != "" && $bairro != ""){ ?>
						<td class="td_cad" align="left">
							<select id="rua" name="rua" onchange="window.document.formBuscaCEP.submit();">
							<?php
								$qr = "SELECT log_nu_sequencial, log_no, log_nome, log_complemento, cep 
										 FROM log_logradouro AS rua
    									WHERE rua.ufe_sg = '$estado'
										  AND rua.loc_nu_sequencial = $cidade
										  AND rua.bai_nu_sequencial_ini = $bairro ";
								$sql = mysql_query($qr);
								$total = mysql_num_rows($sql);

								echo "<option value='' selected>:::Rua/Avenida:::</option>";
								$selecionado = '';
								while($r = mysql_fetch_array($sql)){
									if ($rua == $r['log_nu_sequencial']){
										$selecionado = 'selected';
										$hd_rua = $r['log_nome'];
									}else{
										$selecionado = '';
									}
									echo "<option value='". $r['log_nu_sequencial'] ."' ". $selecionado .">". $r['log_no'] ." ". $r['log_complemento'] ."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">window.document.formBuscaCEP.rua.focus();</script>
						</td>
						<?php } ?>
					</tr>
<?php 
// echo ">>>>> " . $estado . " - " . $cidade . " - BAIRRO:" . $bairro ." - RUA:". $rua;
// echo "</br>>>>>> " . $hd_estado . " - " . $hd_cidade . " - BAIRRO:" . $hd_bairro ." - RUA:". $hd_rua;
?>
					<?php if($estado != "" && $cidade != "" && $bairro != "" && $rua != ""){ ?>
					<tr>
						<td colspan="4" align="center"></br>
							<table border="1" cellspacing="0" cellpadding="0" >
								<thead>
									<tr class="ui-widget-header" height="30px">
										<td align="center"><font size="2"><b>CEP</b></font></td>
									</tr>
								</thead>
								<?php
									$qr = "SELECT cep 
											 FROM log_logradouro AS rua
											WHERE rua.ufe_sg 				= '$estado'
											  and rua.loc_nu_sequencial 	= '$cidade'
											  and rua.bai_nu_sequencial_ini = '$bairro'
											  and rua.log_nu_sequencial 	= '$rua' ";
									$sql = mysql_query($qr);
									$total = mysql_num_rows($sql);
									while($r = mysql_fetch_array($sql)){
										//<input type='hidden' name='hd_cep' 	  value='". substr($r['cep'], 0, 5) ."-". substr($r['cep'], 5, 3) ."'>
										echo "<tr>
												<td align='center' height='30px'>
													&nbsp;&nbsp;
													<input type='hidden' name='hd_rua' 	  	value='$hd_rua'>
													<input type='hidden' name='hd_bairro' 	value='$hd_bairro'>
													<input type='hidden' name='hd_cidade' 	value='$hd_cidade'>
													<input type='hidden' name='hd_estado' 	value='$hd_estado'>
													<input type='hidden' name='hd_cep1' 	value='". substr($r['cep'], 0, 5) ."'>
													<input type='hidden' name='hd_cep2'		value='". substr($r['cep'], 5, 3) ."'>
													<a href='javascript:void(0);' title='Busca CEP' onclick='window.document.formBuscaCEP.btCEP.click();'><b><u><font size='3'>". substr($r['cep'], 0, 5) ."-". substr($r['cep'], 5, 3) ."</font></u></b></a>
													&nbsp;&nbsp;
												</td>
											 </tr>";
									}
								?>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="center"></br>
							<input type="button" name="btCEP" value="Utilizar este CEP" style="height:35px;" onclick="
							<?php 
								if($tipCEP == '1'){
									echo "sendCad();";
								}else if($tipCEP == '2'){
									echo "sendPessoa();";
								}else if($tipCEP == '3'){
									echo "sendPedido();";
								}else if($tipCEP == '4'){
									echo "sendFastCad();";
								}
							?>">
						</td>
					</tr>
					<script language="javascript" type="text/javascript">window.document.formBuscaCEP.btCEP.focus();</script>
					<?php } ?>
				</table>				
			</td>
		</tr>
	</table>
</form>
</html>