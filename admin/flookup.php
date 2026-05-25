<?php
	$acceptUploadExt = array("doc","docx","rtf","pdf","txt","gif","jpg","png","gif");

	if (!function_exists("scandir2")) {
		function scandir2($dir,$listDirectories=false, $skipDots=true) {
			global $acceptUploadExt;
		    $dirArray = array();
				// echo "<script>alert('".$dir."');</script>"; // echo file path
		    if ($handle = opendir($dir)) {
		        while (false !== ($file = readdir($handle))) {
		            if (($file != "." && $file != "..") || $skipDots == true) {
		                //if($listDirectories == false) { if(is_dir($dir.$file)) { continue; } }
		                if (strpos($file,".")!==false){
		                	$fileExt=trim(substr($file,strpos($file,".")+1));
		                	$extOK=0;
							for ($i=0;$i<sizeof($acceptUploadExt);$i++) {
								if (strtoupper($acceptUploadExt[$i])==strtoupper($fileExt)) {$extOK=1; break;}
							}
							if ($extOK) {} else {continue;}
		                	//if (stripos($file,".jpg") || stripos($file,".gif") || stripos($file,".png")) {} else {continue;}
		                }

						array_push($dirArray,basename($file));
		            }
		        }
		        closedir($handle);
		    }
		    return $dirArray;
		}
	}

	$page_title = "Select File";
	$basef = "../";

	require_once "lib/common.lib";
	$page_width = "100%";
?>
<html>
<head>
<title>Files</title>
<link rel="stylesheet" href="lib/img/style.css" type="text/css"/>

<script language="JavaScript">
	function m_on(fld) {fld.style.backgroundColor='#FFFFFF';}
	function m_off(fld) {fld.style.backgroundColor='transparent';}
</script>

</head>
<body>
<center>

<?php
	$folder = "";
	if (frm("folder")!="") {$folder = trim(frm("folder"));}

	$folder = rtrim($folder, "/");
	$folder = str_replace("..","",$folder);
	$folder = str_replace("//","",$folder);
	if ($folder=="Default") {$folder="";}
	$folder = rtrim($folder, "/");

	$page_width=500;

	if (frm("del")) {
		$del=frm("del");
		$del = rtrim($del, "/");
		$del = str_replace("..","",$del);
		$del = str_replace("//","",$del);
		$tmp="../".$folder."/".$del;
		if (file_exists($tmp)){
			$fileExt=trim(substr($del,strpos($del,".")+1));
        	$extOK=0;
			for ($i=0;$i<sizeof($acceptUploadExt);$i++) {
				if (strtoupper($acceptUploadExt[$i])==strtoupper($fileExt)) {$extOK=1; break;}
			}
			if ($extOK) {unlink($tmp);}
		}
	}
?>
<table class="dtt" width="<?=$page_width?>" cellspacing="0" cellpadding="10">
<tr><td class="title">&nbsp;<b>Folder: &nbsp;/ <?=str_replace("/"," / ",$folder)?></b></td></tr>
</table>
<table class="dtt innertable" width="<?=$page_width?>" cellspacing="0" cellpadding="3">
	<tr><td class="tdl">
	<table cellpadding="4" cellspacing="0" width="100%" border="0">
	<?php /*---------------------------------------------------------------*/ ?>
	<?php
		$upload_path = "ul_path";
		$target_field = "path";
		$upload_label = "File";

		$maxFileSize = 1024*1024*1;
		$maxFileSizeStr = "1MB";
		//$acceptUploadExt = array("doc","rtf","pdf","txt","jpg","png","gif");
		$uploadFolderPrefix = $basef.$folder.($folder!="" ? "/":"");

//echo $uploadFolderPrefix; exit;

		if (isset($_FILES) && isset($_FILES[$upload_path]['tmp_name']) && is_uploaded_file($_FILES[$upload_path]['tmp_name'])) {
			$fileName = $_FILES[$upload_path]['name'];
			$fileExt = strtolower(substr($fileName,strrpos($fileName,".")+1));
			$filePfx = strtolower(substr($fileName,0,strrpos($fileName,".")));
			if ($_FILES[$upload_path]['size'] > $maxFileSize) {
				$error.=epfx($error,$upload_label." uploaded file size is too large (max ".$maxFileSizeStr.").");
				unlink($_FILES[$upload_path]['tmp_name']);}
			else{
				$extOK=0;
				$acceptUploadStr="";
				for ($i=0;$i<sizeof($acceptUploadExt);$i++) {
					$acceptUploadStr.=($acceptUploadStr=="" ? "":", ").strtoupper($acceptUploadExt[$i]);
					if (strtoupper($acceptUploadExt[$i])==strtoupper($fileExt)) {$extOK=1; break;}
				}
				if (!$extOK) {
					$error.=epfx($error,$upload_label." only ".$acceptUploadStr." allowed (uploaded: ".$fileExt.").");
    				unlink($_FILES[$upload_path]['tmp_name']);
				}
				else{
					$imagepath="";

					if (isset($randomizeName) && $randomizeName) {
						$lpcount=0;
						while ($lpcount<50){
							$rnd=rnd(16);
							$imagepath=$uploadFolderPrefix.$rnd.".".$fileExt;
							$lpcount++;
							if (!file_exists($imagepath)) {break;}
						}
					}
					else {$imagepath=$uploadFolderPrefix.$filePfx.".".$fileExt;}

					$p[$target_field] = $imagepath;
					if(copy($_FILES[$upload_path]['tmp_name'],$imagepath)) {
						unlink($_FILES[$upload_path]['tmp_name']);
						$update="File successfully uploaded";
					} else {
						// print_r(error_get_last()); // print last error
						$error.=epfx($error, "File is not uploaded");
					}
					// copy($_FILES[$upload_path]['tmp_name'],$imagepath);
					// unlink($_FILES[$upload_path]['tmp_name']);
					// $update="File successfully uploaded";
				}
			}
		}
	?>
	<form method="post" action="flookup.php?folder=<?=$folder?>&fmn=<?=frm('fmn')?>" enctype="multipart/form-data">
	<input type="hidden" name="fmn" value="<?=frm('fmn')?>"/>
	<?php
		if ((isset($error) && $error!="") || (isset($update) && $update!="")) { ?>
			<tr><td colspan='3'>
			<table border="0" cellpadding="10">
			<tr><td <?=(isset($error) && $error!="" ? "class=\"red bgyellow\"":"")?>><b><?=$error?></b></td></tr>
			<tr><td <?=(isset($update) && $update!="" ? "class=\"green bgblue\"":"")?>><b><?=$update?></b></td></tr>
			</table>
			</td></tr>
		<?php }
	?>
	<tr><td colspan="3" align="center"><b>Add File: </b><input size="10" type="file" name="ul_path" /> <input type="submit" value="Upload" /></td></tr>
	</form>
	<?php /*---------------------------------------------------------------*/ ?>
	<?php
		$zcount=0;
		$f = scandir2($basef.$folder);
		//print_r($f);
		$up = substr($folder,0,strrpos($folder,"/"));
		if ($up=="") $up="Default";
		if ($folder!="") {
			$imgIcon = "folder_up.gif";
			?><tr onmouseover="m_on(this);" onmouseout="m_off(this);">
				 <td width="30"><a href="flookup.php?fmn=<?=frm('fmn')?>&folder=<?=$up?>"><img alt="up" src="<?=$imgIcon?>" /></a>
				  <td class="l"><a href="flookup.php?fmn=<?=frm('fmn')?>&folder=<?=$up?>">(Parent folder)</a>
				  <td>&nbsp;</tr><?php
		}

		for ($i=0;$i<sizeof($f);$i++){
			if ($f[$i]=="." || $f[$i]=="..") continue;
			if (is_dir($basef.$folder."/".$f[$i])){
				$imgIcon = "folder.gif";
				?><tr onmouseover="m_on(this);" onmouseout="m_off(this);">
					 <td width="30"><a href="flookup.php?fmn=<?=frm('fmn')?>&folder=<?=($folder=="" ? "":$folder."/").$f[$i]?>"><img alt="file" src="<?=$imgIcon?>" /></a>
					  <td class="l"><a href="flookup.php?fmn=<?=frm('fmn')?>&folder=<?=($folder=="" ? "":$folder."/").$f[$i]?>"><?=$f[$i]?></a>
					  <td>&nbsp;</tr><?php
			}
		}
		for ($i=0;$i<sizeof($f);$i++){
			if (is_dir($basef.($folder ? $folder."/":"").$f[$i]) || $f[$i]=="." || $f[$i]=="..") continue;
			$imgExt = strtolower(substr($f[$i],strrpos($f[$i],".")+1));
			$imgPath = $basef.($folder=="" ? "":$folder."/").$f[$i];

			$imgIcon = "f_other.gif";
			if ($imgExt=="gif" || $imgExt=="png" || $imgExt=="bmp") {$imgIcon="f_img.gif";}
			if ($imgExt=="zip" || $imgExt=="rar" || $imgExt=="tar" || $imgExt=="gz")  {$imgIcon="f_zip.gif";}
			if ($imgExt=="doc" || $imgExt=="rtf") {$imgIcon="f_doc.gif";}
			if ($imgExt=="jpg") {$imgIcon="f_jpg.gif";}
			if ($imgExt=="pdf") {$imgIcon="f_pdf.gif";}
			if ($imgExt=="txt") {$imgIcon="f_txt.gif";}
			if ($imgExt=="swf") {$imgIcon="f_swf.gif";}

			?><tr onmouseover="m_on(this);" onmouseout="m_off(this);">
				 <td width="20"><a href="javascript:void(0)" onclick="var fld=opener.document.getElementById('imgxsrc-inp'); fld.value='../<?=($folder=="" ? "":$folder."/")?><?=$f[$i]?>'; fld.focus(); window.close();"><img alt="file" src="<?=$imgIcon?>" /></a>
				  <td class="l"><a href="javascript:void(0)" onclick="var fld=opener.document.getElementById('imgxsrc-inp'); fld.value='../<?=($folder=="" ? "":$folder."/")?><?=$f[$i]?>'; fld.focus(); window.close();"><?=$f[$i]?></a>
				  <td><i class="small">(<?=date('d-M-Y, h:i a',filemtime($imgPath))?>)</i>
				  <td><i class="small"><a href='flookup.php?fmn=<?=frm('fmn')?>&folder=<?=$folder?>&del=<?=$f[$i]?>' style='color:red'>Delete</a></i>
				  	</tr><?php
		}
	?>
	<tr><td class="tdm" colspan="3"><br><input type="button" value="Close" onclick="<?=(frm('fmn') ? "window.location.href='home.php';":"window.close();");?>"/>
	</table>
	<tr><td>&nbsp;
</table>

</body>
</html>
