<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
		<link rel="stylesheet" href="css/jquery.ui.all.css">		
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/demos.css">

		<script language="javascript" type="text/javascript">			

			function fnDeleta(){
				var select = false;

				for (x =0; x < window.document.frmdel_moto_mod.elements.length; x++){
					if (window.document.frmdel_moto_mod.elements[x].type == 'checkbox'){
						nomeCampo = window.document.frmdel_moto_mod.elements[x].name;

						if (nomeCampo.substring(0,8) == "chkField"){
							if (window.document.frmdel_moto_mod.elements[x].checked){
								window.document.frmdel_moto_mod.hdSelDel.value = window.document.frmdel_moto_mod.hdSelDel.value + "," + window.document.frmdel_moto_mod.elements[x].value;
								select = true;
							}
						}
					}
				}

				if(select == false){
					alert("AVISO!\n\nSelecione um registro para Deletar!");
				}else{
					window.document.frmdel_moto_mod.submit();
				}
			}

			function selAll(){
				var nomeCampo = "";

				for (x =0; x < window.document.frmdel_moto_mod.elements.length; x++){
					if (window.document.frmdel_moto_mod.elements[x].type == 'checkbox'){
						nomeCampo = window.document.frmdel_moto_mod.elements[x].name;

						if (nomeCampo.substring(0,8) == "chkField"){
							if (window.document.frmdel_moto_mod.chkAll.checked){
								window.document.frmdel_moto_mod.elements[x].checked = true;
							}else{
								window.document.frmdel_moto_mod.elements[x].checked = false;
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
			$qr = "DELETE FROM mp_marca_mod WHERE MMO_COD = '". $arrDados[$i] ."' ";
			mysql_query($qr);
		}
	}	
}


/* ##################### CONSULTA #####################  */
$qr = "SELECT * FROM mp_marca_mod ORDER BY MMO_COD";
$sql = mysql_query($qr);
$total = mysql_num_rows($sql);
/* ##################### CONSULTA ##################### */

?>

<form id="frmdel_moto_mod" name="frmdel_moto_mod" action="del_moto_mod.php" method="post" accept-charset="utf-8">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45px">
			<td colspan="2">
				<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#CBCBCB">
					<tr>
						<td align="center"><label style="font-size:18px;"><strong>Modelo</strong></label></td>
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
							<td align="left"><font size="2"><b>Marca</b></font></td>
							<td align="left"><font size="2"><b>Modelo</b></font></td>
						</tr>
					</thead>
					<?php
						$indice = 1;
						while($r = mysql_fetch_array($sql)){
							echo "
							<tr>
							<td align='center'><input type='checkbox' name='chkField". $indice ."' value='". $r['MMO_COD'] ."'></td>
							<td align='left'>"  . $r['MMO_COD']   ."&nbsp;&nbsp;</td>
							<td align='left'>"  . $r['MMO_MAR_COD']  ."&nbsp;&nbsp;</td>
							<td align='left'>"  . $r['MMO_MODELO']   ."&nbsp;&nbsp;</td>
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