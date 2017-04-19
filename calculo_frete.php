<?php
/*
function calcula_frete($servico,$CEPorigem,$CEPdestino,$peso,$altura='4',$largura='12',$comprimento='16',$valor='1.00'){
    ////////////////////////////////////////////////
    // Código dos Serviços dos Correios
    // 41106 PAC
    // 40010 SEDEX
    // 40045 SEDEX a Cobrar
    // 40215 SEDEX 10
    ////////////////////////////////////////////////
	// URL do WebService
    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$CEPorigem."&sCepDestino=".$CEPdestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor."&sCdAvisoRecebimento=n&nCdServico=".$servico."&nVlDiametro=0&StrRetorno=xml";
	// Carrega o XML de Retorno
    $xml = simplexml_load_file($correios);
	// Verifica se não há erros
    if($xml->cServico->Erro == '0'){
        return $xml->cServico->Valor;
	}else{
        return false;
	}
}

echo calcula_frete('40010','93800000','90200210 ','0.5');
*/

$data['nCdEmpresa'] 	    	= '';			// "String" Seu código administrativo junto à ECT. O código está disponível no corpo do contrato firmado com os Correios. 
$data['sDsSenha'] 		    	= '';			// "String" Senha para acesso ao serviço, associada ao seu código administrativo. A senha inicial corresponde aos 8 primeiros dígitos do CNPJ informado no contrato. A qualquer momento, é possível alterar a senha no endereço http://www.corporativo.correios.com
$data['sCepOrigem'] 	    	= '89210320';
$data['sCepDestino'] 	    	= '85807860';
$data['nVlPeso'] 		    	= '2.5';		// "String"  Peso da encomenda, incluindo sua embalagem. O peso deve ser informado em quilogramas. Se o formato for Envelope, o valor máximo permitido será 1Kg
$data['nCdFormato'] 	    	= '1';			// "Int" 	 Formato da encomenda (incluindo embalagem). Valores possíveis: 1, 2 ou 3 | 1 – Formato caixa/pacote | 2 – Formato rolo/prisma | 3 - Envelope 
$data['nVlComprimento']     	= '30';			// "Decimal" Comprimento da encomenda (incluindo embalagem), em centímetros.
$data['nVlAltura'] 		    	= '20';			// "Decimal" Altura da encomenda (incluindo embalagem), em centímetros. Se o formato for envelope, informar zero (0).
$data['nVlLargura'] 	    	= '35';			// "Decimal" Largura da encomenda (incluindo embalagem), em centímetros. 
$data['nVlDiametro'] 			= '0';			// "Decimal" Diâmetro da encomenda (incluindo embalagem), em centímetros. 
$data['sCdMaoPropria'] 			= 'N';			// "String"  Indica se a encomenda será entregue com o serviço adicional mão própria. Valores possíveis: S ou N (S – Sim, N – Não)
$data['nVlValorDeclarado'] 		= '100';		// "Decimal" Indica se a encomenda será entregue com o serviço adicional valor declarado. Neste campo deve ser apresentado o valor declarado desejado, em Reais. "Se não optar pelo serviço informar zero."
$data['sCdAvisoRecebimento'] 	= 'n';			
$data['StrRetorno'] 			= 'xml';
$data['nCdServico'] 			= '41106,40010,40045';
/*
41106 PAC Varejo 			<br>
40010 SEDEX Varejo 			<br>
40045 SEDEX a Cobrar Varejo <br>
40215 SEDEX 10 Varejo 		<br>
40290 SEDEX Hoje Varejo
*/
$data = http_build_query($data);

$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

$curl = curl_init($url . '?' . $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
$result = simplexml_load_string($result);

foreach($result -> cServico as $row){
	//Os dados de cada serviço estará aqui
	if($row -> Erro == 0){
		echo "Codigo 				". $row -> Codigo . '<br>';
		echo "Valor  			 R$ ". $row -> Valor . '<br>';
		echo "PrazoEntrega 			". $row -> PrazoEntrega . '<br>';
		echo "ValorMaoPropria 		". $row -> ValorMaoPropria . '<br>';
		echo "ValorAvisoRecebimento ". $row -> ValorAvisoRecebimento . '<br>';
		echo "ValorValorDeclarado 	". $row -> ValorValorDeclarado . '<br>';
		echo "EntregaDomiciliar 	". $row -> EntregaDomiciliar . '<br>';
		echo "EntregaSabado 		". $row -> EntregaSabado;
	}else{
		echo $row -> MsgErro;
	}
		echo '<hr>';
}

?>