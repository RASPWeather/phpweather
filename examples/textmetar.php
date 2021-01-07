<?php

	// Other METARS for 
	// CAB = EGSC = Cambridge
	// CLL = EGNC = Carlisle
	// COS = EGWC = Cosford
	// CRA = EGYD = Cranwell
	// CLD = EGDR = Culdrose
	// DIF = EGXD = Dishforth
	// ODI = EGVO = Odiham
	// WIT = EGXT = Wittering
	// WSM = EGUW = Wattisham

	if (!isset($_GET['icao'])) {
		$gIcao = 'EGUW'; // default to Wattisham
        } else {
        	$gIcao = $_GET['icao'];
	}

	/* Load PHP Weather */
	require('phpweather.php');

	$weather = new phpweather5();
	
	if (isset($_GET['debug'])) {
		output_metar_debug($gIcao);
	} else { // default to simple output for other apps
		output_metar($gIcao);
	}

// End of main body
// ----------------------------------------------------------------------------
function output_metar($icao)
{

	global $weather;
	$sSeparator = '|';

	$weather->set_icao($icao);
	
	$data = $weather->decode_metar();

	echo $data['icao'].$sSeparator;
	echo $data['wind']['deg'].$sSeparator;
	echo $data['wind']['knots'].$sSeparator;
	echo $data['temperature']['temp_c'].$sSeparator;
	echo $data['temperature']['dew_c'].$sSeparator;
	echo $data['altimeter']['hpa'].$sSeparator;
	echo $data['rel_humidity'].$sSeparator;
	echo $data['time'].$sSeparator;
	echo $data['location'].$sSeparator;
	echo $data['remarks'];
	echo '<br>';
	print_r($data['location']);
	echo "\t";
	print_r($data['metar']);

}
// ----------------------------------------------------------------------------
function output_metar_debug($icao)
{

	global $weather;
	$sSeparator = '|';

	$weather->set_icao($icao);
	
	$data = $weather->decode_metar();
	echo  "<h2>Debugging Info</h2>";

	echo "<pre>";

	echo "\nICAO=".$data['icao'].$sSeparator;
	echo "\nWind Deg=".$data['wind']['deg'].$sSeparator;
	echo "\nWind Kts=".$data['wind']['knots'].$sSeparator;
	echo "\nTemp C=".$data['temperature']['temp_c'].$sSeparator;
	echo "\nDew Pt C=".$data['temperature']['dew_c'].$sSeparator;
	echo "\nQFE=".$data['altimeter']['hpa'].$sSeparator;
	echo "\nRel Hum=".$data['rel_humidity'].$sSeparator;
	echo "\nTime=".$data['time'].$sSeparator;
	echo "\nLocation=".$data['location'].$sSeparator;
	echo "\nRemark=".$data['remarks'];
	echo '<br>';
	print_r($data['location']);
	echo "\n\nMETAR=";
	print_r($data['metar']);
	echo "\n\n";
	print_r($data);
	echo "\n";
	echo "</pre>";
}
// ----------------------------------------------------------------------------
?>