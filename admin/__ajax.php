<?php
	require_once "lib/common.lib";
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Wed, 01 Jan 2020 05:00:00 GMT");

	$fn=frmg("fn");		//function name
	$q=frmg("q");		//query value
	$m=frmg("m");		//method (not used here)
	$f=frmg("f");		//field (not used here)

	//-------------------------------------------------------------

	if ($fn=="countchr") {
		$q = clean(trim($q));
		//echo "alert('".$q."')";exit;
		if (strpos($q,"_")!==false){
			$arr = explode("_",$q);
			$err = 0;
			if ($arr[0]=="" || !isint($arr[0])) {$err=1;}	//eid
			if ($arr[1]=="") {$err=1;}	//value
			if ($err==0){
				echo strlen($arr[1])." character(s)";
			}
		}
	}
	if ($fn=="changeclr") {
		$q = clean(trim($q));
		if (strpos($q,"_")!==false){
			$arr = explode("_",$q);
			$err = 0;
			if ($arr[0]=="" || !isint($arr[0])) {$err=1;}	//eid
			if ($arr[1]=="") {$err=1;}	//value
			if ($err==0){
				echo "gebi('txt7').style.color=\"".$arr[1]."\";";
			}
		}
	}
	if ($fn=="searchitm") {
		$q = clean(trim($q));
		if (strpos($q,"_")!==false){
			$arr = explode("_",$q);
			$err = 0;
			if ($arr[0]=="" || !isint($arr[0])) {$err=1;}	//eid
			if ($arr[1]=="") {$err=1;}	//value
			if ($err==0){
				$v=$arr[1];

				$listname = "cat"; $lklist[$listname] = array();
				$rs = mq("SELECT id,name FROM cat ORDER BY id");
				while ($r=mfa($rs)) {$lklist[$listname][$r[0]]=$r[1];}

				$out="";
				$out.="<table class='dtt' border='1' bordercolor='black' cellpadding='5' cellspacing='0' style='border-collapse:collapse;background-color:white;'>";
				$out.="<tr>".
					"<th class='tdh'>#</th>".
					"<th class='tdh'>Code</th>".
					"<th class='tdh'>Category</th>".
					"<th class='tdh'>Name</th>".
					"</tr>";
				$count=0;
				$rsx=mq("SELECT * FROM itm WHERE code LIKE '%".$v."%' OR name LIKE '%".$v."%'");
				while ($rx=mfa($rsx)){
					$count++;
					$out.="<tr class='trhighlight' onclick=\"gebi('txt8').value='".$rx['code']."'; gebi('spnitm').innerHTML=''; \">".
						"<td class='tdm'>#".$count."</td>".
						"<td class='tdl'>".$rx['code']."</td>".
						"<td class='tdl'>".$lklist['cat'][$rx['cat_id']]."</td>".
						"<td class='tdl'>".$rx['name']."</td>".
						"</tr>";
				}
				$out.="</table>";
				echo $out;
			}
		}
	}

	if ($fn=="lstitm") {
		$q = clean(trim($q));
		if (strpos($q,"_")!==false){
			$arr = explode("_",$q);
			$err = 0;
			if ($arr[0]=="" || !isint($arr[0])) {$err=1;}
			if ($arr[1]=="" || !isint($arr[1])) {$err=1;}
			if ($err==0){
				$eid=$arr[0];
				$cid=$arr[1];

				$re=mfa(mq("SELECT * FROM employee WHERE id=".$eid));
				$can_a=1; $can_e=1; $can_d=1;

				$out="";
				$out.="<table class='innerrow' width='100%' border='1' bordercolor='#ccc' cellpadding='10' cellspacing='0' style='border-collapse:collapse;background-color:white;'>";
				$out.="<tr>".
					"<th class='tdh'>#</th>".
					"<th class='tdh'>Code</th>".
					"<th class='tdh'>Name</th>".
					"<th class='tdh'>Qty</th>".
					($can_d ? "<th class='tdh'>&nbsp;</th>":"").
					"</tr>";
				$count=0;
				$rsx=mq("SELECT * FROM itm WHERE cat_id='".$cid."'");
				while ($rx=mfa($rsx)){
					$count++;
					$out.="<tr class='trhighlight' onclick=\"".
							($can_e ? "":"return;").
							"gebi('txt1').style.backgroundColor='#eee';".
							"gebi('txt1').readOnly=true;".
							"gebi('ekey').value='".$rx['id']."';".
							"gebi('btnitm').value='Update';".

							"gebi('txt1').value='".$rx['code']."';".
							"gebi('txt2').value='".$rx['name']."';".
							"gebi('txt3').value='".$rx['qty']."';".

							"gebi('diveupd').style.display='';".
						"\">".
						"<td class='tdm'>".$count.".</td>".
						"<td class='tdl'>".$rx['code']."</td>".
						"<td class='tdl'>".$rx['name']."</td>".
						"<td class='tdr'>".dfi($rx['qty'])."</td>".
						($can_d ? "<td class='tdm'><b><a href='javascript:void(0);' onclick='delitm(".$rx["id"].");' style='color:red'>X</a></b></td>":"").
						"</tr>";
				}
				$out.="</table>";
				if ($can_a || $can_e) {
					$out.="<br><div id='diveupd' ".($can_a==1 ? "":"style='display:none;'").">";
					$out.="Code: <input type='text' size='10' id='txt1'> &nbsp;&nbsp;";
					$out.="Name: <input type='text' size='20' id='txt2'> &nbsp;&nbsp;";
					$out.="Qty: <input type='text' size='5' id='txt3' class='r'> &nbsp;&nbsp;";
					$out.="<input type='hidden' id='ekey' value=''>";
					$out.="<input type='button' id='btnitm' value='Add' onclick='upditm();'>";
					$out.="</div>";
				}
				echo $out;
			}
		}
	}

	if ($fn=="upditm") {
		$q = clean(trim($q));
		if (strpos($q,"_")!==false){
			$arr = explode("_",$q);
			$err = 0;
			if ($arr[0]=="" || !isint($arr[0])) {$err=1;}
			if ($arr[1]=="" || !isint($arr[1])) {$err=1;}
			if ($arr[2]=="") {$err=1;}
			if ($arr[3]=="") {$err=1;}
			if ($arr[4]=="" || !isint($arr[4])) {$err=1;}
			if ($err==0){
				$eid=$arr[0];
				$cid=$arr[1];
				$code=$arr[2];
				$name=$arr[3];
				$qty=$arr[4];
				$btn=$arr[5];
				$ekey=$arr[6];

				$re=mfa(mq("SELECT * FROM employee WHERE id=".$eid));
				$can_a=1; $can_e=1; $can_d=1;

				$out="";
				if ($btn=="Add" && $can_a==1) {
				
					mq("INSERT INTO in (cat_id,code,name,qty) VALUES (".$cid.",'".$code."','".$name."','".$qty."')");
					$out="lstitm();";}
				
				else if ($btn=="Update" && $can_e==1) {
					mq("UPDATE itm SET name='".$name."', qty='".$qty."' WHERE id=".$ekey);
					$out="lstitm();";
				}
				echo $out;
			}
		}
	}

	if ($fn=="delitm") {
		$q = clean(trim($q));
		if (strpos($q,"_")!==false){
			$arr = explode("_",$q);
			$err = 0;
			if ($arr[0]=="" || !isint($arr[0])) {$err=1;}
			if ($arr[1]=="" || !isint($arr[1])) {$err=1;}
			if ($arr[2]=="" || !isint($arr[2])) {$err=1;}
			if ($err==0){
				$eid=$arr[0];
				$cid=$arr[1];
				$rid=$arr[2];

				$re=mfa(mq("SELECT * FROM employee WHERE id=".$eid));
				$can_a=1; $can_e=1; $can_d=1;

				if ($can_d==1) {
					mq("DELETE FROM itm WHERE cat_id=".$cid." AND id=".$rid);
					$out="lstitm();";
				}
				echo $out;
			}
		}
	}
?>
