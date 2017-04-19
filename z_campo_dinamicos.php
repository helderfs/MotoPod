<?php
/*
$vlr = "199,99";

echo str_replace(",",".",str_replace(".","",$vlr));

echo "<br><br><br><br><br><br>";

echo str_replace(".", ",", "68.78");

*/
/*
	mkdir ("img_prod/F", 0755);
*/

/*
include("func/config.php");

$string = 'mariaengomada@gmail.com';
$codificada = base64_encode($string);

echo "Resultado da codificação usando base64:>>>>" . $codificada ."<<<<";
echo "<br /><br/>";

$original = base64_decode($codificada);
	
echo "<br>Resultado da decodificação usando base64: " . $original;
echo "<br /><br/>";
*/

/*
	$sql_busca = 
	"SELECT PESSOA.*, USER.*" .
	"  FROM PESSOA, USER" .
	" WHERE PESSOA.PES_CPFCNPJ = USER.USR_PES_CPFCNPJ" .
	"   AND USER.USR_EMAIL = '$loginemailtop' " . 
	"   AND USER.USR_ATIVO = 'S'" .
	"   AND USER.USR_SENHA = '$login_senha'";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	if ($num_busca == 0){		
		echo "nenhum registro";
	}else{
		echo "achou registro";
	}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	
	<title>Exemplo</title> 
	
	<script type="text/javascript" src="script/jquery-1.6.js"></script>
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
<body> 
	<div style="border:1px solid #CCC; background-color:#EFEFEF; padding:0 20px;"> 
		<h1>Campos Dinâmicos</h1> <p>
	</div> 

	<div style="width:500px; margin:auto;">
		<form action="" method="post">
			<div class="imagens"> <p class="campoImagens">
				<input type="file" name="campo[]"/><a href="javascript:void(0);" class="removerCampo">Remover Campo</a></p>
			</div>
			<p>
				<a href="javascript:void(0);" class="adicionarCampo">Adicionar campo</a>
			</p>
			<p>
			<input type="submit" name="btIncluir" value="Enviar">
		</form>
	</div>
	
	<?php
		$campo = [];
		$quantidade = 0;
		
		if (isset($_POST['campo']))
			$campo = $_POST['campo'];
			
		$quantidade = count($campo); 
		for ($i=0; $i<$quantidade; $i++){
			echo "campo: ".$campo[$i]."<br />";
		}
	?>
</html>