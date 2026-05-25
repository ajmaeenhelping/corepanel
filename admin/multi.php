<?php
$page_title = "Multis";
$sql_table = "multi";
$edit_column = "code";
require_once "__config.php";
//$page_width=1000;
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$c_flux = array(
	//list			name			align		type			sort		search
	"id",			"",				"m",		"int",			"0",		"x",
	"code",			"Code",			"l",		"",				"1",		"%s%",
	"txt1",			"Multi 1",		"l",		"mt_list1",		"1",		"%s%",
	"txt2",			"Multi 2",		"l",		"mt_cat",		"1",		"%s%",
);

$listname = "cat";
$lklist[$listname] = array();
$rs = mq("SELECT id,name FROM cat ORDER BY id");
while ($r = mfa($rs)) {
	$lklist[$listname][$r[0]] = $r[1];
}
?>
<?php require_once $lib_base . "mergel.lib"; ?>
<?php require_once $lib_base . "presql.lib"; ?>
<?php require_once $lib_base . "sqldelete.lib"; ?>
<?php require_once $lib_base . "prelist.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "search.lib"; ?>
<?php require $lib_base . "paging.lib"; ?>
<?php require $lib_base . "listing.lib"; ?>
<?php require $lib_base . "paging.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "forms.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>