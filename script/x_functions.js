function menuControle (objeto,acao){
	var action = acao.substring(0,2);
//alert(action);
	if (action == "01"){
		if (acao == "01out"){
			objeto.src = "images/menu01_1.gif";
		}
		
		if (acao == "01over"){
			objeto.src = "images/menu01_2.gif";
		}			
	}
	if (action == "02"){
		if (acao == "02out"){
			objeto.src = "images/menu02_1.gif";
		}
		
		if (acao == "02over"){
			objeto.src = "images/menu02_2.gif";
		}
	}
	if (action == "03"){
		if (acao == "03out"){
			objeto.src = "images/menu03_1.gif";
		}
		
		if (acao == "03over"){
			objeto.src = "images/menu03_2.gif";
		}			
	}
	if (action == "04"){
		if (acao == "04out"){
			objeto.src = "images/menu04_1.gif";
		}
		
		if (acao == "04over"){
			objeto.src = "images/menu04_2.gif";
		}
	}
	if (action == "05"){
		if (acao == "05out"){
			objeto.src = "images/menu05_1.gif";
		}

		if (acao == "05over"){
			objeto.src = "images/menu05_2.gif";
		}			
	}
}

function janelaSecundaria (URL, larg, alt){
   window.open(URL,"Janela","width=" + larg + ",height="+ alt +",left=100,top=150,toolbar=0,resizable=0,menubar=0,status=0,location=0,directories=0,scrollbars=0");
}

function getValues(objName){  
	var arr = new Array();
	arr = document.getElementsByName(objName);
   
	// alert("total objects with name \"textfield\" = \n" + arr.length);
	   
	for(var i = 0; i < arr.length; i++){
		var obj = document.getElementsByName(objName).item(i);
		return obj.value;
		//alert(obj.id + " =  " + obj.value);
	}
}

function substPontoVirgula(label){
    valor = label.replace(".",",");
	
	return valor;
}

function substVirgulaPonto(label){
    valor = label.replace(",",".");
	
	return valor;
}

function formatoMoeda(valor){
	/* vlrFinal.toFixed(2).replace(".",",") */
	valor = valor.toFixed(2).replace('.',',');
	for(ii=0 ; ii<= Math.floor(valor.length/3); ii++ ) 
		valor = valor.replace(/([0-9])([0-9]{3})([.,])/,'$1.$2$3');

	return valor;
}

function ConsisteNumerico(tam, fld, e) {
    var key = '';
    var i = 0;
    var len = 0;
    var strCheck = '0123456789';
    var aux = '';
	
    var whichCode = (window.Event) ? e.which : e.keyCode;
    
	if (whichCode == 13 || whichCode == 8 || whichCode == 0)
        return true;  // Enter
    
	key = String.fromCharCode(whichCode);  // Get key value from key code
    if (strCheck.indexOf(key) == -1)
        return false;  // Not a valid key

	len = tam -1;
    aux = '';
	for(; i < len; i++)
        if (strCheck.indexOf(fld.value.charAt(i))!=-1)
            aux += fld.value.charAt(i);
    aux += key;
    fld.value = '';
    fld.value += aux;

	return false;
}

function SomenteNumero(e){
	var tecla = (window.event)?event.keyCode:e.which;
	
	if ( (tecla > 47 && tecla < 58) )
		return true;
	else{
		if (tecla == 8 || tecla == 0) 
			return true;
		else  
			return false;
	}
}

/*
<script language="javascript">

	alert("sss" + opener.formCadProduto.elements.length);
	
	//alert("02" + <?php echo $PRE_ESTILO; ?> );
	//opener.formObj.elements.length
	//opener.formObj.elements[i].value
	var teste = "";
	for(var i = 0; i < opener.formCadProduto.elements.length; i++){
		//teste = teste + " " + opener.formCadProduto.elements[i].name;
		//var obj = opener.formCadProduto.elements[i].value;
		if (opener.formCadProduto.elements[i].name == "PRE_ESTILO"){
			//alert("ss  " + <?php echo $fet_busca['PRE_ESTILO']; ?>);
			
			//var oOption = document.createElement("OPTION");
			//oOption.text="Apples";	
			//oOption.value=i;
			//document.formCadEstilo.select1.add(oOption);
		}
	}
	
	//var oOption = document.createElement("OPTION");
	//oOption.text="Apples";	
	//oOption.value=i;
	//document.formCadEstilo.select1.add(oOption);
</script>
*/
