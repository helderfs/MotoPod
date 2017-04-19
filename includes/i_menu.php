<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./css/style.css"/>		
	</head>
<?php
include_once("../_func/func_db.php");
include_once("../_func/func_library.php");
include_once("../_func/phpmailer/class.phpmailer.php");

$cnpjcpf = "";
$categ   = "";
$gerente = "";

if ($cpf_cnpj != $_SESSION['ses_cpfcnpj']) 	$cpf_cnpj = soNumero($_SESSION['ses_cpfcnpj']);
if ($categ 	  != $_SESSION['ses_categ'])	$categ 	  = $_SESSION['ses_categ'];
if ($gerente  != $_SESSION['ses_gerente'])	$gerente  = $_SESSION['ses_gerente'];

if (SoNumero($cnpjcpf) == "") $cnpjcpf = "000.000.000-00";

// consulta das tabelas "menu" "menus_grp" e "user"
$qr = consMenus($cpf_cnpj, $categ, $gerente);
$sql = mysql_query($qr);
$total = mysql_num_rows($sql);

/* Se Grupo Usuario nao estiver cadastrado, cadastra e mostra menus de CLIENTES */
if ($total == 0){
	$cpf_cnpj = iniMenu($cpf_cnpj);

	// consulta das tabelas "menu" "menus_grp" e "user"
	$qr = consMenus($cpf_cnpj, $categ, $gerente);	
	$sql = mysql_query($qr);
	$total = mysql_num_rows($sql);
}

echo '<ul id="menu_left">';
$indice = 1;
while($reg = mysql_fetch_array($sql)){
	echo '<li><a><strong>' . $reg['MEN_NOME'] . '</strong></a>'.
		 '	<ul> ';
	$qr2 = "
	SELECT menus.*, user.*, menus_grp.*
	  FROM user
	 INNER JOIN menus_grp AS menus_grp ON menus_grp.MGR_GRU_CODIGO = user.USR_GRU_CODIGO
	 INNER JOIN menus 	  AS menus	   ON menus.MEN_CODIGO 		   = menus_grp.MGR_MEN_CODIGO
	 WHERE user.USR_PES_CPFCNPJ = '$cpf_cnpj'
	   AND menus.MEN_CATEG = '$categ'
	   AND menus.MEN_NIVEL = '". $reg['MEN_PRIORID'] ."' ";
	if($gerente != "S"){ $qr2 = $qr2 . " AND menus_grp.MGR_SHOW = 'S' "; }
	$qr2 = $qr2 . "ORDER BY menus.MEN_PRIORID ";

	$sql2 = mysql_query($qr2);
	$total2 = mysql_num_rows($sql2);

	while($reg2 = mysql_fetch_array($sql2)){
		echo '<li><a href="'. $reg2['MEN_CODIGO'] .'" target="_parent">'. $reg2['MEN_NOME'] .'</a></li>';
	}
	echo '	</ul>
		</li>';
	$indice = $indice + 1;
}
echo '	</ul>';

?>
</html>