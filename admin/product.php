<?php
$page_title = "Products";
$sql_table = "product";
$edit_column = "slug";
require_once "__config.php";
//$page_width=1200;
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$c_flux = array(
	//list			name			align		type			sort		search
	"id",			"",				"m",		"int",			"0",		"x",
	"slug",			"Slug",			"l",		"",				"1",		"%s%",
	"name",			"Name",			"l",		"",				"1",		"%s%",
	"cat_id",		"Category",		"l",		"lk_cat",		"1",		"%s%",
	"price",		"Price",		"r",		"dbl",			"1",		"%s%",
	"stock",		"Stock",		"r",		"int",			"1",		"%s%",
);

$listname = "cat";
$lklist[$listname] = array();
$rs = mq("SELECT id,name FROM cat ORDER BY id");
while ($r = mfa($rs)) { $lklist[$listname][$r[0]] = $r[1]; }

// Scope listing to one category when arriving via cat.php "View" button
$presel_cat  = isset($_GET["cat"]) ? cint($_GET["cat"]) : 0;
$presel_name = ($presel_cat > 0 && isset($lklist["cat"][$presel_cat])) ? $lklist["cat"][$presel_cat] : "";

// Preserve ?cat=N on every internal form post (paging/sort/search/submit)
if ($presel_cat > 0) {
	$this_file = $this_file . "?cat=" . $presel_cat;
}
?>
<?php require_once $lib_base . "mergel.lib"; ?>
<?php require_once $lib_base . "presql.lib"; ?>
<?php
if ($presel_cat > 0) {
	$sql_where .= " AND cat_id=" . $presel_cat;
}
?>
<?php require_once $lib_base . "sqldelete.lib"; ?>
<?php require_once $lib_base . "prelist.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php if ($presel_cat > 0) { ?>
<div style="margin:-4px 0 14px 0;">
	<a href="cat.php" style="display:inline-flex; align-items:center; gap:6px; color:#0f172a; text-decoration:none; font-size:13px; padding:6px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#fff;">
		<span style="font-size:15px; line-height:1;">&larr;</span>
		<span>Back to Categories</span>
	</a>
	<span style="margin-left:10px; color:#64748b; font-size:13px;">
		Filtered by category: <strong style="color:#0f172a;"><?php echo hsc($presel_name); ?></strong>
	</span>
</div>
<?php } ?>
<?php require_once $lib_base . "search.lib"; ?>
<?php require $lib_base . "paging.lib"; ?>
<?php require $lib_base . "listing.lib"; ?>
<?php require $lib_base . "paging.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "forms.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>
