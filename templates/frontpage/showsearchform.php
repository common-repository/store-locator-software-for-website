<?php 
$data = array(
    'access_key' => $pinPointAccessKey,
    'cmd' => 'get-settings'
);
$returnData = getPinPointLocatorData($data);
?>
<div class="pinpoint_frontcontainer" style="position: relative;">
	<div id="pinpoint_overlaycontainer"></div>
	<div id="pinpoint_loader">
		<img src="<?php echo PINPOINT_LOADER_URL; ?>" alt="Please Wait..." title="Please Wait..." />
	</div>
	<?php
	if($returnData->status == "error" && $returnData->statuscode == "001"){
		?>
		<div class="pinpoint_error">
			Invalid PinPoint Store Locator Software Access Key.
		</div>
		<?php
	}else{		
		?>
		<div class="pinpoint_searchformcontainer" style="font-family: <?php echo $returnData->storedata->overfontfamily; ?>;font-size:<?php echo $returnData->storedata->overfontsize; ?>px; background: <?php echo $returnData->storedata->overbgcolor; ?>;color:<?php echo $returnData->storedata->overfontcolor; ?>;font-style:<?php echo $returnData->storedata->overfontstyle; ?>;font-weight: <?php echo $returnData->storedata->overfontweight; ?>;">
			<div class="pinpoint_locatortitle" style="font-family: <?php echo $returnData->storedata->storenamefontfamily; ?>;font-size:<?php echo $returnData->storedata->storenamefontsize; ?>px;color:<?php echo $returnData->storedata->storenamefontcolor; ?>;font-style:<?php echo $returnData->storedata->storenamefontstyle; ?>;font-weight: <?php echo $returnData->storedata->storenamefontweight; ?>; ">
				<?php echo $returnData->storedata->storeTitle; ?>
			</div>
			<div id="pinpoint_frontdatacontainer">
				<div class="pinpoint_fieldcontainer">
					<label for="txtpinpoint_zipcocde" class="pinpoint_fieldname">
						<?php echo $returnData->storedata->storeZipcode; ?> : 
					</label>
					<div class="pinpoint_fieldcontrol">
						<input type="text" name="txtpinpoint_zipcocde" id="txtpinpoint_zipcocde" value="" />
					</div>
					<div class="pinpoint_fieldclear"></div>
				</div>
				<?php
				if($returnData->storedata->showStoreMiles == 1){
					?>
					<div class="pinpoint_fieldcontainer">
						<label for="txtpinpoint_miles" class="pinpoint_fieldname">
							<?php echo $returnData->storedata->showStoreMilesTitle; ?> : 
						</label>
						<div class="pinpoint_fieldcontrol">
							<input type="text" name="txtpinpoint_miles" id="txtpinpoint_miles" value="" />
						</div>
						<div class="pinpoint_fieldclear"></div>
					</div>
					<?php
				}
				?>
				<div class="pinpoint_fieldcontainer">
					<label class="pinpoint_fieldname">
						&nbsp;
					</label>
					<div class="pinpoint_fieldcontrol">
						<button type="button" id="pinpoint_searchgo" class="btn btn-success"><?php echo $returnData->storedata->showStoreSearchText; ?></button>
					</div>
					<div class="pinpoint_fieldclear"></div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>