function StringBuffer() {
	this.length = 0;
	
	this._cache = null;
	this._data = [];
	this._joiner = (arguments.length == 1) ? arguments[0] : "";
	
	if (arguments.length > 0) {
		for (var i = 0; i < arguments.length; i++) {
			this.append(arguments[i]);
		}
	}
}
var _p = StringBuffer.prototype;
_p.append = function (s) {
	this.length += String(s).length;
	this._data[this._data.length] = String(s);
}
_p.clear = function () {
	this._cache = null;
	for (var i = 0; i < this._data.length; i++) {
		this._data[i] = null;
	}	
	this._data = [];
}
_p.toString = function () {
	if (this._cache != null) {
		return this._cache;
	}	
	return (this._cache = this._data.join(this._joiner));
}
function $(s) {
	return document.getElementById(s);
}

function LimpaResposta() {
	$('resposta').innerHTML = "";
}

function BuscaCEPBD(){
	//LimpaResposta();
	//$('carregando').className = "aparece";
	var cep = window.document.formCEPPessoa.END_CEP.value;
	cep = cep.replace("-", "");

	xajax_BuscaCEPBD(cep);	
	return true;
}

function BuscaCEPBDFast(){
	var cep = window.document.formCEPFast.END_CEP.value;
	cep = cep.replace("-", "");

	xajax_BuscaCEPBDFast(cep);	
	return true;
}

function BuscaCEPBDPed(){
	var cep = window.document.formCEPPedido.END_CEP.value;
	cep = cep.replace("-", "");

	xajax_BuscaCEPBDPed(cep);
	return true;
}


function IncReg() {
	//LimpaResposta();
	var cep = window.document.formCEPPessoa.cidade.value;
	$('carregando').className = "aparece";	
	xajax_ExibeConteudoInserir(cep);
}

function GravaItensCompr(){
	//var buys = "";
	//for (x =0; x < window.document.formProduto.elements.length; x++){
		// Nao mais utilizado
		/*
		if (window.document.formProduto.elements[x].type == 'hidden'){
			nomeCampo = window.document.formProduto.elements[x].name;

			if (nomeCampo.substring(0,5) == "hdBuy"){
				window.document.formProduto.elements[x].value = "," + window.document.formProduto.elements[x].value;
				
				buys = window.document.formProduto.elements[x].value;
			}
		}*/
	//}
	//window.document.formLogin.tot_itens_buy.value = window.document.formLogin.tot_itens_buy.value + "," + str;

	var str = window.document.formLogin.tot_itens_buy.value;

	var result = str.search(window.document.formLogin.session_itens_buy.value);
	if (result <= 0){
		window.document.formLogin.buy_itens.value = (parseFloat(window.document.formLogin.buy_itens.value) + parseFloat(1)).toString();
		
		window.document.formLogin.tot_itens_buy.value = window.document.formLogin.tot_itens_buy.value + "," + window.document.formLogin.session_itens_buy.value;
	}	
	//alert("session_buy: " + window.document.formLogin.session_buy.value);
	//alert("session_itens_buy: " + window.document.formLogin.session_itens_buy.value);	

	xajax_GravaItensCompr(window.document.formLogin.session_buy.value, window.document.formLogin.session_itens_buy.value);
	return true;
}

function GravaDados() {
	if ( $('estado').value == "" ) {
		alert("Favor, informe o estado!");
		$('estado').focus();
		return false;
	}
	if ( $('cidade').value == "" ) {
		alert("Favor, informe a cidade!");
		$('cidade').focus();
		return false;
	}
	if ( $('descricao').value == "" ) {
		alert("Favor, informe a descrição!");
		$('descricao').focus();
		return false;
	}
	$('enviando').className = "aparece";
	
	alert($('sessao_buy').value);
	
	xajax_GravaDados($('estado').value,$('cidade').value,$('descricao').value,$('sessao_buy').value);
	return true;
}

function ValidaEnvio() {
	if ( $('nome').value == "" ) {
		alert("O nome é campo obrigatório");
		$('nome').focus();
		return false;
	}
	if ( $('email').value == "" ) {
		alert("O e-mail é campo obrigatório");
		$('email').focus();
		return false;
	}
	else {
		if ( $('email').value != "" ) {
			//Expressao Regular utilizada para validar o endereco de email
			var ExpReg = /^[a-zA-Z0-9_\.-]{2,}@([A-Za-z0-9_-]{2,}\.)+[A-Za-z]{2,4}$/;
			if ( !ExpReg.test($('email').value) ) {
				alert("E-MAIL inválido!");
				$('email').focus();
				return false;
			}
		}
	}
	if ( $('texto').value == "" ) {
		alert("O texto é campo obrigatório");
		$('texto').focus();
		return false;
	}
	xajax_enviaEmail($('nome').value,$('email').value,$('texto').value);
	return true;
}

