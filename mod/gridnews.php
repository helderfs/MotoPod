<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

<link rel="stylesheet" href="../css/jquery.ui.all.css">
<script src="../script/jquery-1.5.1.js"></script>

<link rel="stylesheet" href="../css/style.css">

<script language="javascript" type="text/javascript">
	function edita(produto){
		window.parent.document.formCadNews.SelEdtNews.value = produto;
		window.parent.document.formCadNews.submit();
	}

	function deleta(produto,cat){
		if ( confirm('Deseja excluir o Produto ' + produto + ' e todas as imagens do diretório e os comentários?') ){
			window.parent.document.formCadNews.SelDelNews.value = produto;
			window.parent.document.formCadNews.SelDelNewsCat.value = cat;
			window.parent.document.formCadNews.submit();
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
			<td align="center" width='40px'><strong>Cód</strong></td>
			<td align="left"><strong>Categoria</strong></td>
			<td align="left"><strong>Título</strong></td>
			<td align="left"><strong>Data</strong></td>
			<td align="center" width='60px'><strong>Hora</strong></td>
			<!--<td align="left"><strong>Post</strong></td>-->
			<td align="left"><strong>Autor</strong></td>
			<!--<td align="left" ><strong>Nome</strong></td>-->
			<!--<td align="left"><strong>Observação</strong></td>-->
		</tr>
	</thead>
	<tbody>
	<?php
		$qr    = "SELECT * FROM mp_posts LIMIT 0 , 50";
		$sql   = mysql_query($qr);
		$total = mysql_num_rows($sql);
		$indice = 1;
		while($r = mysql_fetch_array($sql)){
			if (strlen($r['PST_TITULO']) > 60)
				$titulo = substr($r['PST_TITULO'], 0, 60) . "...";
			else
				$titulo = $r['PST_TITULO'];
				
			if (strlen($r['PST_POST']) > 35)
				$post = substr($r['PST_POST'], 0, 35) . "...";
			else
				$post = $r['PST_POST'];
			
			$cat_news 	= "";
			$autor 		= "";
			
			switch ($r['PST_CATNEWS']){
				case "1":
					$cat_news = "Moto";
					break;
				case "2":
					$cat_news = "MotoGP";
					break;
				case "3":
					$cat_news = "Fórmula 1";
					break;
			}

			switch ($r['PST_AUTOR']){
				case "1":
					$autor = "HFS";
					break;
				case "2":
					$autor = "Outro";
					break;
			}

			echo "<tr class='grid-body' "; if($indice % 2 == 0) echo "bgcolor='#C2DFFF'";
			echo ">
			<td align='center'><a href='javascript:void(0);' onClick=edita('". $r['PST_COD'] ."')> <img src='../images/icons/edit.png'   alt='Altera' title='Altera' border='0' width='19px' height='19px'></a></td>
			<td align='center'><a href='javascript:void(0);' onClick=deleta('". $r['PST_COD'] ."','". $r['PST_CATNEWS'] ."')> <img src='../images/icons/delete.png' alt='Deleta' title='Deleta' border='0' width='19px' height='19px'></a></td>
			<td align='center'>" . $r['PST_COD'] ."</td>
			<td align='left' width='70px'> $cat_news </td>
			<td align='left'  > $titulo </td>
			<td align='left'  >". $r['PST_DATE'] ."</td>
			<td align='center'>". $r['PST_HORA'] ."</td>
			<!--<td align='left'  > $post </td>-->
			<td align='center'> $autor </td>
			</tr>";

			$indice = $indice + 1;
		}
	?>
	</tbody>
</table>