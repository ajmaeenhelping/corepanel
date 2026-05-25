<?php
$page_title = "Category Details";
$sql_table = "cat";
$edit_column = "code";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name				type				check
	"id",			"",					"",					"",
	"code",			"Code",				"textx_30",			"requq",
	"name",			"Name",				"text_30",			"req",
);
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php require_once $lib_base . "sqlbasic.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>