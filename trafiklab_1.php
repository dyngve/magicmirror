<?php

function getLineColor($lineNumber){
	$lineColor;
	if ($lineNumber == '10' || $lineNumber == '11') {
		$lineColor = 'blue';
	}
	else if ($lineNumber == '13' || $lineNumber == '14') {
		$lineColor = 'red';
	}
	else if ($lineNumber == '17' || $lineNumber == '18' || $lineNumber == '19') {
		$lineColor = 'green';
	}
	else {
		$lineColor = 'black';
	}
	return $lineColor;
}

function getSiteId($search) {
	$json = file_get_contents('http://api.sl.se/api2/typeahead.json?key=feeac2aaf96b45668d931227158edae8&searchstring='.$search.'&maxresults=1');
	$data = json_decode($json, true);
	return $data['ResponseData'][0]['SiteId'];
}

function getNextMetroToTown($siteid, $timewindow, $direction) {  // 9181 = Farsta 
	$json = file_get_contents('http://api.sl.se/api2/realtimedeparturesv4.json?key=143da918f43743f39f32e5e82a844108&siteid='.$siteid.'&timewindow='.$timewindow);
	$data = json_decode($json, true);
	$next = $data['ResponseData']['Metros'][0]['DisplayTime'];
	return $next;
}

function getBothNextMetros($siteid, $timewindow) {  // 9181 = Farsta 
	$json = file_get_contents('http://api.sl.se/api2/realtimedeparturesv4.json?key=143da918f43743f39f32e5e82a844108&siteid='.$siteid.'&timewindow='.$timewindow);
	$data = json_decode($json, true);
	print "<pre>";
	print $data['ResponseData']['Metros'][0]['Destination'].": ".$data['ResponseData']['Metros'][0]['DisplayTime']."\n";
	print $data['ResponseData']['Metros'][1]['Destination'].": ".$data['ResponseData']['Metros'][1]['DisplayTime']."\n";
	print "</pre>";
}

function getNextMetros($siteid, $timewindow, $direction) {  // 9181 = Farsta
	$json = file_get_contents('http://api.sl.se/api2/realtimedeparturesv4.json?key=143da918f43743f39f32e5e82a844108&siteid='.$siteid.'&timewindow='.$timewindow);

	$data = json_decode($json, true);

	print "<pre>";
	print "<h1>Tunnelbana</h1>";
	foreach($data['ResponseData']['Metros'] as $line) {
		if ($line['JourneyDirection'] == $direction) {   //preg_match("#^Hässel(.*)$#i",$line['Destination'])) {
			print "Linje : <span style=\"color:".getLineColor($line['LineNumber'])."\">".$line['LineNumber']."</span>\n";
			print "Linjegrupp : ".$line['GroupOfLine']."\n";;
			print "Mot : ".$line['Destination']."\n";
			print "Åker om : ".$line['DisplayTime']."\n";
			$time = new DateTime($line['ExpectedDateTime']);
			$cTime = $time->format('G:i:s');
			print "Åker : ".$cTime."\n\n";
		}
	}
	//print_r($data);
	print "</pre>";
}

getNextMetros('9181','30', 2);  // 1 verkar vara norrut?
print "<h1>Mot stan om: ".getNextMetroToTown('9181','30', 1)."</h1>";
getBothNextMetros('9181','30');
echo getSiteId("Farsta%20(Stockholm)");
?>