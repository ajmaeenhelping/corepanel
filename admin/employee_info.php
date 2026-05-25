<?php
$page_title = "Employee Details";
$sql_table = "employee";
$req_pm = "isadmin";
$edit_column = "usr";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name				type				check
	"id",			"",					"",					"",
	"usr",			"Username",			"textx_16",			"requqchk",
	"name",			"Employee Name",	"text_30",			"req",
	"designation",	"Designation",		"text_30",			"",
	"active",		"Active",			"cbx_1",			"reqint",
	"isadmin",		"Administrator",	"cbx_0",			"reqint",
	"info",			"Remarks",			"memo",				"",
	"last_login",	"Last Login",		"display",			"datetime",
);
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php
require_once $lib_base . "preparam.lib";
$id = $p[$p_list[0]];
if (frm("id") && isint(frm("id"))) {
	$id = frm("id");
}
if ($id && frm("reset") == 1) {
	$rx = mfa(mq("SELECT usr FROM employee WHERE id=" . $id));
	$sql = "UPDATE " . $sql_table . " SET pwd='" . md5($session_pfx . $rx[0]) . "' WHERE id=" . $id;
	mq($sql);
	set("update", "Password has been reset to same as the username");
}
if ($submitted) {
	if (!frmp("nosubmit")) {
		require_once $lib_base . "validation.lib";
		if ($validated) {
			if ($id == "") {
				require $lib_base . "sqlinsert.lib";
				$sql = "UPDATE " . $sql_table . " SET pwd='" . md5($session_pfx . $p["usr"]) . "' WHERE id=" . $new_id;
				$rs_result = mq($sql);
			} else {
				require $lib_base . "sqlupdate.lib";
			}
			set("update", "Record successfully " . $action);
			go($next_file);
		}
	}
} else if ($id != "") {
	require $lib_base . "sqlselect.lib";
} else {
	$p["last_login"] = "1970-01-01 00:00:00";
}
?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>

<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php if ($id == "") { ?><br><b class=red>Note: All new user accounts will have password same as the username.</b><?php } ?>
<?php if ($id != "") { ?><br><input type='button' value='Reset Password' class="btn-4 bgred" onclick="if (confirm('Confirm reset password?')) {go('employee_info.php?id=<?= $id ?>&reset=1');}" /><?php } ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>