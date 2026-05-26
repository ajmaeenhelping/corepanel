<?php
$page_title = "Product Details";
$sql_table = "product";
$edit_column = "slug";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name				type				check
	"id",			"",					"",					"",
	"slug",			"Slug",				"text_30",			"requq",
	"name",			"Name",				"text_50",			"req",
	"cat_id",		"Category",			"lkcbo_cat",		"req",
	"price",		"Price",			"text_10",			"reqdbl",
	"stock",		"Stock",			"text_6",			"reqint",
);

$post_fld["slug"] = " &nbsp;(unique, lowercase-with-dashes)";
$post_fld["price"] = " &nbsp;(e.g. 19.90)";

$listname = "cat";
$lklist[$listname] = array();
$rs = mq("SELECT id,name FROM cat ORDER BY id");
while ($r = mfa($rs)) {
	$lklist[$listname][$r[0]] = $r[1];
}

$cbo_noblank["cat_id"] = 1;
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php require_once $lib_base . "sqlbasic.lib"; ?>
<?php
// Pre-select category when arriving from cat_info.php "Add product" link
if (!$submitted && $id == "" && isset($_GET["cat_id"])) {
	$p["cat_id"] = cint($_GET["cat_id"]);
}
?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>
