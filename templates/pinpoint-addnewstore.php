<div>
	<h2>Add a Store</h2>
	<?php
	$sendRequest = array(
	    'access_key' => $pinPointAccessKey,
	    'cmd' => 'country-lists'
	);
	$countryListsData = getPinPointLocatorData($sendRequest);
	$myCountry = $countryListsData->countrylists;
	?>
	<form name="pinpointnewstore" id="pinpointnewstore" method="post">
		<input type="hidden" name="pinpoint_cmd" value="pinpoint_addstore" />
		<div class="pinfieldcontainer">
			<label for="txtpin-storename" class="pinfieldname">
				Store name
			</label>
			<div class="pinfieldcontrol bigctrl">
				<input type="text" name="txtpin-storename" id="txtpin-storename" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storeaddress" class="pinfieldname">
				Store address
			</label>
			<div class="pinfieldcontrol bigctrl">
				<input type="text" name="txtpin-storeaddress" id="txtpin-storeaddress" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storecity" class="pinfieldname">
				Store City
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storecity" id="txtpin-storecity" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storestate" class="pinfieldname">
				Store State
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storestate" id="txtpin-storestate" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storecountry" class="pinfieldname">
				Store Country
			</label>
			<div class="pinfieldcontrol smallctrl">
				<select name="txtpin-storecountry" id="txtpin-storecountry">
					<?php
					for($c = 0; $c < count($myCountry); $c++){
					?>
						<option value="<?php echo $myCountry[$c]->iso; ?>" <?php if($c==5){ ?>disabled<?php } ?>><?php echo $myCountry[$c]->country; ?></option>
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
				<input type="text" name="txtpin-storezipcode" id="txtpin-storezipcode" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storetelephone" class="pinfieldname">
				Telephone
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storetelephone" id="txtpin-storetelephone" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storefax" class="pinfieldname">
				Fax
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storefax" id="txtpin-storefax" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storeemail" class="pinfieldname">
				Email
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storeemail" id="txtpin-storeemail" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storewebsite" class="pinfieldname">
				Website
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="text" name="txtpin-storewebsite" id="txtpin-storewebsite" value="" />
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storehidden" class="pinfieldname">
				Hidden
			</label>
			<div class="pinfieldcontrol smallctrl">
				<select name="txtpin-storehidden" id="txtpin-storehidden">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label for="txtpin-storepublish" class="pinfieldname">
				Publish Store
			</label>
			<div class="pinfieldcontrol smallctrl">
				<select name="txtpin-storepublish" id="txtpin-storepublish">
					<option value="1">Yes</option>
					<option value="0">No</option>					
				</select>
			</div>
			<div class="pinpoint-clear"></div>
		</div>

		<div class="pinfieldcontainer">
			<label class="pinfieldname">
				&nbsp;
			</label>
			<div class="pinfieldcontrol smallctrl">
				<input type="button" name="txtpin-savestore" id="txtpin-savestore" value="Save" onclick="javascript:checkPinpointAddStore()" />
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
				document.pinpointnewstore.submit();
			}
		}
	</script>
</div>