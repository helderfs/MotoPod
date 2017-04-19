<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	
	<script language="javascript" src="script/x_mascara.js"></script>

	<script language="javascript" type="text/javascript">
		function gravaCEP(){
			document.formCadEnd.hdEND_CODIGO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CODIGO').value;
			document.formCadEnd.hdEND_CEP.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CEP').value;
			document.formCadEnd.hdEND_NOME.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_NOME').value;
			document.formCadEnd.hdEND_NUMERO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_NUMERO').value;
			document.formCadEnd.hdEND_COMPL.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_COMPL').value;
			document.formCadEnd.hdEND_COMPL_OBS.value 	= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_COMPL_OBS').value;
			document.formCadEnd.hdEND_BAIRRO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_BAIRRO').value;
			document.formCadEnd.hdEND_CIDADE.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_CIDADE').value;
			document.formCadEnd.hdEND_ESTADO.value 		= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_ESTADO').value;
			document.formCadEnd.hdEND_ENTREGA.value 	= document.getElementById('iframeCEP').contentWindow.document.getElementById('END_ENTREGA').value;
		}

		function altEndCtt(tipoEndCtt, codEnd){
			document.formCadEnd.hdTipEndCtt.value = tipoEndCtt;
			document.formCadEnd.hdCodEndCtt.value = codEnd;

			window.parent.document.formCadEnd.submit();
		}
		
	</script>
	</head>

	<body style="color: black;">
<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");
include_once("includes/i_pes_ini.php");


$qtdBuy = $_SESSION['sess_qtd_buy'];
$totalEnd = 0;

if ($at == "s"){

	if (isset($_POST['hdCodEndCtt'])) $hdCodEndCtt = $_POST['hdCodEndCtt'];
	if (isset($_POST['hdTipEndCtt'])) $hdTipEndCtt = $_POST['hdTipEndCtt'];
	if (isset($_POST['btCadPes'])) 	  $btCadPes = $_POST['btCadPes'];

	// ALTERA ENDERECO COMO PRINCIPAL
	if ($hdTipEndCtt == '1'){
		$sql_busca = "UPDATE endereco SET END_ENTREGA = '' " .
					 " WHERE END_PES_CPFCNPJ = '$cpf_cnpj'
						 AND END_CODIGO      <> '$hdCodEndCtt' ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		
		$sql_busca = "UPDATE endereco SET END_ENTREGA = 'S' " .
					 " WHERE END_PES_CPFCNPJ = '$cpf_cnpj'
						 AND END_CODIGO      = '$hdCodEndCtt' ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	}

	// DELETA ENDERECO
	if ($hdTipEndCtt == '3' && $hdCodEndCtt != ""){
		$erro = false;
		// ERRO 1
		$qr = "SELECT * FROM endereco WHERE endereco.END_PES_CPFCNPJ = '$cpf_cnpj' ";
		$sql = mysql_query($qr);
		$totalEnd = mysql_num_rows($sql);

		// ERRO 2
		$sql_busca = "SELECT END_ENTREGA FROM endereco 
					   WHERE END_PES_CPFCNPJ = '$cpf_cnpj' 
						 AND END_CODIGO = '$hdCodEndCtt' ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);

		if ($totalEnd == 1){ // ERRO 1
			echo msgAviso("Endereço não pode ser eliminado! Somente um endereço cadastrado. ","");
			$erro = false;
		}else if ($fet_busca['END_ENTREGA'] == "S"){ // ERRO 2
			echo msgAviso("Endereço Principal não pode ser eliminado!","");
			$erro = false;
		}
		
		if (!$erro){
			// DELETA ENDERECO SELECIONADO
			$sql_busca = " DELETE FROM endereco 
			                WHERE END_PES_CPFCNPJ = '$cpf_cnpj' 
							  AND END_CODIGO = '$hdCodEndCtt' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}
	}	
	
	// CASO CLIQUE NO BOTAO DE "CADASTRO ENDERECO" / "ALTERACAO ENDERECO"
	if ($btCadPes != ""){
		$END_PAIS = "Brasil";
		
		// NOVO ENDERECO
		if ($hdTipEndCtt == '4'){
			// aqui ou ... utilizar a funcao     proxCod()
			$sql_busca = "SELECT MAX(END_CODIGO) AS MAX_END_CODIGO FROM endereco
						   WHERE END_PES_CPFCNPJ = '$cpf_cnpj' ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$END_CODIGO	= $fet_busca['MAX_END_CODIGO'] + 1;

			$END_PAIS   = 'Brasil';
		}
		/*
		if (isset($_POST['hdEND_CODIGO'])){
			$END_CODIGO = $_POST['hdEND_CODIGO'];
			$_SESSION['hdEND_CODIGO'] = $END_CODIGO;
		}
		*/
		
		if (isset($_POST['hdEND_CEP'])){
			$END_CEP = soNumero($_POST['hdEND_CEP']);
			$_SESSION['hdEND_CEP'] = $END_CEP;
		}
		if ($END_CEP == ""){ 
			$c_erros = $c_erros . ",CEP não informado.";
			$erro_cep = "erro";
		}
		
		/*
		if (isset($_POST['hdEND_DESC'])){
			$END_DESC = $_POST['hdEND_DESC'];
			$_SESSION['hdEND_DESC'] = $END_DESC;
		}
		if ($END_DESC == ""){
			$c_erros = $c_erros . ",Descrição não informada.";
			$erro_desc = "erro";
		}
		*/
		
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
		
		if ($c_erros != ""){
			echo msgErro($c_erros);
		}else{
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
						""); // END_ENTREGA

			// Finaliza sessoes
			$hdTipEndCtt = "";
			$hdCodEndCtt = "";
		}
		/* ##################### INSERCAO ##################### */
	}
}else{
	include_once("includes/i_pes_cons.php"); // CONSULTA
}

if ($cpf_cnpj != ""){
	$qr = "
	SELECT * FROM endereco
	 WHERE endereco.END_PES_CPFCNPJ = '$cpf_cnpj'
	 ORDER BY endereco.END_ENTREGA DESC, endereco.END_CODIGO ";

	$sql = mysql_query($qr);
	$totalEnd = mysql_num_rows($sql);
	$i = 0;
	while($reg = mysql_fetch_array($sql)){
		$arrEND_CODIGO[$i]		= $reg['END_CODIGO'];
		$arrEND_CEP[$i] 		= $reg['END_CEP'];
		$arrEND_NOME[$i]		= $reg['END_NOME'];
		$arrEND_NUMERO[$i]		= $reg['END_NUMERO'];
		$arrEND_COMPL[$i]		= $reg['END_COMPL'];
		$arrEND_COMPL_OBS[$i]	= $reg['END_COMPL_OBS'];
		$arrEND_BAIRRO[$i]		= $reg['END_BAIRRO'];
		$arrEND_CIDADE[$i]		= $reg['END_CIDADE'];
		$arrEND_ESTADO[$i]		= $reg['END_ESTADO'];
		$arrEND_ENTREGA[$i]		= $reg['END_ENTREGA'];

		// ALTERA ENDERECO
		if ($hdTipEndCtt == '2' && $hdCodEndCtt == $arrEND_CODIGO[$i]){
			$_SESSION['hdEND_CEP'] 			= $arrEND_CEP[$i];
			$_SESSION['hdEND_CODIGO']		= $arrEND_CODIGO[$i];
			$_SESSION['hdEND_NOME']			= $arrEND_NOME[$i];
			$_SESSION['hdEND_BAIRRO']		= $arrEND_BAIRRO[$i];
			$_SESSION['hdEND_CIDADE']		= $arrEND_CIDADE[$i];
			$_SESSION['hdEND_ESTADO']		= $arrEND_ESTADO[$i];
			$_SESSION['hdEND_NUMERO']		= $arrEND_NUMERO[$i];
			$_SESSION['hdEND_COMPL']		= $arrEND_COMPL[$i];
			$_SESSION['hdEND_COMPL_OBS']	= $arrEND_COMPL_OBS[$i];
			$_SESSION['hdEND_ENTREGA']		= $arrEND_ENTREGA[$i];
		}

		$i = $i + 1;
	}
}

?>

<form id="formCadEnd" name="formCadEnd" action="<?php echo $modulo; ?>" method="post" accept-charset="utf-8">

	<input type="hidden" name="at" value="s">
	<input type="hidden" id="hd_USR_EMAIL" 		name="hd_USR_EMAIL" 	value="<?php if($USR_EMAIL != "") echo $USR_EMAIL; ?>">
	<input type="hidden" id="hdEND_CODIGO" 		name="hdEND_CODIGO" 	value="">
	<input type="hidden" id="hdEND_CEP" 		name="hdEND_CEP" 		value="">
	<input type="hidden" id="hdEND_NOME" 		name="hdEND_NOME" 		value="">
	<input type="hidden" id="hdEND_NUMERO" 		name="hdEND_NUMERO" 	value="">
	<input type="hidden" id="hdEND_COMPL" 		name="hdEND_COMPL" 		value="">
	<input type="hidden" id="hdEND_COMPL_OBS" 	name="hdEND_COMPL_OBS" 	value="">
	<input type="hidden" id="hdEND_BAIRRO" 		name="hdEND_BAIRRO" 	value="">
	<input type="hidden" id="hdEND_CIDADE" 		name="hdEND_CIDADE" 	value="">
	<input type="hidden" id="hdEND_ESTADO" 		name="hdEND_ESTADO" 	value="">
	<input type="hidden" id="hdCodEndCtt" 		name="hdCodEndCtt" 		value="<?php if ($hdCodEndCtt != "") echo $hdCodEndCtt; ?>">
	<input type="hidden" id="hdTipEndCtt" 		name="hdTipEndCtt" 		value="<?php if ($hdTipEndCtt != "") echo $hdTipEndCtt; ?>">

	<table width="100%" border="0" cellpadding="7" cellspacing="0" bgcolor="#CBCBCB" style="margin-top:10px; margin-bottom:10px;">
		<tr>
			<td>
				<label style="font-size:18px"><strong><div>Endereço de Entrega</div></strong></label>
			</td> 
		</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="4" cellpadding="0">
		<tr>
			<td width="100%" align="center">
			<!-- 
			##### DIVIDE DE DUAS COLUNAS #####
			<div id="" style="width:800px; border: solid 0px #CCC;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody>
				<tr>
				<td align="left" valign="top" style="padding-left:25px;padding-right:25px;">
			##### DIVIDE DE DUAS COLUNAS #####
			-->
				<?php
				for($i = 0; $i < $totalEnd; $i++){
				?>
					<!-- 
					##### DIVIDE DE DUAS COLUNAS #####
					<div style="width:330px; float:left; padding-top:5px; padding-right:6px;"> -->
						<table border="0" cellpadding="0" cellspacing="0" height="" width="380px">
							<tbody>
							<tr>
								<td colspan="2" height="25px" valign="top" align="left">
									<span style="font-size:17px; color:#333;"><?php if ($arrEND_ENTREGA[$i] == "S"){ echo "<strong>Endereço Principal</strong>"; } //else{ echo "<strong>".$arrEND_DESC[$i]."</strong>"; } ?></span>
								</td>
							</tr>
							<tr><td align="left" width="70px">CEP:</td>
								<td align="left"><span style="font-size:12px;color:#666;"><?php echo substr($arrEND_CEP[$i], 0, 5)."-".substr($arrEND_CEP[$i], 5, 3); ?></span></td>
							</tr>
							<tr><td align="left">Endereço:</td>
								<td align="left">
								<span style="font-size:12px;color:#666;"><?php echo $arrEND_NOME[$i].", "; ?></span>
								Nº <span style="font-size:12px;color:#666;"><?php echo $arrEND_NUMERO[$i]; ?></span>
								</td>
							</tr>
							<tr><td valign="top" align="left">Bairro:</td>
								<td align="left"><span style="font-size:12px;color:#666;"><?php echo $arrEND_BAIRRO[$i]; ?></span></td>
							</tr>
							<tr><td valign="top" align="left">Cidade:</td>
								<td align="left"><span style="font-size:12px;color:#666;"><?php echo $arrEND_CIDADE[$i]; ?></span></td>
							</tr>
							<tr><td valign="top" align="left">UF:</td>
								<td align="left"><span style="font-size:12px;color:#666;"><?php echo $arrEND_ESTADO[$i]; ?></span></td>
							</tr>
							<tr>
								<td colspan="2" align="left" height="50px">
									<a href="javascript:void(0);" class="bt_little_gray" onclick="altEndCtt('2','<?php echo $arrEND_CODIGO[$i]; ?>')">Editar »</a>&nbsp;&nbsp;&nbsp;
									<a href="javascript:void(0);" class="bt_little_gray" onclick="altEndCtt('3','<?php echo $arrEND_CODIGO[$i]; ?>')">Excluir »</a>&nbsp;&nbsp;&nbsp;
									<?php if ($arrEND_ENTREGA[$i] != "S"){ ?>
									<a href="javascript:void(0);" class="bt_little_blue" onclick="altEndCtt('1','<?php echo $arrEND_CODIGO[$i]; ?>')">Entregar Neste Endereço »</a>
									<?php } ?>
								</td>
							</tr>
							</tbody>
						</table>
					<!--
					##### DIVIDE DE DUAS COLUNAS #####
					</div>-->
				<?php
					/*
					##### DIVIDE DE DUAS COLUNAS #####
					if ($i == 1)
						echo '
						</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="padding-left:25px;padding-right:25px;">';
					else
						echo '
						</td>
						<td align="left" valign="top" style="padding-left:25px;padding-right:25px;">';
					##### DIVIDE DE DUAS COLUNAS #####
					*/
				}
				?>
				<!--
				##### DIVIDE DE DUAS COLUNAS #####
				</tbody>
			</table>
			##### DIVIDE DE DUAS COLUNAS #####
			-->
			<?php if ($hdTipEndCtt != "2" && $hdTipEndCtt != "4"){ ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="" align="center" style="padding-top:30px;">
						<a href="javascript:void(0);" class="button_large" title="Cadastrar Novo Endereço" onClick="altEndCtt('4','0');">Cadastrar Novo Endereço »</a>
					</td>
				</tr>
				<?php if ($qtdBuy){ ?>
				<tr>
					<td colspan="" align="center" style="padding-top:30px;">
						<a href="javascript:void(0);" class="button_large" title="Finalizar Compra" onClick="window.location='endereco';">Finalizar Compra »</a>
					</td>
				</tr>
				<?php } ?>
			</table>
			<?php } ?>
			<!--</div> -->
			</td>
		</tr>
		
		<!-- ###################################################################### NOVO ENDERECO -->
		<?php
		// Caso NAO clicou no botao cadastrar e deseja cadastrar novo, limpa campos
		if ($btCadPes == "" && $hdTipEndCtt == '4'){
			$_SESSION['hdEND_CODIGO']	 = "";
			$_SESSION['hdEND_CEP']	 	 = "";
			$_SESSION['hdEND_NOME']      = "";
			$_SESSION['hdEND_NUMERO']    = "";
			$_SESSION['hdEND_COMPL']     = "";
			$_SESSION['hdEND_COMPL_OBS'] = "";
			$_SESSION['hdEND_BAIRRO']    = "";
			$_SESSION['hdEND_CIDADE']    = "";
			$_SESSION['hdEND_ESTADO']    = "";
			$_SESSION['hdEND_ENTREGA']   = "";
		}
		
		if ($hdTipEndCtt == "2" || $hdTipEndCtt == "4"){
		?>
			<tr>
				<td colspan="2" class="td_cad">
					<iframe name="iframeCEP" id="iframeCEP" src="./ajax_cep.php" frameborder="0" scrolling="no" align="center" width="100%" height="250px" style="margin-left:33px;">
						Sem suporte a iFrames.
					</iframe>
				</td>
			</tr>
			<tr>
				<td colspan="2" valign="middle" align="center" height="35px"><font color="red">* Campos Obrigatórios</font></td>
				<script language="javascript" type="text/javascript">document.formCadPessoa.PES_NOME.focus();</script>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<?php if ($hdTipEndCtt == "2"){ ?>
						<input class="btsubmit" type="submit" name="btCadPes" value="Alterar" alt="Alterar" title="Alterar" onclick="gravaCEP()">
					<?php }else{ ?>
						<input class="btsubmit" type="submit" name="btCadPes" value="Cadastrar" alt="Cadastrar" title="Cadastrar" onclick="gravaCEP()">
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</table>

	</br></br>

</form>

</body>
</html>