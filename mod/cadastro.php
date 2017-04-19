<?php
include_once("../_func/phpmailer/class.phpmailer.php");
include_once("i_login_cad.php");
?>
</br>
<form id="formVerifCad" name="formVerifCad" method="post" action="logar" onSubmit="" accept-charset="utf-8">
	<?php include("i_cad_login.html"); ?>
</form>

<?php if ($errologinemail != "" || $errosenha != ""){ ?>
	<script language="javascript" type="text/javascript">document.formVerifCad.loginemailcad.focus();</script>
<?php }else if ($erroacessoemail != "" || $errocep != ""){ ?>
	<script language="javascript" type="text/javascript">document.formVerifCad.acessoemailcad.focus();</script>
<?php } ?>