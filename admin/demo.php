<?php
	$page_title = "Demos";
	$sql_table = "demo";
	$edit_column = "code";
	require_once "__config.php";
	$page_width=1400;
?>
<?php require_once $lib_base."header.lib"; ?>
<?php
	$c_flux = array(
		//list			name			align		type			sort		search
		"id",			"",				"m",		"int",			"0",		"x",
		"code",			"Code",			"l",		"",				"1",		"%s%",
		"name",			"Name",			"l",		"",				"1",		"%s%",
		"info",			"Info",			"l",		"memo",			"1",		"%s%",
		"dob",			"DOB",			"m",		"sdf",			"1",		"%s%",
		"updated",		"Updated",		"m",		"sdtf",			"1",		"%s%",
		"cat1",			"Lookup 1",		"l",		"lk_cat",		"1",		"%s%",
		"cat2",			"Lookup 2",		"l",		"lk_list1",		"1",		"%s%",
		"rad1",			"Radio 1",		"l",		"",				"1",		"%s%",
		"cbx1",			"Check 1",		"m",		"bool",			"1",		"%s%",
		"cms1",			"CMS 1",		"l",		"memo",			"1",		"%s%",
	);

	//$debug_select=1;
	//$can_a=0;
	//$can_d=0;
	//if (!get("isadmin")) {$can_d=0;}
	//$l_order_by="name";
	//$l_direction="DESC";

	$listname="cat"; $lklist[$listname] = array();
	$rs = mq("SELECT id,name FROM cat ORDER BY id");
	while ($r=mfa($rs)) {$lklist[$listname][$r[0]]=$r[1];}
?>
<?php require_once $lib_base."mergel.lib"; ?>
<?php require_once $lib_base."presql.lib"; ?>
<?php require_once $lib_base."sqldelete.lib"; ?>
<?php require_once $lib_base."prelist.lib"; ?>
<?php require_once $lib_base."menu.lib"; ?>
<?php require_once $lib_base."subheader.lib"; ?>
<?php require_once $lib_base."search.lib"; ?>
<?php require $lib_base."paging.lib"; ?>
<?php require $lib_base."listing.lib"; ?>
<?php require $lib_base."paging.lib"; ?>
<?php require_once $lib_base."subfooter.lib"; ?>
<?php require_once $lib_base."forms.lib"; ?>
<?php require_once $lib_base."footer.lib"; ?>