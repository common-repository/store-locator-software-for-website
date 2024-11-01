<div class="pinpoint_admin_container wrap">
	<h1>Pin Point Store Locator Software</h1>
	<?php
	include_once(PINPOINT_PLUGIN_PATH."library/pinpoint-actions.php");

	$pinPointAccessKey = get_option('pin_point_access_key');
	
	settings_errors(); 

	$sPage = "";
	if(sanitize_text_field($_GET['spage']) && trim(sanitize_text_field($_GET['spage'])) == "settings"){
		$sPage = "settings";
	}else if(sanitize_text_field($_GET['spage']) && trim(sanitize_text_field($_GET['spage'])) != ""){
		$sPage = trim(sanitize_text_field($_GET['spage']));
	}

	$sid = 0;
	if(sanitize_text_field($_GET['sid']) && trim(sanitize_text_field($_GET['sid'])) > 0 ){
		$sid = trim(sanitize_text_field($_GET['sid']));
	}
	
	if(trim(sanitize_text_field($pinPointAccessKey)) == "" || $sPage == "settings"){
		?>
		<div class="pinpointdatacontainer">
		<?php
		include_once(PINPOINT_PLUGIN_PATH."templates/pinpoint-accesskeyform.php");
		?>
		</div>
		<?php
	}else{ 
		include_once(PINPOINT_PLUGIN_PATH.'templates/pinpoint-menu.php');

		?>
		<div class="pinpointdatacontainer">
		<?php
		if($sPage == "addnew"){
			include_once(PINPOINT_PLUGIN_PATH.'templates/pinpoint-addnewstore.php');
		}else if($sPage == "editstore" && $sid > 0){
			include_once(PINPOINT_PLUGIN_PATH.'templates/pinpoint-editstore.php');
		}else{
			include_once(PINPOINT_PLUGIN_PATH.'templates/pinpoint-storelists.php');
		}
		?>
		</div>
		<?php
	}	
	?>
</div>