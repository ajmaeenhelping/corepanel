<?php
$page_title = "Setup";
$sql_table = "setup";
$edit_column = "";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list				name				type				check
	"id",				"",					"",					"",
	"txt1",				"Text",				"text_10",			"",
	"num1",				"Number",			"text_3",			"int",
	"primarycolor",		"Primary Color",	"text_5",			"req",
	"secondarycolor",	"Secondary Color", 	"text_5",			"req",
);

$next_file = "setup.php";
$post_fld["txt1"] = "&nbsp; (sample)";
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php
require_once $lib_base . "preparam.lib";
$id = 1;
if ($submitted) {
	if (!frmp("nosubmit")) {
		require_once $lib_base . "validation.lib";
		if ($validated) {
			if ($id == "") {
				require $lib_base . "sqlinsert.lib";
			} else {
				require $lib_base . "sqlupdate.lib";
			}
			set("update", "Record successfully " . $action);
			go($next_file);
		}
	}
} else if ($id != "") {
	require $lib_base . "sqlselect.lib";
}
?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>

<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>
<script>
	window.onload = function() {
		gebi("primarycolor").setAttribute("type", "color");
		gebi("secondarycolor").setAttribute("type", "color");
	}
</script>