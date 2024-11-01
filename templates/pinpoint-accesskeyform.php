
<form name="frm-pin-point-accesskey" method="post" action="<?php echo esc_url( admin_url( '/admin.php?page=pin-point-store-locator') ); ?>">
	<input type="hidden" name="pinpoint_cmd" value="pinpoint_key" />
	<h2>What is first?</h2>
	<p>
		You have to <a href="https://www.pinpointstorelocator.com/pricing/" target="_blank">register your account</a> first, get required Access Key from <strong><a href="https://www.pinpointstorelocator.com/" target="_blank">Pin Point Store Locator Software</a></strong> and save them bellow.
	</p>
	<table class="form-table" role="presentation">
		<tbody>
			<tr>
				<th scope="row">
					<label for="pin_point_access_key">Access Key</label></th>
				<td>
					<input type="text" name="pin_point_access_key" class="regular-text" id="pin_point_access_key" value="<?php echo $pinPointAccessKey; ?>" autocomplete="off" />
				</td>
			</tr>
			<?php
			if(trim($pinPointAccessKey) != ""){
				?>
				<tr>
					 
					<td colspan="2">
						Insert <strong>[PIN_POINT_STORE_LOCATOR]</strong> shortcode in your post/page content to show PinPoint Store Locator software on your frontend.
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<p class="submit">
		<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">&nbsp;&nbsp;<input type="button" value="Cancel" class="button button-primary" onclick="javascript:location.href='<?php echo esc_url( admin_url( '/admin.php?page=pin-point-store-locator') ); ?>'">
	</p>
</form> 