<?php
// #### NET ###
/*
$host 		= "localhost"; 				//Servidor do mysql
$db 		= "zoomoutd_cep"; 			//banco de dados
$user 		= "zoomoutd_santos"; 		//Usuario do banco de dados
$senha 		= "fuckner22"; 				//senha do banco de dados
*/
// #### LOCAL ###

$host 		= "localhost"; 				//Servidor do mysql
$db 		= "quali197_cep"; 			//banco de dados
$user 		= "quali197_testusr"; 		//Usuario do banco de dados
$senha 		= "rosarumorosa2014";		//senha do banco de dados


mysql_connect($host, $user, $senha) or die (mysql_error());
mysql_select_db($db) or die (mysql_error()); 

mysql_set_charset('utf8'); // para a conexão com o MySQL
?>