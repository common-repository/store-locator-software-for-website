<?php
$performAction = trim(sanitize_text_field($_POST['performaction']));//performaction
include_once(PINPOINT_PLUGIN_PATH."library/pinpoint-server.php");
$pinPointAccessKey = get_option('pin_point_access_key');
if($performAction == "search"){
	$pinpointPostCode = trim(sanitize_text_field($_POST['pinpointpostcode']));
	$pinpointMiles = trim(sanitize_text_field($_POST['pinpointmiles']));
	if(trim($pinpointPostCode) == ""){
		$pinpointError = "yes";
		?>
		<div class="pinpoint_error">
			Please enter zipcode
		</div>
		<div class="pinpoint_resetbtncontainer">
			<button id="pinpoint_reset" type="button" class="btn btn-success" title="Back to Search">&lt;&lt;Back</button>
		</div>
		<?php
	}else{

		$data = array(
		    'access_key' => $pinPointAccessKey,
		    'cmd' => 'get-searchresult',
		    'zipcode' => $pinpointPostCode,
		    'miles'=> $pinpointMiles
		);
		$returnData = getPinPointLocatorData($data);
		if($returnData->status == "error" &&  $returnData->statuscode == "002"){
			?>
			<div class="pinpoint_error">
				<?php echo $returnData->message; ?>
			</div>
			<div class="pinpoint_resetbtncontainer">
				<button id="pinpoint_reset" type="button" class="btn btn-success" title="Back to Search">&lt;&lt;Back</button>
			</div>
			<?php
		}else if($returnData->status == "error" &&  $returnData->statuscode == "003"){
			?>
			<div class="pinpoint_error">
				<?php echo $returnData->message; ?>
			</div>
			<div class="pinpoint_resetbtncontainer">
				<button id="pinpoint_reset" type="button" class="btn btn-success" title="Back to Search">&lt;&lt;Back</button>
			</div>
			<?php
		}else if($returnData->status == "success" &&  $returnData->statuscode == "009"){
			$totalStoreFound = $returnData->totalstores;
			$storesData = $returnData->storedatas;
 
			$resultListBg = $returnData->settings->resultlistbgcolor;
			$resultOddRow = $returnData->settings->oddrowbg;
			$resultEvenRow = $returnData->settings->evenrowbg;
			?>
			<div style="padding: 10px 13px;">
				<a href="javascript:void(0)" onclick="javascript:backToPinpointSearch()" title="Back to Search">&lt;&lt;Back to Search</a>
			</div>
			<div style="color: #155724; background-color: #d4edda; border:1px solid #c3e6cb;padding: 10px 13px;">
				<strong><?php echo $returnData->totalstores; ?></strong>
			</div>
			<div style="background: <?php echo $resultListBg; ?>;padding:10px;max-height: 460px;overflow-y: auto;">
				<?php
				for($s = 0; $s < count($storesData); $s++){
					?>
					<div id="pinpointrow_<?php echo $s; ?>" class="pinpoint_storelistsrow" style="cursor:pointer;background: <?php if($s % 2 == 0){ echo $resultEvenRow; }else{ echo $resultOddRow; } ?>; padding:5px 7px; margin-bottom: 5px;border-radius:4px;">
						<input type="hidden" id="txtpinpointrow_<?php echo $s; ?>" value="<?php echo $storesData[$s]->storeId; ?>" /> 
						<div><strong><?php echo $storesData[$s]->storeTitle; ?></strong></div>
						<div><?php echo $storesData[$s]->storeAddressInfo1; ?></div>
						<div><?php echo $storesData[$s]->storeAddressInfo2; ?></div>
						<div><span>Phone:</span> <?php echo $storesData[$s]->storePhone; ?></div>
						<div><span>Distance:</span> <?php echo $storesData[$s]->storeDistance; ?></div>						
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		
	}
}else if($performAction == "resultdetails"){
	$pinStoreId = trim(sanitize_text_field($_POST['pinpointstoreid']));

	$data = array(
	    'access_key' => $pinPointAccessKey,
	    'cmd' => 'resultdetails',
	    'storeId'=> $pinStoreId
	);
	$returnData = getPinPointLocatorData($data);
	if($returnData->status == "error" &&  $returnData->statuscode == "001"){
		?>
		<div class="pinpoint_error">
			<?php echo $returnData->message; ?>
		</div>
		<div class="pinpoint_resetbtncontainer">
			<button id="pinpoint_reset" type="button" class="btn btn-success" title="Back to Search">&lt;&lt;Back</button>
		</div>
		<?php
	}else if($returnData->status == "error" &&  $returnData->statuscode == "004"){
		?>
		<div class="pinpoint_error">
			<?php echo $returnData->message; ?>
		</div>
		<div class="pinpoint_resetbtncontainer">
			<button type="button" class="btn btn-success" onclick="javascript:backToPinpointResultList()" title="Back to Results">&lt;&lt;Back</button>
		</div>
		<?php
	}else if($returnData->status == "success" &&  $returnData->statuscode == "010"){
		?>
		<div style="padding: 10px 13px;">
			<a href="javascript:void(0)" onclick="javascript:backToPinpointResultList()" title="Back to Results">&lt;&lt;Back to Results</a>
		</div>
		<div style="background: <?php echo $returnData->storeSettings->resultlistbgcolor; ?>;padding: 5px;">
			<div class="pinstore_title">
				<strong><?php echo $returnData->storeData->storeName; ?></strong>
			</div>
			<div class="pinstore_address1"><?php echo $returnData->storeData->storeAddress1; ?></div>
			<div class="pinstore_address2"><?php echo $returnData->storeData->storeAddress2; ?></div>
			<?php if(trim($returnData->storeData->telephone) != ""){ ?>
				<div class="pinstore_phone"><span>Phone: </span> <?php echo $returnData->storeData->telephone; ?></div>
				<?php
			}
			if(trim($returnData->storeData->fax) != ""){
				?>
				<div class="pinstore_fax"><span>Fax: </span> <?php echo $returnData->storeData->fax; ?></div>
				<?php
			}
			if(trim($returnData->storeData->fax) != ""){
				?>
				<div class="pinstore_email"><span>Email: </span> <a href="mailto:<?php echo $returnData->storeData->email; ?>"><?php echo $returnData->storeData->email; ?></a></div>
				<?php
			}
			if(trim($returnData->storeData->fax) != ""){
				?>
				<div class="pinstore_website"><span>Website: </span> <a href="<?php echo $returnData->storeData->website; ?>" target="_blank"><?php echo $returnData->storeData->website; ?></a></div>
				<?php
			}
			?>
		</div>
		<?php
	}

}
?>