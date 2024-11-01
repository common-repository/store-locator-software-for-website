<div>
	<h2>Edit Store</h2>
	<?php
	$sendRequest = array(
	    'access_key' => $pinPointAccessKey,
	    'cmd' => 'country-lists'
	);
	$countryListsData = getPinPointLocatorData($sendRequest);
	$myCountry = $countryListsData->countrylists;

	$sendRequest = array(
	    'access_key' => $pinPointAccessKey,
	    'cmd' => 'store-info',
	    'storeid' => $sid
	);

	$storeInfo = getPinPointLocatorData($sendRequest);
	?>
	<form name="pinpointupdatestore" id="pinpointupdatestore" method="post">
		<input type="hidden" name="pinpoint_cmd" value="pinpoint_updatestore" />
		<input type="hidden" name="pinpoint_storeid" value="<?php echo $sid; ?>" />
		<div class="pinfieldcontainer">
			<label for="txtpin-storename" class="pinfieldname">
				Store name
			</label>
			<div class="pinfieldcontrol bigctrl">
				<input type="text" name="txtpin-storename" id="txtpin-storename" value="<?php echo $storeInfo->storedata->store_title; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storeaddress" class="pinfieldname">
				Store address
			</label>
			<div class="pinfieldcontrol bigctrl">
				<input type="text" name="txtpin-storeaddress" id="txtpin-storeaddress" value="<?php echo $storeInfo->storedata->store_address; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storecity" class="pinfieldname">
				Store City
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storecity" id="txtpin-storecity" value="<?php echo $storeInfo->storedata->store_city; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storestate" class="pinfieldname">
				Store State
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storestate" id="txtpin-storestate" value="<?php echo $storeInfo->storedata->store_state; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storecountry" class="pinfieldname">
				Store Country
			</label>
			<div class="pinfieldcontrol smallctrl">
				<?php
				$countryName = $storeInfo->storedata->store_country;
				?>
				<select name="txtpin-storecountry" id="txtpin-storecountry">
					<?php
					for($c = 0; $c < count($myCountry); $c++){
					?>
						<option value="<?php echo $myCountry[$c]->iso; ?>" <?php if($c==5){ ?>disabled<?php } ?> <?php if($countryName == $myCountry[$c]->iso){ ?>selected="selected"<?php } ?>><?php echo $myCountry[$c]->country; ?></option>
					<?php 
					}
					?>
				</select>
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storezipcode" class="pinfieldname">
				Store Zipcode
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storezipcode" id="txtpin-storezipcode" value="<?php echo $storeInfo->storedata->store_zipcode; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storetelephone" class="pinfieldname">
				Telephone
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storetelephone" id="txtpin-storetelephone" value="<?php echo $storeInfo->storedata->store_telephone; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storefax" class="pinfieldname">
				Fax
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storefax" id="txtpin-storefax" value="<?php echo $storeInfo->storedata->store_fax; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storeemail" class="pinfieldname">
				Email
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storeemail" id="txtpin-storeemail" value="<?php echo $storeInfo->storedata->store_email; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storewebsite" class="pinfieldname">
				Website
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storewebsite" id="txtpin-storewebsite" value="<?php echo $storeInfo->storedata->store_website; ?>" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storehidden" class="pinfieldname">
				Hidden
			</label>
			<?php
			$pinpointHidden = $storeInfo->storedata->store_hide;
			?>
			<div class="pinfieldcontrol smallctrl">
				<select name="txtpin-storehidden" id="txtpin-storehidden">
					<option value="0" <?php if($pinpointHidden == 0){ ?>selected="selected"<?php } ?>>No</option>
					<option value="1" <?php if($pinpointHidden == 1){ ?>selected="selected"<?php } ?>>Yes</option>
				</select>
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storepublish" class="pinfieldname">
				Publish Store
			</label>
			<?php
			$pinpointPublish = $storeInfo->storedata->store_approved;
			?>
			<div class="pinfieldcontrol smallctrl">
				<select name="txtpin-storepublish" id="txtpin-storepublish">
					<option value="1" <?php if($pinpointPublish == 1){ ?>selected="selected"<?php } ?>>Yes</option>
					<option value="0" <?php if($pinpointPublish == 0){ ?>selected="selected"<?php } ?>>No</option>					
				</select>
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label class="pinfieldname">
				&nbsp;
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="button" name="txtpin-savestore" id="txtpin-savestore" value="Update" onclick="javascript:checkPinpointAddStore()" />
				&nbsp;
				<input type="button" value="Cancel" onclick="javascript:history.back();" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

	</form>
	<script>
		function checkPinpointAddStore(){
			var pinStoreName = document.getElementById('txtpin-storename').value;
			var pinZipcode = document.getElementById('txtpin-storezipcode').value;
			var pinCountry = document.getElementById('txtpin-storecountry').value;

			if(pinStoreName.replace(/\s+/g,'') == ""){
				alert('Please enter valid Store Name');
				document.getElementById('txtpin-storename').value = '';
				document.getElementById('txtpin-storename').focus();
			}else if(pinCountry.replace(/\s+/g,'') == ""){
				alert('Please select valid Country Name');
				document.getElementById('txtpin-storecountry').value = '';
				document.getElementById('txtpin-storecountry').focus();
			}else if(pinZipcode.replace(/\s+/g,'') == ""){
				alert('Please enter valid Zipcode');
				document.getElementById('txtpin-storezipcode').value = '';
				document.getElementById('txtpin-storezipcode').focus();
			}else{
				document.pinpointupdatestore.submit();
			}
		}
	</script>
</div>