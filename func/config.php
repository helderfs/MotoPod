<?php
// #### NET ###
//$host 		= "localhost"; 		//Servidor do mysql
//$db 			= "motopod"; 		//banco de dados
//$user 		= "root"; 			//Usuario do banco de dados
//$senha 		= ""; 				//senha do banco de dados

// #### LOCAL ###
$host 	= "localhost";
$db 	= "quali197_motopod";
$user 	= "quali197_testusr";
$senha 	= "rosarumorosa2014";

$nome_site 	= "MotoPod"; 					//Nome do site
$email 		= "contato@motopod.com.br"; 	//E-mail do administrador
$site 		= "http://www.motopod.com.br"; 	//Seu site n se esuqece de bota o http://

mysql_connect($host, $user, $senha) or die (mysql_error());
mysql_select_db($db) or die (mysql_error());
mysql_set_charset('utf8'); // para a conexão com o MySQL
?>