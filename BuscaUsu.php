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
		for (x =0; x < window.opener.parent.document.formCadUsu.elements.length; x++){
			if (window.opener.parent.document.formCadUsu.elements[x].name == "USG_USR_PES_CPFCNPJ"){
				if (vlr1 != "0"){
					window.opener.parent.document.formCadUsu.elements[x].value = vlr1;
				}else{
					window.opener.parent.document.formCadUsu.elements[x].value = valor;
				}
			}

			if (window.opener.parent.document.formCadUsu.elements[x].name == "PES_NOME"){
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
			<th align="left"><strong>CPF</strong></th>
			<th align="left"><strong>Nome</strong></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$qr = "SELECT * FROM pessoa LIMIT 0 , 50";
		$sql = mysql_query($qr);
		$total = mysql_num_rows($sql);

		$indice = 1;
		while($r = mysql_fetch_array($sql)){
			echo "<tr>".
				 "<td align='left'>".
				 "	<a href='javascript:void(0);' onClick=retValores(document.getElementById('PES_CPFCNPJ".$indice."').value,document.getElementById('PES_NOME".$indice."').value)>".$r['PES_CPFCNPJ']."</a>".
				 "  <input id='PES_CPFCNPJ".$indice."' type='hidden' value='".$r['PES_CPFCNPJ']."'>".
				 "  <input id='PES_NOME"   .$indice."' type='hidden' value='".$r['PES_NOME']."'>".
				 "</td>".
				 "<td align='left'> <a href='javascript:void(0);' onClick=retValores(document.getElementById('PES_CPFCNPJ".$indice."').value,document.getElementById('PES_NOME" .$indice. "').value)>" .$r['PES_NOME']. "</a> </td>".
				 "</tr>";
			$indice ++;
		}
	?>
	</tbody>
</table>
</html>