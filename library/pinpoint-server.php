<?php
function getPinPointLocatorData($jsonData){ 
	try {
		$args = array(
		    'timeout' => 60,
		    'redirection' => 5,
		    'headers' => array( 'Content-Type' => 'application/json' ),
		    'body' => 
		        json_encode( 
		            $jsonData
		        ),
		    'cookies' => array()                            
		    );
		$response = wp_remote_post( 'https://www.pinpointstorelocator.com/api/pinpoint-plugins.php', $args );
		return json_decode($response['body']);
	}catch(Exception $e) {
		 echo 'Message: ' .$e->getMessage();
		
	}
}
?>