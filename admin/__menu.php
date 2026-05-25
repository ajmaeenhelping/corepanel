<?php
set("mce_base_url", $mce_base_url);

$mn_flux = array(
	// Use "__group" as the file value to define a sidebar group label.
	// Format per row:  perm, file, label_key, icon
	// For groups:      "",   "__group", "nav.key", ""
	// Labels are passed through t() in menu.lib — use lang keys from admin/lang/*.php

	//perm				//file				//label					//icon
	"",					"__group",			"nav.general",			"",
	"",					"home.php",			"nav.home",				"fas fa-home",

	"",					"__group",			"nav.content",			"",
	"",					"banner.php",		"nav.banners",			"fas fa-flag",
	"",					"cat.php",			"nav.categories",		"fas fa-list",
	"",					"page.php",			"nav.pages",			"fas fa-file",
	"",					"demo.php",			"nav.demo",				"fas fa-desktop",
	// "",				"multi.php",		"nav.multi",			"fas fa-layer-group",

	"isadmin",			"__group",			"nav.administration",	"",
	"isadmin",			"employee.php",		"nav.employees",		"fas fa-users",
	// "isadmin",		"setup.php",		"nav.settings",			"fas fa-cog",

	"",					"__group",			"nav.account",			"",
	"",					"password.php",		"nav.password",			"fas fa-unlock-alt",
	// "",				"logout.php",		"nav.logout",			"fas fa-sign-out-alt",
	// "",				"testing.php",		"Testing",				"fas fa-screwdriver",
);
