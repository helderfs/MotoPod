<?php
include_once("../_func/func_db.php");
include_once("../_func/phpmailer/class.phpmailer.php");

include_once("i_login_cad.php");
?>

<form id="formFastCad" name="formFastCad" action="logar" method="post" accept-charset="utf-8">
	<input type="hidden" name="btCadFast" value="s">
	<?php include("i_cad_fast.html"); ?>
</form>

<form id="formVerifCad" name="formVerifCad" action="logar" method="post" accept-charset="utf-8">
	<input type="hidden" name="postVerifCad" value="s">
	<?php include("i_cad_login.html"); ?>
</form>

<?php if ($errologinemail != "" || $errosenha != ""){ ?>
	<script language="javascript" type="text/javascript">document.formVerifCad.loginemailcad.focus();</script>
<?php }else if ($erroacessoemail != "" || $errocep != ""){ ?>
	<script language="javascript" type="text/javascript">document.formVerifCad.acessoemailcad.focus();</script>
<?php }else{ ?>
	<script language="javascript" type="text/javascript">document.formFastCad.PES_NOME.focus();</script>
<?php } ?>
