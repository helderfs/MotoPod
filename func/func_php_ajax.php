<?php
class String {
	var $texto;
	
	function String() {
		$this->texto = "";
	}
	
	function append($s) {
		$this->texto .= (string) $s;
	}
	
	function toString() {
		return utf8_encode($this->texto);
	}
}

// ################## DATABASE CEP ##################

include_once("config.php");

function BuscaModeloBD($marca){

	$mod_cod = "";
	
	$sql = "
	SELECT MMO_COD, MMO_MODELO
	  FROM mp_marca_mod
	 WHERE MMO_MAR_COD = '$marca' ";
	$qr = mysql_query($sql);
	$total = mysql_num_rows($qr);

	$objResponse = new xajaxResponse();

	// Limpa COMBO BOX para receber novos modelos de acordo com a MARCA selecionada
	$objResponse->addScript(" document.formCadMotoAjax.cdmt_mod.options.length = 0; ");
	
	$objResponse->addScript(" document.formCadMotoAjax.cdmt_mod.options.add( new Option('...Escolha o Modelo','0') ); ");

	while($r = mysql_fetch_array($qr)){
		$modelo = $r['MMO_MODELO'];

		//$mod_cod = retSEspOut( $modelo );
		
		$mod_cod = $r['MMO_COD'];
		$objResponse->addScript(" document.formCadMotoAjax.cdmt_mod.options.add( new Option('$modelo','$mod_cod') ); ");
	}

/*
	$teste = "$marca";

	$objResponse = new xajaxResponse();	
	// exemplo
	//document.combobox_validation.city.options.add( new Option('chennai','chennai') );
	
	$objResponse->addScript(" document.formCadMotoAjax.cdmt_mod.options.add( new Option('$marca','$marca') ); ");	
	$objResponse->addScript(" document.formCadMotoAjax.cdmt_mod.options.add( new Option('lalau','lalau') ); ");
	
	$objResponse->addScript("$('cdmt_mod').value = \"". $teste ."\";");
*/
	return $objResponse;
}

function bscMarModBD($marca,$modelo){

	$MMO_COD = "";
	$sql_busca = "
	SELECT MMO_COD
	  FROM mp_marca_mod
	 WHERE MMO_COD = '". $marca . $modelo ."' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0)
		$MMO_COD = $fet_busca['MMO_COD'];

	$objResponse = new xajaxResponse();
	$objResponse->addScript("$('hdMMO_COD').value 	 = \"". $modelo ."\";");
	$objResponse->addScript("$('hdMMO_MARCA').value  = \"". $marca  ."\";");
	$objResponse->addScript("$('hdMMO_MODELO').value = \"". $modelo ."\";");
	return $objResponse;
}


/* Busca  MARCA  --  MODELO  -- ANO*/
function SrcModBD($marca){

	$mod_cod = "";
	
	$sql = "
	SELECT MMO_COD, MMO_MODELO
	  FROM mp_marca_mod
	 WHERE MMO_MAR_COD = '$marca' ";
	$qr = mysql_query($sql);
	$total = mysql_num_rows($qr);

	$objResponse = new xajaxResponse();

	// Limpa COMBO BOX para receber novos modelos de acordo com a MARCA selecionada
	$objResponse->addScript(" document.frmViewMtAjax.cdmt_mod.options.length = 0; ");
	
	$objResponse->addScript(" document.frmViewMtAjax.cdmt_mod.options.add( new Option('...Escolha o Modelo','0') ); ");
	
	while($r = mysql_fetch_array($qr)){
		$modelo = $r['MMO_MODELO'];

		//$mod_cod = retSEspOut( $modelo );
		
		$mod_cod = $r['MMO_COD'];
		$objResponse->addScript(" document.frmViewMtAjax.cdmt_mod.options.add( new Option('$modelo','$mod_cod') ); ");
	}
	
	return $objResponse;
}

function SrcMarModBD($marca,$modelo){
	// #############################
	// MODELO - Busca Todos os MODELOS da MARCA
	// #############################
	$MMO_COD = "";
	$sql_busca = "
	SELECT MMO_COD
	  FROM mp_marca_mod
	 WHERE MMO_COD = '". $modelo ."' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
	if ($num_busca <> 0)
		$MMO_COD = $fet_busca['MMO_COD'];

	$objResponse = new xajaxResponse();
	$objResponse->addScript("$('hdMMO_COD').value 	 = \"". $modelo ."\";");
	$objResponse->addScript("$('hdMMO_MARCA').value  = \"". $marca  ."\";");
	$objResponse->addScript("$('hdMMO_MODELO').value = \"". $modelo ."\";");

	return $objResponse;
}

function SrcAnosModBD($modelo){
	// #############################
	// ANO - Busca Todos os ANOS do MODELO
	// #############################
	$sql = "
	SELECT MOT_ANOFAB
	  FROM mp_motos
	 WHERE MOT_MMO_COD = '". $modelo ."' ";
	$qr = mysql_query($sql);
	$total = mysql_num_rows($qr);

	$objResponse = new xajaxResponse();

	// Limpa COMBO BOX para receber novos modelos de acordo com a MARCA selecionada
	$objResponse->addScript(" document.frmViewMtAjax.ano_mod.options.length = 0; ");
	
	$objResponse->addScript(" document.frmViewMtAjax.ano_mod.options.add( new Option('...Escolha o Ano','0') ); ");

	while($r = mysql_fetch_array($qr)){
		$ano_mod = $r['MOT_ANOFAB'];

		$objResponse->addScript(" document.frmViewMtAjax.ano_mod.options.add( new Option('$ano_mod','$ano_mod') ); ");
	}

	return $objResponse;
}
