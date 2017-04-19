<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

<link rel="stylesheet" href="../css/jquery.ui.all.css">
<script src="../script/jquery-1.5.1.js"></script>

<link rel="stylesheet" href="../css/style.css">

<script language="javascript" type="text/javascript">
	function editar(cod, ano){
		window.parent.document.formCadMoto.SelEdtMtCod.value = cod;
		window.parent.document.formCadMoto.SelEdtMtAno.value = ano;
		window.parent.document.formCadMoto.submit();
	}

	function deletar(cod, ano){
		if ( confirm('Deseja excluir a Moto '+ cod +' de Ano '+ ano +' e todas as imagens do diretório?') ){
			window.parent.document.formCadMoto.SelDelMtCod.value = cod;
			window.parent.document.formCadMoto.SelDelMtAno.value = ano;
			window.parent.document.formCadMoto.submit();
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
			<td align="center"><strong></strong></td>
			<td align="center"><strong></strong></td>
			<td align="center"><strong>Marca</strong></td>
			<td align="center"><strong>Modelo</strong></td>
			<td align="center"><strong>Ano</strong></td>
			<td align="center"><strong>Tipo</strong></td>
			<td align="center"><strong>CC</strong></td>
			<td align="center"><strong>Cilindro</strong></td>
			<!--
			<td align="center"><strong>HP / CV</strong></td>
			<td align="center"><strong>KGFM</strong></td>
			<td align="center"><strong>Marchas</strong></td>
			-->
		</tr>
	</thead>
	<tbody style="font-size: 14px;">
	<?php
		$qr    = "
		SELECT MOT.*, MMO.*, MAR.*
		  FROM mp_motos MOT
		  LEFT JOIN mp_marca_mod MMO ON MMO.MMO_COD = MOT.MOT_MMO_COD
		  LEFT JOIN mp_marca 	 MAR ON MAR.MAR_COD = MMO.MMO_MAR_COD
		 LIMIT 0 , 50";
		$sql   = mysql_query($qr);
		$total = mysql_num_rows($sql);
		$indice = 1;
		while($r = mysql_fetch_array($sql)){

			$marca = buscaDB('mp_marca', 'MAR_COD', $r['MMO_MAR_COD'], 'MAR_NOME');	// Table Search , Field Search , Value Search , Field Return

			$tipo = "";
			switch ($r['MOT_CATEG']){
				case "U":
					$tipo = "Urbana";
					break;
				case "C":
					$tipo = "Custom";
					break;
				case "L":
					$tipo = "Clássica";
					break;
				case "N":
					$tipo = "Naked";
					break;
				case "R":
					$tipo = "Scooter";
					break;
				case "P":
					$tipo = "Sport";
					break;
				case "S":
					$tipo = "SuperSport";
					break;
				case "A":
					$tipo = "Aventureira";
					break;
				case "O":
					$tipo = "Off Road";
					break;
				case "V":
					$tipo = "Vintage";
					break;
			}
			
			echo "<tr class='grid-body' "; if($indice % 2 == 0) echo "bgcolor='#C2DFFF'";
			echo ">
			<td align='center'><a href='javascript:void(0);' onClick=editar('". $r['MOT_MMO_COD'] ."','". $r['MOT_ANOFAB'] ."')> <img src='../images/icons/edit.png'   alt='Altera' title='Altera' border='0' width='19px' height='19px'></a></td>
			<td align='center'><a href='javascript:void(0);' onClick=deletar('". $r['MOT_MMO_COD'] ."','". $r['MOT_ANOFAB'] ."')> <img src='../images/icons/delete.png' alt='Deleta' title='Deleta' border='0' width='19px' height='19px'></a></td>
			<td align='center'>". $marca ."</td>
			<td align='center'>". $r['MMO_MODELO'] ."</td>
			<td align='center'>". $r['MOT_ANOFAB'] ."</td>
			<td align='center'>". $tipo ."</td>
			<td align='center'>". $r['MOT_CC'] ."</td>
			<td align='center'>". $r['MOT_CIL'] ."</td>
			</tr>";
			/*
			<td align='center'>". $r['MOT_HP'] ."</td>
			<td align='center'>". $r['MOT_KGFM'] ."</td>
			<td align='center'>". $r['MOT_MARCHAS'] ."</td>
			*/
			
			$indice += 1;
		}
	?>
	</tbody>
</table>