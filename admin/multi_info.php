<?php
$page_title = "Multi Details";
$sql_table = "multi";
$edit_column = "code";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name				type				check
	"id",			"",					"",					"",
	"code",			"Code",				"textx_30",			"requq",
	"txt1",			"Multi 1",			"text_30",			"",
	"txt2",			"Multi 2",			"text_30",			"",
);
//$debug_insert=1;
$pre_fld = array();
$post_fld = array();

$pchk = "chk1";
$fld = "txt1";
$listname = "list1";
$tmp = "";
$akey = array_keys($lklist[$listname]);
for ($i = 0; $i < sizeof($akey); $i++) {
	$tmp .= "<label style='cursor:pointer;'><input type='checkbox' id='" . $pchk . "_" . $akey[$i] . "' name='" . $pchk . "_" . $akey[$i] . "' onclick=\"rewriteChk('" . $pchk . "_',gebi('" . $fld . "'));\"> " . $lklist[$listname][$akey[$i]] . "<label> &nbsp;&nbsp;&nbsp;&nbsp;";
}
$all = "<label style='cursor:pointer;'><input type='checkbox' onclick=\"checkAll('" . $pchk . "_',(this.checked ? 1:0));rewriteChk('" . $pchk . "_',gebi('" . $fld . "'));\"> <b><u>All</u></b><label><br>";
$pre_fld[$fld] = "<span style='display:none;'>";
$post_fld[$fld] = "</span>" . $all . $tmp;

$listname = "cat";
$lklist[$listname] = array();
$rs = mq("SELECT id,name FROM cat ORDER BY id");
while ($r = mfa($rs)) {
	$lklist[$listname][$r[0]] = $r[1];
}

$pchk = "chk2";
$fld = "txt2";
$listname = "cat";
$tmp = "";
$akey = array_keys($lklist[$listname]);
for ($i = 0; $i < sizeof($akey); $i++) {
	$tmp .= "<label style='cursor:pointer;'><input type='checkbox' id='" . $pchk . "_" . $akey[$i] . "' name='" . $pchk . "_" . $akey[$i] . "' onclick=\"rewriteChk('" . $pchk . "_',gebi('" . $fld . "'));\"> " . $lklist[$listname][$akey[$i]] . "<label><br>";
}
$all = "<label style='cursor:pointer;'><input type='checkbox' onclick=\"checkAll('" . $pchk . "_',(this.checked ? 1:0));rewriteChk('" . $pchk . "_',gebi('" . $fld . "'));\"> <b><u>All</u></b><label><br>";
$pre_fld[$fld] = "<span style='display:none;'>";
$post_fld[$fld] = "</span>" . $all . $tmp;

// $pchk="chk3"; $fld="txt3"; $listname="list3";
// $tmp=""; $akey=array_keys($lklist[$listname]);
// for ($i=0; $i<sizeof($akey); $i++) {$tmp .= "<label style='cursor:pointer;'><input type='checkbox' id='".$pchk."_".$akey[$i]."' name='".$pchk."_".$akey[$i]."' onclick=\"rewriteChk('".$pchk."_',gebi('".$fld."'));\"> ".$lklist[$listname][$akey[$i]]."<label><br>";}
// $all = "<label style='cursor:pointer;'><input type='checkbox' onclick=\"checkAll('".$pchk."_',(this.checked ? 1:0));rewriteChk('".$pchk."_',gebi('".$fld."'));\"> <b><u>All</u></b><label><br>";
// $pre_fld[$fld]="<span style='display:none;'>";
// $post_fld[$fld]="</span>".$all.$tmp;
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php require_once $lib_base . "sqlbasic.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<script>
	writeChk('chk1_', gebi('txt1'));
</script>
<script>
	writeChk('chk2_', gebi('txt2'));
</script>
<?php require_once $lib_base . "footer.lib"; ?>