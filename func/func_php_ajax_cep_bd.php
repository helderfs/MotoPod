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

include_once("config_cep.php");

function BuscaCEPBD($cep){
	$sql_busca = "
	SELECT logra.cep, logra.log_nome, logra.ufe_sg, bairro.bai_no, cidade.loc_nosub
	  FROM log_logradouro AS logra
	 INNER JOIN log_localidade AS cidade ON cidade.loc_nu_sequencial = logra.loc_nu_sequencial
	 INNER JOIN log_bairro 	   AS bairro ON bairro.bai_nu_sequencial = logra.bai_nu_sequencial_ini
	 WHERE logra.cep = '$cep' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$objResponse = new xajaxResponse();
	$objResponse->addScript("$('END_NOME').value = \"". $fet_busca['log_nome'] ."\";");
	$objResponse->addScript("$('END_CIDADE').value = \"". $fet_busca['loc_nosub'] ."\";");
	$objResponse->addScript("$('END_BAIRRO').value = \"". $fet_busca['bai_no'] ."\";");
	$objResponse->addScript("$('END_ESTADO').value = \"". $fet_busca['ufe_sg'] ."\";");
	
	//$('option[value=valueToSelect]', newOption).attr('selected', 'selected');
	
	//$objResponse->addAssign("resposta","innerHTML",utf8_encode($msg));
	//$objResponse->addScript("$('enviando').className = \"desaparece\";");
	//$objResponse->addScript("$('carregando').className = \"desaparece\";");	
	//$objResponse->addAssign("conteudo_ajax","innerHTML",$s->toString());
	return $objResponse;
}

function BuscaCEPBDFast($cep){
	$sql_busca = "
	SELECT logra.cep, logra.log_nome, logra.ufe_sg, bairro.bai_no, cidade.loc_nosub
	  FROM log_logradouro AS logra
	 INNER JOIN log_localidade AS cidade ON cidade.loc_nu_sequencial = logra.loc_nu_sequencial
	 INNER JOIN log_bairro 	   AS bairro ON bairro.bai_nu_sequencial = logra.bai_nu_sequencial_ini
	 WHERE logra.cep = '$cep' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$objResponse = new xajaxResponse();
	$objResponse->addScript("$('END_NOME').value = \"". $fet_busca['log_nome'] ."\";");
	$objResponse->addScript("$('END_CIDADE').value = \"". $fet_busca['loc_nosub'] ."\";");
	$objResponse->addScript("$('END_BAIRRO').value = \"". $fet_busca['bai_no'] ."\";");
	$objResponse->addScript("$('END_ESTADO').value = \"". $fet_busca['ufe_sg'] ."\";");
	
	//$('option[value=valueToSelect]', newOption).attr('selected', 'selected');
	
	//$objResponse->addAssign("resposta","innerHTML",utf8_encode($msg));
	//$objResponse->addScript("$('enviando').className = \"desaparece\";");
	//$objResponse->addScript("$('carregando').className = \"desaparece\";");	
	//$objResponse->addAssign("conteudo_ajax","innerHTML",$s->toString());
	return $objResponse;	
}

function BuscaCEPBDPed($cep){
/*
	$sql_busca = "
	SELECT logra.cep, logra.log_nome, logra.ufe_sg, bairro.bai_no, cidade.loc_nosub
	  FROM log_logradouro AS logra
	 INNER JOIN log_localidade AS cidade ON cidade.loc_nu_sequencial = logra.loc_nu_sequencial
	 INNER JOIN log_bairro 	   AS bairro ON bairro.bai_nu_sequencial = logra.bai_nu_sequencial_ini
	 WHERE logra.cep = '$cep' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);
*/
	$vlrFrete = 85.42;
	
	$objResponse = new xajaxResponse();
	$objResponse->addScript("$('hdVlrFrete').value = \"". $vlrFrete ."\";");
	return $objResponse;	
}

function ExibeConteudoInserir($cep){

	$sql_busca = "
	SELECT logra.cep, logra.log_nome, logra.ufe_sg, bairro.bai_no, cidade.loc_nosub
	  FROM log_logradouro AS logra
	 INNER JOIN log_localidade AS cidade ON cidade.loc_nu_sequencial = logra.loc_nu_sequencial
	 INNER JOIN log_bairro 	   AS bairro ON bairro.bai_nu_sequencial = logra.bai_nu_sequencial_ini
	 WHERE logra.cep = '89210320' ";
	$exe_busca = mysql_query($sql_busca) or die (mysql_error());
	$fet_busca = mysql_fetch_assoc($exe_busca);
	$num_busca = mysql_num_rows($exe_busca);

	$objResponse = new xajaxResponse();	
	$objResponse->addScript("$('estado').value = \"". $fet_busca['ufe_sg'] ."\";");
	$objResponse->addScript("$('cidade').value = \"". $fet_busca['loc_nosub'] ."\";");
	$objResponse->addScript("$('bairro').value = \"". $cep ."\";");
	//$objResponse->addScript("$('bairro').value = \"". $fet_busca['bai_no'] ."\";");
	
	//$objResponse->addAssign("resposta","innerHTML",utf8_encode($msg));
	//$objResponse->addScript("$('enviando').className = \"desaparece\";");
	//$objResponse->addScript("$('carregando').className = \"desaparece\";");	
	//$objResponse->addAssign("conteudo_ajax","innerHTML",$s->toString());
	
	return $objResponse;
		
	/*
	$sql_busca = "SELECT * FROM log_faixa_uf ORDER BY ufe_no";
	$busca_uf  = mysql_query($sql_busca);
	while ( $Est = mysql_fetch_array($busca_uf) ):
		$s->append("<option value=\"".$Est['ufe_sg']."\">".$Est['ufe_no']."</option>");
	endwhile;

	$s->append("</select><br />");
	$s->append("Cidade: <input type=\"text\" name=\"cidade\" id=\"cidade\" maxlength=\"100\" size=\"20\" value\"sssss\"/><br />");
	$s->append("Descri&ccedil;&atilde;o: <input type=\"text\" name=\"descricao\" id=\"descricao\" maxlength=\"250\" size=\"20\" /><br />");
	$s->append("<input type=\"button\" name=\"enviar\" id=\"enviar\" value=\"Enviar\" onclick=\"javascrip:GravaDados();\" />");
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("conteudo_ajax","innerHTML","");
	$objResponse->addScript("$('carregando').className = \"desaparece\";");
	$objResponse->addAssign("conteudo_ajax","innerHTML",$s->toString());
	return $objResponse;
	*/
	
/*
	$s = new String();
	$s->append("Estado:");
	$s->append("<select name=\"estado\" id=\"estado\">");
	$s->append("<option value=\"\">Selecione o Estado</option>");

	$sql = "SELECT * FROM japs_estado_dados";
	$rsEst = mysql_query($sql,$GLOBALS['conexao']);
	while ( $Est = mysql_fetch_array($rsEst) ):
		$s->append("<option value=\"".$Est['estado_pk']."\">".$Est['estado']."</option>");
	endwhile;
		
	$s->append("</select><br />");
	$s->append("Cidade: <input type=\"text\" name=\"cidade\" id=\"cidade\" maxlength=\"100\" size=\"20\" /><br />");
	$s->append("Descri&ccedil;&atilde;o: <input type=\"text\" name=\"descricao\" id=\"descricao\" maxlength=\"250\" size=\"20\" /><br />");
	$s->append("<input type=\"button\" name=\"enviar\" id=\"enviar\" value=\"Enviar\" onclick=\"javascrip:GravaDados();\" />");
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("conteudo_ajax","innerHTML","");
	$objResponse->addScript("$('carregando').className = \"desaparece\";");
	$objResponse->addAssign("conteudo_ajax","innerHTML",$s->toString());
	return $objResponse;
	*/
}