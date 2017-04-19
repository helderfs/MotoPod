<?php
session_start();

include_once("../func/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<head>
	<link rel="stylesheet" href="css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/colorpicker.js"></script>
    <script type="text/javascript" src="js/eye.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
	
	<script language="javascript" type="text/javascript">
		function mudaCor(x,origColor){
			//var newColor = 'red';
			if ( x.style ) {
				//x.style.backgroundColor = (newColor == x.style.backgroundColor)? origColor : newColor;
				x.style.backgroundColor = '#' + origColor;
			}
		}
		
		function setCor(){
			var cor0 = document.formProdCor.cor0.value;
			var cor1 = document.formProdCor.cor1.value;
			var cor2 = document.formProdCor.cor2.value;
			var cor3 = document.formProdCor.cor3.value;
			var cor4 = document.formProdCor.cor4.value;
			var cor5 = document.formProdCor.cor5.value;
			var cordesc0 = document.formProdCor.cordesc0.value;
			var cordesc1 = document.formProdCor.cordesc1.value;
			var cordesc2 = document.formProdCor.cordesc2.value;
			var cordesc3 = document.formProdCor.cordesc3.value;
			var cordesc4 = document.formProdCor.cordesc4.value;
			var cordesc5 = document.formProdCor.cordesc5.value;

			if (cor0 != ""){
				parent.document.formCadProduto._cor0.value = cor0;
				parent.document.formCadProduto._cor_desc0.value = cordesc0;
				mudaCor(document.getElementById(0),cor0);
			}
			if (cor1 != ""){
				parent.document.formCadProduto._cor1.value = cor1;
				parent.document.formCadProduto._cor_desc1.value = cordesc1;
				mudaCor(document.getElementById(1),cor1);
			}
			if (cor2 != ""){
				parent.document.formCadProduto._cor2.value = cor2;
				parent.document.formCadProduto._cor_desc2.value = cordesc2;
				mudaCor(document.getElementById(2),cor2);
			}
			if (cor3 != ""){
				parent.document.formCadProduto._cor3.value = cor3;
				parent.document.formCadProduto._cor_desc3.value = cordesc3;
				mudaCor(document.getElementById(3),cor3);
			}
			if (cor4 != ""){
				parent.document.formCadProduto._cor4.value = cor4;
				parent.document.formCadProduto._cor_desc4.value = cordesc4;
				mudaCor(document.getElementById(4),cor4);
			}
			if (cor5 != ""){
				parent.document.formCadProduto._cor5.value = cor5;
				parent.document.formCadProduto._cor_desc5.value = cordesc5;
				mudaCor(document.getElementById(5),cor5);
			}
		}
	</script>
</head>
<form id="formProdCor" name="formProdCor" method="post" accept-charset="utf-8">
	<div style="margin-left:220px; margin-top:0px;">
	<table border="0" cellspacing="0" cellpadding="0" align="center">
		<?php	
		$PRD_CODIGO = "";
		$PRD_COR = "";
		$PRD_COR_DESC = "";
		$sess_lst_cor = "";
		$sess_lst_cor_desc = "";
		
		if (isset($_SESSION['PRD_CODIGO'])){
			$PRD_CODIGO 		= $_SESSION['PRD_CODIGO'];
			$sess_lst_cor 		= $_SESSION['sess_lst_cor'];
			$sess_lst_cor_desc 	= $_SESSION['sess_lst_cor_desc'];
		}

		if ($sess_lst_cor != ""){
			$PRD_COR = $sess_lst_cor;
			$PRD_COR_DESC = $sess_lst_cor_desc;
		}else{
			if ($PRD_CODIGO != ""){
				$sql_busca = "SELECT * FROM produto WHERE PRD_CODIGO = $PRD_CODIGO ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$num_busca = mysql_num_rows($exe_busca);
				if ($num_busca <> 0)
					$PRD_COR = $fet_busca['PRD_COR'];
					$PRD_COR_DESC = $fet_busca['PRD_COR_DESC'];
			}
		}
		
		/* CARREGA AS CORES */
		$array = "";
		$array 		= explode(",",$PRD_COR);
		$array_desc = explode(",",$PRD_COR_DESC);
		
		for($i = 0 ; $i < 6 ; $i++ ){
			if (isset($array[$i]))
				$vlr_cor = $array[$i];
			else
				$vlr_cor = "";		

			if (isset($array_desc[$i]))
				$vlr_cor_desc = $array_desc[$i];
			else
				$vlr_cor_desc = "";		

			$i_cor = $i + 1;
			echo '
			<tr>
				<td height="25px" width="120px"><p>Cor '. $i_cor .': 
				<input type="text" name="cor'. $i .'" maxlength="6" size="6" id="colorpickerField1" value="'. $vlr_cor .'" onChange="setCor();" />
				</p>
				</td>
				<td width="80px" height="5px" id="'. $i .'" style="background-color:#'. $vlr_cor .'; border: 1px solid black;"></td>
				<td width="140px"><input type="text" name="cordesc'. $i .'" maxlength="20" size="15" value="'. $vlr_cor_desc .'" onChange="setCor();" /></td>
			</tr>';
			//onblur="setCor();" onmouseout="setCor();"
		}
		?>
	</table>
	</div>
	<script language="javascript" type="text/javascript">setCor();</script>
</form>