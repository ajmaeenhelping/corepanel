<?php
$page_title = "Update Password";
$sql_table = "employee";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name					type			check
	"pwd1",			"Current Password",		"pwd_16",		"reqchk",
	"pwd2",			"New Password",			"pwd_16",		"reqchk",
	"pwd3",			"Confirm Password",		"pwd_16",		"reqchk",
);
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php
require_once $lib_base . "preparam.lib";
if ($submitted) {
	if (!frmp("nosubmit")) {
		require_once $lib_base . "validation.lib";

		if ($validated) {
			if ($p["pwd2"] != $p["pwd3"]) {
				$error = "New password and confirm password is not identical";
			}
			if ($error == "") {
				$sql = "SELECT * FROM " . $sql_table . " WHERE usr='" . get("usr") . "'";
				$rs = mq($sql);
				if ($r = mfa($rs)) {
					if ($r["pwd"] == md5($session_pfx . $p["pwd1"])) {
						$sql = "UPDATE " . $sql_table . " SET pwd='" . md5($session_pfx . $p["pwd2"]) . "' WHERE usr='" . get('usr') . "'";
						$rs_result = mq($sql);
						if (isset($log_audit["pw"]) && $log_audit["pw"]) {
							$log_info = "CHANGE PASSWORD (" . $r["usr"] . ")";
							require $lib_base . "auditlog.lib";
						}
						set("update", "Password successfully updated");
						go("password.php");
					} else {
						$error = "Invalid current password";
					}
				} else {
					$error = "Invalid current password";
				}
			}
		}
	}
}
?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "notification.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>

<tr>
	<td width="100%">
		<table class="innerrow" border="1" bordercolor="#909090" width="100%" cellpadding="5" cellspacing="0">
			<?php
			for ($i = 0; $i < sizeof($p_list); $i++) {
				require $lib_base . "frmfield.lib";
			}
			?>
		</table>
<tr>
	<td colspan="3" align="center"><br />
		<input type="submit" name="submit" value="  Update  " class="btn-4 bg-primary">
		<input type="button" name="clear" class="btn-4 bgred" value="  Clear  " onclick="
			gebi('pwd1').value='';
			gebi('pwd2').value='';
			gebi('pwd3').value='';
		">

		<?php require_once $lib_base . "subfooter.lib"; ?>
		<?php require_once $lib_base . "forms.lib"; ?>
		<?php require_once $lib_base . "footer.lib" ?>