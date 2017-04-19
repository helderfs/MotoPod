<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		<link rel="stylesheet" href="css/jquery.ui.all.css">		
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">
	</head>
<?php
include_once("../func/config.php");
include_once("../_func/func_db.php");
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
			
			$qr  = "DELETE FROM prod_marca WHERE prod_marca.PMA_MARCA = '$del' ";
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
$qr = "SELECT * FROM prod_marca ORDER BY prod_marca.PMA_PRIORID ";
$sql = mysql_query($qr);
$total = mysql_num_rows($sql);

/* ##################### CONSULTA ##################### */

?>

<form id="formCadMarca" name="formCadMarca" action="del_marca.php?deleta=s" method="post" accept-charset="utf-8">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Marca</strong></label></td>
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
							<td align="left"><font size="2"><b>Marca</b></font></td>
							<td align="left"><font size="2"><b>Descrição</b></font></td>
							<td align="center"><font size="2"><b>Prioridade</b></font></td>
						</tr>
					</thead>
					<?php
						$indice = 1;
						while($r = mysql_fetch_array($sql)){
							echo "<tr>".
								 "<td align='center'><input type='checkbox' name='chk". $indice ."' value='". $r['PMA_MARCA'] ."'></td>" .
								 "<td align='left'>"   . $r['PMA_MARCA'] . "&nbsp;&nbsp;</td>" . 
								 "<td align='left'>"   . $r['PMA_MARCA_DESC'] . "&nbsp;&nbsp;</td>" . 
								 "<td align='center'>" . $r['PMA_PRIORID'] . "</td>".
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