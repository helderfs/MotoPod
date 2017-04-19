//////////////////////////////////////////////////////////////////////////////
// ######################    INICIO MASCARAS    ######################
//////////////////////////////////////////////////////////////////////////////

function FormataValor(id,tammax,teclapres){
		
	if(window.event) { // Internet Explorer
		var tecla = teclapres.keyCode; }
	else if(teclapres.which) { // Nestcape / firefox
		var tecla = teclapres.which;
	}

	vr = document.getElementById(id).value;
	vr = vr.toString().replace( "/", "" );
	vr = vr.toString().replace( "/", "" );
	vr = vr.toString().replace( ",", "" );
	vr = vr.toString().replace( ".", "" );
	vr = vr.toString().replace( ".", "" );
	vr = vr.toString().replace( ".", "" );
	vr = vr.toString().replace( ".", "" );
	tam = vr.length;

	if (tam < tammax && tecla != 8){ tam = vr.length + 1; }
	if (tecla == 8 ){ tam = tam - 1; }
	if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ){
		if ( tam <= 2 ){ document.getElementById(id).value = vr; }
		if ( (tam > 2) && (tam <= 5) ){
			document.getElementById(id).value = vr.substr( 0, tam - 2 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 6) && (tam <= 8) ){
			document.getElementById(id).value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 9) && (tam <= 11) ){
			document.getElementById(id).value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 12) && (tam <= 14) ){
			document.getElementById(id).value = vr.substr( 0, tam - 11 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 15) && (tam <= 17) ){
			document.getElementById(id).value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );
		}
	}
}

function soNumeros(d){
	return d.replace(/\D/g,"")
}

function semNumeros(d){
	return d.replace(/\d/g,"");
}

function valCPF(e,campo){
 
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
           mascara(campo, '###.###.###-##');
           return true;
         }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

function ValidarCPF(d){
	campo = eval (d);
	
	d = campo.value;
    d = soNumeros(d)
    d=d.replace(/(\d{3})(\d)/,"$1.$2")
    d=d.replace(/(\d{3})(\d)/,"$1.$2")
    d=d.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
	
    campo.value = d;
}

function valCNPJ(e,campo){

    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
           mascara(campo, '##.###.###/####-##');
           return true;
         }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

function ValidarCNPJ(d){
	campo = eval (d);
	
	d = campo.value;
    d = soNumeros(d)
    d=d.replace(/^(\d{2})(\d)/,"$1.$2")
    d=d.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
    d=d.replace(/\.(\d{3})(\d)/,".$1/$2")
    d=d.replace(/(\d{4})(\d)/,"$1-$2")

    campo.value = d;
}

/*permite somente valores numericos*/
function valPHONE(e,campo){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
           mascara(campo, '(##)####-####');
           return true;
         }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}
/*permite somente valores numericos*/
function valCEP(e,campo){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
           mascara(campo, '#####-###');
           return true;
         }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

/*permite somente valores numericos*/
function valData(e,campo){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
           mascara(campo, '##/##/####');
           return true;
         }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

function ValidarData(d){
	campo = eval (d);
	
	d = campo.value;
    d = soNumeros(d)

    d = d.substr(0,2) +"/"+ d.substr(2,2) +"/"+ d.substr(4,4);
	
    campo.value = d;
	
	if ( !VerificaData(d) )
		campo.value = "";
}

function VerificaData(digData){
	var bissexto = 0;
	var data = digData; 
	var tam = data.length;
	if (tam == 10) 
	{
		var dia = data.substr(0,2)
		var mes = data.substr(3,2)
		var ano = data.substr(6,4)
		if ((ano > 1900)||(ano < 2100))
		{
			switch (mes) 
			{
				case '01':
				case '03':
				case '05':
				case '07':
				case '08':
				case '10':
				case '12':
					if  (dia <= 31) 
					{
						return true;
					}
					break
				
				case '04':		
				case '06':
				case '09':
				case '11':
					if  (dia <= 30) 
					{
						return true;
					}
					break
				case '02':
					// Validando ano Bissexto / fevereiro / dia
					if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)) 
					{ 
						bissexto = 1; 
					} 
					if ((bissexto == 1) && (dia <= 29)) 
					{ 
						return true;				 
					} 
					if ((bissexto != 1) && (dia <= 28)) 
					{ 
						return true; 
					}			
					break						
			}
		}
	}
	alert("A Data "+data+" é inválida!");
	return false;
}	

/*cria a mascara*/
function mascara(src, mask){
   var i = src.value.length;
   var saida = mask.substring(1,2);
   var texto = mask.substring(i);
   if (texto.substring(0,1) != saida)
   {
      src.value += texto.substring(0,1);
   }
}
