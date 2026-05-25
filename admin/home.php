<?php
$page_title = "Home";
$sql_table = "employee";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<style>
	.home-css {
		display: none;
	}

	.home-content {
		margin-left: 20px;
	}

	.bordered {
		border-radius: 10px;
	}
</style>
<?php require_once $lib_base . "menu.lib"; ?>

<?php require_once $lib_base . "subheader.lib"; ?>
<tr>
	<td>
		<div class="home-content">
			<h2 class="font-primary">Welcome to <?= $site_name . " " . $system_name ?></h2>

			<div class="bg-primary bordered">
				<table width="100%">
					<tr style="height: 60px;">
						<td width="70%" class="noti-title">You have <b>5 new paid order</b></td>
						<td width="30%" style="text-align: right;padding-right: 15px;"><a href="" class="btn btn-0 bgwhite font-primary">View Orders</a></td>
					</tr>
				</table>
			</div>
		</div>
	</td>
</tr>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php require_once $lib_base . "footer.lib"; ?>