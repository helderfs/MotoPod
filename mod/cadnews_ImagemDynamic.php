<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
	<script language="javascript" src="script/x_mascara.js"></script>

	<link rel="stylesheet" href="css/jquery.ui.all.css">

	<script src="script/jquery-1.5.1.js"></script>
	<script src="script/jquery.cookie.js"></script>
	<script src="script/jquery.ui.core.js"></script>
	<script src="script/jquery.ui.widget.js"></script>
	<script src="script/jquery.ui.tabs.js"></script>
	

	<script language="javascript" type="text/javascript">
		
		$(function() {
			$( "#tabs" ).tabs({
				cookie: {
					// store cookie for a day, without, it would be a session cookie
					expires: 1
				}
			});
		});

		function delImages(codPai,codImag){
			if (codImag == ""){
				if (codPai == ""){
					alert("Selecione uma Notícia.");
					window.parent.document.formCadNews.SelDelNewsImgPai.value = "codPai";
				}else{
					if ( confirm('Deseja excluir as imagens da Notícia ' + codPai) ){
						window.parent.document.formCadNews.SelDelNewsImgPai.value = codPai;
						window.parent.document.formCadNews.submit();
					}
				}
			}else{
				window.parent.document.formCadNews.SelDelNewsImgFil.value = codImag;
				window.parent.document.formCadNews.submit();
			}
		}
	</script>
	
	<script type="text/javascript">
		$(function (){
			function removeCampo(){
				$(".removerCampo").unbind("click"); 
				$(".removerCampo").bind("click", function (){
										i=0;
										$(".imagens p.campoImagens").each(function (){
											i++;
										});
										if (i>1){
											$(this).parent().remove();
										}
									});
			}
			removeCampo(); 
			$(".adicionarCampo").click(
				function (){
					novoCampo = $(".imagens p.campoImagens:first").clone();
					novoCampo.find("input").val("");
					novoCampo.insertAfter(".imagens p.campoImagens:last");
					removeCampo();
				});
			}
		);
	</script>
	
	</head>

<?php
include_once("func/config.php");
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

/* ################################################ INICIALIZACAO ################################################ */
$c_erros = "";

$PST_COD		= 0;
$PST_LINK       = "";
$PST_CATNEWS    = "";
$PST_TITULO     = "";
$PST_DATE       = "";
$PST_HORA       = "";
$PST_AUTOR      = "";
$PST_POSTRES    = "";
$PST_POST       = "";

$PIM_IMAGE_path = "";

/* ################################################ INICIALIZACAO ################################################ */
$btIncluir = "";
$SelEdtNews = "";
$SelDelNews = "";
$SelDelNewsImgFil = "";
$SelDelNewsImgPai = "";

if (isset($_POST['btIncluir'])) 	$btIncluir	= $_POST['btIncluir'];
if (isset($_POST['SelEdtNews'])) 	$SelEdtNews = $_POST['SelEdtNews'];
if (isset($_POST['SelDelNews'])) 	$SelDelNews = $_POST['SelDelNews'];
if (isset($_POST['SelDelNewsImgFil'])) $SelDelNewsImgFil = $_POST['SelDelNewsImgFil'];
if (isset($_POST['SelDelNewsImgPai'])){
	$SelDelNewsImgPai = $_POST['SelDelNewsImgPai'];
	if ($SelDelNewsImgPai != "cod")
		$PST_COD = $SelDelNewsImgPai;
}

/* ##################### INSERCAO ##################### */
if ($btIncluir != "" && $SelEdtNews == "" && $SelDelNews == "" && $SelDelNewsImgFil == "" && $SelDelNewsImgPai == ""){

	$c_erros 	  = "";
	$erro_link 	  = "";
	$erro_catnews = "";
	$erro_titulo  = "";
	$erro_autor   = "";
	$erro_post    = "";

	// Verifica codigo
	if($btIncluir != "Alterar Notícia"){
		$sql_busca 	= "SELECT MAX(PST_COD) AS MAX_COD FROM mp_posts";
		$exe_busca 	= mysql_query($sql_busca) or die (mysql_error());
		$fet_busca 	= mysql_fetch_assoc($exe_busca);
		$PST_COD	= $fet_busca['MAX_COD'] + 1;
	}else{
		$PST_COD = "";
		if (isset($_POST['PST_COD'])) 	$PST_COD = $_POST['PST_COD'];
	}

	if (isset($_POST['PST_LINK']))		$PST_LINK	 	= $_POST['PST_LINK'];
	if (isset($_POST['PST_CATNEWS']))	$PST_CATNEWS	= $_POST['PST_CATNEWS'];
	if (isset($_POST['PST_TITULO']))	$PST_TITULO 	= $_POST['PST_TITULO'];
	if (isset($_POST['PST_AUTOR']))		$PST_AUTOR  	= $_POST['PST_AUTOR'];
	if (isset($_POST['PST_POSTRES']))	$PST_POSTRES	= $_POST['PST_POSTRES'];
	if (isset($_POST['PST_POST']))		$PST_POST   	= $_POST['PST_POST'];
	
	if ($PST_LINK == ""){
		$c_erros = $c_erros . ",Link não informado.";
		$erro_estilo = "erro";
	}
	if ($PST_CATNEWS == ""){
		$c_erros = $c_erros . ",Categoria da Notícia não informada.";
		$erro_estilo = "erro";
	}
	if ($PST_TITULO == ""){
		$c_erros = $c_erros . ",Título não informado.";
		$erro_estilo = "erro";
	}
	if ($PST_AUTOR == ""){
		$c_erros = $c_erros . ",Autor não informado.";
		$erro_estilo = "erro";
	}
	if ($PST_POST == ""){
		$c_erros = $c_erros . ",Post não informado.";
		$erro_estilo = "erro";
	}

	/* ############################### Envia IMAGENS ############################### */
	$field_file = [];
	$qtd_img = 0;
	if (isset($_POST['field_file']))
		$field_file = $_POST['field_file'];

	$qtd_img = count($field_file);
	for ($i=0; $i<$qtd_img; $i++){
echo "01";
		if( $_FILES ) { // Verificando se existe o envio de arquivos.
echo "02";		
			if( $_FILES['PIM_IMAGE'.$i]['name'] <> "" ) { // Verifica se o campo não está vazio.
echo "03";			
				// NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO
				if(!is_dir("../imgMotoPod/News/". $PST_CATNEWS))
					 mkdir("../imgMotoPod/News/". $PST_CATNEWS);
				if(!is_dir("../imgMotoPod/News/". $PST_CATNEWS ."/". $PST_COD ."/"))
					 mkdir("../imgMotoPod/News/". $PST_CATNEWS ."/". $PST_COD ."/");
				// NAO ADIANTA FAZER DESTA SELECAO UMA FUNCAO

				$dir 	 = "../imgMotoPod/News/". $PST_CATNEWS ."/". $PST_COD ."/";

				$tmpName = $_FILES['PIM_IMAGE'.$i]['tmp_name']; // Recebe o arquivo temporário.
				$name 	 = $_FILES['PIM_IMAGE'.$i]['name'];		// Recebe o nome do arquivo.

				if ($name != ""){
					// move_uploaded_file( $arqTemporário, $nomeDoArquivo )
					if (!file_exists($dir . $name)){
						if (move_uploaded_file( $tmpName, $dir . $name )){ // move_uploaded_file irá realizar o envio do arquivo.
							// ################################ Copia p/ Imagem em tamanho medio
							/*if(!is_dir($dir ."small/"))
								mkdir($dir ."small/");
							if (!copy($dir . $name, $dir ."small/". $name )){
								$c_erros = $c_erros . ",ERRO ao copiar imagem Média";
							}*/
						}else
							$c_erros = $c_erros . ",ERRO no Envio da Imagem";
					}else
						$c_erros = $c_erros . ",Imagem já existe";

					$txt_path = $dir . $name;
					if ($txt_path != ""){
						if ($PIM_IMAGE_path != "")
							$PIM_IMAGE_path = $PIM_IMAGE_path .",". $txt_path;
						else
							$PIM_IMAGE_path = $txt_path;
					}
					echo "ENTROU PIM_IMAGE_path $PIM_IMAGE_path";
				}
			}else{
				// ################################ IMAGEM Principal
				$txt_path = $_POST['PIM_IMAGE_path'.$i];
				if ($txt_path != ""){
					if ($PIM_IMAGE_path != "")
						$PIM_IMAGE_path = $PIM_IMAGE_path .",". $txt_path;
					else
						$PIM_IMAGE_path = $txt_path;
				}
				echo "..... PIM_IMAGE_path $PIM_IMAGE_path";
			}
		}
	}
	if ($qtd_img <= 0)
		$c_erros = $c_erros . ",Insira ao menos uma Imagem.";

	/* ############################### Envia IMAGENS ############################### */
	
	
	/* ##################### INSERCAO DADOS ##################### */
	if ($c_erros != ""){
		echo msgErro($c_erros);
	}else{
		$PST_DATE = date("Y-m-d");
		$PST_HORA = date("H:i");

		$sql_busca = "SELECT * FROM mp_posts WHERE PST_COD = $PST_COD ";
		$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		$fet_busca = mysql_fetch_assoc($exe_busca);
		$num_busca = mysql_num_rows($exe_busca);
		if ($num_busca == 0){
			$sql_busca = "INSERT INTO mp_posts (PST_COD,PST_LINK,PST_CATNEWS,PST_TITULO,PST_DATE,PST_HORA,PST_AUTOR,PST_POSTRES,PST_POST)
						  VALUES ($PST_COD,'$PST_LINK','$PST_CATNEWS','$PST_TITULO','$PST_DATE','$PST_HORA','$PST_AUTOR','$PST_POSTRES','$PST_POST')";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());

			$PST_COD		= 0;
			$PST_LINK       = "";
			$PST_CATNEWS    = "";
			$PST_TITULO     = "";
			$PST_DATE       = "";
			$PST_HORA       = "";
			$PST_AUTOR      = "";
			$PST_POSTRES    = "";
			$PST_POST       = "";
		}else{
			$sql_busca = "
			UPDATE mp_posts SET
			PST_LINK  	= '$PST_LINK',
 			PST_CATNEWS = '$PST_CATNEWS',
			PST_TITULO	= '$PST_TITULO',
 			PST_DATE  	= '$PST_DATE',
			PST_HORA  	= '$PST_HORA',
			PST_AUTOR  	= '$PST_AUTOR',
			PST_POSTRES = '$PST_POSTRES',
			PST_POST  	= '$PST_POST'
			WHERE PST_COD = $PST_COD ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
		}

		/* ####### IMAGEM POST ####### */
		for ($i=0; $i<$qtd_img; $i++){
			//echo "field_file: ".$field_file[$i]."<br />";
			
			// VALOR CAMPO PAI -- NOME CAMPO PAI -- NOME CAMPO da TABELA -- NOME TABELA
			$cod_son = proxCod1($PST_COD, "PIM_PST_COD", "PIM_COD", "mp_post_img");
			
			$sql_busca = "
			SELECT * FROM mp_post_img 
			WHERE PIM_PST_COD = $PST_COD 
			  AND PIM_COD = $cod_son ";
			$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			$fet_busca = mysql_fetch_assoc($exe_busca);
			$num_busca = mysql_num_rows($exe_busca);
			if ($num_busca == 0){
				$sql_busca = "INSERT INTO mp_post_img (PIM_PST_COD,PIM_COD,PIM_IMAGE)
							  VALUES ($PST_COD, $cod_son, '". $field_file[$i] ."')";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());

				$PIM_IMAGE_path = "";
			}else{
				$sql_busca = "
				UPDATE mp_post_img SET
				PIM_IMAGE = '". $field_file[$i] ."'
				WHERE PIM_PST_COD = $PST_COD 
				  AND PIM_COD     = $cod_son ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
			}
		}		
	}
	/* ##################### INSERCAO ##################### */
}

/* ##################### CONSULTA ##################### */
if (($PST_COD != "" || $SelEdtNews != "") && ($c_erros == "")){
	
	if ($PST_COD == "" && $SelEdtNews != "")
		$PST_COD = $SelEdtNews;
	
	$sql_busca = "SELECT * FROM mp_posts WHERE PST_COD = $PST_COD ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0){
		$PST_COD		= $fet_busca['PST_COD'];
		$PST_LINK       = $fet_busca['PST_LINK'];
		$PST_CATNEWS    = $fet_busca['PST_CATNEWS'];
		$PST_TITULO     = $fet_busca['PST_TITULO'];
		$PST_DATE       = $fet_busca['PST_DATE'];
		$PST_HORA       = $fet_busca['PST_HORA'];
		$PST_AUTOR      = $fet_busca['PST_AUTOR'];
		$PST_POSTRES	= $fet_busca['PST_POSTRES'];
		$PST_POST       = $fet_busca['PST_POST'];
	}	
}else{
	zeraCampos();
}

/* ##################### DELETA TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelNews != ""){
	$qr = "DELETE FROM mp_post_img WHERE PIM_PST_COD = '$SelDelNews' ";
	mysql_query($qr);	

	$qr = "DELETE FROM mp_posts WHERE PST_COD = '$SelDelNews' ";
	mysql_query($qr);

	zeraCampos();
}

/* ##################### DELETA TODAS IMAGENS BANCO DADOS e ARQUIVOS ##################### */
if ($SelDelNewsImgFil != "" || $SelDelNewsImgPai != ""){

	if ($SelDelNewsImgFil != ""){
		$qr = "DELETE FROM mp_post_img WHERE PIM_PST_COD = '$SelDelNewsImgFil' AND PIM_PST_COD = $PST_COD ";
		$qr = "DELETE FROM mp_post_img WHERE PIM_PST_COD = '$SelDelNewsImgPai' ";
		if( is_dir("../imgMotoPod/News/". $PST_CATNEWS ."/") )
			rmdir_recurse("../imgMotoPod/News/". $PST_CATNEWS ."/");
	}else{
		$qr = "DELETE FROM mp_post_img WHERE PIM_PST_COD = '$SelDelNewsImgPai' ";
		if( is_dir("../imgMotoPod/News/". $PST_CATNEWS ."/") )
			rmdir_recurse("../imgMotoPod/News/". $PST_CATNEWS ."/");
	}
	
	mysql_query($qr);

	$btIncluir = "Alterar Notícia";
}

/* ########################################## FUNCOES ########################################## */
function rmdir_recurse($path){
    $path = rtrim($path, '/').'/';
    $handle = opendir($path);
    while(false !== ($file = readdir($handle))) {
        if($file != '.' and $file != '..' ) {
            $fullpath = $path.$file;
            if(is_dir($fullpath)) rmdir_recurse($fullpath); else unlink($fullpath);
        }
    }
    closedir($handle);
    rmdir($path);
}

function zeraCampos(){	
	$PST_COD		= "";
	$PST_LINK       = "";
	$PST_CATNEWS    = "";
	$PST_TITULO     = "";
	$PST_DATE       = "";
	$PST_HORA       = "";
	$PST_AUTOR      = "";
	$PST_POSTRES	= "";
	$PST_POST       = "";
}

/* ########################################## FUNCOES ########################################## */

if ($SelDelNews != "" && $c_erros == ""){
	echo msgAviso("Notícia $PST_COD Eliminada com Sucesso!","cadnews");
}

?>

<!-- <div id="titulo">Notícias</div> -->

<form id="formCadNews" name="formCadNews" action="cadnews" method="post" accept-charset="utf-8">

	<input type="hidden" name="PST_COD" value="<?php echo $PST_COD; ?>">

	<div class="demo">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Notícia</a></li>
				<li><a href="#tabs-2">Imagens</a></li>
			</ul>
			<div id="tabs-1">
				<table border="0" cellspacing="4" cellpadding="0" width="710px" align="center">
					<tr>
						<!-- ########################### COLUNA 01 ########################### -->
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr align="left" height="35px">
									<td colspan="2" width="170px">
										<font size="22px"><b><?php echo $PST_COD; ?></b></font>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Link</label></b></div></td>
									<td align="left" colspan="2"><div ><input type="text" class="<?php if($erro_link != "")echo "field_error"; else echo "input"; ?>" size="45" maxlength="45" name="PST_LINK" value="<?php if($PST_LINK != ""){ echo $PST_LINK; } ?>"></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Título</label></b></div></td>
									<td align="left" colspan="2"><div ><input type="text" class="<?php if($erro_titulo != "")echo "field_error"; else echo "input"; ?>" size="75" maxlength="150" name="PST_TITULO" value="<?php if($PST_TITULO != ""){ echo $PST_TITULO; } ?>"></div></td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><b><label style="margin-right:5px;">Categoria</label></b></div></td>
									<td align="left">
										<select name="PST_CATNEWS" class="<?php if($erro_catnews != ""){echo "field_error";}else{echo "input_select";} ?>">
											<option value=""  <?php if ($PST_CATNEWS == "") echo "selected"; else echo ""; ?>>Selecione</option>
											<option value="1" <?php if ($PST_CATNEWS == "1") echo "selected"; else echo ""; ?>>Moto</option>
											<option value="2" <?php if ($PST_CATNEWS == "2") echo "selected"; else echo ""; ?>>MotoGP</option>
											<option value="3" <?php if ($PST_CATNEWS == "3") echo "selected"; else echo ""; ?>>F-1</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Autor</label></b></div></td>
									<td align="left">
										<select name="PST_AUTOR" class="<?php if($erro_autor != ""){echo "field_error";}else{echo "input_select";} ?>">
											<option value=""  <?php if ($PST_AUTOR == "") echo "selected"; else echo ""; ?>>Selecione</option>
											<option value="1" <?php if ($PST_AUTOR == "1") echo "selected"; else echo ""; ?>>H.F.S</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Resumo</label></b></div></td>
									<td height="40px" colspan="3">
										<table border="0 " cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td><div><textarea name="PST_POSTRES" rows="2" cols="75"><?php if($PST_POSTRES != ""){ echo $PST_POSTRES; } ?></textarea></div></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="td_cad" align="right"><div align="right"><font color="red">* </font><b><label style="margin-right:5px;">Notícia</label></b></div></td>
									<td height="40px" colspan="3">
										<table border="0 " cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td><div><textarea name="PST_POST" rows="5" cols="75"><?php if($PST_POST != ""){ echo $PST_POST; } ?></textarea></div></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div id="tabs-2">
				<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
					<tr><td align='left' width="10px"><font size="22px"><b><?php echo $PST_COD; ?></b></font></td></tr>
				</table>
				<table id="dataTable" border="0" cellspacing="0" cellpadding="0" align="center">
				<?php
				/* Busca IMAGENS */
				$sql_busca = "SELECT * FROM mp_post_img WHERE PIM_PST_COD = $PST_COD ";
				$exe_busca = mysql_query($sql_busca) or die (mysql_error());
				$fet_busca = mysql_fetch_assoc($exe_busca);
				$num_busca = mysql_num_rows($exe_busca);
				for($i = 0; $i < $num_busca; $i++){
					$path_img = $fet_busca['PIM_IMAGE'];
				?>
					<tr>
						<td>
							<input type="file" name="PIM_IMAGE<?php echo $i; ?>" accept="images/*"></br>
							<input type="text" size="42" name="PIM_IMAGE_path<?php echo $i; ?>" value="<?php echo $path_img; ?>" readonly>
						</td>
						<td align="left">
							<img src='<?php echo "../imgMotoPod/". $path_img ?>' width='80px' height='50px'>
						</td>
						<td align="right">
							<a href='javascript:void(0);' onClick="delImages('<?php echo $fet_busca['PIM_PST_COD']; ?>')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a>
						</td>
					</tr>
					<tr><td height="30px" colspan="3"><hr color="red"></hr></td></tr>
				<?php
				}
				?>
					<tr>
						<td>
							<div class="imagens"> 
								<p class="campoImagens">
									<input type="file" name="field_file[]"/>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="javascript:void(0);" class="removerCampo" style="color:#2185c5;"><u>Remover Campo</u></a>
								</p>
							</div>
						</td>
					</tr>
					<tr height="40px">
						<td align="center">
							<a href="javascript:void(0);" class="adicionarCampo" style="color:#2185c5;"><u>Adicionar Campo</u></a>
						</td>
					</tr>
				</table>
				
				<?php
				if ($num_busca != 0){
				?>
				</br>
				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td align='center' width="30px"><a href='javascript:void(0);' onClick="delImages('<?php echo $PST_COD; ?>','')"><img src='images/icons/delete.png' alt='Deleta Imagens' title='Deleta' border='0' width='19px' height='19px'></a></td>
						<td align='center' valign="middle"><a href='javascript:void(0);' onClick="delImages('<?php echo $PST_COD; ?>','')">Deletar Todas Imagens</a></td>
					</tr>
				</table>
				</br>
				<?php
				}	
				?>
			</div>
		</div>
	</div>
	
	<center><input type="submit" class="btsubmit" name="btIncluir" value="<?php if($SelEdtNews != "" || $btIncluir == "Alterar Notícia"){echo "Alterar Notícia";}else{echo "Incluir Notícia";} ?>"></center>
	</br>
	
	<?php
	// altura dinamica de acordo com o numero de registros
	$sql_busca = "SELECT MAX(PST_COD) AS TOTAL FROM mp_posts";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);

	$alt_grid = 0;
	$alt_grid = $fet_busca['TOTAL'] * 25;
	$alt_grid += 40;
	?>
	<!-- ######################################## GRID ######################################## -->
	<div ><!-- style="border-bottom:1px solid #cccccc" -->
	<iframe src="mod/gridNews.php" frameborder="0" scrolling="yes" align="left" width="788px" height="<?php echo $alt_grid; ?>">
		<p>Your browser does not support iframes.</p>
	</iframe>
	</div>
	
	<div style="margin-bottom:30px">&nbsp;</div>

	<input type="hidden" name="SelEdtNews" 	 	 value="">
	<input type="hidden" name="SelDelNews" 	 	 value="">
	<input type="hidden" name="SelDelNewsImgFil" value="">
	<input type="hidden" name="SelDelNewsImgPai" value="">

</form>
</html>