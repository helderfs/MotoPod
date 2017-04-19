<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

<link rel="stylesheet" href="../css/jquery.ui.all.css">
<script src="../script/jquery-1.5.1.js"></script>

<link rel="stylesheet" href="../css/style.css">

<script language="javascript" type="text/javascript">
	function edtProd(produto){
		window.parent.document.formCadProduto.SelEdtProd.value = produto;
		window.parent.document.formCadProduto.submit();
	}

	function delProd(produto){
		if ( confirm('Deseja excluir o Produto ' + produto) ){
			window.parent.document.formCadProduto.SelDelProd.value = produto;
			window.parent.document.formCadProduto.submit();
		}
	}

	function imgGera(imagem){
		window.open('../' + imagem, 'WindowC', 'left=20,top=20,width=650,height=500,resizable=yes');
	}
	
</script>

<?php
	include_once("../func/config.php");
	include_once("../../_func/func_db.php");
?>

<table border="0" cellspacing="2" cellpadding="0" width="100%">
	<thead>
		<tr class="grid-header" height="30px">
			<!--<td align="center"></td>-->
			<!--<td align="center"><strong>Img</strong></td>-->
			<td align="center"><strong></strong></td>
			<td align="center"><strong></strong></td>
			<td align="center"><strong>Cód</strong></td>
			<td align="center"><strong>Sx</strong></td>
			<td align="left"><strong>Estilo</strong></td>
			<td align="left"><strong>Produto</strong></td>
			<td align="left" width="80px"><strong>Marca</strong></td>
			<td align="left"><strong>Material</strong></td>
			<td align="left"><strong>Modelo</strong></td>
			<td align="left"><strong>Ativ</strong></td>
			<td align="left"><strong>Fret</strong></td>
			<td align="right"><strong>Vlr.Custo</strong></td>
			<td align="right"><strong>Vlr.Venda</strong></td>
			<td align="right"><strong>Vlr.Promo</strong></td>
			<!--<td align="right"><strong>Vlr.Desc.</strong></td>
			<td align="left" ><strong>Nome</strong></td>
			<td align="left"><strong>Observação</strong></td>-->
		</tr>
	</thead>
	<tbody>
	<?php
		$qr    = "SELECT * FROM produto LIMIT 0 , 50";
		$sql   = mysql_query($qr);
		$total = mysql_num_rows($sql);

		$indice = 1;
		while($r = mysql_fetch_array($sql)){
			if (strlen($r['PRD_ESTILO']) > 7)
				$estilo = substr($r['PRD_ESTILO'], 0, 7) . "...";
			else
				$estilo = $r['PRD_ESTILO'];
			
			//<input type='hidden' name='codPrdSel". $indice ."' value='". $r['PRD_CODIGO'] ."'>
			//"<td align='center'><input type='checkbox' name='chkPrdSel". $indice ."' value='". $r['PRD_CODIGO'] ."'></td>" .
			//"<td align='center'><img src=". $r['PRD_IMAGEM'] ." width='30px' height='30px'></td>" . 
			
			/*
			<td align='center'>
				<table border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td align='center'><a href='javascript:void(0);' onClick=imgGera('". $r['PRD_IMAGEM'] ."');>   	<img src='../images/icons/anexo.png' title='Visualiza Imagem Thumbnail' 	border='0' width='19px' height='19px'></a></td>
					<td align='center'><a href='javascript:void(0);' onClick=imgGera('". $r['PRD_IMG_THUMB'] ."');> <img src='../images/icons/anexo.png' title='Visualiza Imagem Thumbnail' 	border='0' width='19px' height='19px'></a></td>
				</tr>
				</table>
			</td>
			*/
			
			echo "
			<tr class='grid-body' "; if($indice % 2 == 0){ echo "bgcolor='#C2DFFF'"; } echo ">

			<td align='center'><a href='javascript:void(0);' onClick=edtProd('". $r['PRD_CODIGO'] ."')>	<img src='../images/icons/edit.png'   alt='Altera' title='Altera' border='0' width='19px' height='19px'></a></td>
			<td align='center'><a href='javascript:void(0);' onClick=delProd('". $r['PRD_CODIGO'] ."')>	<img src='../images/icons/delete.png' alt='Deleta' title='Deleta' border='0' width='19px' height='19px'></a></td>
			<td align='center'>" . $r['PRD_CODIGO'] ."</td>
			";
			
			if ($r['PRD_TIPO_SEXO'] == "F"){echo "<td align='center'>F</td>";}else{echo "<td align='center'>M</td>";}
			
			echo "
			<td align='left'>" . $estilo ."</td>
			<td align='left'>" . $r['PRD_TIPO_PROD'] ."</td>
			<td align='left'>" . $r['PRD_MARCA'] ."</td>
			<td align='left'>" . buscaDB('prod_material', 'PRM_MATERIAL', $r['PRD_MATERIAL'], 'PRM_MATERIAL') ."</td>
			<td align='left'>" .$r['PRD_MODELO'] ."</td>
			<td align='center'>". $r['PRD_ATIVO'] ."</td>";
			//if ($r['PRD_ATIVO'] == "S"){echo "<td align='left'>Sim</td>";}else{echo "<td align='left'>Não</td>";}
			if($r['PRD_FRET_GRAT'] == "S"){echo "<td align='center'>G</td>";}else{echo "<td align='center'>N</td>";}
			
			echo "<td align='right'>". str_replace(".", ",", $r['PRD_VLR_CUSTO']) ."</td>".
			     "<td align='right'>". str_replace(".", ",", $r['PRD_VLR_VENDA']) ."</td>".
				 "<td align='right'>". str_replace(".", ",", $r['PRD_VLR_PROMO']) ."</td>".
				 //"<td align='right'>". str_replace(".", ",", $r['PRD_VLR_DESC']) ."</td>".
				 //"<td align='left'>". 	$r['PRD_NOME'] ."</td>".
				 //"<td align='left'>" . 	$r['PRD_OBS'] . "</td>".
				 "</tr>";
			$indice = $indice + 1;
		}
	?>
	</tbody>
</table>