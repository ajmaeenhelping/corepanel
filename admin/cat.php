<?php
$page_title = "Categories";
$sql_table = "cat";
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
	"name",			"Name",			"l",		"",				"1",		"%s%",
	"__products",	"Products",		"m",		"lc_pcount",	"0",		"x",
);

// Build per-category product counts, used by the lc_pcount "View (n)" button
$listname = "pcount";
$lklist[$listname] = array();
$rs = mq("SELECT cat_id, COUNT(*) FROM product GROUP BY cat_id");
while ($r = mfa($rs)) { $lklist[$listname][$r[0]] = $r[1]; }

$lc_link["__products"] = "product.php?cat=#id#";
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
