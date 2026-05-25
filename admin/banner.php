<?php
$page_title = "Banners";
$sql_table = "banner";
$edit_column = "name";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$c_flux = array(
	//list			name			align		type			sort		search
	"id",			"",				"m",		"int",			"0",		"x",
	"name",			"Name",			"l",		"",				"1",		"%s%",
	"image",			"Image",			"l",		"display_image",				"1",		"%s%",
);
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