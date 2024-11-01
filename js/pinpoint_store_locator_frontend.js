var pinpointSearchHTML = '';
var pinpointResultList = '';
jQuery(document).ready(function($) {
	$('#pinpoint_searchgo').live("click", function(){
		$('#pinpoint_overlaycontainer').css('display', 'block');
		$('#pinpoint_loader').css('display', 'block');
		var pinpointZipcode = document.getElementById('txtpinpoint_zipcocde').value;
		var pinpontMilesEle = document.getElementById('txtpinpoint_miles');
		var pinpointMiles = '';
		if(typeof(pinpontMilesEle) != 'undefined' && pinpontMilesEle != null){
			pinpointMiles = document.getElementById('txtpinpoint_miles').value;
		}
		var data = {
			action: 'pinpoint_frontaction',
			pinpointpostcode: encodeURIComponent(pinpointZipcode),
			pinpointmiles: pinpointMiles,
			performaction: 'search'
		};
		$.post(PinpointAjax.ajaxurl, data, function(response) {
			pinpointSearchHTML = $('#pinpoint_frontdatacontainer').html();
			$('#pinpoint_frontdatacontainer').html(response);
			$('#pinpoint_overlaycontainer').css('display', 'none');
			$('#pinpoint_loader').css('display', 'none');
		});
	});

	$('#pinpoint_reset').live("click", function(){
		$('#pinpoint_frontdatacontainer').html(pinpointSearchHTML);
	});

	$('.pinpoint_storelistsrow').live("click", function(){
		var pinPointRowID = $(this).attr('id');
		var pinPointArr = pinPointRowID.split("_");
		var pinRowId = pinPointArr[1];
		var storeId = $('#txtpinpointrow_'+pinRowId).val();

		$('#pinpoint_overlaycontainer').css('display', 'block');
		$('#pinpoint_loader').css('display', 'block');
		var data = {
			action: 'pinpoint_frontaction',
			pinpointstoreid: storeId,
			performaction: 'resultdetails'
		};
		$.post(PinpointAjax.ajaxurl, data, function(response) {
			pinpointResultList = $('#pinpoint_frontdatacontainer').html();
			$('#pinpoint_frontdatacontainer').html(response);
			$('#pinpoint_overlaycontainer').css('display', 'none');
			$('#pinpoint_loader').css('display', 'none');
		});
	});
});
function backToPinpointSearch(){
	document.getElementById('pinpoint_frontdatacontainer').innerHTML = pinpointSearchHTML;
}
function backToPinpointResultList(){
	document.getElementById('pinpoint_frontdatacontainer').innerHTML = pinpointResultList;	
}