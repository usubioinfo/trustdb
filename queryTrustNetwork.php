<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);
require("config.php");

// Set headers to allow all origins
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

$accession= $_POST['accession'];

//
$link = mysqli_connect('localhost:3306', DB_USER, DB_PASSWORD) or die('Could not connect to mysql');
$link->set_charset("utf8");
mysqli_select_db($link,'trustdb') or die('Could not select database');

$query = 'SELECT * FROM proteinDescription WHERE accession="'.$accession.'"';
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

$description = "";

while ($lineQueryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$description = $lineQueryResult['description'];
}

mysqli_free_result($result);

if($description == ""){

	$query = 'SELECT * FROM cProteinDescription WHERE accesion="'.$accession.'"';
	$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));


	while ($lineQueryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

		$description = $lineQueryResult['description'];
	}

}

mysqli_free_result($result);

print_r($description);


/*

$query = 'SELECT * FROM ipscan WHERE accesion="'.$accesion.'"';
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($lineQueryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$interpro = $lineQueryResult['interproAcc'];
	print_r($interpro);
	print_r(',');

}
mysqli_free_result($result);

*/

mysqli_close($link);

?>
