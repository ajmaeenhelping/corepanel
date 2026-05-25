<?php
$page_title = "Category Details";
$sql_table = "cat";
$edit_column = "code";
require_once "__config.php";
?>
<?php require_once $lib_base . "header.lib"; ?>
<?php
$p_flux = array(
	//list			name				type				check
	"id",			"",					"",					"",
	"code",			"Code",				"textx_30",			"requq",
	"name",			"Name",				"text_30",			"req",
);
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php require_once $lib_base . "sqlbasic.lib"; ?>
<?php require_once $lib_base . "menu.lib"; ?>
<?php require_once $lib_base . "subheader.lib"; ?>
<?php require_once $lib_base . "frmbasic.lib"; ?>
<?php require_once $lib_base . "subfooter.lib"; ?>
<?php
// Products linked to this category — only when editing an existing record
if ($id != "") {
	$cat_id = cint($id);
	$rs = mq("SELECT id, slug, name, price, stock FROM product WHERE cat_id=" . $cat_id . " ORDER BY name");
	$rows = array();
	while ($r = mfa($rs)) { $rows[] = $r; }
?>
<div style="margin-top:24px; background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:18px 20px;">
	<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
		<h3 style="margin:0; font-size:15px; font-weight:600; color:#0f172a;">
			Products in this category
			<span style="color:#64748b; font-weight:400;">(<?php echo sizeof($rows); ?>)</span>
		</h3>
		<a href="product_info.php?cat_id=<?php echo $cat_id; ?>"
		   style="background:#0f172a; color:#fff; padding:6px 12px; border-radius:6px; font-size:13px; text-decoration:none;">
			+ Add product
		</a>
	</div>
<?php if (sizeof($rows) == 0) { ?>
	<p style="margin:0; color:#64748b; font-size:13px;">No products linked to this category yet.</p>
<?php } else { ?>
	<table cellspacing="0" cellpadding="0" style="width:100%; font-size:13px; border-collapse:collapse;">
		<thead>
			<tr style="background:#f8fafc; color:#475569; text-align:left;">
				<th style="padding:8px 10px; border-bottom:1px solid #e2e8f0;">Slug</th>
				<th style="padding:8px 10px; border-bottom:1px solid #e2e8f0;">Name</th>
				<th style="padding:8px 10px; border-bottom:1px solid #e2e8f0; text-align:right;">Price</th>
				<th style="padding:8px 10px; border-bottom:1px solid #e2e8f0; text-align:right;">Stock</th>
			</tr>
		</thead>
		<tbody>
<?php foreach ($rows as $row) { ?>
			<tr>
				<td style="padding:8px 10px; border-bottom:1px solid #f1f5f9;">
					<a href="product_info.php?id=<?php echo cint($row[0]); ?>" style="color:#0ea5e9; text-decoration:none;">
						<?php echo hsc($row[1]); ?>
					</a>
				</td>
				<td style="padding:8px 10px; border-bottom:1px solid #f1f5f9;"><?php echo hsc($row[2]); ?></td>
				<td style="padding:8px 10px; border-bottom:1px solid #f1f5f9; text-align:right;"><?php echo number_format(cdbl($row[3]), 2); ?></td>
				<td style="padding:8px 10px; border-bottom:1px solid #f1f5f9; text-align:right;"><?php echo cint($row[4]); ?></td>
			</tr>
<?php } ?>
		</tbody>
	</table>
<?php } ?>
</div>
<?php } ?>
<?php require_once $lib_base . "footer.lib"; ?>
