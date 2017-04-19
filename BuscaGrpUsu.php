<?php
	include_once("func/config.php");
	include_once("../_func/func_db.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
<link rel="stylesheet" href="css/jquery.ui.all.css">
<script src="script/jquery-1.5.1.js"></script>
<script src="script/jquery.ui.tabs.js"></script>

<link rel="stylesheet" href="css/demos.css">
<script>
$(function() {
	$( "#tabs" ).tabs({
		cookie: {
			// store cookie for a day, without, it would be a session cookie
			expires: 1
		}
	});
});
</script>

<script language="javascript" type="text/javascript">		
	function retValores(vlr1,vlr2){
		/*var valor = "";
		for (x =0; x < window.document.formBuscaGrpUsu.elements.length; x++){
			if (window.document.formBuscaGrpUsu.elements[x].name == "GRU_CODIGO")
				valor = window.document.formBuscaGrpUsu.elements[x].value;
		}*/
		
		for (x =0; x < window.opener.parent.document.formCadUsu.elements.length; x++){
			if (window.opener.parent.document.formCadUsu.elements[x].name == "USR_GRU_CODIGO"){
				if (vlr1 != "0"){
					window.opener.parent.document.formCadUsu.elements[x].value = vlr1;
				}else{
					window.opener.parent.document.formCadUsu.elements[x].value = valor;
				}
			}

			if (window.opener.parent.document.formCadUsu.elements[x].name == "GRU_NOME_02"){
				if (vlr2 != "0"){
					window.opener.parent.document.formCadUsu.elements[x].value = vlr2;
				}else{
					window.opener.parent.document.formCadUsu.elements[x].value = valor;
				}
			}
		}
		
		window.self.close();			
	}
</script>

</head>
<table border="0" cellspacing="4" cellpadding="0" width="100%">
	<thead>
		<tr class="ui-widget-header" height="30px">
			<th align="left" width=""><strong>Código</strong></th>
			<th align="left" width=""><strong>Nome</strong></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$qr = "SELECT * FROM grupousr LIMIT 0 , 50";
		$sql = mysql_query($qr);
		$total = mysql_num_rows($sql);

		$indice = 1;
		while($r = mysql_fetch_array($sql)){
			echo "<tr>".
				 "<td align='left'>".
				 "	<a href='javascript:void(0);' onClick=retValores(document.getElementById('GRU_CODIGO" .$r['GRU_CODIGO']. "').value,document.getElementById('GRU_NOME" .$r['GRU_CODIGO']. "').value)>" .$r['GRU_CODIGO']. "</a>".
				 "  <input id='GRU_CODIGO" .$r['GRU_CODIGO']. "' type='hidden' value='". $r['GRU_CODIGO'] ."'>".
				 "  <input id='GRU_NOME"   .$r['GRU_CODIGO']. "' type='hidden' value='". $r['GRU_NOME'] ."'>".
				 "</td>".
				 "<td align='left'> <a href='javascript:void(0);' onClick=retValores(document.getElementById('GRU_CODIGO" .$r['GRU_CODIGO']. "').value,document.getElementById('GRU_NOME" .$r['GRU_CODIGO']. "').value)>" .$r['GRU_NOME']. "</a> </td>".
				 "</tr>";
			$indice ++;
		}
	?>
	</tbody>
</table>
</html>