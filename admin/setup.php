<?php
$page_title = "Setup";
$sql_table = "";
$req_pm = "isadmin";
$edit_column = "";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>

<br><br>
<table width="100%">
	<tr>
		<td class='r'><input type="button" class="b btn-4 bg-primary" onclick="go('employee.php');" value="Employees" /></td>
		<td class='l' style='padding-left:10px;'>Manage System Users</td>
	</tr>
	<tr>
		<td class='r'><input type="button" class="b btn-4 bg-primary" onclick="go('setup2.php');" value="General" /></td>
		<td class='l' style='padding-left:10px;'>Manage General Settings</td>
	</tr>
</table>
<br><br>&nbsp;
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>