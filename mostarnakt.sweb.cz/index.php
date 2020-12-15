<?php

	// ---- CONFIG ---
	
	$MOSTARNAKT_NEW_URL = 'https://mostarnakt.web.app/';
	$MOSTARNAKT_OLD_URL = 'http://mostarnakt.sweb.cz/www/';
	
	
	// ---- Check new URL ---

	// Create a curl handle to a location
	$ch = curl_init($MOSTARNAKT_NEW_URL);

	// Execute
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_exec($ch);

	// Store return code
	$errno = curl_errno($ch);

	// Close handle
	curl_close($ch);


	// ---- Redirect to new or old url ---

	// Check if any url error occurred with new location
	if ($errno == 0) {
		// no error = new location is ok -> redirect to new location
		header('Location: '.$MOSTARNAKT_NEW_URL, true, 301);
	} else {
		// no error = new location is down -> redirect to old location (failover)
		//echo 'Curl error: ' . $errno;
		header('Location: '.$MOSTARNAKT_OLD_URL, true, 301);
	}


	// ---- DONE - exiting ---

	exit();	
?>