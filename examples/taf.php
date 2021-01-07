<?php

#error_reporting(E_NONE);
/* Load PHP Weather */
require('phpweather.php');

if (isset($_REQUEST['taf']))
    $taf = $_REQUEST['taf'];
  else {
    echo "\nUsing EGUW as default";
    $taf = 'EGUW';
  }

$weather = new phpweather(array('icao' => $taf));
$data = $weather->decode_taf();

echo "<pre>\n";

print_r($data['location']);echo "\t";
print_r($data['taf']);echo "\n";

?>

