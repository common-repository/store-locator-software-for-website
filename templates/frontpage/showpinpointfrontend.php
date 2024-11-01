<?php
	$pinPointAccessKey = get_option('pin_point_access_key');
	include_once(PINPOINT_PLUGIN_PATH."library/pinpoint-actions.php");
	
	if($pinPointAccessKey == ""){
		include_once(PINPOINT_PLUGIN_PATH."templates/frontpage/nopinpointkeyfound.php");
	}else{
		include_once(PINPOINT_PLUGIN_PATH."templates/frontpage/showsearchform.php");
	}
?>