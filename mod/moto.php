<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />

	<link  href="css/style.css" type="text/css" rel="stylesheet" />
	<script language="javascript" src="script/x_mascara.js"></script>
	<script language="javascript" src="script/x_functions.js"></script>

	<link rel="stylesheet" href="css/jquery.ui.all.css">

	<script language="javascript" type="text/javascript">
	
		function gravaMarMod(){
			document.formViewMoto.hdMMO_COD.value 	 = document.getElementById('ifrmSrcMoto').contentWindow.document.getElementById('hdMMO_COD').value;
			document.formViewMoto.hdMMO_MARCA.value	 = document.getElementById('ifrmSrcMoto').contentWindow.document.getElementById('cdmt_marca').value;
			//document.formViewMoto.hdMMO_MODELO.value = document.getElementById('ifrmSrcMoto').contentWindow.document.getElementById('hdMMO_COD').value;
			document.formViewMoto.hdMMO_MODELO.value = document.getElementById('ifrmSrcMoto').contentWindow.document.getElementById('cdmt_mod').value;
			document.formViewMoto.hdANOFAB.value 	 = document.getElementById('ifrmSrcMoto').contentWindow.document.getElementById('ano_mod').value;
		}
		
	</script>

	</head>

<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

$marca   = "";
$modelo  = "";
$ano_mod = "";

if (isset($_POST['hdMMO_COD']))	$_SESSION['sesMMO_COD']	= $_POST['hdMMO_COD'];
if (isset($_POST['hdMMO_MARCA'])){
	$_SESSION['sesMMO_MARCA']  	= $_POST['hdMMO_MARCA'];
	$marca = $_POST['hdMMO_MARCA'];
}
if (isset($_POST['hdMMO_MODELO'])){
	$_SESSION['sesMMO_MODELO'] 	= $_POST['hdMMO_MODELO'];
	$modelo = $_POST['hdMMO_MODELO'];
}
if (isset($_POST['hdANOFAB'])){
	$_SESSION['sesANOFAB'] 		= $_POST['hdANOFAB'];
	$ano_mod = $_POST['hdANOFAB'];
}
/*
echo "<br>src MARCA  = ". $marca;
echo "<br>src MODELO = ". $modelo;
echo "<br>src ANO    = ". $ano_mod;

if (isset($_SESSION['sesMMO_COD']))		echo "<br>sesMMO_COD 	- ". $_SESSION['sesMMO_COD'];
if (isset($_SESSION['sesMMO_MARCA']))	echo "<br>sesMMO_MARCA  - ". $_SESSION['sesMMO_MARCA'];
if (isset($_SESSION['sesMMO_MODELO']))	echo "<br>sesMMO_MODELO - ". $_SESSION['sesMMO_MODELO'];
if (isset($_SESSION['sesANOFAB']))		echo "<br>sesANOFAB 	- ". $_SESSION['sesANOFAB'];
*/

$lk_marca_cod = "";
if ($modulo1 != ""){
	$lk_marca = ret_espaco_acento( $modulo1 );
	$lk_marca = soCaractere( $lk_marca );
	$lk_marca = str_replace("%"," ",$lk_marca);

	$lk_marca_cod = srcLikeDB('mp_marca', 'MAR_NOME', $lk_marca, 'MAR_COD');	// Table Search , Field Search , Value Search , Field Return
	
	if ($lk_marca_cod == "")
		$lk_marca_cod = $lk_marca;
}

if ($modulo2 != ""){
	$lk_model = $modulo2;
	
	// Percorre a tabela mp_marca_mod com a marca "$lk_marca_cod" verificando o nome do modelo sem (espaço em branco, acento) e coloca em maiúsculo e vê se existe
	$sql = "SELECT MMO_COD, MMO_MODELO FROM mp_marca_mod 
			 WHERE MMO_MAR_COD = '$lk_marca_cod' ";
	$qr = mysql_query($sql);
	while($r = mysql_fetch_array($qr)){
		$src_modelo = mb_strtoupper( retCarEsp( str_replace(" ", "", $r['MMO_MODELO']) ) );	// Letras Maiusculo --- Retira Espacos --- Retira acentos
		if ($lk_model == $src_modelo)
			$lk_mod_cod = $r['MMO_COD'];
	}
}

if ($modulo3 != "")	$lk_ano = $modulo3;

/*
echo "<br>çççaaee 88 $ .... ççç 456 ASSAS //??? ÁÁÁÍÍÍÍ  ====== ". mb_strtoupper( retCarEsp( str_replace(" ", "", 'çççaaee 88 $ .... ççç 456 ASSAS //??? ÁÁÁÍÍÍÍ') ) );
echo "<br>lk MARCA ====== ". $lk_marca;
echo "<br>lk MARCA_COD == ". $lk_marca_cod;
echo "<br>lk MODELO ===== ". $lk_model;
echo "<br>lk MODELO_COD = ". $lk_mod_cod;
echo "<br>lk ANO ======== ". $lk_ano;
*/
?>
<!-- <div id="titulo">Motos</div> -->

<form id="formViewMoto" name="formViewMoto" action="moto" method="post" accept-charset="utf-8" enctype="multipart/form-data">

	<input type="hidden" id="hdMMO_COD"		name="hdMMO_COD"	value="<?php if (isset($_SESSION['sesMMO_COD']))	echo $_SESSION['sesMMO_COD']; ?>">
	<input type="hidden" id="hdMMO_MARCA"	name="hdMMO_MARCA" 	value="<?php if (isset($_SESSION['sesMMO_MARCA']))	echo $_SESSION['sesMMO_MARCA']; ?>">
	<input type="hidden" id="hdMMO_MODELO"	name="hdMMO_MODELO" value="<?php if (isset($_SESSION['sesMMO_MODELO']))	echo $_SESSION['sesMMO_MODELO']; ?>">
	<input type="hidden" id="hdANOFAB"		name="hdANOFAB"		value="<?php if (isset($_SESSION['sesANOFAB']))		echo $_SESSION['sesANOFAB']; ?>">

	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="background: #333; color: #fff;">
		<tr>
			<td valign="middle">
				<iframe name="ifrmSrcMoto" id="ifrmSrcMoto" src="./ajax_view_moto.php" frameborder="0" scrolling="no" align="middle" width="100%" height="50px" style="background: #333; color: #fff;">
					<p>Sem suporte a iFrames.</p>
				</iframe>
			</td>
			<td valign="middle">
				<input type="submit" id="btProcurar" name="btProcurar" value="Procurar" onClick="gravaMarMod()">
			</td>
		</tr>
	</table>
	</br>
	
	<?php

	if (($marca != "" && $modelo != "" && $modelo != "0" && $ano_mod != "" && $ano_mod != "0") || 
		($lk_marca != "" && $lk_model != "" && $lk_ano != "") ){

		$sql = "
		SELECT *
		  FROM mp_motos MOT
		  LEFT JOIN mp_marca_mod MRM ON MRM.MMO_COD 	= MOT.MOT_MMO_COD
		  LEFT JOIN mp_marca 	 MAR ON MAR.MAR_COD 	= MRM.MMO_MAR_COD
		  LEFT JOIN mp_moto_img  IMG ON IMG.MIM_MMO_COD = MOT.MOT_MMO_COD
									AND	IMG.MIM_MOT_ANO = MOT.MOT_ANOFAB
									AND IMG.MIM_IMG_PRI <> '' ";
		// PROCURA PELO mecanismo do site
		if ($marca != "" && $modelo != "" && $modelo != "0" && $ano_mod != "" && $ano_mod != "0"){
			$sql .= "WHERE MOT.MOT_MMO_COD = '". $modelo ."'
					   AND MOT.MOT_ANOFAB  = '". $ano_mod ."'";
		}
		
		// PROCURA direta pelo BROWSE
		if ($lk_marca != "" && $lk_model != "" && $lk_ano != ""){
			$sql .= "WHERE MOT.MOT_MMO_COD = '". $lk_mod_cod ."'
					   AND MOT.MOT_ANOFAB  = '". $lk_ano ."'";
		}
//echo "QUERY<br> $sql";
		$sql .= "LIMIT 1 ";
		
		$qr = mysql_query($sql);
		$total = mysql_num_rows($qr);

		if ($total == 0) echo "<center>Nennhuma moto encontrada. &nbsp;&nbsp;&nbsp;&nbsp; :( </center>";
		
		while($r = mysql_fetch_array($qr)){

			$lubrif = "";
			switch ($r['MOT_LUB']){
				case "U":
				$lubrif = "Cárter Úmido";
				break;
				case "S":
				$lubrif = "Cárter Seco";
				break;
			}

			$combust = "";
			switch ($r['MOT_COMB']){
				case "G":
				$combust = "Gasolina";
				break;
				case "A":
				$combust = "Etanol";
				break;
				case "F":
				$combust = "Flex";
				break;
				case "P":
				$combust = "Pódium somente";
				break;
			}
			
			$categoria = "";
			switch ($r['MOT_CATEG']){
				case "U":
					$categoria = "Urbana";
					break;
				case "C":
					$categoria = "Custom";
					break;
				case "L":
					$categoria = "Clássica";
					break;
				case "N":
					$categoria = "Naked";
					break;
				case "R":
					$categoria = "Scooter";
					break;
				case "P":
					$categoria = "Sport";
					break;
				case "S":
					$categoria = "SuperSport";
					break;
				case "A":
					$categoria = "Aventureira";
					break;
				case "O":
					$categoria = "Off Road";
					break;
			}
			
			$sis_partida = "";
			switch ($r['MOT_PARTIDA']){
				case "E":
					$sis_partida = "Elétrica";
					break;
				case "P":
					$sis_partida = "Pedal";
					break;
				case "A":
					$sis_partida = "Elétrica/Pedal";
					break;
			}

			$trans_sec = "";
			switch ($r['MOT_TRANSSEC']){
				case "C":
					$trans_sec = "Corrente";
					break;
				case "A":
					$trans_sec = "Cardã";
					break;
				case "O":
					$trans_sec = "Correia Dentada";
					break;
			}
			
			$modelo_lb = mb_strtoupper( retSEspOut( $r['MMO_MODELO'] ) );
			$path_img  = "http://images.motopod.com.br/Moto/". $r['MAR_COD'] ."/". $modelo_lb ."/". $r['MOT_ANOFAB'] ."/". $r['MIM_PATH'];
			?>
			
			<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX INICIO FOTOS XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
			<center><span style="font-size: 16px; color: #003760; font-weight: normal;"><b>FOTOS</b></span></center>

			<?php
			$sqlImg = "
			SELECT *
			  FROM mp_moto_img
			 WHERE MIM_MMO_COD = '". $r['MOT_MMO_COD'] ."'
			   AND MIM_MOT_ANO = '". $r['MOT_ANOFAB'] ."'
			 ORDER BY MIM_COD";
			$qrImg = mysql_query($sqlImg);
			
			echo "<center></br><div class='gallery clearfix'>";
			
				while($rImg = mysql_fetch_array($qrImg)){

					$path_img = "http://images.motopod.com.br/Moto/". $r['MAR_COD'] ."/". $modelo_lb ."/". $r['MOT_ANOFAB'] ."/". $rImg['MIM_PATH'];
					
					echo "<a href='". $path_img ."' rel='prettyPhoto[Moto]'><img src='". $path_img ."' widht='100px' height='100px'/ style='margin:2px 2px 2px 2px;'></a>";
				}

			echo "</div></center></br></br>";

			?>
			<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX FIM FOTOS XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

			<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX INICIO XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
			<article id="" class="wrapper-ficha" width="100%" style="margin: 10px; margin-top: 0px; margin-bottom: 0px">
				<center><span style="font-size: 16px; color: #003760; font-weight: normal;"><b>FICHA TÉCNICA</b></span></center></br>
				
				<table class="tb-ficha" style="margin-bottom: 0px" width="100%">
					<thead>
						<tr>
							<th width="55%" ></th>
							<th width="45%" id="" class="azul"></br>
								<img id="" src="<?php echo $path_img; ?>" style="border-width:0px;" width="102" height="63"></br></br>
								<strong><?php echo $r['MAR_NOME'] .' - '. $r['MMO_MODELO'] .' - '. $r['MOT_ANOFAB']; ?></strong>
							</th>
							<!--
							<th width="35%" ></th>
							<th width="25%" id="" class="azul"><img id="" src="./images/tmp/k1tb.jpg" style="border-width:0px;"><br>Factor YBR 125 K1</th>
							<th width="20%" id="" class="cinza"><img id="" src="./images/tmp/etb.jpg" style="border-width:0px;"><br>Factor YBR 125 E</th>
							<th width="20%" id="" class="cinza"><img id="" src="./images/tmp/edtb.jpg" style="border-width:0px;"><br>Factor YBR 125 ED</th>
							-->
						</tr>
						<tr>
							<th colspan="5" height="10"></th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td colspan="5" class="grupo">Motor<span></span></td>
						</tr>

							<tr>
								<td>Tipo<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_TPMOTOR']; ?></td>
								<td class="dados-compara" style="display: none;">4 tempos, SOHC, refrigerado a ar, 2 válvulas</td>
								<td class="dados-compara" style="display: none;">4 tempos, SOHC, refrigerado a ar, 2 válvulas</td>
							</tr>

							<tr>
								<td>Quantidade de cilindros<span></span></td>
								<td class="princ-compara">1 cilindro <?php echo $r['MOT_CIL']; ?></td>
								<td class="dados-compara" style="display: none;">1 cilindro</td>
								<td class="dados-compara" style="display: none;">1 cilindro</td>
							</tr>
						
							<tr>
								<td>Cilindrada<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_CC']; ?> cc</td>
								<td class="dados-compara" style="display: none;">123,7 cc</td>
								<td class="dados-compara" style="display: none;">123,7 cc</td>
							</tr>

							<tr>
								<td>Categoria<span></span></td>
								<td class="princ-compara"><?php echo $categoria; ?> cc</td>
								<td class="dados-compara" style="display: none;">123,7 cc</td>
								<td class="dados-compara" style="display: none;">123,7 cc</td>
							</tr>

							<tr>
								<td>Diâmetro x curso<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_DIA_CUR']; ?></td>
								<td class="dados-compara" style="display: none;">54 x 54 mm</td>
								<td class="dados-compara" style="display: none;">54 x 54 mm</td>
							</tr>
						
							<tr>
								<td>Taxa de compressão<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_TXCOMPR']; ?></td>
								<td class="dados-compara" style="display: none;">10:1</td>
								<td class="dados-compara" style="display: none;">10:1</td>
							</tr>

							<tr>
								<td>Potência máxima<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_HP']; ?></td>
								<td class="dados-compara" style="display: none;">10,2 cv (7800rpm)</td>
								<td class="dados-compara" style="display: none;">10,2 cv (7800rpm)</td>
							</tr>
						
							<tr>
								<td>Torque máximo<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_KGFM']; ?></td>
								<td class="dados-compara" style="display: none;">1.0 kgf.m / 6.000r/min</td>
								<td class="dados-compara" style="display: none;">1.0 kgf.m / 6.000r/min</td>
							</tr>
						
							<tr>
								<td>Sistema de lubrificação<span></span></td>
								<td class="princ-compara"><?php echo $lubrif; ?></td>
								<td class="dados-compara" style="display: none;">Cárter úmido</td>
								<td class="dados-compara" style="display: none;">Cárter úmido</td>
							</tr>
						
							<tr>
								<td>Alimentação<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_ALIMENT']; ?></td>
								<td class="dados-compara" style="display: none;">Carburador</td>
								<td class="dados-compara" style="display: none;">Carburador</td>
							</tr>
						
							<tr>
								<td>Embreagem<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_EMBREAG']; ?></td>
								<td class="dados-compara" style="display: none;">Multi-disco, Úmida</td>
								<td class="dados-compara" style="display: none;">Multi-disco, Úmida</td>
							</tr>
						
							<tr>
								<td>Câmbio/Marchas<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_MARCHAS']; ?></td>
								<td class="dados-compara" style="display: none;">5 velocidades</td>
								<td class="dados-compara" style="display: none;">5 velocidades</td>
							</tr>
						
							<tr>
								<td>Sistema de ignição<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_SISIGNI']; ?></td>
								<td class="dados-compara" style="display: none;">CDI</td>
								<td class="dados-compara" style="display: none;">CDI</td>
							</tr>
						
							<tr>
								<td>Combustível<span></span></td>
								<td class="princ-compara"><?php echo $combust; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Óleo<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_OLEO']; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Sistema de partida<span></span></td>
								<td class="princ-compara"><?php echo $sis_partida; ?></td>
								<td class="dados-compara" style="display: none;">Elétrica</td>
								<td class="dados-compara" style="display: none;">Elétrica</td>
							</tr>

							<tr>
								<td>Transmissão secundária<span></span></td>
								<td class="princ-compara"><?php echo $trans_sec; ?></td>
								<td class="dados-compara" style="display: none;">Corrente</td>
								<td class="dados-compara" style="display: none;">Corrente</td>
							</tr>
						
						<tr>
							<td colspan="5" class="grupo">Chassi e Suspensão<span></span></td>
						</tr>
						
							<tr>
								<td>Tipo do Chassi<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_TPCHASSI']; ?></td>
								<td class="dados-compara" style="display: none;">Diamante</td>
								<td class="dados-compara" style="display: none;">Diamante</td>
							</tr>

							<tr>
								<td>Suspensão Dianteira<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_SUSPDIA']; ?></td>
								<td class="dados-compara" style="display: none;">Diamante</td>
								<td class="dados-compara" style="display: none;">Diamante</td>
							</tr>

							<tr>
								<td>Suspensão Traseira<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_SUSPTRA']; ?></td>
								<td class="dados-compara" style="display: none;">Diamante</td>
								<td class="dados-compara" style="display: none;">Diamante</td>
							</tr>

						<tr>
							<td colspan="5" class="grupo">Freio e Pneu<span></span></td>
						</tr>
						
							<tr>
								<td>Freio dianteiro<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_FREIOD']; ?></td>
								<td class="dados-compara" style="display: none;">Tambor mecânico de 130mm de diâmetro</td>
								<td class="dados-compara" style="display: none;">Disco Hidráulico de 245mm de diâmetro</td>
							</tr>
						
							<tr>
								<td>Freio traseiro<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_FREIOT']; ?></td>
								<td class="dados-compara" style="display: none;">Tambor mecânico de 130mm de diâmetro</td>
								<td class="dados-compara" style="display: none;">Tambor mecânico de 130mm de diâmetro</td>
							</tr>
						
							<tr>
								<td>Pneu dianteiro<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_PNEUD']; ?></td>
								<td class="dados-compara" style="display: none;">Pirelli - 2.75-18 42P</td>
								<td class="dados-compara" style="display: none;">Pirelli - 2.75-18 42P</td>
							</tr>
						
							<tr>
								<td>Pneu traseiro<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_PNEUT']; ?></td>
								<td class="dados-compara" style="display: none;">Pirelli - 90/90-18 REINF 57P</td>
								<td class="dados-compara" style="display: none;">Pirelli - 90/90-18 REINF 57P</td>
							</tr>
							
						<tr>
							<td colspan="5" class="grupo">Dimensões<span></span></td>
						</tr>

							<tr>
								<td>Distância entre eixos<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_EIXODIS']; ?></td>
								<td class="dados-compara" style="display: none;">1.290 mm</td>
								<td class="dados-compara" style="display: none;">1.290 mm</td>
							</tr>
						
							<tr>
								<td>Altura do assento<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_ALTASS']; ?></td>
								<td class="dados-compara" style="display: none;">780 mm</td>
								<td class="dados-compara" style="display: none;">780 mm</td>
							</tr>

							<tr>
								<td>Distância do solo<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_DISTSOLO']; ?></td>
								<td class="dados-compara" style="display: none;">780 mm</td>
								<td class="dados-compara" style="display: none;">780 mm</td>
							</tr>

							<tr>
								<td>Comprimento<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_COMPRIM']; ?></td>
								<td class="dados-compara" style="display: none;">160 mm</td>
								<td class="dados-compara" style="display: none;">160 mm</td>
							</tr>
						
							<tr>
								<td>Largura<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_LARG']; ?></td>
								<td class="dados-compara" style="display: none;">160 mm</td>
								<td class="dados-compara" style="display: none;">160 mm</td>
							</tr>
						
							<tr>
								<td>Altura Moto<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_ALTURA']; ?></td>
								<td class="dados-compara" style="display: none;">160 mm</td>
								<td class="dados-compara" style="display: none;">160 mm</td>
							</tr>
						
							<tr>
								<td>Peso Líquido (ordem de marcha)<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_PESO']; ?></td>
								<td class="dados-compara" style="display: none;">118 kg</td>
								<td class="dados-compara" style="display: none;">119 kg</td>
							</tr>
						
							<tr>
								<td>Capacidade do tanque de combustível<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_TANQUE']; ?></td>
								<td class="dados-compara" style="display: none;">13 litros (2,4 litros reserva)</td>
								<td class="dados-compara" style="display: none;">13 litros (2,4 litros reserva)</td>
							</tr>
							
						<tr>
							<td colspan="5" class="grupo">Elétrica<span></span></td>
						</tr>

							<tr>
								<td>Lâmpada Dianteira<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_LAMPDIA']; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Lâmpada Traseira<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_LAMPTRA']; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Lampejador<span></span></td>
								<td class="princ-compara"><?php if ($r['MOT_LAMPEJ'] == "S") echo "Sim"; else "Não"; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Pisca Alerta<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_PISCAAL']; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Sistema Elétrico<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_SISELE']; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>

							<tr>
								<td>Bateria<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_BATERIA']; ?></td>
								<td class="dados-compara" style="display: none;">12v x 5 AH</td>
								<td class="dados-compara" style="display: none;">12v x 5 AH</td>
							</tr>

						<tr>
							<td colspan="5" class="grupo">Observações<span></span></td>
						</tr>
							<tr>
								<td>Observações<span></span></td>
								<td class="princ-compara"><?php echo $r['MOT_OBS']; ?></td>
								<td class="dados-compara" style="display: none;"></td>
								<td class="dados-compara" style="display: none;"></td>
							</tr>
							
					</tbody>
				</table>
			</article>


			<!-- // #################### INI - COMENTARIOS #################### -->
			<?php

			$qr2 = "
			SELECT * FROM mp_post_cmt
			 WHERE PCM_PST_COD = '". $r['PST_COD'] ."'
			 ORDER BY PCM_HORA DESC, PCM_DATE DESC";
			$sql2 = mysql_query($qr2);
			$total2 = mysql_num_rows($sql2);
			
			if ($total2 > 0)
				$ret .= '
				<div id="comment_section">
					<ol class="comments first_level">
				';
			$tiplinha = false;
			$linha = '';
			while($r2 = mysql_fetch_array($sql2)){
				$data2 = implode("/",array_reverse(explode("-",$r2['PCM_DATE'])));
				$post2 = $r2['PCM_POST'];
				$hora = $r2['PCM_HORA'];
				
				if ($tiplinha){
					$linha = '2';
					$tiplinha = false;
				}else{
					$linha = '1';
					$tiplinha = true;
				}

				$horario = substr($hora,0,2) .':'. substr($hora,2,2);

				echo '
					<li>
						<div class="comment_box commentbox'. $linha .'">
							<div class="gravatar"><img src="http://images.motopod.com.br/avator.png" alt="'. $r2['PCM_NOME'] .'" /></div>
							<div class="comment_text">
								<div class="comment_author">'. $r2['PCM_NOME'] .'<span class="date">'. $data2 .'</span><span class="time">'. $horario .'</span></div>
								<p>'. $post2 .'</p>
								<!--<div class="btn_more float_r"><a href="#"><span>+</span> Reply</a></div>-->
							</div>
							<div class="cleaner"></div>
						</div>                        
					</li>';
			
				if ($total2 > 0)
				echo '</ol>
					</div>';
				// ####################################### INSERE COMENTARIOS #######################################
			}
			?>
			
			<!-- // ####################################### INSERE COMENTARIOS ####################################### 
			</br>
			<div id="comment_form"></br>
				<h3>Deixe sua Opinião / Comentário sobre esta Moto</h3>

				<form id="frmComent" name="frmComent" action="'. $link .'" method="post" accept-charset="utf-8">
					<div class="form_row">
						<label>Nome (*obrigatório)</label>
						<br />
						<input type="text" id="name" name="name" size="50" maxlength="100" class="'. $erro1 .'"/>
					</div>
					<div class="form_row">
						<label>E-mail (*obrigatório)</label>
						<br />
						<input type="text" id="email" name="email" size="50" maxlength="100" class="'. $erro2 .'"/>
					</div>
					<div class="form_row">
						<label>Opinião / Comentário</label><br />
						<textarea id="comment" name="comment" rows="5" cols="60" maxlength="999" class="'. $erro3 .'"/></textarea>
					</div><br>
					<input type="submit" name="btEnvCmntMt" value="Enviar" class="submit_btn" />
				</form>
			</div>
			????
			-->
			<?php
			// #################### FIM - COMENTARIOS ####################
			
			// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX FIM XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX			
		}

	}else{
		echo '
		<table border="0" cellpadding="0" cellspacing="0" height="0" bgcolor="">
		  <tr>
			<td align="left" valign="middle">
				<div id="contentBlog">';
	
				/* ################# INI --- CASO NAO ESCOLHIDO NENHUMA MOTO... APRESENTA AS ULTIMAS MOTOS ################# */
				$qr2 = "
				SELECT *
				  FROM mp_motos MOT
				  LEFT JOIN mp_moto_img  MIM ON MIM.MIM_MMO_COD = MOT.MOT_MMO_COD
											AND MIM.MIM_MOT_ANO = MOT.MOT_ANOFAB
											AND MIM.MIM_IMG_PRI = 'S'
				  LEFT JOIN mp_marca_mod MMO ON MMO.MMO_COD     = MOT.MOT_MMO_COD ";

				// PROCURA PELO mecanismo do site
				if ($marca != "" && $modelo != "" && $modelo != "0"){
					$qr2 .= "WHERE MOT.MOT_MMO_COD LIKE '". $modelo ."%' ";
				}elseif ($marca != ""){
					$qr2 .= "WHERE MOT.MOT_MMO_COD LIKE '". $marca ."%' ";
				}
				
				// PROCURA direta pelo BROWSE
				if ($lk_marca_cod != "" && $lk_model != "" && $lk_ano != ""){
				//if ($lk_marca != "" && $lk_model != "" && $lk_ano != ""){
					$qr2 .= "WHERE MOT.MOT_MMO_COD LIKE '". $lk_marca_cod . $lk_model ."%'
							   AND MOT.MOT_ANOFAB  = '". $ano_mod ."'";
				}elseif ($lk_marca_cod != "" && $lk_model != ""){
					$qr2 .= "WHERE MOT.MOT_MMO_COD LIKE '". $lk_marca_cod . $lk_model ."%'";
				}elseif ($lk_marca_cod != ""){
					$qr2 .= "WHERE MOT.MOT_MMO_COD LIKE '". $lk_marca_cod ."%'";
				}
//echo "QUERY<br> $qr2";
				$qr2 .= " ORDER BY MOT.MOT_DTCAD DESC ";

				$sql2 = mysql_query($qr2);
				$tot2 = mysql_num_rows($sql2);
				
				// NENHUMA RESULTADO
				if ($tot2 == 0) echo "</br></br> <center><h1>Nennhuma moto encontrada. &nbsp;&nbsp;&nbsp;&nbsp; :( </h1></center>";
				
				while($r2 = mysql_fetch_array($sql2)){
					$mar_mod = $r2['MOT_MMO_COD'];
					$link_img = $r2['MIM_PATH'];
					
					$marca  = $r2['MMO_MAR_COD'];
					$mar_nm = buscaDB('mp_marca', 'MAR_COD', $r2['MMO_MAR_COD'], 'MAR_NOME');	// Table Search , Field Search , Value Search , Field Return
					$modelo = mb_strtoupper( retSEspOut( $r2['MMO_MODELO'] ) );
					$mod_nm = $r2['MMO_MODELO'];
					$ano    = $r2['MOT_ANOFAB'];
					
					$tipo = "";
					switch ($r2['MOT_CATEG']){
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

					$path_img 	= '//images.motopod.com.br/Moto/'. $r2['MMO_MAR_COD'] ."/". $modelo ."/". $ano ."/". $link_img;
					$link	  	= 'moto/'. $marca .'/'. $modelo .'/'. $ano;
					$txt_imagem = '<a href="'. $link .'"><img src="'. $path_img .'" alt="'. $mar_nm ." - ". $modelo .'" widht="100px" height="100px"/></a>';

					echo '
					<div class="post_box">
						<h2><a href="'. $link .'"><font size="5em">'. $mar_nm ." - ". $mod_nm ." - ". $ano .'</font></a></h2>
						<div class="post_meta">
							<font size="2em" color="#fff">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							  <tr>
								<td align="left"><strong>	Cilindros: 		</strong><font color="#f27444">'. $r2['MOT_CIL'] .'</font></td>
								<td align="left"><strong>	Cilindrada:		</strong><font color="#f27444">'. $r2['MOT_CC'] .'</font></td>
								<td align="left"><strong>	Potência(CV):	</strong><font color="#f27444">'. $r2['MOT_HP'] .'</font></td>
								<td align="right"><strong>	Categoria:		</strong><font color="#f27444">'. $tipo .'</font></td>
							  </tr>
							</table>
							</font>
						</div>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td align="left">'. $txt_imagem .'</td>
								<td align="left" width="520px">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" width="120px"><strong>Motor:</strong></td>
											<td align="left">'. $r2['MOT_TPMOTOR'] .'</td>
										</tr>
										<tr>
											<td align="left"><strong>Torque(KGFM):</strong></td>
											<td align="left">'. $r2['MOT_KGFM'] .'</td>
										</tr>
										<tr>
											<td align="left"><strong>Marchas:</strong></td>
											<td align="left">'. $r2['MOT_MARCHAS'] .' marchas</td>
										</tr>
										<tr>
											<td align="left"><strong>Pneu (Diant.):</strong></td>
											<td align="left">'. $r2['MOT_PNEUD'] .'</td>
										</tr>
										<tr>
											<td align="left"><strong>Pneu (Tras.):</strong></td>
											<td align="left">'. $r2['MOT_PNEUT'] .'</td>
										</tr>
										<tr>
											<td align="left"><strong>Peso:</strong></td>
											<td align="left">'. $r2['MOT_PESO']	.'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						
						<div class="btn_more float_r"><a href="'. $link .'">Leia Mais <span>&raquo;</span></a></div>
					</div>
					';
				}
				/* ################# FIM --- CASO NAO ESCOLHIDO NENHUMA MOTO... APRESENTA AS ULTIMAS MOTOS ################# */
				
				echo '
				</div> <!-- end of content -->';

		include("mod/sidebar.php");

		echo '
			</td>
		  </tr>
		</table>';
	}
	?>
	
	<div style="margin-bottom:30px">&nbsp;</div>

</form>
</html>