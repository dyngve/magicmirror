<<<<<<< HEAD
<?php
//**
// TESTA DENNA
// 
// 		https://openweathermap.org/api
// 
//**

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
	$iconImg = $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . '/magicmirror/images/' . $iconNumb . '.jpg';
	print "<pre>";
	print "ICON: ".$iconImg;
	print "</pre>";
}

function getYrXML() {
	// explanation of yr.no returning data  http://om.yr.no/verdata/xml/spesifikasjon/
	$xml = simplexml_load_file('http://www.yr.no/place/Sweden/Stockholm/Stockholm/forecast.xml') or die("Error creating xml from yr.no");
	print "<pre>";
	foreach($xml->forecast->tabular->children() as $child) {
		if ($child['period'] == 2) {
		print_r($child);
			// yr.no symbols @ http://om.yr.no/symbol/
			echo "<h3>Period: " . $child['period'] . "<br></h3>";
			echo "Symbol: " . $child->symbol['numberEx'] . "<br>";
			echo "<img src=\"https://www.yr.no/grafikk/sym/v2016/png/100/" . $child->symbol['var'] . ".png\"><br>";
			echo "From: " . $child['from'] . "<br>";
			echo "To:   " . $child['to'] . "<br>";
			echo "Temp: " . $child->temperature['value'] . " C.<br><br>";
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
=======
<?php
//**
// TESTA DENNA
// 
// https://openweathermap.org/api
// 
//**

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
	$iconImg = $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . '/magicmirror/images/' . $iconNumb . '.jpg';
	print "<pre>";
	print "ICON: ".$iconImg;
	print "</pre>";
}

function getYrXML() {
	// explanation of yr.no returning data  http://om.yr.no/verdata/xml/spesifikasjon/
	$xml = simplexml_load_file('http://www.yr.no/place/Sweden/Stockholm/Stockholm/forecast.xml') or die("Error creating xml from yr.no");
	print "<pre>";
	foreach($xml->forecast->tabular->children() as $child) {
		if ($child['period'] == 2) {
		print_r($child);
			// yr.no symbols @ http://om.yr.no/symbol/
			echo "<h3>Period: " . $child['period'] . "<br></h3>";
			echo "Symbol: " . $child->symbol['numberEx'] . "<br>";
			echo "<img src=\"https://www.yr.no/grafikk/sym/v2016/png/100/" . $child->symbol['var'] . ".png\"><br>";
			echo "From: " . $child['from'] . "<br>";
			echo "To:   " . $child['to'] . "<br>";
			echo "Temp: " . $child->temperature['value'] . " C.<br><br>";
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
>>>>>>> a5f7342b24b140ce12cf216d362aed802dcfef64
