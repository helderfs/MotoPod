
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<script>
		function mobileSimNao01(){
			alert('passou');
			/* URL mobile do seu site ou blog */
			MOBILE_URL = "http://m.uol.com.br/";

			var WORDS = ["mobile", "android", "blackberry", "brew", "htc", "j2me", "lg", "midp", "mot", "netfront", "nokia", "obigo", "openweb", "operamini", "palm", "psp", "samsung", "sanyo", "sch", "sonyericsson", "symbian", "symbos", "teleca", "up.browser", "wap", "webos", "windows ce"];
			var WLEN = WORDS.length;

			for (var i = 0; i < WLEN; i++){
			
				var re = new RegExp(WORDS[i], "i");
				if (re.exec(navigator.userAgent))
				{
					window.location = MOBILE_URL;
					break;
				}
			}
			alert('passou 2');
		}
		
		function mobileSimNao02(){
			var userAgent = navigator.userAgent.toLowerCase();
			
			var devices = new Array('nokia','iphone','blackberry','sony','lg',
			'htc_tattoo','samsung','symbian','SymbianOS','elaine','palm',
			'series60','windows ce','android','obigo','netfront',
			'openwave','mobilexplorer','operamini');
			
			var url_redirect = 'http://www.seusite.com.br/versaomobile/';
			
			function mobiDetect(userAgent, devices) {
				for(var i = 0; i < devices.length; i++) {
					if (userAgent.search(devices[i]) > 0) {
						return true;
					}
				}
				return false;
			}
			
			if (mobiDetect(userAgent, devices)) {
				window.location.href = url_redirect;
			}
			
			alert('teste 2');
		}
		
		function mobileSimNao03(){
			// Indentifica o User Agent do navegador cliente
			// AAA - Out 09
			var ua = navigator.userAgent.toLowerCase();

			var uMobile = '';

			// === REDIRECIONAMENTO PARA iPhone, Windows Phone, Android, NokiaE71 etc. ===

			// Lista de substrings a procurar para ser identificado como mobile WAP
			uMobile = '';
			uMobile += 'iphone;ipod;windows phone;android;iemobile 8;nokiae71';

			// Sapara os itens individualmente em um array
			v_uMobile = uMobile.split(';');
			alert(window.location.href.slice(window.location.href.indexOf('?') + 1).split('&'));

			alert(window.location.href.slice(window.location.href.indexOf('?',0)+1));
			// percorre todos os itens verificando se eh mobile
			var boolMovel = false;
			for (i=0;i<=v_uMobile.length;i++)
			{
				if ((ua.indexOf(v_uMobile[i]) != -1) && window.location.href.slice(window.location.href.indexOf('?') + 1).split('&') != 'vip=1')
				{
					boolMovel = true;
				}
			}

			if (boolMovel == true)
				{
					location.href='http://meusite.com.br/celular-smartphones-3Gs/home.html'; //AQUI DEFINE A PÁGINA PARA BROWSERS DE TELEFONE MÓVEIS COMO BLACKBERRY, IPHONE, WINDOWS MOBILE, ETC. (3G)
				}

			// ===================================================================

			// === REDIRECIONAMENTO PARA O WAP ===================================

			// Lista de substrings a procurar para ser identificado como mobile WAP
			uMobile = '';
			uMobile += 'playstation;wap;windows ce;Windows phone;iemobile;';
			uMobile += 'series60;symbian;series60;series70;series80;series90;';
			uMobile += 'blackberry;midp;wml;brew;palm;xiino;blazer;pda;nitro;netfront;';
			uMobile += 'sonyericsson;ericsson;sec-sgh;docomo;kddi;vodafone;mot;sony';

			// Sapara os itens individualmente em um array
			v_uMobile = uMobile.split(';');

			// percorre todos os itens verificando se eh mobile
			var boolMovel = false;
			for (i=0;i<=v_uMobile.length;i++){
				if (ua.indexOf(v_uMobile[i]) != -1){
					boolMovel = true;
				}
			}

			if (boolMovel == true){
					location.href='http://wap.seusite.com.br/mobile/index.html'; //ESTE REDIRECIONA PARA CELULARES MAIS SIMPLES 2G (obs. Modelos Antigos, que fazem o acesso 2g com páginas simples no conteúdo!
			}
			
			alert('teste 3');
		}
		
	</script>
	
	
<input type="button" value="Teste 01" onClick="mobileSimNao01();">
<input type="button" value="Teste 02" onClick="mobileSimNao02();">
<input type="button" value="Teste 03" onClick="mobileSimNao03();">

	
</html>