<?php

function getWeather($lon, $lat) {  // stockholm lon = 18, lat = 59
	$json = file_get_contents('https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/'.$lon.'/lat/'.$lat.'/data.json');
	$data = json_decode($json, true);
	//print "<pre>";
	//print_r($data);
	//print "</pre>";
	return $data;
}

function getWeatherIcon($data) {
	$iconNumb = $data['timeSeries'][0]['parameters'][18]['values'][0];
	//return $iconNumb;	
	$iconImg = $_SERVER['HTTP_REFERER'] . 'images/' . $iconNumb . '.jpg';
	print "<pre>";
	print "ICON: ".$iconImg;
	print "</pre>";
}

function getYrXML() {
	// explanation of yr.no returning data  http://om.yr.no/verdata/xml/spesifikasjon/
	$xml = simplexml_load_file('http://www.yr.no/place/Sweden/Stockholm/Stockholm/forecast.xml') or die("Error creating xml from yr.no");
	print "<pre>";
	foreach($xml->forecast->tabular->children() as $child) {
		//print_r($child);
		if ($child['period'] == 3) {
			// yr.no symbols @ http://om.yr.no/symbol/
			echo "Symbol: " . $child->symbol['numberEx'] . "<br>";
			echo "<img src=\"https://www.yr.no/grafikk/sym/v2016/png/100/" . $child->symbol['var'] . ".png\"><br>";
			echo "From: " . $child['from'] . "<br>";
			echo "To:   " . $child['to'] . "<br>";
			echo "Period: " . $child['period'] . "<br>";
			echo "Temp: " . $child->temperature['value'] . "<br><br>";
		}
	}
	//print "<pre>";
	//print_r($xml);
	print "</pre>";	
}

$data = getWeather(18, 59);
getWeatherIcon($data);
getYrXML();

?>
