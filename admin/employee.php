<?php
$page_title = "Employees";
$sql_table = "employee";
$req_pm = "isadmin";
$edit_column = "usr";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$c_flux = array(
	//list			name				align		type			sort		search
	"id",			"",					"m",		"int",			"0",		"x",
	"usr",			"Username",			"l",		"",				"1",		"%s%",
	"name",			"Person Name",		"l",		"",				"1",		"%s%",
	"designation",	"Designation",		"m",		"",				"1",		"%s%",
	"last_login",	"Last Login",		"m",		"sdtf",			"1",		"x",
	"active",		"Active",			"m",		"bool",			"1",		"",
	"isadmin",		"Admin",			"m",		"bool",			"1",		"",
);
?>
<?php require_once $lib_base . "mergel.lib"; ?>
<?php require_once $lib_base . "presql.lib"; ?>
<?php $sql_where .= " AND usr<>'admin' "; ?>
<?php require_once $lib_base . "sqldelete.lib"; ?>
<?php require_once $lib_base . "prelist.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>

<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "search.lib"; ?>
<?php require $lib_base . "paging.lib"; ?>
<?php require_once $lib_base . "listing.lib"; ?>
<?php require $lib_base . "paging.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "forms.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>