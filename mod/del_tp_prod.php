<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		<link rel="stylesheet" href="css/jquery.ui.all.css">		
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">
	</head>
<?php

include_once("../func/func_db.php");
include_once("../func/config.php");
include_once("../../_func/phpmailer/class.phpmailer.php");

$btExkluirSair = "";
if (isset($_POST['btExkluirSair'])){
	$btExkluirSair = $_POST['btExkluirSair'];
}

$deleta = "";
if (isset($_GET['deleta'])){
	$deleta = $_GET['deleta'];
}
$del = "";
if ($deleta == "s"){
	for ($i = 1; $i <= 1000; $i++){
		if (isset($_POST['chk' . $i])){
			$del = $_POST['chk' . $i];
			
			$qr  = "DELETE FROM prod_tip_prod WHERE prod_tip_prod.PTP_TIPO_PROD = '$del' ";
			mysql_query($qr);
		}
	}

	// Sair e deletar cad. produt.
	if ($btExkluirSair != ""){
	?>
	<script language="javascript">
		opener.parent.document.formCadProduto.submit();
		window.close();
	</script>
	<?php
	}
}

/* ##################### CONSULTA #####################  */
$qr = "SELECT * FROM prod_tip_prod ORDER BY prod_tip_prod.PTP_PRIORID ";
$sql = mysql_query($qr);
$total = mysql_num_rows($sql);
/* ##################### CONSULTA ##################### */
?>

<form id="formCadTipoProd" name="formCadTipoProd" action="del_tp_prod.php?deleta=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Tipo de Produto</strong></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center"></br>
				<table border="1" cellspacing="0" cellpadding="0" >
					<thead>
						<tr class="ui-widget-header" height="30px">
							<td align="left"><font size="2"><b></b></font></td>
							<td align="left"><font size="2"><b>Produto</b></font></td>
							<td align="left"><font size="2"><b>Descrição</b></font></td>
							<td align="center"><font size="2"><b>Prioridade</b></font></td>
						</tr>
					</thead>
					<?php
						$indice = 1;
						while($r = mysql_fetch_array($sql)){
							echo "<tr>".
								 "<td align='center'><input type='checkbox' name='chk". $indice ."' value='". $r['PTP_TIPO_PROD'] ."'></td>" .
								 "<td align='left'>"   . $r['PTP_TIPO_PROD'] . "&nbsp;&nbsp;</td>" . 
								 "<td align='left'>"   . $r['PTP_TIPO_PROD_DESC'] . "&nbsp;&nbsp;</td>" . 
								 "<td align='center'>" . $r['PTP_PRIORID'] . "</td>".
								 "</tr>";
							$indice = $indice + 1;
						}
					?>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" height="50px">
				<input type="submit" name="btExkluirSair" value="Exkluir e Sair" style="width: 95px;">
				<input type="submit" name="btExkluir" 	  value="Exkluir" style="width: 72px;">
				<input type="submit" name="btFechar"  	  value="Fechar"  style="width: 72px;" onclick="window.close();">
			</td>
		</tr>
	</table>
</form>
</html>