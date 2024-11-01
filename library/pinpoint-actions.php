<?php
include_once(PINPOINT_PLUGIN_PATH."library/pinpoint-server.php");
if(isset($_POST)){
	global $pinPointFullPageURL;
	if(sanitize_text_field($_POST['pinpoint_cmd']) && trim(sanitize_text_field($_POST['pinpoint_cmd'])) == "pinpoint_key"){
		$accessKey = trim(sanitize_text_field($_POST['pin_point_access_key']));
		if($accessKey == ""){
			$type = 'error';
        	$message = __( 'Please enter valid Pin Point Store Locator Access Key', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}else{
			$data = array(
			    'access_key' => $accessKey,
			    'cmd' => 'validate-key'
			);
			$returnData = getPinPointLocatorData($data);

			if($returnData->status == "error"){
				$type = 'error';
	        	$message = __( 'Invalid Pin Point Store Locator Software Access Key', 'my-text-domain' );
				add_settings_error(
			        'myUniqueIdentifyer',
			        esc_attr( 'settings_updated' ),
			        $message,
			        $type
			    );
			}else{
				update_option( 'pin_point_access_key', $accessKey );

				$type = 'success';
	        	$message = __( 'Access Key saved.', 'my-text-domain' );
				add_settings_error(
			        'myUniqueIdentifyer',
			        esc_attr( 'settings_updated' ),
			        $message,
			        $type
			    );
			}
		}
	}
	else if(sanitize_text_field($_POST['pinpoint_cmd']) && trim(sanitize_text_field($_POST['pinpoint_cmd'])) == "pinpoint_addstore"){
		$pinPointAccessKey = get_option('pin_point_access_key');
		$pinStoreName = trim(sanitize_text_field($_POST['txtpin-storename']));
		$pinStoreAddress = trim(sanitize_text_field($_POST['txtpin-storeaddress']));
		$pinStoreCity = trim(sanitize_text_field($_POST['txtpin-storecity']));
		$pinStoreState = trim(sanitize_text_field($_POST['txtpin-storestate']));
		$pinStoreCountry = trim(sanitize_text_field($_POST['txtpin-storecountry']));
		$pinStoreZipcode = trim(sanitize_text_field($_POST['txtpin-storezipcode']));
		$pinStorePhone = trim(sanitize_text_field($_POST['txtpin-storetelephone']));
		$pinStoreFax = trim(sanitize_text_field($_POST['txtpin-storefax']));
		$pinStoreEmail = trim(sanitize_text_field($_POST['txtpin-storeemail']));
		$pinStoreWebsite = trim(sanitize_text_field($_POST['txtpin-storewebsite']));
		$pinStoreHidden = trim(sanitize_text_field($_POST['txtpin-storehidden']));
		$pinStorePublish = trim(sanitize_text_field($_POST['txtpin-storepublish']));

		$storeData = array(
			'storeName' =>$pinStoreName,
			'storeAddress'=>$pinStoreAddress,
			'storeCity'=>$pinStoreCity,
			'storeState'=>$pinStoreState,
			'storeCountry'=>$pinStoreCountry,
			'storeZipcode'=>$pinStoreZipcode,
			'storePhone'=>$pinStorePhone,
			'storeFax'=>$pinStoreFax,
			'storeEmail'=>$pinStoreEmail,
			'storeWebsite'=>$pinStoreWebsite,
			'storeHidden'=>$pinStoreHidden,
			'storePublish'=>$pinStorePublish
		);
		$jsonData = array(
			'access_key' => $pinPointAccessKey,
	    	'cmd' => 'add_new_store',
	    	'storedata'=>$storeData
		);
		$returnData = getPinPointLocatorData($jsonData);
		if($returnData->status == "error" && $returnData->statuscode == "001"){
			$type = 'error';
        	$message = __( 'Please enter valid Pin Point Store Locator Software Access Key', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}else if($returnData->status == "success" && $returnData->statuscode == "004"){
			$type = 'success';
        	$message = __( 'Your Store has been saved successfully', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}
		$pageArray = explode("?", $pinPointFullPageURL);
		$newPageURL = $pageArray[0]."?page=pin-point-store-locator&spage=lists";
		?>
		<script>
			location.href = '<?php echo $newPageURL; ?>';
		</script>
		<?php
		die;
	}
	else if(sanitize_text_field($_POST['pinpoint_cmd']) && trim(sanitize_text_field($_POST['pinpoint_cmd'])) == "pinpoint_deletestore")
	{
		$pinPointAccessKey = get_option('pin_point_access_key');
		$storeId = trim(sanitize_text_field($_POST['pinpoint_storeid']));
		$jsonData = array(
			'access_key' => $pinPointAccessKey,
	    	'cmd' => 'delete_store',
	    	'storeid'=>$storeId
		);
		$returnData = getPinPointLocatorData($jsonData);
		if($returnData->status == "error" && $returnData->statuscode == "001"){
			$type = 'error';
        	$message = __( 'Please enter valid Pin Point Store Locator Software Access Key', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}else if($returnData->status == "success" && $returnData->statuscode == "005"){
			$type = 'success';
        	$message = __( 'Your Store has been deleted successfully', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}
	}
	else if(sanitize_text_field($_POST['pinpoint_cmd']) && trim(sanitize_text_field($_POST['pinpoint_cmd'])) == "pinpoint_updatestore")
	{
		$pinPointAccessKey = get_option('pin_point_access_key');
		$pinStoreId = trim(sanitize_text_field($_POST['pinpoint_storeid']));
		$pinStoreName = trim(sanitize_text_field($_POST['txtpin-storename']));
		$pinStoreAddress = trim(sanitize_text_field($_POST['txtpin-storeaddress']));
		$pinStoreCity = trim(sanitize_text_field($_POST['txtpin-storecity']));
		$pinStoreState = trim(sanitize_text_field($_POST['txtpin-storestate']));
		$pinStoreCountry = trim(sanitize_text_field($_POST['txtpin-storecountry']));
		$pinStoreZipcode = trim(sanitize_text_field($_POST['txtpin-storezipcode']));
		$pinStorePhone = trim(sanitize_text_field($_POST['txtpin-storetelephone']));
		$pinStoreFax = trim(sanitize_text_field($_POST['txtpin-storefax']));
		$pinStoreEmail = trim(sanitize_text_field($_POST['txtpin-storeemail']));
		$pinStoreWebsite = trim(sanitize_text_field($_POST['txtpin-storewebsite']));
		$pinStoreHidden = trim(sanitize_text_field($_POST['txtpin-storehidden']));
		$pinStorePublish = trim(sanitize_text_field($_POST['txtpin-storepublish']));

		$storeData = array(
			'storeId' => $pinStoreId,
			'storeName' =>$pinStoreName,
			'storeAddress'=>$pinStoreAddress,
			'storeCity'=>$pinStoreCity,
			'storeState'=>$pinStoreState,
			'storeCountry'=>$pinStoreCountry,
			'storeZipcode'=>$pinStoreZipcode,
			'storePhone'=>$pinStorePhone,
			'storeFax'=>$pinStoreFax,
			'storeEmail'=>$pinStoreEmail,
			'storeWebsite'=>$pinStoreWebsite,
			'storeHidden'=>$pinStoreHidden,
			'storePublish'=>$pinStorePublish
		);
		$jsonData = array(
			'access_key' => $pinPointAccessKey,
	    	'cmd' => 'update_store',
	    	'storedata'=>$storeData
		);
		$returnData = getPinPointLocatorData($jsonData);
		
		if($returnData->status == "error" && $returnData->statuscode == "001"){
			$type = 'error';
        	$message = __( 'Please enter valid Pin Point Store Locator Software Access Key', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}else if($returnData->status == "success" && $returnData->statuscode == "007"){
			$type = 'success';
        	$message = __( 'Your Store has been updated successfully', 'my-text-domain' );
			add_settings_error(
		        'myUniqueIdentifyer',
		        esc_attr( 'settings_updated' ),
		        $message,
		        $type
		    );
		}

		$pageArray = explode("?", $pinPointFullPageURL);
		$newPageURL = $pageArray[0]."?page=pin-point-store-locator&spage=lists";
		?>
		<script>
			location.href = '<?php echo $newPageURL; ?>';
		</script>
		<?php
		die;
	}
}


function pagination($page, $prev, $next, $lastpage, $lmp1, $pageURL){
	$adjacents = 2;

	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<nav style=\"margin:0px auto; text-align:center;\"><ul class=\"pagination1 pagination-lg\">";
		//previous button
		if ($page > 1) {
			if($prev == 1){
				$pagination.= "<li><a href=\"".$pageURL."/\" title=\"Page - $prev\">&laquo;</a></li>";
			}else{
				$pagination.= "<li><a href=\"".$pageURL."&cpage=".$prev."\" title=\"Page - $prev\">&laquo;</a></li>";
			}
		}
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					if($counter == 1){
						$pagination.= "<li class=\"active\"><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";
					}else{
						$pagination.= "<li class=\"active\"><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";
					}
				}
				else{
					if($counter == 1){
						$pagination.= "<li><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";
					}else{
						$pagination.= "<li><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";					
					}
				}
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page){
						if($counter == 1){
							$pagination.= "<li class=\"active\"><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";	
						}else{
							$pagination.= "<li class=\"active\"><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";
						}
					}
					else{
						if($counter == 1){
							$pagination.= "<li><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";
						}else{
							$pagination.= "<li><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";					
						}
					}
				}
				$pagination.= "<li><span>...</span></li>";
				$pagination.= "<li><a href=\"".$pageURL."&cpage=".$lmp1."\" title=\"Page - $lmp1\">$lmp1</a></li>";
				$pagination.= "<li><a href=\"".$pageURL."&cpage=".$lastpage."\" title=\"Page - $lastpage\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"".$pageURL."&cpage=1\" title=\"Page - 1\">1</a></li>";
				$pagination.= "<li><a href=\"".$pageURL."&cpage=2\" title=\"Page - 2\">2</a></li>";
				$pagination.= "<li>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page){
						if($counter == 1){
							$pagination.= "<li class=\"active\"><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";
						}else{
							$pagination.= "<li class=\"active\"><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\"'>$counter</a></li>";
						}
					}
					else{
						if($counter == 1){
							$pagination.= "<li><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";	
						}else{
							$pagination.= "<li><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";					
						}
					}
				}
				$pagination.= "<li><span>...</span></li>";
				$pagination.= "<li><a href=\"".$pageURL."&cpage=".$lmp1."\" title=\"Page - $lmp1\">$lmp1</a></li>";
				$pagination.= "<li><a href=\"".$pageURL."&cpage=".$lastpage."\" title=\"Page - $lastpage\">$lastpage</a></li>";			
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"".$pageURL."/\">1</a></li>";
				$pagination.= "<li><a href=\"".$pageURL."&cpage=2\">2</a></li>";
				$pagination.= "<li><span>...</span></li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						if($counter == 1){
							$pagination.= "<li class=\"active\"><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";
						}else{
							$pagination.= "<li class=\"active\"><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";
						}
					}
					else{
						if($counter == 1){
							$pagination.= "<li><a href=\"".$pageURL."\" title=\"Page - $counter\">$counter</a></li>";	
						}else{
							$pagination.= "<li><a href=\"".$pageURL."&cpage=".$counter."\" title=\"Page - $counter\">$counter</a></li>";					
						}
					}
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) {
			$pagination.= "<li><a href=\"".$pageURL."&cpage=".$next."\" title=\"Page - $next\">&raquo;</a></li>";
		}
		$pagination.= "</ul></nav>\n";		
	}
	return $pagination;
}
?>