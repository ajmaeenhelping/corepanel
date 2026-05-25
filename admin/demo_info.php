<?php
$page_title = "Demo Details";
$sql_table = "demo";
$edit_column = "code";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name				type				check
	"id",			"",					"",					"",
	"code",			"Code",				"textx_30",			"requq",
	"name",			"Name",				"text_50",			"req",
	"age",			"Age",				"text_3",			"reqint",
	"salary",		"Salary",			"text_6",			"reqdbl",
	"dob",			"DOB",				"date",				"reqdate",
	"dt1",			"Due Date",			"date_today",		"date",
	"updated",		"Updated",			"display",			"reqdatetime",
	"email",		"Email",			"text_30",			"uqemail",
	"url",			"URL",				"text_30",			"uqurl",
	"phone",		"Phone",			"text_20",			"phone",
	"pwd",			"Password",			"pwd",				"",
	"alphanum",		"Alpha/Num",		"text_20",			"alphanum",
	"address",		"Address",			"memo_6_80",		"",
	"info",			"Info",				"memo",				"",
	"disp",			"Auto",				"display",			"",

	"__1",			"Divider 1",		"split",			"",
	"__2",			"Divider 2",		"split_l",			"",
	"__3",			"Divider 3",		"split_r",			"",

	"cat1",			"Lookup 1",			"lkcbo_cat",		"req",
	"cat2",			"Lookup 2",			"lkcbo_list1",		"",
	"cbo1",			"Combo 1",			"cbo_AAA_BBB_CCC",	"req",
	"cbo2",			"Combo 2",			"cbo_DDD_EEE_FFF",	"",
	"rad1",			"Radio 1",			"rad_Male_Female",	"req",
	"rad2",			"Radio 2",			"rad_Cat_Dog_",		"",
	"cbx1",			"Check 1",			"cbx",				"reqint",
	"cbx2",			"Check 2",			"cbxx_1",			"reqint",

	"__4",			"CMS",				"split",			"",
	"cms1",			"CMS 1",			"cms",				"reqraw",
	"cms2",			"CMS 2",			"cms",				"raw",

	"__5",			"Joined Fields",	"split",			"",
	"cbx3",			"Selection",		"cbx",				"reqint",
	"cbx4",			"Check 4",			"cbx",				"reqint",
	"cbx5",			"Check 5",			"cbx",				"reqint",
	"txt1",			"Field 1",			"text_10",			"",
	"txt2",			"Field 2",			"text_10",			"",
	"txt3",			"Field 3",			"text_10",			"",

	"__6",			"Scripting",		"split",			"",
	"txt4",			"JS",				"text_10",			"",
	"txt5",			"Ajax (Fld)",		"text_10",			"",
	"txt6",			"Ajax (Eval)",		"text_10",			"",
	"txt7",			"Output",			"text_10",			"",
	"txt8",			"Ajax (Span)",		"text_10",			"",

	"catx",			"Outlet",			"text_30",			"",
);

//$debug_update=1;
//$debug_insert=1;
//$multipart0;

//$can_e=0;
//if (!get("isadmin")) {$can_e=0;}

$post_fld["txt5"] = " &nbsp;(character count)";
$post_fld["txt6"] = " &nbsp;(change color)";

$post_fld["email"] = " &nbsp;(e.g. john@gmail.com)";

$cal_unlock_date["dob"] = 1;
$cal_unlock_date["dt1"] = 1;

$listname = "cat";
$lklist[$listname] = array();
$rs = mq("SELECT id,name FROM cat ORDER BY id");
while ($r = mfa($rs)) {
	$lklist[$listname][$r[0]] = $r[1];
}

$cbo_noblank["cat2"] = 1;

$js_func["url"] = $noauto; //prevent autofill

$js_func["txt4"] = " onkeyup=\"gebi('txt7').value=this.value;\" "; //JS
$js_func["txt5"] = " onkeyup=\"ajax('countchr','" . get("id") . "_'+this.value,'field','txt7','');\" "; 
$js_func["txt6"] = " onkeyup=\"ajax('changeclr','" . get("id") . "_'+this.value,'eval','','');\" ";
$js_func["txt8"] = " onkeyup=\"ajax('searchitm','" . get("id") . "_'+this.value,'span','spnitm','(loading)');\"" . $noauto;

$post_fld["txt8"] = "&nbsp; (search/lookup)<br><span id='spnitm' style='position:absolute;'></span>";
?>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes2.js"></script>
<script>
	window.onload = function() {
		var dp_cal1;
		dp_cal1 = new Epoch('epoch_popup', 'popup', document.getElementById('dob'));
		var dp_cal2;
		dp_cal2 = new Epoch('epoch_popup', 'popup', document.getElementById('dt1'));
	};
</script>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php
$skip_label_r["cbx3"] = 1;
$skip_label["cbx4"] = 1;
$skip_label_l["cbx5"] = 1;

$pre_fld["cbx3"] = "<label style='cursor:pointer'>";
$post_fld["cbx3"] = "Custom" . "</label> &nbsp;&nbsp;&nbsp; ";

$pre_fld["cbx4"] = "<label style='cursor:pointer'>";
$post_fld["cbx4"] = $p_name[$p_key["cbx4"]] . "</label>  &nbsp;&nbsp;&nbsp; ";

$pre_fld["cbx5"] = "<label style='cursor:pointer'>";
$post_fld["cbx5"] = $p_name[$p_key["cbx5"]] . "</label>  &nbsp;&nbsp;&nbsp; ";

//---

$skip_label["txt1"] = 1;
$skip_label["txt2"] = 1;
$skip_label["txt3"] = 1;

$pre_fld["txt1"] = "<tr><td nowrap class='tdh r'>Dimension :&nbsp;<td style='padding:5px 5px 5px 5px'>";
$post_fld["txt1"] = " x ";
$post_fld["txt2"] = " x ";
$post_fld["txt3"] = "</td></tr>";

?>
<style>
	.lookuptab {position:absolute; background-color:white; border:1px solid black;}
	.lookuptab tr td {padding:5px; border:1px solid #ccc; cursor:pointer;}
	.lookuptab tr:hover {background-color:#dedede;}
</style>
<script>
function dolookuptab(tb,fd){
	var v=gebi(fd).value;
	if (v=='' || v.length<3){dotabsel(tb,fd,v);}
	else{
		ajax('tablookup','1_'+tb+'_'+fd+'_'+v,'span','tab1','');
	}
}
function dotabsel(tb,fd,v,addr) {
	gebi(tb).innerHTML='';
	gebi(fd).value=v;
	addr=addr.replaceAll('&#039;',"'");
	addr=addr.replaceAll('&quot;','"');
	gebi('address').value=addr;
}
</script>
<?php
$post_fld["catx"] = "<table class='lookuptab' id='tab1' cellspacing='0'></table>";
$js_func["catx"] = " onkeyup=\"dolookuptab('tab1','catx');\" autocomplete='off' ";

$js_func["txt1"] = " placeholder='width' style='text-align:center' ";
$js_func["txt2"] = " placeholder='height' style='text-align:center' ";
$js_func["txt3"] = " placeholder='depth' style='text-align:center' ";

?>
<?php
//require_once $lib_base."sqlbasic.lib";
?>
<?php
require_once $lib_base . "preparam.lib";
$id = $p[$p_list[0]];
if ($submitted) {
	if (!frmp("nosubmit")) {
		require_once $lib_base . "validation.lib";
		if ($validated) {
			$p["updated"] = now();

			if ($id == "") {
				require $lib_base . "sqlinsert.lib";
				$newcode = "A-" . pad($new_id, "0", 5);
				$p["disp"] = $newcode;
				mq("UPDATE " . $sql_table . " SET disp='" . $newcode . "' WHERE id=" . $new_id);
			} else {
				require $lib_base . "sqlupdate.lib";
			}
			set("update", "Record successfully " . $action);
			go($next_file);
		}
	}
} else if ($id != "") {
	require $lib_base . "sqlselect.lib";
} else {
	$p["disp"] = "(auto)";
}
?>

<?php require_once $lib_base . "mergei.lib"; ?>
<?php require_once $lib_base . "sqlbasic.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>