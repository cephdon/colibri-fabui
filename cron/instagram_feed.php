<?php
require_once '/var/www/lib/config.php';
require_once '/var/www/lib/utilities.php';

if(!file_exists(INSTAGRAM_FEED_JSON)){
	write_file(INSTAGRAM_FEED_JSON, '', 'w');
}

if(!file_exists(INSTAGRAM_HASH_JSON)){
	write_file(INSTAGRAM_HASH_JSON, '', 'w');
}


if (is_internet_avaiable()) {

	$ch = curl_init(INSTAGRAM_FEED_URL);

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$instagram_feed = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);

	if ($info['http_code'] == 200) {
		
		write_file(INSTAGRAM_FEED_JSON, $instagram_feed, 'w');
	}else{
		echo __FILE__.": server unreachable";
	}
	
	
	// ===========================================================
	

	$ch = curl_init(INSTAGRAM_HASH_URL);

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$instagram_hash = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);

	if ($info['http_code'] == 200) {
		write_file(INSTAGRAM_HASH_JSON, $instagram_hash, 'w');
	}else{
		echo __FILE__.": server unreachable";
	}

}else{
	echo  __FILE__."No internet connection";
}
?>
