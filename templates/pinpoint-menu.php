<?php
$settingUrl = esc_url( admin_url( '/admin.php?page=pin-point-store-locator&spage=settings') );
$storeListsUrl = esc_url( admin_url( '/admin.php?page=pin-point-store-locator&spage=lists') );
$newStoreUrl = esc_url( admin_url( '/admin.php?page=pin-point-store-locator&spage=addnew') );
?>
<div class="pinpoint-menu">
	<div style="float: right">
	<a href="<?php echo $newStoreUrl; ?>">Add New Store</a>&nbsp;|&nbsp;<a href="<?php echo $storeListsUrl; ?>">Store Lists</a>&nbsp;|&nbsp;<a href="<?php echo $settingUrl; ?>">Settings</a>
	</div>
	<div style="clear: both;"></div>
</div>