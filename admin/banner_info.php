<?php
	$page_title = "Banner Details";
	$sql_table = "banner";
	$edit_column = "name";
	require_once "__config.php";
?>
<?php require_once $lib_base."header.lib"; ?>
<?php
	$p_flux = array(
		//list			name				type				check
		"id",			"",					"",					"",
		"name",			"Name",				"text_30",			"requq",
		"image",		"Image",			"upload_image_200",	"req",
	);
	$multipart=1;
?>
<?php require_once $lib_base."mergei.lib"; ?>
<?php
	$folder_path="uploads/";
	$photos=array("image");
	$photos_label=array("Image");

	require_once $lib_base."preparam.lib";
	$id = $p[$p_list[0]];
	$uploadFolderPrefix = $folder_path;
	$uploadAbsolutePrefix = __DIR__ . "/" . $folder_path; // absolute path for file writes
	if($submitted){
		if (!frmp("nosubmit")){
			require_once $lib_base."validation.lib";

			// set max file size, extension
			$maxFileSize = 1024*1024*4;
			$maxFileSizeStr = "1MB";
			$acceptUploadExt = array("jpg","png","jpeg");

			$randomizeName = 1;
			// validate photos
			for ($l=0; $l < sizeof($photos); $l++) {
				if ($validated){
					$upload_path = "ul_".$photos[$l];
					$target_field = $photos[$l];
					$upload_label = $photos_label[$l];
					require $lib_base."fileupload.lib";
					if (strpos($p_check[$p_key[$photos[$l]]],"req")!==false && $p[$photos[$l]]=="") {$error.=epfx($error,$photos[$l]." cannot be blank");}
					if ($error!="") {$validated=0;break;}
				}
			}

			if ($validated){
				if ($id=="") {require $lib_base."sqlinsert.lib";}
				else {require $lib_base."sqlupdate.lib";}
				set("update","Record successfully ".$action);
				//exit;
				go($next_file);
			}
		}
	}
	else if ($id!="") {require $lib_base."sqlselect.lib";}
?>
<?php require_once $lib_base."menu.lib"; ?>
<?php require_once $lib_base."subheader.lib"; ?>
<?php require_once $lib_base."frmbasic.lib"; ?>
<?php require_once $lib_base."subfooter.lib"; ?>
<?php require_once $lib_base."footer.lib"; ?>