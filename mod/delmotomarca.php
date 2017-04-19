<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		<link rel="stylesheet" href="css/jquery.ui.all.css">		
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">

		<script language="javascript" type="text/javascript">			

			function fnDeleta(){
				var select = false;

				for (x =0; x < window.document.frmdel_moto_marca.elements.length; x++){
					if (window.document.frmdel_moto_marca.elements[x].type == 'checkbox'){
						nomeCampo = window.document.frmdel_moto_marca.elements[x].name;

						if (nomeCampo.substring(0,8) == "chkField"){
							if (window.document.frmdel_moto_marca.elements[x].checked){
								window.document.frmdel_moto_marca.hdSelDel.value = window.document.frmdel_moto_marca.hdSelDel.value + "," + window.document.frmdel_moto_marca.elements[x].value;
								select = true;
							}
						}
					}
				}

				if(select == false){
					alert("AVISO!\n\nSelecione um registro para Deletar!");
				}else{
					window.document.frmdel_moto_marca.submit();
				}
			}

			function selAll(){
				var nomeCampo = "";

				for (x =0; x < window.document.frmdel_moto_marca.elements.length; x++){
					if (window.document.frmdel_moto_marca.elements[x].type == 'checkbox'){
						nomeCampo = window.document.frmdel_moto_marca.elements[x].name;

						if (nomeCampo.substring(0,8) == "chkField"){
							if (window.document.frmdel_moto_marca.chkAll.checked){
								window.document.frmdel_moto_marca.elements[x].checked = true;
							}else{
								window.document.frmdel_moto_marca.elements[x].checked = false;
							}
						}
					}
				}
			}
		
		</script>		

	</head>
<?php
include_once("../func/config.php");
include_once("../../_func/func_library.php");
include_once("../../_func/phpmailer/class.phpmailer.php");


$hdSelDel = "";
if (isset($_POST['hdSelDel']))	$hdSelDel = $_POST['hdSelDel'];


/* ##################### DELETA COMENTARIOS ##################### */
if ($hdSelDel != ""){	
	$arrDados = explode(",", $hdSelDel);
	
	for ($i = 0; $i <= count($arrDados) - 1; $i++){
		if ($arrDados[$i] != ""){
			$qr = "DELETE FROM mp_marca WHERE MAR_COD = '". $arrDados[$i] ."' ";
			mysql_query($qr);
		}
	}	
}


/* ##################### CONSULTA #####################  */
$qr = "SELECT * FROM mp_marca ORDER BY MAR_COD";
$sql = mysql_query($qr);
$total = mysql_num_rows($sql);
/* ##################### CONSULTA ##################### */

?>

<form id="frmdel_moto_marca" name="frmdel_moto_marca" action="delmotomarca.php" method="post" accept-charset="utf-8">

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
							<td align="left"><input type="checkbox" name="chkAll" onclick="selAll();"></td>
							<td align="left"><font size="2"><b>Código</b></font></td>
							<td align="left"><font size="2"><b>Nome</b></font></td>
							<td align="left"><font size="2"><b>Ano</b></font></td>
							<td align="center"><font size="2"><b>Ativa</b></font></td>
						</tr>
					</thead>
					<?php
						$indice = 1;
						while($r = mysql_fetch_array($sql)){
							echo "
							<tr>
							<td align='center'><input type='checkbox' name='chkField". $indice ."' value='". $r['MAR_COD'] ."'></td>
							<td align='left'>"  . $r['MAR_COD']   ."&nbsp;&nbsp;</td>
							<td align='left'>"  . $r['MAR_NOME']  ."&nbsp;&nbsp;</td>
							<td align='left'>"  . $r['MAR_ANO']   ."&nbsp;&nbsp;</td>
							<td align='center'>". $r['MAR_ATIVA'] ."</td>
							</tr>";
							$indice = $indice + 1;
						}
					?>

					<tr height="40px">
						<td colspan="5" align="center">
							<a href="javascript:void(0);" onClick="fnDeleta();"><img src="../images/icons/delete.png" alt="Deleta" title="Deleta" border="0"></a>
						</td>
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" height="50px">
				<input type="submit" name="btFechar" value="Fechar" style="width: 72px;" onclick="window.close();">
			</td>
		</tr>
	</table>

	<input type="hidden" name="hdSelDel" value="">

</form>
</html>