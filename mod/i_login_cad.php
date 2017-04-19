<?php
$ultPagVisit = "";
if (isset($_SESSION['ultPagVisit']))
	$ultPagVisit = $_SESSION['ultPagVisit'];

// ############################ LOGIN
if ($loginemailcad != $_SESSION['loginemailcad'])
	$loginemailcad = $_SESSION['loginemailcad'];
	
if ($errologinemail != $_SESSION['errologinemail'])
	$errologinemail = $_SESSION['errologinemail'];
if ($errosenha != $_SESSION['errosenha'])
	$errosenha = $_SESSION['errosenha'];
// ############################ LOGIN

// ############################ CADASTRO
if (isset($_POST['acessoemailcad'])){
echo "passou POST acessoemailcad". $_POST['acessoemailcad'];
	$acessoemailcad = $_POST['acessoemailcad'];
	$_SESSION['acessoemailcad'] = $_POST['acessoemailcad'];
}

if ($acessoemailcad != $_SESSION['acessoemailcad'])
	$acessoemailcad = $_SESSION['acessoemailcad'];

if ($acessocep1 != $_SESSION['acessocep1']){
	if ($_SESSION['acessocep1'] <> "")
		$acessocep1 = $_SESSION['acessocep1'];
}
if ($acessocep2 != $_SESSION['acessocep2']){
	if ($_SESSION['acessocep2'] <> "")
		$acessocep2 = $_SESSION['acessocep2'];
}

if ($erroacessoemail != $_SESSION['erroacessoemail'])
	$erroacessoemail = $_SESSION['erroacessoemail'];
if ($errocep != $_SESSION['errocep'])
	$errocep = $_SESSION['errocep'];
// ############################ CADASTRO

//if ($errologinemail != "" || $errosenha != "" || $erroacessoemail != "" || $errocep != ""){
if ($ultPagVisit == "EfetuaLogin"){
	if ($errologinemail != "")
		$c_erro = ", ". $errologinemail;
	if ($errosenha != "")
		$c_erro = $c_erro .", ". $errosenha;
}

if ($ultPagVisit == "IniciaCad"){
	if ($erroacessoemail != "")
		$c_erro = ", ". $erroacessoemail;
	if ($errocep != "")
		$c_erro = $c_erro .", ". $errocep;
}

if ($c_erro != "")
	echo msgErro($c_erro);
?>