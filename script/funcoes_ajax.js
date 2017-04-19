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

/* ######################## FUNCOES ######################## */
function BuscaModeloBD(){
	var marca = window.document.formCadMotoAjax.cdmt_marca.value;

	xajax_BuscaModeloBD(marca);
	return true;
}

function bscMarModBD(){
	var marca  = window.document.formCadMotoAjax.cdmt_marca.value;
	var modelo = window.document.formCadMotoAjax.cdmt_mod.value;

	xajax_bscMarModBD(marca,modelo);
	return true;
}

// Busca  MARCA  --  MODELO  -- ANO
function SrcModBD(){
	var marca = window.document.frmViewMtAjax.cdmt_marca.value;

	xajax_SrcModBD(marca);
	return true;
}

function SrcMarModBD(){
	var marca  = window.document.frmViewMtAjax.cdmt_marca.value;
	var modelo = window.document.frmViewMtAjax.cdmt_mod.value;

	// Busca todos os Modelos e grava o escolhido no ComboBox
	xajax_SrcMarModBD(marca,modelo);

	// Busca todos os Anos do Modelo
	xajax_SrcAnosModBD(modelo);

	return true;
}
