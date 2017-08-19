<?php

function getWeather($lon, $lat) {  // stockholm lon = 18, lat = 59
	$json = file_get_contents('https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/'.$lon.'/lat/'.$lat.'/data.json');
	$data = json_decode($json, true);
	print "<pre>";
	print_r($data);
	print "</pre>";
}

getWeather(18, 59);

?>
